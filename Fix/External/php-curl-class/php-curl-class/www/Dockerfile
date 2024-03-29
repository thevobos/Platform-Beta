# Use phusion/baseimage with a specific version as base image.
# Pick a version from the releases page:
# https://github.com/phusion/baseimage-docker/releases
FROM phusion/baseimage:0.11

# Use baseimage-docker's init system.
CMD ["/sbin/my_init"]

# BEGIN Build instructions =============================================================================================

# Install nginx mainline.
# "We recommend that in general you deploy the NGINX mainline branch at all times." - nginx.com
RUN add-apt-repository -y ppa:nginx/development
RUN apt-get update
RUN apt-get -y install nginx
RUN echo "nginx version: $(nginx -v)"
RUN echo '\
server {\n\
    listen 80 default_server;\n\
    listen [::]:80 default_server;\n\
\n\
    root /var/www;\n\
    index index.php;\n\
\n\
    charset utf-8;\n\
\n\
    HTTP_HOST _;\n\
    server_tokens off;\n\
\n\
    location / {\n\
        try_files $uri $uri/ =404;\n\
    }\n\
\n\
    location ~ \.php$ {\n\
        include snippets/fastcgi-php.conf;\n\
        fastcgi_pass unix:/run/php/php7.3-fpm.sock;\n\
    }\n\
}'\
> /etc/nginx/sites-enabled/default
# Fix: "nginx: [emerg] bind() to 0.0.0.0:80 failed (98: Address already in use)".
RUN echo "daemon off;" >> /etc/nginx/nginx.conf

# Install PHP.
RUN add-apt-repository ppa:ondrej/php
# Avoid "debconf: unable to initialize frontend: Dialog" by using DEBIAN_FRONTEND=noninteractive before install command.
RUN DEBIAN_FRONTEND=noninteractive apt-get -y install php7.3-fpm
RUN echo "php version: $(php -v)"

# Add nginx daemon.
RUN mkdir /etc/service/nginx
RUN echo '#!/usr/bin/env bash\nnginx' > /etc/service/nginx/run
RUN chmod +x /etc/service/nginx/run

# Add php-fpm daemon.
RUN mkdir /etc/service/php-fpm
RUN echo '#!/usr/bin/env bash\nservice php7.3-fpm start' > /etc/service/php-fpm/run
RUN chmod +x /etc/service/php-fpm/run

# Add homepage.
ADD index.php /var/www/

# END Build instructions ===============================================================================================

# Clean up APT when done.
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
