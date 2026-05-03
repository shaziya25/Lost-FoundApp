FROM php:8.2-apache

# Enable Apache rewrite (important for PHP apps)
RUN a2enmod rewrite

# Copy project files to server root
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 80