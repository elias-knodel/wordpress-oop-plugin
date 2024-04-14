Sure, here's a basic guide on how to use the `EntityManager` class:

## EntityManager Usage Guide

The `EntityManager` class provides a simple interface for performing CRUD operations (Create, Read, Update, Delete) on a database table in a WordPress multisite environment.

### Initialization

First, you need to create an instance of the `EntityManager` class. The constructor requires one parameter: the name of the table you want to interact with.

```php
$entityManager = new \SyncManager\Database\EntityManager('your_table_name');
```

### Create

The `create` method inserts a new row into the table. It accepts an associative array where the keys are the column names and the values are the corresponding values to be inserted.

```php
$data = [
    'column1' => 'value1',
    'column2' => 'value2',
    // ...
];
$result = $entityManager->create($data);
```

If the operation is successful, the method returns the ID of the inserted row. If not, it returns a `WP_Error` object.

### Read

The `read` method retrieves a row from the table. It accepts the ID of the row to be retrieved.

```php
$id = 1; // Replace with your actual ID
$result = $entityManager->read($id);
```

If the operation is successful, the method returns an associative array representing the row. If not, it returns a `WP_Error` object.

### Update

The `update` method updates a row in the table. It accepts the ID of the row to be updated and an associative array of the data to be updated.

```php
$id = 1; // Replace with your actual ID
$data = [
    'column1' => 'new_value1',
    'column2' => 'new_value2',
    // ...
];
$result = $entityManager->update($id, $data);
```

If the operation is successful, the method returns `true`. If not, it returns a `WP_Error` object.

### Delete

The `delete` method deletes a row from the table. It accepts the ID of the row to be deleted.

```php
$id = 1; // Replace with your actual ID
$result = $entityManager->delete($id);
```

If the operation is successful, the method returns `true`. If not, it returns a `WP_Error` object.

Remember to replace `'your_table_name'`, `1`, `'column1'`, `'value1'`, etc. with your actual table name, ID, column names, and values.
