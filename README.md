# 📌 Attendance Registration and Control System

<p align="center">
  <a href="./SYSTEM%20USER%20MANUAL.pdf">
    <img src="https://img.shields.io/badge/📘%20DOWNLOAD%20USER%20MANUAL-blue?style=for-the-badge&logo=adobeacrobatreader" alt="Download Manual"/>
  </a>
</p>

**IMPORTANT❗❗:** Since this project was developed for my university, the **codebase, comments, database, and user manual are entirely in Spanish**.

This project was developed in **Laravel** as part of my **university graduation project**.  
It also represents an important milestone, as it was the **first complete system I built entirely on my own**.  

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

3. **Configure the `.env` file with your database.**

4. **Run migrations and seeders:** →  
   `php artisan migrate --seed`

5. **Start the development server:** →  
   `php artisan serve`


### 🔑 Access Credentials
When running `php artisan migrate --seed`, the system will automatically create a **default administrator user** with the following credentials:

- **Email:** `manuelc.dev@gmail.com`  
- **Password:** `123456789`  

These credentials can be used to access the system on the first login.

---

## 🖼️ Screenshots

![Login](./screenshots/login.png)  
![Main Dashboard](./screenshots/index.png)  
![Database](./screenshots/DB.png)  

---

## 📖 User Manual (Summary)

- **Access and authentication** → Login with email and password.  
- **Main dashboard** → Quick access to users, members, and attendance.  
- **Attendance** → Record and view check-ins and check-outs.  
- **Users** → Create, edit, and enable/disable accounts.  
- **Roles and permissions** → Configure customized access levels.  
- **Reports** → Export to PDF with advanced filters.  
- **Data backup** → Database backup.  

> For more details, see the [Full Manual](./SYSTEM%20USER%20MANUAL.pdf).

---

✍️ **Personal Note:**  
Beyond being an academic assignment, this project was the **first one I fully developed on my own**.  
It became a **personal and professional challenge** that allowed me to apply my knowledge in **Laravel**, **MySQL**, and **web development best practices**, while gaining valuable experience completing a full system independently.  
