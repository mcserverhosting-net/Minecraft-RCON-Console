FROM harbor.internal/proxy/library/php:7.2-apache
ADD app /var/www/html 
EXPOSE 8080
RUN sed -i "s/80/8080/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
#RUN chmod +r stuff