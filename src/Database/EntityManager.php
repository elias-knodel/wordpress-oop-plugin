<?php

namespace SyncManager\Database;

use SyncManager\Interfaces\Entity;
use wpdb;
use WP_Error;

class EntityManager
{
    private wpdb $wpdb;
    private string $table;

    public function __construct(string $entityClass)
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table = $wpdb->prefix . constant($entityClass . '::TABLE_NAME');
    }

    public function create(array $data): int|WP_Error
    {
        $result = $this->wpdb->insert($this->table, $data);

        if ($result === false) {
            return new WP_Error('db_insert_error', 'Could not insert data into the database');
        }

        return $this->wpdb->insert_id;
    }

    public function read(int $id): array|WP_Error
    {
        $result = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM {$this->table} WHERE id = %d", $id));

        if ($result === null) {
            return new WP_Error('db_select_error', 'Could not find the requested data in the database');
        }

        return $result;
    }

    public function update(int $id, array $data): bool|WP_Error
    {
        $result = $this->wpdb->update($this->table, $data, array('id' => $id));

        if ($result === false) {
            return new WP_Error('db_update_error', 'Could not update the data in the database');
        }

        return true;
    }

    public function delete(int $id): bool|WP_Error
    {
        $result = $this->wpdb->delete($this->table, array('id' => $id));

        if ($result === false) {
            return new WP_Error('db_delete_error', 'Could not delete the data from the database');
        }

        return true;
    }

    public function createTable(string $sql): bool|WP_Error
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $result = dbDelta($sql);

        if ($result === false) {
            return new WP_Error('db_create_table_error', 'Could not create the table');
        }

        return true;
    }

    public function dropTable(): bool|WP_Error
    {
        $sql = "DROP TABLE IF EXISTS {$this->table};";
        $result = $this->wpdb->query($sql);

        if ($result === false) {
            return new WP_Error('db_drop_table_error', 'Could not drop the table');
        }

        return true;
    }
}
