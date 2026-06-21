# BRGY 587 Iskolar iApply: A Barangay Scholarship Application System

A web-based scholarship application and management platform for barangay residents, administrators, and super administrators. The system helps residents discover scholarship programs, submit application requirements, and track application status, while barangay staff can verify residency, manage scholarship programs, review applications, and publish announcements.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [User Roles](#user-roles)
- [Tech Stack](#tech-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Environment Configuration](#environment-configuration)
- [Running the Application](#running-the-application)
- [Database Seeders and Demo Accounts](#database-seeders-and-demo-accounts)
- [Testing](#testing)
- [Project Structure](#project-structure)
- [Core Workflows](#core-workflows)
- [Useful Commands](#useful-commands)
- [Contributing Notes](#contributing-notes)

---

## Overview

The **BRGY 587 Iskolar iApply: Barangay Scholarship Application System** is designed to digitize the scholarship application process at the barangay level. It supports public scholarship browsing, resident account verification, dynamic scholarship requirement forms, application review, admin management, notifications, and audit logging.

The application is built with Laravel, Livewire, Flux UI, and Tailwind CSS, providing a modern server-driven interface without requiring a separate frontend framework.

---

## Features

### Public Pages

- Home page with featured scholarships and announcements
- About page
- FAQs page
- Contact page
- Public scholarship listing
- Scholarship details page

### Resident Features

- Account registration and login
- Email verification through Laravel Fortify
- Resident dashboard
- Residency verification document upload
- Browse available scholarship programs
- Apply to scholarships once residency is verified
- Dynamic multi-step application form based on scholarship requirements
- Upload required documents for applications
- Prevent duplicate applications for the same scholarship
- View application status updates
- Receive application status notifications

### Admin Features

- Admin dashboard with statistics
- View pending residency verification requests
- Approve or reject resident verification submissions
- Review pending scholarship applications
- Approve or reject applications with remarks
- Automatic scholarship slot updates when applications are approved
- Manage scholarship programs
- Create, edit, and delete scholarship requirements
- Manage announcements

### Super Admin Features

- Create admin accounts
- Edit admin account information
- Reset admin passwords
- Delete admin accounts with password confirmation
- Maintain at least one admin account
- View and store admin management audit logs

### System Features

- Role-based route protection
- Email verification enforcement
- Residency verification gate before scholarship application
- Admin approval gate before admin panel access
- Application status logs
- Database notifications
- File uploads for verification and scholarship requirements
- Seeded demo data for development and presentation

---

## User Roles

| Role | Description |
| --- | --- |
| `user` | Barangay resident/applicant. Can verify residency and apply for scholarships. |
| `admin` | Barangay staff. Can verify residents, manage scholarships, review applications, and post announcements. |
| `superadmin` | Highest-level administrator. Can manage admin accounts and access admin functionality. |

---

## Tech Stack

- **Backend:** Laravel 13
- **PHP:** ^8.5
- **Frontend:** Livewire 4, Flux UI, Blade
- **Styling:** Tailwind CSS 4
- **Authentication:** Laravel Fortify
- **Passkeys:** Laravel Passkeys
- **Database:** PostgreSQL recommended
- **Testing:** Pest PHP, PHPUnit
- **Static Analysis:** Larastan / PHPStan
- **Code Style:** Laravel Pint
- **Build Tool:** Vite

---

## Requirements

Before installing, make sure the following are available on your machine:

- PHP 8.5 or higher
- Composer
- Node.js and npm
- PostgreSQL
- Git

Optional but recommended:

- A local mail testing tool or SMTP credentials
- Laravel Sail, Herd, Valet, or another local PHP development environment

---

## Installation

Clone the repository:

```bash
git clone https://github.com/king-oyster-pumpkin-soup-seasonings/barangay-scholarship-application-system.git
cd barangay-scholarship-application-system
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create your environment file:

```bash
cp .env.example .env
```

Generate an application key:

```bash
php artisan key:generate
```

Create the storage symlink for uploaded files:

```bash
php artisan storage:link
```

Run migrations:

```bash
php artisan migrate
```

Seed demo data:

```bash
php artisan db:seed
```

Build frontend assets:

```bash
npm run build
```

---

## Environment Configuration

Update your `.env` file with your local database credentials.

Example PostgreSQL configuration:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=barangay_scholarship
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

The project also uses database-backed sessions, queues, and cache by default:

```env
SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

For local development, you may use a log or array mail driver if SMTP is not configured:

```env
MAIL_MAILER=log
```

For production or real email testing, configure SMTP credentials in `.env`.

---

## Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

In another terminal, start Vite:

```bash
npm run dev
```

Then open the application in your browser:

```text
http://localhost:8000
```

You can also use the project development script:

```bash
composer run dev
```

This starts the Laravel server, queue listener, and Vite development server together.

---

## Database Seeders and Demo Accounts

Running the database seeders creates demo users, scholarships, announcements, applications, and verification data.

```bash
php artisan db:seed
```

### Demo Login Accounts

| Role | Email | Password |
| --- | --- | --- |
| Super Admin | `superadmin@brgyscholarship.net` | `password123` |
| Approved Admin | `iwakura@brgyscholarship.net` | `password123` |
| Pending Admin | `dantegulapa@brgyscholarship.net` | `password123` |
| Verified Resident | `nobitski123@email.com` | `password123` |
| Verified Resident | `mariabatumbakal@yahoo.com` | `password123` |
| Rejected Resident | `raul@hacker.net` | `password123` |

> These accounts are intended for local development, testing, and demonstration only. Change or remove them before deploying to production.

---

## Testing

Run the application test suite:

```bash
php artisan test
```

Run the full project quality check:

```bash
composer test
```

The full test script includes:

- Configuration clearing
- Laravel Pint style check
- PHPStan/Larastan static analysis
- Pest/PHPUnit tests

### Testing Database

The `phpunit.xml` file is configured for a PostgreSQL testing database:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=barangay_scholarship_test
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

Make sure the test database exists before running tests.

---

## Project Structure

```text
app/
├── Actions/                  # Business actions for admin, application, and verification workflows
├── Http/
│   ├── Middleware/           # Role, resident verification, and admin approval middleware
│   └── Responses/            # Custom Fortify login/register responses
├── Livewire/
│   ├── Admin/                # Admin dashboard, applications, scholarships, announcements, verifications
│   ├── Pages/                # Public and resident-facing Livewire pages
│   └── Superadmin/           # Super admin admin-management page
├── Models/                   # Eloquent models
├── Notifications/            # Email/database notifications
└── Providers/                # App and Fortify service providers

database/
├── migrations/               # Database schema
├── seeders/                  # Demo and default data seeders
└── factories/                # Model factories

resources/
├── views/                    # Blade and Livewire views
├── css/                      # Application CSS
└── js/                       # Application JavaScript

routes/
├── web.php                   # Main web routes
└── settings.php              # Authenticated settings routes

tests/
├── Feature/                  # Feature tests
└── Unit/                     # Unit tests
```

---

## Core Workflows

### Resident Scholarship Application Flow

1. Resident registers an account.
2. Resident verifies their email.
3. Resident submits residency verification documents.
4. Admin reviews the residency verification request.
5. Once verified, the resident can apply to available scholarships.
6. Resident completes dynamic scholarship requirements and uploads files.
7. Admin reviews the submitted application.
8. Resident receives status updates when the application is approved or rejected.

### Admin Verification Flow

1. Admin opens pending residency verifications.
2. Admin reviews uploaded documents.
3. Admin approves or rejects the request.
4. The resident user record is updated with the corresponding verification status.

### Scholarship Management Flow

1. Admin creates a scholarship program.
2. Admin defines eligibility questions, document requirements, and additional fields.
3. Residents see the dynamic application form generated from these requirements.
4. Application answers and uploaded files are stored per requirement.

### Application Review Flow

1. Admin views pending scholarship applications.
2. Admin reviews applicant information, requirements, answers, and uploaded documents.
3. Admin approves or rejects the application.
4. The application status is logged.
5. If approved, scholarship slots are decremented.
6. If no slots remain, the scholarship status becomes `full`.

---

## Useful Commands

Install all dependencies and prepare the app:

```bash
composer run setup
```

Start local development services:

```bash
composer run dev
```

Run migrations:

```bash
php artisan migrate
```

Refresh the database and seed demo data:

```bash
php artisan migrate:fresh --seed
```

Run tests:

```bash
php artisan test
```

Format PHP code:

```bash
vendor/bin/pint
```

Run static analysis:

```bash
vendor/bin/phpstan analyse
```

Build production frontend assets:

```bash
pnpm run build
```


---

## Main Routes

| Route | Description |
| --- | --- |
| `/` | Public home page |
| `/about` | About page |
| `/faqs` | FAQs page |
| `/contact` | Contact page |
| `/scholarships` | Scholarship listing |
| `/scholarships/{scholarship}` | Scholarship details |
| `/dashboard` | Resident dashboard |
| `/verification` | Resident verification page |
| `/scholarships/{scholarship}/apply` | Scholarship application form |
| `/admin/dashboard` | Admin dashboard |
| `/admin/verifications` | Residency verification management |
| `/admin/applications` | Scholarship application review |
| `/admin/scholarships` | Scholarship management |
| `/admin/announcements` | Announcement management |
| `/superadmin/admins` | Super admin admin-management page |

---

## Contributing Notes

When working on this project:

- Follow the existing Laravel, Livewire, and Blade conventions in the codebase.
- Keep business logic in actions where possible.
- Reuse existing components and layouts before creating new ones.
- Add or update tests for any behavior changes.
- Run formatting before committing PHP changes.
- Avoid committing real credentials or production data.

Recommended pre-commit checks:

```bash
vendor/bin/pint
php artisan test
```

---

## License

This project is currently WIP for the Barangay Scholarship Application System. Will update this section if a formal license is added.
