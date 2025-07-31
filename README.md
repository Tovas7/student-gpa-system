# Student Result & GPA Management System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Blade](https://img.shields.io/badge/Blade-F7523F?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?style=for-the-badge&logo=apache&logoColor=white)

A mini web-based application built with Laravel and Blade templates, designed to assist instructors in managing student course scores, calculating letter grades, determining GPA, and displaying a sorted list of students.

## ✨ Features

* **Instructor Authentication:** Secure login and registration for instructors (powered by Laravel Breeze).
* **Student Management:**
    * Add new student records.
    * Edit existing student details and their course scores.
    * Delete student records.
* **Course Score Entry:** Input scores (0-100) for each student per course.
* **Automatic Letter Grade Calculation:** Instantly calculates and displays letter grades (A, B, C, D, F) based on scores.
* **GPA Calculation:** Automatically calculates the Grade Point Average for each student based on all their enrolled courses and scores.
* **Sorted Student List:** Displays a comprehensive list of all students, dynamically sorted by their calculated GPA in descending order.
* **Responsive UI:** Built with Tailwind CSS for a clean and adaptive user interface.

## 🚀 Technologies Used

* **Backend:**
    * Laravel 10.x (PHP Framework)
    * PHP 8.2+
    * MySQL (Database)
* **Frontend:**
    * Laravel Blade (Templating Engine)
    * Tailwind CSS (Utility-first CSS Framework)
    * JavaScript (for dynamic grade updates)
* **Development Tools:**
    * Composer (PHP Dependency Manager)
    * NPM / Yarn (Node.js Package Manager)
    * Vite (Frontend Build Tool)
    * XAMPP (Local Server Environment: Apache, MySQL, PHP)

## 📦 Installation Guide

Follow these steps to get the project up and running on your local machine.

### Prerequisites

Before you begin, ensure you have the following installed:

* **XAMPP:** (or a similar local server environment like Laragon, Valet, Docker with Sail)
    * Apache (for web server)
    * MySQL (for database)
    * PHP (8.2 or higher)
* **Composer:** [Get Composer](https://getcomposer.org/download/)
* **Node.js & npm (or Yarn):** [Download Node.js](https://nodejs.org/en/download/) (npm is included)

### Steps

1.  **Clone the Repository:**
    ```bash
    git clone [https://github.com/Tovas7/student-gpa-system.git](https://github.com/Tovas7/student-gpa-system.git)
    cd student-gpa-system
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Set up Environment File:**
    Create a copy of the `.env.example` file and name it `.env`:
    ```bash
    cp .env.example .env
    ```

4.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Configure Database:**
    Open your `.env` file and update the database credentials. Ensure your MySQL server (via XAMPP) is running.

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=student_gpa_db # You can choose any name
    DB_USERNAME=root         # Your MySQL username (default for XAMPP is 'root')
    DB_PASSWORD=             # Your MySQL password (default for XAMPP is empty)
    ```
    **Important:** Create the database (`student_gpa_db` or your chosen name) in your MySQL server (e.g., using phpMyAdmin accessible via XAMPP control panel).

6.  **Install Frontend Dependencies:**
    ```bash
    npm install # or yarn install
    ```

7.  **Run Database Migrations:**
    This will create all the necessary tables in your database (users, students, courses, student_course pivot).
    ```bash
    php artisan migrate
    ```

8.  **Seed Initial Data (Optional but Recommended):**
    This will create a default user (`test@example.com` with password `password`) and some sample courses.
    ```bash
    php artisan db:seed
    ```

9.  **Start Development Servers:**
    You'll need two separate terminal windows for this:

    * **Terminal 1 (Laravel Server):**
        ```bash
        php artisan serve
        ```
        This will typically run on `http://127.0.0.1:8000`.

    * **Terminal 2 (Vite for Frontend Assets):**
        ```bash
        npm run dev # or yarn dev
        ```
        Keep this running in the background while developing to compile your CSS and JS changes.

## 🚦 Usage

1.  **Access the Application:** Open your web browser and navigate to `http://127.0.0.1:8000`.
2.  **Login/Register:**
    * If you ran `php artisan db:seed`, you can log in with:
        * **Email:** `test@example.com`
        * **Password:** `password`
    * Otherwise, click "Register" to create a new instructor account.
3.  **Navigate to Students:** After logging in, you will see a "Students" link in the navigation bar. Click on it to access the student management interface.
4.  **Manage Students:**
    * Use the "Add New Student" button to create new student records.
    * Click "Edit" next to an existing student to update their details and course scores.
    * Enter scores (0-100) for courses; the letter grade will update dynamically.
    * The main student list will automatically sort students by their calculated GPA.

## 📸 Screenshots

*(Replace this section with actual screenshots of your application)*

* **Login Page:**
    ![Login Page](https://placehold.co/600x400/E0E0E0/000000?text=Login+Page)
* **Student List (Dashboard):**
    ![Student List](https://placehold.co/600x400/E0E0E0/000000?text=Student+List)
* **Add/Edit Student Form:**
    ![Add/Edit Student Form](https://placehold.co/600x400/E0E0E0/000000?text=Student+Form)

## 🤝 Contributing

Contributions are welcome! If you find a bug or have a feature request, please open an issue. If you'd like to contribute code, please fork the repository and create a pull request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE.md).

## 📧 Contact

For any inquiries or feedback, please reach out to:

* **Author:** Tovas7
* **GitHub:** [https://github.com/Tovas7](https://github.com/Tovas7)
* **Email:** raphaeltovas6@gmail.com
