# обновление городов
php artisan db:seed --class=Cities

#счетчик добавления в изборанное 
php artisan migrate --path=/database/migrations/2020_11_12_091413_post_update.php