# EventMania - Event Management System

## Project Description
A web-based event management system built with PHP, MySQL, HTML, CSS, and JavaScript, running on XAMPP server.

## Project Location
`C:\xampp\htdocs\event-management\`

## File Structure
| File          | Type        | Purpose                     |
|---------------|-------------|-----------------------------|
| index.php     | PHP/HTML    | Main landing page           |
| login.php     | PHP/HTML    | User login system           |
| register.php  | PHP/HTML    | User registration           |
| profile.php   | PHP/HTML    | Profile management          |
| payment.php   | PHP/HTML    | Payment processing          |
| auth.php      | PHP         | Authentication logic        |
| db.php        | PHP         | Database connection         |
| script.js     | JavaScript  | Client-side functionality   |
| style.css     | CSS         | Application styling         |

## System Requirements
- XAMPP (Apache + MySQL + PHP)
- PHP 7.4+
- MySQL 5.7+
- Modern web browser

## Installation
1. Install [XAMPP](https://www.apachefriends.org/download.html)
2. Clone or extract project files to: C:\xampp\htdocs\event-management\
3. Start Apache and MySQL services in XAMPP Control Panel
4. Create database in phpMyAdmin (http://localhost/phpmyadmin)
5. Configure database credentials in: C:\xampp\htdocs\event-management\db.php

## Accessing the Application
After setup, access the application at: http://localhost/event-management/

## Features
- User registration and login
- Profile management
- Event browsing
- Payment processing
- Responsive design

## Troubleshooting
If the application doesn't load:
1. Verify XAMPP services are running
2. Check file permissions in: C:\xampp\htdocs\event-management\
3. Ensure database credentials in db.php are correct
4. Check PHP error logs in XAMPP
