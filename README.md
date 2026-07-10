# Social Auth Platform

A production-oriented social media platform built with **Laravel** and **PostgreSQL**, designed to demonstrate secure authentication, relational database modeling, and scalable backend architecture.

## Overview

This project simulates the core functionality of a modern social media application. It focuses on backend engineering practices including authentication, authorization, data relationships, session management, and clean MVC architecture.

Rather than being a simple CRUD application, the system implements real-world concepts commonly found in production web applications.

## Key Features

### Authentication & Security

- Secure user registration
- Session-based authentication
- Authentication middleware
- Password hashing using Laravel Hash
- CSRF protection
- Form validation and request sanitization
- Protected routes

### Social Features

- Public social feed
- Create posts
- Delete own posts
- One user can publish multiple posts
- Like & Unlike system
- Real-time synchronized like counter
- Relationship-based authorization

### Database Design

The application is built using normalized relational database principles.

```
User
 ├── hasMany Posts
 └── hasMany Likes

Post
 ├── belongsTo User
 └── hasMany Likes
```

Laravel Eloquent relationships are used throughout the application to keep queries efficient and maintainable.

## Technical Highlights

- Laravel MVC Architecture
- Eloquent ORM
- PostgreSQL
- Blade Templating
- Session Authentication
- Middleware Authorization
- REST-oriented Controller Design
- Database Relationship Management
- Validation & Error Handling
- Clean Project Structure

## Architecture

```
Browser
      │
      ▼
Laravel Routes
      │
      ▼
Middleware
      │
      ▼
Controller
      │
      ▼
Eloquent ORM
      │
      ▼
PostgreSQL
```

## Backend Skills Demonstrated

- Authentication System Design
- Authorization using Middleware
- Session Management
- CRUD Operations
- Relational Database Modeling
- Eloquent Relationships
- Route Protection
- MVC Pattern
- Form Validation
- Database Migrations
- Clean Code Organization

## Project Status

Current implementation includes:

- User Authentication
- Session Login
- Middleware Protection
- Public Feed
- Personal Posts
- Delete Post
- Like / Unlike
- Synchronized Like Counter

Planned improvements:

- Comment System
- User Profile
- Image Upload
- Notifications
- Feed Pagination

---

**Developed by Putra Rohman**

Backend Developer | Laravel • PHP • PostgreSQL
