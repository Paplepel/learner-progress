# Learner Progress Dashboard - Coding Challenge

A Laravel application that displays learner progress across enrolled courses with filtering and sorting capabilities.

## Features

- View all learners with their enrolled courses and progress percentages
- Filter learners by course enrollment
- Sort learners by name or average progress
- Clean, responsive user interface

## Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- SQLite3 PHP extension

### Installation

1. Clone the repository:
```bash
git clone https://github.com/Paplepel/learner-progress.git
cd learner-progress
```

2. Install dependencies:
```bash
composer install
```

3. Set up environment configuration:
```bash
cp .env.example .env
```

4. Generate the application key:
```bash
php artisan key:generate
```

5. Run migrations and seed the database:
```bash
php artisan migrate --seed
```

6. Start the development server:
```bash
php artisan serve
```

The application will be available at `http://localhost:8000/learner-progress`

## Usage

Visit `/learner-progress` to view the learner progress dashboard. Use the dropdown controls to:
- **Filter by Course**: Select a specific course to view only learners enrolled in that course
- **Sort**: Choose to sort learners alphabetically by name or by average progress (highest to lowest)

Click "Apply" to apply the selected filters and sorting.
