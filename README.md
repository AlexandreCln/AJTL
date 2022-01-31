## AJTL
*Rebuilding a site from scratch for a board games association, made with Symfony 5 &amp; Vue 3.*

## Local development

#### Requirements :

- [PHP >=8](https://www.php.net/downloads.php)

- [Composer](https://getcomposer.org/doc/00-intro.md)

- [MySQL](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/)

- [Yarn](https://classic.yarnpkg.com/lang/en/docs/install/#windows-stable)

#### Installation

run ```composer install```

Creates a *.env.local from* *.env* file.

Configure the *DATABASE_URL* environment variable.

run ```php bin/console doctrine:database:create```

run ```php bin/console doctrine:schema:update --force```

run ```php bin/console doctrine:migrations:migrate```

run ```yarn install```

run ```yarn dev```
