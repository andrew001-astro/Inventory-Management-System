## NEED TO INSTALL
- node.js v16.15.1
- npm 9.3.1
- XAMPP v7.4.33
- Composer version 2.5.1
- Git Bash CLI


## HOW TO SETUP
```
- create a database in phpmyadmin named `ims_db`

- clone project
$ git clone https://github.com/andrew001-astro/Inventory-Management-System.git

- go to project dir
$ cd inventory-management-system
$ composer update
$ npm install
$ npm run dev
$ php artisan key:generate
$ php artisan migrate:refresh --seed
$ php artisan route:cache

- run to serve the project
$ PORT=9001
$ sudo php artisan serve --host 192.168.56.101 --port ${PORT}

- access via browser
localhost:9001

- Click register to register an account

```