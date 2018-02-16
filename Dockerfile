FROM adilsoncarvalho/php-docker

RUN mkdir /var/log/php-fpm

ENV APPLICATION_ENV Development
ENV OVERRIDE_ON_INIT Yes

RUN apt-get update -y \
  && apt-get install -y \
    libxml2-dev \
    php-soap \
  && apt-get clean -y \
  && docker-php-ext-install soap

COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.conf

# NGINX
RUN rm -rf /etc/nginx/sites-enabled/* && \
    rm -rf /etc/nginx/sites-available/*
COPY docker/nginx/conf.d/* /etc/nginx/sites-available/
RUN ln -s /etc/nginx/sites-available/advanced.conf /etc/nginx/sites-enabled/advanced.conf

WORKDIR /www
COPY app /www
COPY docker/build.sh .
COPY docker/run.sh .

RUN ./build.sh
RUN ./run.sh
