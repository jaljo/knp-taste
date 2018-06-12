# KNP Taste
## A cooking training for clumsy developpers !

This little application allows logged-in users to browse for cooking courses, so they can improve their cooking skills.
Not to say that developpers are bad at cooking, but you know...

### Prerequisites

This application assumes that you have a runing LAMP environnment with composer installed as a running executable.

### Installation

Clone repository from Github :

```
git clone git@github.com:jaljo/knp-taste.git
```

Install dependencies using composer :

```
composer install
```

Don't forget to update your .env file with your database connection parameters :

```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```

Create database schema:

```
php bin/console doctrine:migrations:migrate
```

Populate course table with fixtures :

```
php bin/console fixtures:load
```

### Testing

Run behat functionnal tests:

```
./vendor/bin/behat
```

Run phpunit functionnal tests:

```
./bin/phpunit
```