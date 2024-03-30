php artisan db:monitor
php artisan config:cache
php artisan clear-compiled

php artisan migrate
php artisan migrate --path=database/migrations/V1/Hr
php artisan migrate --path=database/migrations/V1


php artisan db:seed
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize:clear
php artisan optimize
php artisan config:cache
php artisan storage:link
