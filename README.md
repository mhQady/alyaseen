# Alyaseen Task App 👋

## Introduction

This is a Laravel-based application that allows users to browse products, categories.

## Features

-   Admin authentication
-   Browse and search products
-   Real-time stock monitoring
-   Admin dashboard for managing products and orders

## Requirements

-   PHP >= 8.2
-   Composer
-   MySQL database

## Installation

### 1. Clone the Repository

```bash
git clone git@github.com:mhQady/alyaseen.git
cd your-repo-name
composer install
php artisan migrate --seed
```

> ⚠️ **Warning:** Make sure to update your `.env` file with the correct credentials.
> ⚠️ **Warning:** You can use `<base-url>/dash/test/notification` to test the low stock notification.
> ⚠️ **Warning:** Dashboard credentials are required. You can use `email: admin@alyaseen.com | password: password`.
