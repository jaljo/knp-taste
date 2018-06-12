# KNP Taste
## A cooking training for clumsy developpers !

[todo] description


### Prerequisites

This application assumes that you have a runing LAMP environnment.


### Installation

Clone repository from Github :

...
git clone git@github.com:jaljo/knp-taste.git
...

Install dependencies using composer :

...
composer install
...

Don't forget to update your .env file with your database connection parameters :

...
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
...

Create database schema:

...
php bin/console doctrine:migrations:migrate
...

Populate course database with fixtures :

...
php bin/console fixtures:load
...


### Testing

Run behat functionnal tests:

...
./vendor/bin/behat
...

Run phpunit functionnal tests:

...
[todo]
...