FROM ubuntu:latest

# installing python, php and apache
RUN apt-get update \
  && DEBIAN_FRONTEND=noninteractive apt-get install -y python3-pip python3-dev php apache2 \
  && cd /usr/local/bin \
  && ln -s /usr/bin/python3 python \
  && pip3 install --upgrade pip

# install client and scripts
ADD ./client /etc/client/
ADD ./scripts /etc/scripts/
RUN chmod +x /etc/scripts/*.sh
RUN /etc/scripts/setup.sh

RUN rm /var/www/html/*
ADD ./www /var/www/

# provides a writable folder for PHP to save job definitions
RUN mkdir /etc/jobs && cd /etc && chmod -R 777 jobs

EXPOSE 80
CMD apachectl -D FOREGROUND
