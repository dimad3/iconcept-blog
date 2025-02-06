# 📝 Laravel 11 Blog App

This is a **simple blog application** built with Laravel 11 and Tailwind CSS.  
Users can create, edit, and delete posts, as well as leave comments.

---

## 🚀 **Installation Guide**

### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/dimad3/iconcept-blog.git
cd iconcept-blog
```

### **2️⃣ Install Dependencies**
```sh
composer install
npm install
```

### **3️⃣ Create Environment File**
Copy the `.env.example` file and rename it to `.env`:
```sh
cp .env.example .env
```

### **4️⃣ Generate Application Key**
```sh
php artisan key:generate
```

### **5️⃣ Set Up Database**
- Update `.env` file with your database details:
  ```ini
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=blog_db
  DB_USERNAME=root
  DB_PASSWORD=yourpassword
  ```
- Run migrations and seed the database:
  ```sh
  php artisan migrate --seed
  ```

### **7️⃣ Start the Development Server**
```sh
php artisan serve
```
Your blog is now running at **[http://127.0.0.1:8000](http://127.0.0.1:8000)** 🎉

---

## 🛠 **Frontend Setup**
This project uses **Tailwind CSS** with Vite.

### **1️⃣ Compile Assets**
```sh
npm run dev
```

For production:
```sh
npm run build
```

---

## 🔐 **Authentication**
- Register/Login using Laravel Breeze:
  ```sh
  php artisan breeze:install
  npm install && npm run dev
  ```

- Run migrations again if necessary:
  ```sh
  php artisan migrate --seed
  ```

- Visit:
  - **Register**: `/register`
  - **Login**: `/login`

---

## 📂 **API Routes**
This app does not provides **RESTful API routes**

---

## ⚡ **Deployment**
For deploying to a live server:
```sh
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Make sure to set the correct permissions:
```sh
chmod -R 775 storage bootstrap/cache
```

---

## 🛠 **Tech Stack**
- **Laravel 11** - Backend
- **MySQL** - Database
- **Tailwind CSS** - UI Styling
- **Vite** - Asset Bundling
- **Blade** - Templating Engine

---

## 🎯 **Features**
✅ User authentication (Login, Register, Logout)  
✅ Create, Edit, Delete Posts  
✅ Many-to-Many Categories  
✅ Comment System  
✅ Post Search Functionality  

---

## 📜 **License**
This project is open-source and available under the [MIT License](LICENSE).

---

🚀 Happy Coding! 🎉

