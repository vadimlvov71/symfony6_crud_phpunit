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

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

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
2. * composer
  ```sh
  composer install
  ```
3. * run sh init.sh
  ```sh
  sh init.sh
  ```
##### which creates:
* two database: employee and employee_test
* through migrations tables employee are created
* phpunit functional tests run for crude endpoints
##### Feature
###### OPENAPI(Swagger) is used NelmioApiDoc bundle
![изображение](https://github.com/vadimlvov71/symfony6_crud_phpunit/assets/57807117/d5b4e1ae-884a-4f7a-a9a9-89538c9f31f2)


