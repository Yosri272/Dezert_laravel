
# Fullstack Signup Project – Laravel Backend + Vue.js Web + Android App

This project includes a Laravel API backend with two frontend clients: a Vue.js web form and a native Android app. Users can register through either frontend, and their data is stored securely with email confirmation handled via Laravel Queues.

---

## 🔧 Backend – Laravel API

### 📌 Features

- API endpoint to handle signup requests
- Input validation (name, email, password)
- User data stored in `users` table with hashed passwords
- Confirmation email sent asynchronously via Laravel Queues (Redis or database driver)

### 📁 API Route

```
POST /api/signup
```

#### Request Body

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "12345678"
}
```

### ✅ Validation Rules

- `name` – required
- `email` – required, valid email, unique
- `password` – required, minimum 8 characters

### 📨 Queue & Email

- After registration, a welcome email is queued and sent using Laravel's queue system.
- Ensure queue worker is running:  
  ```bash
  php artisan queue:work
  ```

### 🗄️ Database Schema – users table

| Field       | Type      |
|-------------|-----------|
| id          | bigint    |
| name        | string    |
| email       | string    |
| password    | string (hashed) |
| created_at  | timestamp |

---

## 🌐 Frontend – Vue.js Web Form

### 📋 Features

- Basic registration form
- Input validation (required fields, valid email, password min length)
- Sends data to Laravel API via `axios`

### 📁 Form Fields

- Name
- Email
- Password

### 🔒 Validation

- All fields required
- Email must be valid
- Password: minimum 8 characters

### 📡 API Call

```js
axios.post('/api/signup', {
  name: this.name,
  email: this.email,
  password: this.password
})
```

### 🚀 Launch Instructions

```bash
npm install
npm run dev
```

---

## 📱 Frontend – Android App (Java or Kotlin)

### 📋 Features

- Signup form with same fields
- Uses Volley for HTTP requests
- Displays success or error based on API response

### 🔄 Integration

- Endpoint: `https://your-domain.com/api/signup`
- Same request format and validations

---

## ⚙️ Example `.env.example` (Backend)

```dotenv
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:xxxx
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=signup_app
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=suport@wepower.host
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=suport@wepower.host
MAIL_FROM_NAME="${APP_NAME}" 
```

---

## ✅ Deployment Tips

- Ensure `.env` is configured correctly for mail and queue
- Run `php artisan migrate` to create tables
- Run `php artisan queue:work` to process queued emails
- Use Postman or frontend clients to test signup

---

## 📌 Notes

- Always validate on both frontend and backend
- Do not expose sensitive environment variables in frontend code
