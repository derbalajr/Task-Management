# Task Management Project

This is a Laravel project for managing tasks.

## Getting Started

Follow these steps to set up and run the project locally.

### Prerequisites

- Composer (https://getcomposer.org/)
- Node.js and npm (https://nodejs.org/)

### Installation

```bash
# Clone the repository
git clone https://github.com/your-username/task-management.git

# Navigate to the project directory
cd task-management

# Install Composer dependencies
composer install

# Copy the .env.example file to .env
cp .env.example .env

# Update the .env file with your database credentials

# Generate an application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Install npm packages and compile assets
npm install && npm run dev

# Start the Laravel development server
php artisan serve
