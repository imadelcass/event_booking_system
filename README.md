# 🎟️ Event Booking API (Laravel)

A RESTful API built with **Laravel** for managing events, tickets, bookings, and payments.  
It includes authentication, role-based access (Admin, Organizer, Customer), booking logic, and a simulated payment service.

---

## 🚀 Features

- 👥 **User Roles**: Admin, Organizer, Customer (enum-based).
- 🎫 **Event & Ticket Management**.
- 🧾 **Bookings with Payment Simulation**.
- 🛡️ **Middleware to prevent double-booking**.
- 🧰 **Factories & Seeders** for testing data.
- 🧩 **Service Class** for simulated payments.
- 🔍 **Filtering & Sorting** with [Spatie Laravel Query Builder](https://spatie.be/docs/laravel-query-builder/v6).
- 🧪 **Insomnia API Collection** included for easy endpoint testing `insomnia_collection.yaml`.
- 📦 Built with Laravel best practices.

---

## 🏗️ Models & Relationships

| Model | Relationships |
|--------|----------------|
| **User** | hasMany(Event), hasMany(Booking), hasMany(Payment) |
| **Event** | belongsTo(User), hasMany(Ticket) |
| **Ticket** | belongsTo(Event), hasMany(Booking) |
| **Booking** | belongsTo(User), belongsTo(Ticket), hasOne(Payment) |
| **Payment** | belongsTo(Booking) |

---

## ⚙️ Installation

```bash
# 1. Clone the repository
git clone https://github.com/imadelcass/event_booking_system
cd event_booking_system

# 2. Install dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 6. Run migrations & seeders
php artisan migrate --seed

# 7. Start the local server
php artisan serve
