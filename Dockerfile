# Dockerfile
FROM php:7.4-apache

# Configurar puertos expuestos
EXPOSE 80
EXPOSE 443

# Habilitar módulos de Apache comúnmente necesarios
RUN a2enmod mime rewrite headers ssl

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar contenido HTML/PHP a la imagen
# Nota: Esto copia el contenido estático en la imagen
# Si necesitas montar volúmenes dinámicos, deberás usar docker run con -v
COPY ./html /var/www/html

# Asegurar permisos correctos
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Configurar AllowOverride All para /var/www/html
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# (Opcional) Instalar extensiones PHP comunes
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Mantener la política de reinicio (esto es para docker run, no para build)
# Se ejecuta el comando por defecto del contenedor base
