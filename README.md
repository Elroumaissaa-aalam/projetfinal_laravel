# ClinivieApp - Medical Clinic Management System

A comprehensive web application for managing medical clinic operations with role-based dashboards, appointment scheduling, medication management, and communication features.

## Features

### 🏥 Multi-Role System
- **Patient Portal**: View appointments, test results, medications
- **Doctor Dashboard**: Manage patients, review test results, calendar view
- **Nurse Interface**: Schedule appointments, manage medications, order tests
- **Admin Panel**: Full system management and user administration

### 📅 Appointment Management
- Interactive calendar views for all roles
- Real-time appointment scheduling
- Email confirmations via Mailhog
- Surgery and consultation scheduling

### 💊 Medication Management
- Comprehensive medication database
- Prescription management by doctors and nurses
- Patient medication tracking
- Drug interaction and contraindication information

### 🧪 Medical Testing
- Test ordering and scheduling
- Results management with doctor feedback
- Patient access to completed results
- Test status tracking

### 💬 Communication System
- Role-based chat system
- Doctor-nurse-patient communication
- Real-time messaging
- Message read status tracking

### 🎨 Design Features
- **Sky Blue/White/Blue Theme**: Clean, medical-appropriate design
- **Responsive Layout**: Works on desktop, tablet, and mobile
- **Modern UI**: Gradient backgrounds, floating elements, beautiful cards
- **Accessibility**: WCAG compliant design patterns

## Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js and npm
- SQLite (default) or MySQL/PostgreSQL

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd clinivie
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate:fresh
   php artisan db:seed
   ```

5. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

## Demo Accounts

The system comes with pre-configured demo accounts:

| Role | Email | Password |
|------|-------|----------|
| Patient | patient@clinic.com | password |
| Doctor | doctor@clinic.com | password |
| Nurse | nurse@clinic.com | password |
| Admin | admin@clinic.com | password |

## Email Setup (Mailhog)

For development, the system is configured to use Mailhog for email testing:

1. **Install Mailhog**
   ```bash
   # macOS
   brew install mailhog
   
   # Windows (via Go)
   go get github.com/mailhog/MailHog
   
   # Or download binary from GitHub releases
   ```

2. **Start Mailhog**
   ```bash
   mailhog
   ```

3. **Access Mailhog UI**
   - Open http://localhost:8025 to view sent emails

## Database Schema

### Core Tables
- `users` - All system users with role-based access
- `appointments` - Patient appointments and doctor schedules
- `medications` - Medication database with detailed information
- `prescriptions` - Patient medication prescriptions
- `medical_tests` - Test orders and results
- `chat_messages` - Inter-user communication

### Relationships
- Users have role-based relationships (patient-doctor, nurse-patient, etc.)
- Appointments link patients with doctors
- Prescriptions connect patients, doctors, medications, and nurses
- Medical tests involve patients, doctors, and ordering nurses

## API Endpoints

### Dashboard Routes
- `/patient/dashboard` - Patient dashboard
- `/doctor/dashboard` - Doctor dashboard  
- `/nurse/dashboard` - Nurse dashboard
- `/admin/dashboard` - Admin dashboard

### Functional Routes
- `/patient/calendar` - Patient appointment calendar
- `/nurse/medications` - Medication management
- `/doctor/test-results` - Test result reviews
- `/chat` - Communication system

## Technology Stack

- **Backend**: Laravel 11, PHP 8.1+
- **Frontend**: Blade templates, Tailwind CSS, Alpine.js
- **Database**: SQLite (default), MySQL/PostgreSQL support
- **Email**: Laravel Mail with Mailhog integration
- **Assets**: Vite build system
- **Authentication**: Laravel Breeze

## Security Features

- Role-based access control (RBAC)
- CSRF protection
- Email verification
- Secure password hashing
- Input validation and sanitization
- SQL injection prevention

## Development Features

- **Seeders**: Pre-populated with realistic test data
- **Factories**: User and data factories for testing
- **Migrations**: Complete database schema management
- **Responsive Design**: Mobile-first approach
- **Error Handling**: Comprehensive error management

## Customization

### Theme Colors
The system uses a carefully chosen medical color palette:
- **Primary**: Sky Blue (#0ea5e9)
- **Secondary**: Blue (#3b82f6)
- **Accent**: Cyan (#06b6d4)
- **Success**: Green (#10b981)

### Adding New Features
1. Create new migrations for database changes
2. Add corresponding Eloquent models
3. Create controllers with proper validation
4. Build responsive Blade views with consistent styling
5. Add routes with appropriate middleware

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Support

For support and questions, please contact the development team or create an issue in the repository.

---

**ClinivieApp** - Making clinic management simple, efficient, and beautiful.
# projetfinal_laravel
