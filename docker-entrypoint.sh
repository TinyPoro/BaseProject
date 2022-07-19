#!/bin/bash

set -e
check_error=true

if $check_error ; then
    sh -c "cp /var/www/app/docker/docker.env /var/www/app/.env"

    sh -c "php artisan key:generate"
    sh -c "php artisan migrate"
    sh -c "php artisan db:seed"

    sh -c "chmod 777 -R /var/www/app/storage"
    sh -c "chmod 777 -R /var/www/app/public"

    sh -c "php artisan storage:link"

    exec "$@"
else
    echo 'Exit'
fi
