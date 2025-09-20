# 📌 Attendance Registration and Control System

<p align="center">
  <a href="./public/manual/manual_english.pdf">
    <img src="https://img.shields.io/badge/📘%20DOWNLOAD%20USER%20MANUAL-blue?style=for-the-badge&logo=adobeacrobatreader" alt="Download Manual"/>
  </a>
</p>

**IMPORTANT❗❗:** Since this project was developed by me for my university, the **codebase, comments and database are entirely in SPANISH**.

This project was developed in **Laravel** as part of my **university graduation project**.  

The **Attendance Registration and Control System** enables efficient management of staff attendance within an institution.


---

## 🚀 System Overview

Its main features include:

- 👤 **Member management** with personal information and assigned shifts.  
- ⏱️ **Attendance tracking** with check-in and check-out times.  
- 🧑‍💻 **User management** with customized roles and permissions.  
- 📊 **PDF report generation** by date range or staff type.  
- 💾 **One-click database backup**.  
- 🔐 **Security best practices** to protect information.  

---

## ⚙️ Installation and Usage

1. **Clone the repository:** →  
   `git clone https://github.com/manuzky/sys_attendance`

2. **Install dependencies:** →  
   `composer install && npm install && npm run dev`

3. **Generate a New Key:** →  
   `php artisan key:generate`

4. **Configure the `.env` file with your database.**

5. **Run migrations and seeders:** →  
   `php artisan migrate --seed`

6. **Start the development server:** →  
   `php artisan serve`


### 🔑 Access Credentials
When running `php artisan migrate --seed`, the system will automatically create a **default administrator user** with the following credentials:

- **Email:** `manuelc.dev@gmail.com`  
- **Password:** `123456789`  

These credentials can be used to access the system on the first login.

---

## 🖼️ System Screenshots (Highlights)

| Index (Login & Dashboard) | Database |
|---------------------------|----------|
| ![Index](./screenshots/SS2/index.gif) | ![DB](./screenshots/DB.png) |
| Attendance | Reports |
| ![Attendance](./screenshots/SS2/attendance.gif) | ![Reports](./screenshots/SS2/reports.gif) |



---

## 📖 User Manual (Summary)

- **Access and authentication** → Login with email and password.  
- **Main dashboard** → Quick access to users, members, and attendance.  
- **Attendance** → Record and view check-ins and check-outs.  
- **Users** → Create, edit, and enable/disable accounts.  
- **Roles and permissions** → Configure customized access levels.  
- **Reports** → Export to PDF with advanced filters.  
- **Data backup** → Database backup.  

> For more details, see the [Full Manual](./public/manual/manual_english.pdf).

---

✍️ **Personal Note:**  
Beyond being an academic assignment, this project became a **personal and professional challenge**.  
It was also the **first complete system I built entirely on my own, solo solín solito**.  
Developing it allowed me to apply my knowledge in **Laravel**, **MySQL**, and **web development best practices**, while gaining valuable experience completing a full system independently.
