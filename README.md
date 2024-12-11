<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Task Management Application

## Setup Instructions

Follow these steps to set up and run the Task Management Application locally.

### Prerequisites

Make sure you have the following installed:
- PHP 8.2 or higher
- Composer
- MySQL or any compatible database
- Node.js and npm
- Laravel CLI

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-repository/task-management.git
   cd task-management
   ```

2. **Install Dependencies**
   Run the following command to install PHP dependencies:
   ```bash
   composer install
   ```
   Then install JavaScript dependencies:
   ```bash
   npm install
   ```

3. **Environment Configuration**
    I have already added .env file to git repository.
   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

   Update the `.env` file with your database credentials and other configurations:
   ```env
   APP_NAME=Task Management
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost

   LOG_CHANNEL=stack
   LOG_DEPRECATIONS_CHANNEL=null
   LOG_LEVEL=debug

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_management
   DB_USERNAME=root
   DB_PASSWORD=

   BROADCAST_DRIVER=log
   CACHE_DRIVER=file
   QUEUE_CONNECTION=sync
   SESSION_DRIVER=file
   SESSION_LIFETIME=120

   SANCTUM_STATEFUL_DOMAINS=localhost
   SESSION_DOMAIN=localhost
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed the Database (Optional)**
   If you have seeders defined, you can populate the database with initial data:
   ```bash
   php artisan db:seed
   ```