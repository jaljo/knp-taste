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

### Configuration

The course view limit per user can be changed in parameters.yml: coursesViewLimit
The number of days a user has to wait before is allowed to view another course can be changed in parameters.yml: daysBeforeLimitDrops

### Testing

Populate course table with fixtures :

```
php bin/console fixtures:load
```

This will create the following users and data:
- "admin@knplabs.com" with password "admin" and ROLE_ADMIN which has already viewed 20 courses and can access others without restrictions
- "user1@knplabs.com" with password "user1" and ROLE_USER which has only viewed 1 course and can therefor access up to 9 courses until restriction applies
- "user2@knplabs.com" with password "user1" and ROLE_USER which has already 10 course and can't view others videos unless he waited 1 day

Run behat functionnal tests:

```
./vendor/bin/behat
```

Run phpunit functionnal tests:

```
./bin/phpunit
```