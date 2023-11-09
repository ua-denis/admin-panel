## Install to development environment:
You need to install [docker](https://www.docker.com/) and follow next steps:

1. Copy `.env.example` into `.env`;
2. Add next records into your `hosts` file:
   ```
   127.0.0.1 laravel-admin-panel.test
   ```
3. Install docker containers `docker-compose up -d`;
4. Run the following commands:
   ```
   docker-compose exec ws bash
   composer install
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   php artisan storage:link
   npm install
   npm run build
   ```
