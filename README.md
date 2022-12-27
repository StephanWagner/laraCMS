# laraCMS

laraCMS is a highly customizable Content Management System based on the [Laravel](https://laravel.com/) framework.

---

## Authors

Stephan Wagner, [stephanwagner.me](https://stephanwagner.me), [mail@stephanwagner.me](mail@stephanwagner.me)

---

## Install and Setup

1. Install via composer

    ```bash
    composer create-project stephanwagner/laracms my-app
    ```

2. Navigate to the `htdocs` folder

    ```bash
    cd htdocs
    ```

2. Copy the file `.env.example` to `.env` and adjust database settings

    ```bash
    cp .env.example .env
    ```

3. Generate new app key

    ```bash
    php artisan key:generate
    ```

4. Migrate database

    ```bash
    php artisan migrate
    ```

5. laraCMS is now ready to rock and roll!

    ```bash
    php artisan serve
    ```

    You can login using the `/admin` path: http://127.0.0.1:8000/admin

---

## Development

Run following command within the `htdocs` folder to start the development server:

```bash
php artisan serve
```

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
