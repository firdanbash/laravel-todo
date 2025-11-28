# Laravel Todo App

A modern, reactive Todo List application built with the **Laravel** framework and **Livewire**. This project provides a seamless, single-page application (SPA) feel for managing tasks, complete with authentication and real-time updates.

## 🚀 Features

This application is designed to help users stay organized with a clean and responsive interface.

* **Secure Authentication**: Full user registration and login system.
* **Task Management**: Create, read, update, and delete (CRUD) todo items effortlessly.
* **Status Tracking**: Mark tasks as completed or pending with a single click.
* **Smart Filtering**: Filter your view to see "All", "Pending", or "Completed" tasks.
* **Reactive UI**: Built with **Livewire 3** for dynamic interactions without page reloads.
* **Modern Design**: Styled using **Tailwind CSS 4** and **Flowbite** for a polished, mobile-friendly look.

## 🛠️ Tech Stack

* **Backend**: PHP 8.2+, Laravel Framework 12.x
* **Frontend**: Livewire 3.7, Blade Templates
* **Styling**: Tailwind CSS 4, Flowbite 4
* **Database**: MySQL / SQLite (configurable)

## 🏁 Getting Started

Follow these steps to set up the project locally on your machine.

### Prerequisites

Ensure you have the following installed:
* [PHP](https://www.php.net/) (v8.2 or higher)
* [Composer](https://getcomposer.org/)
* [Node.js](https://nodejs.org/) & NPM

### Installation

1.  **Clone the repository**
    ```bash
    git clone [https://github.com/yourusername/laravel-todo.git](https://github.com/yourusername/laravel-todo.git)
    cd laravel-todo
    ```

2.  **Install Backend Dependencies**
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies**
    ```bash
    npm install
    ```

4.  **Environment Setup**
    Copy the example environment file and configure your database settings:
    ```bash
    cp .env.example .env
    ```
    *Open `.env` and check your database credentials (DB_DATABASE, DB_USERNAME, etc.).*

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Run Database Migrations**
    Create the necessary tables (Users and Todos):
    ```bash
    php artisan migrate
    ```

### Running the Application

This project includes a convenient setup script and commands for development.

**Option 1: Quick Start (Recommended)**
You can start the server, queue listener, and Vite development server all at once:
```bash
composer run dev
