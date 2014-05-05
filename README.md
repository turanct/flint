Flint
========================================

A Silex application skeleton.


1. Goals & Accomplishments
----------------------------------------

### Goals
- Domain logic separated from bussiness logic
- TDD/(spec)BDD
- ORM
- Security / Logins / Accounts
- Localisation (YAML)
- Logging
- E-mails
- Caching
- Error Handling / Error reporting to Errbit
- Configuration via YAML file(s)
- Assetic?


2. Getting Started
----------------------------------------

### 1. Clone the repo

```
git clone git@github.com:turanct/flint.git
```

### 2. Install dependencies

```
composer install
```

### 3. Create a config file

```
cp app/config.yml.dist app/config.yml
```

### 4. Create your domain model in `/src`

Use phpspec or phpunit do test your domain model (using tests in `/tests` or `/spec`) and create your domain classes in `/src`. Don't forget to let composer know how to autoload them.

### 5. Create your controller providers

Controller providers should be created in `/app/Controllers`. When that is done, they can be 'mounted' in `/app/Core/ControllersList.php`


3. Doctrine
----------------------------------------

### Create tables

```
php vendor/bin/doctrine orm:schema-tool:create
```


LICENSE
----------------------------------------

This code is released under the MIT license.
