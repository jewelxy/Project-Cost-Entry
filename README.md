# Project Cost Management System

## Table of Contents
- [Introduction](#introduction)
- [Technologies Used](#technologies-used)
- [Features](#features)
- [Database Schema](#database-schema)
- [API Endpoints](#api-endpoints)
- [Frontend Code Overview](#frontend-code-overview)
- [Installation Guide](#installation-guide)
- [Usage Guide](#usage-guide)
- [Future Enhancements](#future-enhancements)
- [Conclusion](#conclusion)

## Introduction
The **Project Cost Management System** is a web-based application designed to efficiently manage project costs. Users can add project costs, associate them with customers and projects, and track cost details. The system includes real-time data updates, a dynamic table, and skeleton loading for an improved user experience.

---

## Technologies Used
### Frontend
- **React.js** (Functional Components & Hooks)
- **Tailwind CSS** (UI Styling)
- **Axios** (API Calls)
- **React Select** (Dropdowns)
- **React Toastify** (Notifications)

### Backend
- **Laravel 10** (REST API Development)
- **MySQL** (Database)
- **Eloquent ORM** (Database Management)
- **Laravel Migrations & Seeders**

---

## Features
### Frontend Features
- Dynamic form for adding project costs
- Dropdowns to select customers and projects
- Real-time data updates after form submission
- Skeleton loaders for enhanced UX
- Responsive and modern UI using Tailwind CSS
- Toast notifications for success and error messages

### Backend Features
- RESTful API for managing project costs
- Database migrations for structured data management
- Eloquent relationships for optimized queries
- Secure input validation using Laravel
- Unique Tracking ID generation

---

## Database Schema
### **tbl_customer**
| Column       | Type             | Constraints |
|-------------|-----------------|-------------|
| id          | BIGINT (PK)      | Auto-increment |
| name        | VARCHAR(255)     | NOT NULL |
| phone       | VARCHAR(20)      | NOT NULL |
| email       | VARCHAR(255)     | UNIQUE |
| company     | VARCHAR(255)     | NOT NULL |
| address     | TEXT             | NOT NULL |
| created_at  | TIMESTAMP        | Default CURRENT_TIMESTAMP |
| updated_at  | TIMESTAMP        | Default CURRENT_TIMESTAMP |

### **tbl_project**
| Column          | Type         | Constraints |
|----------------|-------------|-------------|
| id             | BIGINT (PK)  | Auto-increment |
| name           | VARCHAR(255) | NOT NULL |
| projectdescription | TEXT  | NOT NULL |
| customer_id    | BIGINT (FK)  | References tbl_customer(id) ON DELETE CASCADE |
| created_at     | TIMESTAMP    | Default CURRENT_TIMESTAMP |
| updated_at     | TIMESTAMP    | Default CURRENT_TIMESTAMP |

### **tbl_project_cost**
| Column        | Type           | Constraints |
|--------------|---------------|-------------|
| id           | BIGINT (PK)    | Auto-increment |
| customer_id  | BIGINT (FK)    | References tbl_customer(id) ON DELETE CASCADE |
| project_id   | BIGINT (FK)    | References tbl_project(id) ON DELETE CASCADE |
| cost         | DECIMAL(10,2)  | NOT NULL |
| tracking_id  | VARCHAR(255)   | UNIQUE |
| created_by   | BIGINT         | Nullable |
| updated_by   | BIGINT         | Nullable |
| created_at   | TIMESTAMP      | Default CURRENT_TIMESTAMP |
| updated_at   | TIMESTAMP      | Default CURRENT_TIMESTAMP |

---

## API Endpoints
### **Customer Management**
- `GET /api/customers` - Fetch all customers

### **Project Management**
- `GET /api/projects/{customer_id}` - Fetch projects for a specific customer

### **Project Cost Management**
- `POST /api/project-cost` - Add a new project cost
- `GET /api/project-cost` - Fetch all project costs

---

## Frontend Code Overview
### **Components**
- `ProjectCostEntry.js` - Handles the form and submission of project costs
- `ProjectCostTable.js` - Displays the project cost data in a table with real-time updates

### **Key Features in Code**
- Uses `useState` and `useEffect` hooks for state management
- `axios` for API requests
- `react-toastify` for notifications
- Skeleton loading when fetching data
- Dynamic form with `react-select` dropdowns

---

## Installation Guide
### **Backend Setup (Laravel 10)**
1. Clone the repository:  
   ```bash
   git clone https://github.com/jewelxy/Project-Cost-Entry
   cd Laravel RESTful API
   ```
2. Install dependencies:  
   ```bash
   composer install
   ```
3. Configure `.env`:  
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=project_cost_entry
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Run migrations and seeders:  
   ```bash
   php artisan migrate --seed
   ```
5. Start the Laravel server:  
   ```bash
   php artisan serve
   ```

### **Frontend Setup (React.js)**
1. Navigate to the frontend directory:  
   ```bash
   cd React Tailwind
   ```
2. Install dependencies:  
   ```bash
   npm install
   ```
3. Configure environment variables in `.env`:  
   ```ini
   REACT_APP_BASE_API_URL=http://127.0.0.1:8000
   ```
4. Start the React app:  
   ```bash
   npm start
   ```

---

## Usage Guide
1. Open `http://localhost:3000/` in the browser.
2. Select a **Customer** and **Project** from the dropdowns.
3. Enter the **Project Cost** and click **Submit**.
4. The data will be stored in the database and immediately appear in the table below.
5. If the form is successfully submitted, a toast notification will appear.

---

## Future Enhancements
- Implement **Edit & Delete** functionality for project costs.
- Add **User Authentication & Roles**.
- Generate **Detailed Reports** for project expenses.
- Implement **Export to Excel/PDF** feature.

---

## Conclusion
The **Project Cost Management System** is an efficient tool for tracking project costs in real-time. With a modern UI, seamless API integration, and a well-structured database, it provides a scalable and user-friendly experience. Future enhancements will add more functionality, making it a complete project cost tracking solution.

