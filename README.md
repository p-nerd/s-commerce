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
-   **[SQLite](https://www.sqlite.org):** A lightweight, self-contained SQL database engine used for local data storage.
-   **[TailwindCSS](https://tailwindcss.com):** A utility-first CSS framework for creating custom designs quickly and efficiently.
-   **[AlpineJS](https://alpinejs.dev):** A minimal framework for adding JavaScript behavior to your HTML with a simple API.
-   **[SSLCommerz](https://www.sslcommerz.com):** A payment gateway in Bangladesh supporting various local and global payment methods.

## Installation and Running the Development Server

Follow these steps to set up the application locally:

1. **Install Laravel Herd**  
   Download and install [Laravel Herd](https://herd.laravel.com). This will set up PHP, Composer, Laravel Installer, and Node.js.
   Verify the installation with:
    ```bash
    php -v
    composer -v
    laravel -v
    node -v
    ```
2. **Clone the Repository**
    ```bash
    git clone https://github.com/p-nerd/s-commerce.git
    cd s-commerce
    ```
3. **Install Dependencies**
    ```bash
    composer install
    npm -g i pnpm && pnpm install
    ```
4. **Set Up**
    - **Environment Variables**
        ```bash
        cp .env.example .env
        ```
        Edit the `.env` file to configure your database and other settings.
    - **Generate the Application Key**
        ```bash
        php artisan key:generate
        ```
5. **Run Database Migrations**
    ```bash
    php artisan migrate
    ```
    To add sample data, run:
    ```bash
    php artisan db:seed
    ```
6. **Running the Development Server**
    - **Start the PHP Local Development Server with Laravel Herd**
        ```bash
        herd link
        ```
    - **Compile Frontend Assets with Hot reloading**  
      In a separate terminal window:
        ```bash
        pnpm run dev
        ```
    - **Open the Application**
        ```bash
        herd open
        ```
        Alternatively, visit [http://s-commerce.test](http://s-commerce.test) in your browser.
