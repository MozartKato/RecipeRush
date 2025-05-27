<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

# RecipeRush

RecipeRush is a Laravel-based recipe management application featuring user authentication, an admin panel, and a user information API.

---

## ✨ Features
- User Authentication (register, login, logout)
- Admin Panel
- User Information API

## 🚀 Installation

1. **Clone this repository**
   ```bash
   git clone https://github.com/MozartKato/RecipeRush.git
   cd RecipeRush
   ```
2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```
3. **Copy the environment file**
   ```bash
   cp .env.example .env
   ```
   Then, configure your database settings in the `.env` file.
4. **Generate application key**
   ```bash
   php artisan key:generate
   ```
5. **Run database migrations**
   ```bash
   php artisan migrate
   ```
6. **Start the server**
   ```bash
   php artisan serve
   ```

## 📖 Usage

- **Login:**  
  `POST /api/login`
- **User Info:**  
  `GET /api/user` (requires token)

📄 **Full API documentation:**  
[Postman Collection](https://postman.co/workspace/My-Workspace~50a8f57e-f4e0-426a-852c-976e279f0aec/collection/37930680-1316f40a-2698-44dc-a8d4-85812124ee4e?action=share&creator=37930680)

## 🤝 Contribution

Pull requests and issues are very welcome!

## 📄 License

MIT
