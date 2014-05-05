Flint
========================================

A Silex application skeleton.

Requirements
----------------------------------------

- Domain logic separated from bussiness logic
- TDD/(spec)BDD
- ORM
- Security / Logins / Accounts
- Localisation (YAML)
- Logging
- E-mails
- Caching
- Error Handling / Error reporting to Errbit
- Configuration via YAML file(s) [Yaml Config Service Provider](https://github.com/deralex/YamlConfigServiceProvider)


Vagrant
----------------------------------------

- PHP settings
- PHP versions
- xdebug setings
- opcode caching


Doctrine
----------------------------------------

### Create tables

```
php vendor/bin/doctrine orm:schema-tool:create
```
