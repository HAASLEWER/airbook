# airbook

After cloning repo:

1. Check Permissions on bootstrap, Storage directories
2. Composer install
3. php artisan key:generate
4. for shceduled tasks, add the following to crontab:
	* * * * * php /PATH/TO/LARAVEL/PROJECT/artisan schedule:run >> /dev/null 2>&1
