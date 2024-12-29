<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center">
<img src="https://img.shields.io/badge/Livewire-3.0-4c8e9c?logo=livewire&logoColor=white" width="100" />
<img src="https://img.shields.io/badge/Bootstrap%205-5A5A5A?logo=bootstrap&logoColor=white" width="100" />
</p>

# Laravel Blog

A simple blog application built with Laravel 10, Livewire 3, and Bootstrap 5.

## Features

- User authentication
- Blog post creation, editing, and deletion
- Comment system
- Real-time updates and interactions using **Livewire 3** 
- Responsive design using **Bootstrap 5** 
- Built with **Laravel 10** 

## Requirements

- PHP >= 8.1
- Composer
- Laravel 10
- Livewire 3

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/sarrafi-mo/laravel-blog.git
   ```
2. Navigate into the project directory:
   ```bash
   cd laravel-blog
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Install Livewire:
   ```bash
   composer require livewire/livewire
   ```
5. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
6. Generate the application key:
   ```bash
   php artisan key:generate
   ```
7. Run the migrations:
   ```bash
   php artisan migrate
   ```
8. Serve the application:
   ```bash
   php artisan serve
   ```

## Usage

Once the application is set up, you can register, log in, and start creating blog posts. Comments can be added to each post. The Livewire components will ensure real-time interactions without page reloads.

## Contributing

Feel free to fork this project, open issues, or submit pull requests.

## License

This project is licensed under the MIT License.
