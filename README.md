# HR Management System

A simple HR management system built with Laravel API with Sanctum authentication.

---

## Installation

Follow these steps to set up and run the project locally.

### Prerequisites

Make sure you have the following installed on your machine:

- PHP (version 8.2.11 or higher)
- Composer (version 2.6.5 or higher)
- MySQL (version 8.1 or higher)

## Steps

#### Clone the repository
```bash
git clone https://github.com/Araz-Ibrahim/hr-management-api.git
```
#### Navigate to the project directory
```bash
cd your-project
```
#### Install PHP dependencies using Composer
```bash
composer install
```
#### Copy the .env.example file to .env
```bash
cp .env.example .env
```
#### Generate a new application key
```bash
php artisan key:generate
```
#### Update the database credentials in the .env file

#### Setup mail configuration in the .env file

#### Script to Run Database Migrations, Clear Cache and Seed the Database
```bash
bash run.sh
```
#### Start the development server
```bash
php artisan serve
```
