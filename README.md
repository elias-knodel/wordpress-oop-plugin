# wordpress-oop-plugin

WordPress OOP attempts and best practices.

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
