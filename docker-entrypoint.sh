#!/bin/sh
php /var/www/html/artisan migrate --force
apache2-foreground