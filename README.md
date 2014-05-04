Turanct Silex Application
========================================

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


Questions
----------------------------------------

- Can we extend the `Silex\Application` so that we can assign services and controllers outside of the index.php page?
- How will we structure the framework?

