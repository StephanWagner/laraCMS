# laraCMS

A highly customizable Content Management System based on the [Laravel](https://laravel.com/) framework.

---

## Authors

Stephan Wagner, [stephanwagner.me](https://stephanwagner.me), [mail@stephanwagner.me](mail@stephanwagner.me)

---

## Install and setup

1. Install with [composer](https://getcomposer.org)

    ```bash
    composer create-project stephanwagner/laracms my-app
    ```

2. Update database connection in file `htdocs/.env`

    ```txt
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laracms
    DB_USERNAME=root
    DB_PASSWORD=
    ```

3. Migrate database

    ```bash
    php artisan migrate
    ```

4. laraCMS is now ready to rock and roll!

    ```bash
    php artisan serve
    ```

    You can login using the `/admin` path: http://127.0.0.1:8000/admin

---

## Assets

SCSS and JS files are in the folder `htdocs/resources/src`. To watch or build assets use the following bash commands within the `htdocs` folder:

Watch assets during development:

```bash
npm run watch
```

Build assets for production:

```bash
npm run build
```

laraCMS uses [https://gulpjs.com](gulp) to compile assets.

---

## Deployment

The document root of the hosting should point to the `htdocs/public` folder.
