# Vulnerable Web Application - SQL Injection Demo

## App generated using Claude AI and modified to be vulnerable.

A deliberately vulnerable PHP/MySQL web application designed for educational purposes to demonstrate SQL injection and XSS vulnerabilities.


## 📦 Prerequisites

Before you begin, ensure you have the following installed:

- **XAMPP** (Windows/Mac/Linux) - [Download](https://www.apachefriends.org/)
  - Includes Apache, MySQL/MariaDB, and PHP

## 🚀 Installation

### Step 1: Install XAMPP

1. Download XAMPP from [apachefriends.org](https://www.apachefriends.org/)
2. Run the installer and follow the installation wizard

### Step 2: Clone the Repository

```bash
git clone https://github.com/22AKMS/SQLi-project
```

1. Copy the entire xampp folder from the extracted files
2. Paste it into C:\ (Windows) or /Applications/ (Mac)
3. When prompted, choose "Merge" or "Replace" files


### Step 3: Start XAMPP Services

1. Open **XAMPP Control Panel**
2. Click **Start** next to **Apache**
3. Click **Start** next to **MySQL**
4. Both should show green "Running" status

---

## 🗄️ Database Setup

### Option 1: Import via phpMyAdmin (Recommended)

1. Open phpMyAdmin: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Click **"New"** in the left sidebar
3. Database name: `demo_site`
4. Click **"Create"**
5. Click on the `demo_site` database
6. Click the **"Import"** tab
7. Click **"Choose File"** and select `db_setup.sql`
8. Scroll down and click **"Import"**
9. Wait for success message


### Test Credentials

The database comes with three pre-configured users:

| Username | Password | Role |
|----------|----------|------|
| `admin` | `admin123` | admin |
| `abdulla` | `abdulla123` | manager |
| `user1` | `user123` | user |

---

## 🎯 Usage

### Access the Application

1. **Login Page**: [http://localhost/demo-site/login.php](http://localhost/demo-site/login.php)
2. **Search Page**: [http://localhost/demo-site/search.php](http://localhost/demo-site/search.php) (requires login)


## 🧪 Testing Exploits

Follow the powerpoint for a step by step guide
