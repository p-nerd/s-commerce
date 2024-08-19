# S-Commerce

A single-vendor eCommerce platform built with Laravel.

## Story

During my final semester diploma internship at [Systech Digital Limited](https://systechdigital.com), I developed this project over two months. It's a fully functional single-vendor eCommerce web application, incorporating all the essential features you'd expect from a typical eCommerce platform.

The application is written in PHP using the Laravel web framework. I implemented the frontend with Laravel Blade templating, and styled the admin dashboard from scratch using TailwindCSS. The store section utilizes an eCommerce template provided by Systech.

This project serves as a robust foundation for launching an eCommerce platform. It can be easily customized to meet specific business needs, allowing for quick deployment of a feature-rich online store.

The resulting application showcases my ability to develop complex web systems and demonstrates my expertise in building a web application from the ground up, following best practices.

## Key Features

-   **Product Filtering:** Users can filter products by category, price, and stock on the products page.
-   **Cart System:** Customers can add products to their cart for shopping.
-   **SSLCommerz Payment Gateway Integration:** Users can make payments using cards, bKash, Nagad, and other options.
-   **Account Section:** Customers can update their shipping and billing addresses, view their order history, and manage their account information.
-   **Admin Dashboard:** The dashboard allows full control over the platform's operations.
    -   Manage users and view user lists.
    -   Create, manage, and perform CRUD operations on products and categories.
    -   Create and control coupons.
    -   View and update order statuses.
    -   Set different delivery charges for districts in Bangladesh.
    -   Customize the site by adding news flashes, managing hero sliders, and more.
-   **Authentication System:**
    -   Customers can register and log in with their credentials.
    -   Password reset via email with a reset token.
    -   Email verification for user accounts.

## Technologies and Libraries

-   **[PHP](https://www.php.net):** A widely-used server-side scripting language for building dynamic web applications.
-   **[Laravel](https://laravel.com):** A PHP framework that simplifies web development with elegant syntax and built-in tools.
-   **[TailwindCSS](https://tailwindcss.com):** A utility-first CSS framework for creating custom designs quickly and efficiently.
-   **[SSLCommerz](https://www.sslcommerz.com):** A payment gateway in Bangladesh supporting various local and global payment methods.

## Installation and Running the Development Server

To get the application up and running on your local machine, follow these steps:

1. First download & install [Laravel Herd](https://herd.laravel.com) Desktop App
    - This will install PHP, Composer, Laravel Installer, Node.js for us
    - To check is all everything installed run this commands in terminal
    ```bash
    php -v
    composer -v
    laravel -v
    node -v
    ```
2. Clone the Repository
    ```bash
    git clone https://github.com/p-nerd/s-commerce.git
    cd s-commerce
    ```
3. Install Dependencies
    ```bash
    composer install
    npm -g i pnpm && pnpm install
    ```
4. Set Up
    - Environment Variables:
        ```bash
        cp .env.example .env # Open the `.env` file and update the database configuration and other environment variables as needed.
        ```
    - Generate the Application Key:
    ```bash
    php artisan key:generate
    ```
5. Run Database Migrations:
    ```bash
    php artisan migrate
    ```
    If you need sample data, you can also run the seeder:
    ```bash
    php artisan db:seed
    ```
6. Running the Development Server
    1. Start the PHP Local Development Server with Laravel Hard
    ```bash
    herd link
    ```
    2. Compile Frontend Assets with Vite Server: In a separate terminal window, run:
    ```bash
    pnpm run dev
    ```
    3. Open the application with blow or visit http://s-commerce.test on browser
    ```bash
    herd open # this will open application url on the browser
    ```

This will compile your frontend assets and enable hot reloading for development.
