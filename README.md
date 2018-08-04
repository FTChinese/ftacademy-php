# Run 

## Local

`php -S localhost:8888 -t public public/index.php`

`npm run build` to put frontend asset in place.

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

`ChromePhp` might send to data casuing `upstream sent too big header while reading response header from upstream` issue. Use it with caution.

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
