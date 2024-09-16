# Karigor E-commerce

This is a Laravel-based eCommerce platform designed to provide a robust online store with features such as product management, order processing, customer management, and payment integration.

## Features

- **Product Management**: Admins can manage products, categories, and inventory.
- **Order Management**: Customers can place orders, track them, and receive notifications on their status.
- **Customer Management**: Manage customer accounts, profiles, and order history.
- **Payment Integration**: Integration with popular payment gateways for secure transactions.
- **Shopping Cart**: Users can add products to their cart and proceed to checkout.
- **Wishlist**: Users can save products for later in their wishlist.
- **Coupons and Discounts**: Admins can create and manage coupons for promotional offers.
- **Shipping Options**: Integration with multiple shipping providers.
- **Product Reviews**: Customers can leave reviews and ratings for purchased products.
- **Admin Dashboard**: A dashboard for managing products, orders, customers, and reports.
- **Inventory Management**: Manage stock levels and receive notifications when stock is low.
- **User Authentication**: Secure login and registration using Laravel Sanctum.
- **Responsive Design**: Fully responsive design for mobile and desktop users.

## Requirements

- **PHP**: >= 7.2
- **Laravel**: >= 7.x
- **MySQL**: >= 5.7
- **Composer**

## Installation

1. Clone the repository:

   ```bash
   git clone [https://github.com/rubab2020/matrimony.git](https://github.com/rubab2020/karigor-ecommerce.git)
   cd karigor-ecommerce
2. Install dependencies: 
   ```bash
   composer install
3. Configure environment variables: 
   ```bash
   cp .env.example .env
4. Set up the database in .env:
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_db_username
    DB_PASSWORD=your_db_password
5. Run migrations and seed the database: 
   ```bash
   php artisan migrate --seed
6. Start the application: 
   ```bash
   php artisan serve

## Usage
1. Register as a customer, browse products, add them to the cart, and place orders.
2. Admin users can manage products, categories, orders, and customers from the admin dashboard.
2. Payment for orders is handled through COD and MFS-Bkash by sharing references of payment.
3. Customers can track their orders, leave reviews, and manage their profiles.

## Contributing
1. Fork the repository.
2. Create a new branch (git checkout -b feature/your-feature).
3. Commit your changes (git commit -m 'Add some feature').
4. Push to the branch (git push origin feature/your-feature).
5. Open a pull request.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.
