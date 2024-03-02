
# Instagram Clone Project

## Overview

This project is a feature-rich Instagram clone developed using Laravel 10, encompassing essential Laravel components such as migrations, Blade templates, controllers, models, routes, ORM (Eloquent), and Breeze for authentication. Furthermore, the Overtrue/Laravel-Follow and Overtrue/Laravel-Like packages have been seamlessly integrated to enhance the follow and like functionalities.

## Team Members

Meet the talented individuals who contributed to this project:

- [William George](https://www.linkedin.com/in/williamgeorge97/)
- [Ahmed Sobhi](https://www.linkedin.com/in/ahmeds0bhi)
- [Neamatullah Mustafa](https://www.linkedin.com/in/neamatullah-abo-lila-b325a9203?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app)
- [Nada Saeed](https://www.linkedin.com/in/nada-said-81ab31220?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app)
- [MennaTullah Ashraf](https://www.linkedin.com/in/mennatallahashraf?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app)
- [Sara Eldabaa](https://www.linkedin.com/in/sarah-e-6b45a810a/)

## Table of Contents


- [Installation](#installation)
- [Features](#features)
- [Usage](#usage)
  - [1. User Authentication and Authorization](#1-user-authentication-and-authorization)
  - [2. Post Management](#2-post-management)
  - [3. Interactive Features](#3-interactive-features)
  - [4. Media Support](#4-media-support)
  - [5. User Profiles](#5-user-profiles)
  - [6. Follow System](#6-follow-system)
  - [7. Blocking Feature](#7-blocking-feature)
  - [8. Editable User Data](#8-editable-user-data)
  - [9. Editable Posts](#9-editable-posts)
  - [10. Tagging System](#10-tagging-system)
- [Contributing](#contributing)

## Installation

- `git clone https://github.com/WilliamGeorge1997/InstagramClone.git`
- `cd InstagramClone`
- `composer install`
- `npm install`
- `cp .env.example .env`
- `php artisan storage:link`
- `php artisan queue:work`
- `php artisan key:generate`
- `npm run dev`
- `php artisan serve`

## Usage
1.  Register for a new account.
2.  Verify email using https://mailtrap.io/ using Email: gram28319@gmail.com & Password: instagramClone123 
3.  Log in with your new account.
4.  Explore the Instagram clone functionalities such as posting images, liking, commenting, and following other users.

## Features

### 1. User Authentication and Authorization

- **Secure Authentication:**
  - Utilizes Laravel Breeze for secure user registration and authentication.
  - Users can register, log in, and log out with ease.

- **Authorization:**
  - Implements access control to ensure users can only edit their own data and posts.

### 2. Post Management

- **Create, Edit, and Delete:**
  - Users can create, edit, and delete their posts.
  - Editable posts ensure users can refine their content over time.

- **Rich Content Support:**
  - Posts can include a mix of images and videos for a dynamic user experience.

### 3. Interactive Features

- **Like and Unlike:**
  - Users can like and unlike posts seamlessly using the Overtrue/Laravel-Like package.
  - Liked posts are highlighted, providing instant feedback to users.

- **Commenting:**
  - Allows users to leave comments on posts, fostering engagement and interaction.

- **Save Post for Later:**
  - Users can save posts for later viewing.

### 4. Media Support

- **Image and Video Uploads:**
  - Posts support both images and videos, enabling a multimedia-rich environment.

### 5. User Profiles

- **Personalized Profiles:**
  - Each user has a dedicated profile page showcasing their avatar, username, full name, bio, gender and additional details.

### 6. Follow System

- **Follow and Unfollow:**
  - Utilizes Overtrue/Laravel-Follow for implementing a seamless follow system.
  - Users can follow and unfollow each other easily.

### 7. Blocking Feature

- **User Blocking:**
  - Users can block each other to prevent interaction and content visibility.
  - Blocked users' content is hidden from the blocker's timeline.

### 8. Editable User Data

- **Profile Information Editing:**
  - Users can edit their gender, email, phone, avatar, username, bio, and password.

### 9. Editable Posts

- **Post Content Editing:**
  - Users can edit the caption of their own posts, allowing for corrections or updates.

### 10. Tagging System

- **Tagging Posts:**
  - Posts can be tagged with relevant keywords or topics.
  - A dedicated tag page displays posts related to specific tags, enhancing content discovery.

## Contributing

We welcome contributions! If you have any ideas, bug fixes, or improvements, please open an issue or submit a pull request.
