> [!CAUTION]
> There are too many components I would need to write from scratch. Hence, in my second approach,  
> I used the Symfony Components, which are by default standalone and usable: [elias-knodel/wordpress-x-symfony](https://github.com/elias-knodel/wordpress-x-symfony)

# wordpress-oop-plugin

WordPress OOP attempts and best practices.

## Development

1. Install Composer Dependencies

```shell
composer install
```

2. Start Local Instance

```shell
docker compose up -d
```

3. Install Composer Dependencies

```shell
docker compose exec wordpress composer install
```

4. Go to `http://localhost:8080` and install WordPress and change permalink settings OR

5. Wait until you see the installation page and then execute these two commands

```shell
docker compose run --rm --remove-orphans wpcli core install --url="localhost:8000" --title="Local WordPress" --admin_user="admin" --admin_password="admin" --admin_email="admin@example.com"
```

```shell
docker compose run --rm --remove-orphans wpcli option update permalink_structure '/%postname%/'
```

### Other Commands

1. Stop Local Instance

```shell
docker compose down
```

2. If you want you can easily reset the database

```shell
docker compose down -v
```

## Description

- All the code is an example of how you would implement modern Software architecture with WordPress.
- It uses the Rest API, a Serializer and more to allow easy synchronization between an extern and the WP Intern
  Database.
- Goal is to make this something like a boilerplate for future projects.
- Because it's just a boilerplate and under the MIT license, you can use it freely as a starting point for your own
  projects.

### (Planned) Features and Inspiration

- Backend Settings for api mappings
- Queue system to sync something again / back if a job has failed
- Serializer for easier work with woocommerce.
    - Example: Receiving a product as json and converting it to a WC_Product / saving it to the database.
