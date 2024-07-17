# E-Library Laravel 9

Features:
- Book management with category, bookshelf, and publisher data.
- Administrator, Staff, and Member role.
- Book borrowing system
- Various report data for monitoring.

Install:
- Copy this repository
- Install composer dependency
  ```bash
  composer install
  ```
- Create MySQL Database
- Rename .env.example to .env
- Configure env variables for database at .env file
- Generate key
  ```bash
  php artisan key:generate
  ```
- Run migration
  ```bash
  php artisan migrate
  ```
- Run database seeder
  ```bash
  php artisan db:seed
  ```
- Run app
  ```bash
  php artisan serve
  ```

Login with administrator account (administrator@gmail.com | password)
Login with staff account (staff@gmail.com | password)
Login with member account (member@gmail.com | password)