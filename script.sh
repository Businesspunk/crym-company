#!/bin/bash
# our comment is here
chmod -R 777 storage
rm public/storage -r 
php artisan cache:clear 
php artisan storage:link

