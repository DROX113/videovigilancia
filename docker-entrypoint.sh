#!/bin/sh
php /var/www/html/artisan config:clear
php /var/www/html/artisan migrate --force
apache2-foreground