Tracker
============================

Tracker tracks all fresh media info, like movies and games.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources
      components/         contains some important component classes



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


CONFIGURATION
-------------

### Database

Copy the file `.env.example` to `.env` and fill it with real data, for example:

```php
YII_DEBUG=true
YII_ENV=dev

DB_HOST=localhost
DB_NAME=vagrant_catalog
DB_USER=vagrant_catalog
DB_PASS=123456

```

**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.

Also check and edit the other files in the `config/` directory to customize your application.
