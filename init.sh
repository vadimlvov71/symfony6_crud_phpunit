#!/bin/bash
echo "сегодня " `date`
php bin/console doctrine:database:create --env=test
yes | bin/console doctrine:migrations:migrate -e test