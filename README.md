Wellpers
========================

1) Installation
---------------

### a) Clone the git Repository

Run the following commands:

    git clone https://github.com/wellpers/wellpers.git

Once you've downloaded the standard edition, installation is easy, and basically
involves making sure your system is ready for Symfony.

### b) Install the Vendor Libraries

    sudo apt-get install curl
    curl -s http://getcomposer.org/installer | php
    php composer.phar update

### c) parameters.yml
touch app/config/parameters.yml

and add
```
parameters:
    database_driver:   TheDatabaseDriver
    database_host:     TheDatabaseHost
    database_port:     TheDatabasePort
    database_name:     TheDatabaseName
    database_user:     TheDatabaseUser
    database_password: TheDatabasePassword

    mailer_transport:  smtp
    mailer_host:       localhost
    mailer_user:       ~
    mailer_password:   ~

    locale:            fr
    secret:            ThisTokenIsNotSoSecretChangeIt
