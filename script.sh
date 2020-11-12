#!/bin/bash
# our comment is here
chmod -R 755 storage
rm -r public/storage
php artisan cache:clear 
php artisan storage:link

