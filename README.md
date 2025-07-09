# Laravel Infusionsoft OAuth2 Demo

This is a Laravel 12 demo project showcasing how to integrate **OAuth2 with Infusionsoft (Keap)** using **Guzzle HTTP client** and Laravel, without relying on the official SDK. It covers the entire authentication flow, access token storage, refreshing, and consuming the API (fetching contacts) with a clean Laravel service structure.

---

## 🔧 Features

- ✅ OAuth2 Authorization Flow with Infusionsoft
- ✅ Token storage in database (access + refresh tokens)
- ✅ Automatic token refresh if expired
- ✅ Display real-time contacts from Infusionsoft on a Blade view
- ✅ Laravel Service Class pattern used
- ✅ Modular, clean code ready for production adaptation

---

## 📸 Screenshot

https://tinyurl.com/ynktjzhz

---

## 🧱 Folder Structure

```
app/
├── Http/
│   └── Controllers/
│       └── InfusionsoftOAuth2Controller.php
├── Models/
│   └── InfusionsoftToken.php
├── Services/
│   └── InfusionsoftOAuth2.php
resources/
└── views/
    └── contacts.blade.php
```

---

## 🚀 Setup Instructions

1. **Clone the Repository**

```bash
git clone https://github.com/umr4ever/laravel-infusionsoft-oauth-demo.git
cd laravel-infusionsoft-oauth-demo
```

2. **Install Dependencies**

```bash
composer install
cp .env.example .env
php artisan key:generate
```

3. **Set Infusionsoft Credentials in `.env`**

```env
INFUSIONSOFT_CLIENT_ID=your_client_id
INFUSIONSOFT_CLIENT_SECRET=your_client_secret
INFUSIONSOFT_DEV_REDIRECT_URI=http://127.0.0.1:8000/oauth/callback
```

4. **Configure Database**

Set your local DB connection in `.env`, then run:

```bash
php artisan migrate
```

5. **Run the Application**

```bash
php artisan serve
```

6. **Authorize App**

Visit this URL to start OAuth2 flow:
```
http://127.0.0.1:8000/oauth/authorize
```

7. **Fetch Contacts**

After authorization, access:
```
http://127.0.0.1:8000/contacts
```

---

## 📦 API Used

- [Infusionsoft REST API](https://developer.infusionsoft.com/docs/rest/)
- [OAuth2 Authentication](https://developer.infusionsoft.com/getting-started-oauth-keys/)
- [Guzzle HTTP Client](https://docs.guzzlephp.org/en/stable/)


---

## 🙋‍♂️ About the Author

**👋 Mohammad Umair**  
Senior Laravel Developer | 15+ Years of Experience  
Remote from 🇮🇳 | Seeking full-time remote roles  
🔗 [LinkedIn](https://www.linkedin.com/in/umr4ever/) | 🔗 [GitHub](https://github.com/umr4ever)

---

## 📝 License

This project is open-sourced under the [MIT license](LICENSE).
