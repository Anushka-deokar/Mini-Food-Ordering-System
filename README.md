# 🍽️ Mini Food Ordering System - Laravel

A Laravel-based mini food ordering platform with user and admin login system, CRUD for food items, order management, CSV export, and status tracking.

## 🚀 Features

### 👤 User Panel
- Register/Login (Laravel Breeze)
- Browse food items with price and description
- Add to cart with quantity
- Place orders

### 🔐 Admin Panel
- Admin login
- Create/Update/Delete food items
- View all orders
- Export orders as CSV
- Mark order as `Processing` or `Completed`

## 🛠️ Built With
- Laravel 10
- Laravel Breeze (Authentication)
- MySQL
- Bootstrap / Tailwind
- CSV Export package

## 📦 Setup Instructions

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL

### Installation

```bash
git clone https://github.com/YOUR_USERNAME/mini-food-ordering-laravel.git
cd mini-food-ordering-laravel
cp .env.example .env
composer install
npm install && npm run dev
php artisan key:generate
php artisan migrate
php artisan serve








