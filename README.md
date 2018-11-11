# Run on Local Machine

## Install latest PHP

You can install globally with `brew install php` on Mac. Or install php with [phpbrew](https://github.com/phpbrew/phpbrew).

Then install [composer](https://getcomposer.org/doc/00-intro.md) following the offical instructions.

In the root directory of this project, run `composer install` to install all dependencies.

Run command:

```
php -S localhost:8888 -t public public/index.php
```

A server runs on localhost started. Open it in your browser: `http://localhost:8888`


## Documents you need to read

* [Slim](https://www.slimframework.com/) The micro-framework we used. Or you can simply read the source in the `vendor` directory. It's very short.
* [Twig](https://twig.symfony.com/) The template engine we used in this project.

## Deploy with nginx

```
# You must configure and start FPM first.
# With it default settings you can run the command: `php-fpm --fpm-config=/usr/local/etc/php/7.2/php-fpm.conf`
server {
    listen 8090;
    server_name localhost;
    index index.php;
    error_log /Users/niweiguo/logs/fta.error.log;
    access_log /Users/niweiguo/logs/fta.access.log;
    root /Users/niweiguo/ftc-repo/ftacademy/public;
    
    location / {
        try_files $uri /index.php$is_args$args;
    }

    location ~ \.php {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param SCRIPT_NAME $fastcgi_script_name;
        fastcgi_index index.php;
        # This point to the fpm's address on which to accept FastCGI requests.
        # You need to set it expclitely if you don't want to use the default.
        # In you `php-fpm.conf` file, (it might be `php-fpm.d/www.conf` if you installed PHP by Homebrew on Mac),
        # find this section starting with `The address on which to accept FastCGI requests.`
        # Find this line `listen = 127.0.0.1:9000`.
        # Copy and paste the IP and PORT here. They must be consitent.
        # If you want FPM run on another port, change it to another one in both of these two places.
        fastcgi_pass 127.0.0.1:9000;
    }
}
```

Then go to `http://localhost:8090`

## Be careful

`ChromePhp` might send too much data causing `upstream sent too big header while reading response header from upstream` issue. Use it with caution.

# Slim Framework 3 Skeleton Application

Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application.

    php composer.phar create-project slim/slim-skeleton [my-app-name]

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

To run the application in development, you can run these commands 

	cd [my-app-name]
	php composer.phar start

Run this command in the application directory to run the test suite

	php composer.phar test

That's it! Now go build something cool.
