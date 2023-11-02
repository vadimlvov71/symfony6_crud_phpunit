#####  symfony6_crud_phpunit
##### About The Project 
* crud of Employee Entity via JSON
* all crud endpoints covered by phpunit functional tests
* for OPENAPI(Swagger) is used NelmioApiDoc bundle
* PSR 12 standart, except warning: length more than 120 charactrers
  ##### only file src/Controller/EmployeeApiController.php

##### Built With

*  symfony 6.1
*  phpunit
*  OPENAPI: "nelmio/api-doc-bundle"

<!-- GETTING STARTED -->
##### Getting Started

##### Prerequisites
* php 8.1
* Mysql

##### Installation

1. Clone the repo
   ```sh
   git clone git@github.com:vadimlvov71/symfony6_crud_phpunit.git
   ```
   or
    ```sh
   git clone https://github.com/vadimlvov71/symfony6_crud_phpunit.git
   ```
2. Composer
  ```sh
  composer install
  ```
3. Run init.sh
  ```sh
  sh init.sh
  ```
##### which creates:
* two database: employee and employee_test
* through migrations tables employee are created

##### PHPUnit testing:

* phpunit functional tests run for crude endpoints
* run phpunit
  ```sh
  php bin/phpunit
  ```
  * but if you don\`t comment testDelete function any records aren\`t be shown in test database`s table 'employee'
##### Feature
* http://localhost:82/api/doc
* you can see all 5 crud endpoints:
  
###### OPENAPI(Swagger) is used NelmioApiDoc bundle
![изображение](https://github.com/vadimlvov71/symfony6_crud_phpunit/assets/57807117/eabdfd97-43ca-4789-94f3-3b7725cdb7de)




