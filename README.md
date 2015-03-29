Symfony Demo Application
========================

The "Symfony Demo Application" is a reference application created to show how
to develop Symfony applications following the recommended best practices.

Installation
------------

This is a fully-functional Symfony project. If you want to get it running,
you have two alternatives:

### A) Using the Symfony Installer

First, install the [Symfony Installer](https://github.com/symfony/symfony-installer).
Then, download and install the Symfony Demo Application executing this command
anywhere in your system:

```bash
$ symfony demo

# if you're using Windows:
$ php symfony demo
```

### B) Using Git

Alternatively, you can clone this repository using Git. Open up a terminal and
execute the following command:

```bash
$ git clone https://github.com/symfony/symfony-demo
````

Next, [install Composer](http://symfony.com/doc/current/cookbook/composer.html)
(if you haven't done this already), move into the project and use Composer to
download the application dependencies:

```bash
$ cd symfony-demo/
$ composer install
```

Usage
-----

If you have PHP 5.4 or higher, there is no need to configure a virtual host
in your web server to access the application. Just use the built-in web server:

```bash
$ cd symfony-demo/
$ php app/console server:run
```

This will start a web server that's accessible at http://localhost:8000.
It will just sit and wait forever, so don't expect it to finish. You can
quit it later when you want by pressing `Ctrl + c`.

> **NOTE**
>
> If you're using PHP 5.3, configure your web server to point at the `web/`
> directory of the project. For more details, see:
> http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html

You're all done! Now just load up the application in your browser: http://localhost:8000
