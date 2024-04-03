# HR Management System

A simple HR management system built with Laravel API with Sanctum authentication.

---

## Installation

Follow these steps to set up and run the project locally.

### Prerequisites

Make sure you have the following installed on your machine:

- Laravel (version 10)
- PHP (version 8.2.11 or higher)
- Composer (version 2.6.5 or higher)
- MySQL (version 8.1 or higher)

---

## Steps

#### 1. Clone the repository
```bash
git clone https://github.com/Araz-Ibrahim/hr-management-api-v2.git
```
#### 2. Navigate to the project directory
```bash
cd your-project
```
#### 3. Install PHP dependencies using Composer
```bash
composer install
```
#### 4. Copy the .env.example file to .env
```bash
cp .env.example .env
```
#### 5. Generate a new application key
```bash
php artisan key:generate
```
#### 6. Update the database credentials in the .env file

#### 7. Setup mail configuration in the .env file

#### 8. Script to Run Database Migrations, Clear Cache and Seed the Database
```bash
bash run.sh
```
#### 9. Start the development server
```bash
php artisan serve
```
---

### Database File

- **File Path**: `root/migrations/data/database.sql`
- **Link**: [database.sql](https://github.com/Araz-Ibrahim/hr-management-api-v2/blob/main/database/data/database.sql)

### Postman Collection

- **File Path**: `root/postman/v1.postman_collection.json`
- **Link**: [v1.postman_collection.json](https://github.com/Araz-Ibrahim/hr-management-api-v2/blob/main/postman/v1.postman_collection.json)

### Postman API Documentation 

- **Link**: [API Documentation](https://documenter.getpostman.com/view/25810383/2sA35G4N2V)



