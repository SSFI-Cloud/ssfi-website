# SSFI - Speed Skating Federation of India Website

Official website for the Speed Skating Federation of India (SSFI).

## Project Structure

```
ssfi-website/
├── admin/              # Admin Dashboard
├── public/             # Public Website
├── database/
│   ├── schema.sql      # Database structure + data
│   └── exports/        # Excel exports of all tables
├── docs/               # Documentation
└── README.md
```

## Requirements

- PHP 8.0+
- MySQL 8.0+
- Apache/Nginx web server

## Installation

### 1. Database Setup

```bash
# Create database
mysql -u root -p -e "CREATE DATABASE ssfibharat_dashboard;"

# Import schema and data
mysql -u root -p ssfibharat_dashboard < database/schema.sql
```

### 2. Configure Database Connection

Edit `admin/config/db.php`:

```php
$host = 'localhost';
$dbname = 'ssfibharat_dashboard';
$username = 'your_db_user';
$password = 'your_db_password';
```

### 3. Web Server Configuration

- Point your domain root to the `public/` folder
- Point admin subdomain to the `admin/` folder (e.g., `admin.yourdomain.com`)

### 4. File Permissions

```bash
chmod -R 755 admin/uploads/
chmod -R 755 public/registers/uploads/
```

## Local Development

```bash
# Start PHP development servers
cd admin && php -S localhost:8080
cd public && php -S localhost:8081
```

## License

© Speed Skating Federation of India. All rights reserved.
