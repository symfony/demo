FROM php:7.4-cli

#Update packages 
RUN apt-get update \
  && apt-get install -y libzip-dev git wget --no-install-recommends \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
 
#RUN docker-php-ext-install pdo mysqli pdo_mysql zip;

RUN wget https://get.symfony.com/cli/installer -O - | bash

#Move the binary to the local bin directory
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

#Setting up git authentication
RUN git config --global user.email "harold.lopez@somoglobal.com" \ 
    && git config --global user.name "Harold L."

#Install simfony composer to build the pro
RUN wget https://getcomposer.org/download/2.1.8/composer.phar \ 
    && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer


#Copy the apache configuration files and copy everything to /var/wwww
COPY . /var/www

#Switch the working directory
WORKDIR /var/www/symfony

#Create the project 
RUN /usr/local/bin/symfony new --demo my_project

#Set the working directory
WORKDIR  /var/www/symfony/my_project/

#Run the application
CMD ["/usr/local/bin/symfony","serve"]
