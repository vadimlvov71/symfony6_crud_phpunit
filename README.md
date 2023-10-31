#####  symfony6_crud_phpunit
##### About The Project 
* crud of Employee Entity via JSON
* all crud endpoints covered by phpunit functional tests
* for OPENAPI(Swagger) is used NelmioApiDoc bundle


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
* you can see all 4 crud endpoints:
  
###### OPENAPI(Swagger) is used NelmioApiDoc bundle
![изображение](https://github.com/vadimlvov71/symfony6_crud_phpunit/assets/57807117/47c624ce-ba9f-4ace-9b62-78db6b7236be)



