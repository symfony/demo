EasyAdmin Demo Application
==========================

This project is the official [EasyAdmin][1] Demo application that showcases the
main features of EasyAdmin, a popular admin generator for [Symfony][2] applications.

It's a fork of the [Symfony Demo application][3]. This allows to compare the
manual backend/admin included in Symfony Demo and the backend/admin created with
EasyAdmin.

Requirements
------------

  * PHP 7.3 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements][2].

Installation
------------

Run this command with [Composer][4]:

```bash
$ composer create-project easyCorp/easyadmin-demo my_project
```

Usage
-----

There's no need to configure anything to run the application. If you have
[installed Symfony CLI][5], run this command:

```bash
$ cd my_project/
$ symfony serve
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`
to use the built-in PHP web server or [configure a web server][6] like Nginx or
Apache to run the application.

[1]: https://github.com/EasyCorp/EasyAdminBundle/
[2]: https://symfony.com
[3]: https://github.com/symfony/demo
[4]: https://getcomposer.org/
[5]: https://symfony.com/download
[6]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
