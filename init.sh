#!/bin/bash
echo "сегодня " `date`
php bin/console doctrine:database:create 
php bin/console doctrine:database:create --env=test
yes | bin/console doctrine:migrations:migrate 
yes | bin/console doctrine:migrations:migrate -e test