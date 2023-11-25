# CulinaBase - Culinary Information System

## Introduction

CulinaBase is a collaborative project developed by a team of three enthusiastic individuals. This web application is designed to serve as a comprehensive Culinary Information System, providing users with a platform to share, discover, and manage their favorite recipes.

## Key Features

- **User-friendly Interface:** The application offers an intuitive and easy-to-navigate interface, ensuring a seamless experience for users.

- **Recipe Management:** Users can create, edit, and delete their recipes(inprogress). Each recipe can include details such as ingredients, steps, and images.

- **Search and Filter:** A powerful search and filter functionality helps users find specific recipes quickly base on recipe-name, making the platform efficient and user-centric.

- **Profile Management:** Users have personalized profiles where they can view and manage their uploaded recipes.

- **Responsive Design:** CulinaBase is designed to be responsive, ensuring optimal user experience across various devices on some condition only.

## Technology Stack

- **Laravel:** The backend is built using the Laravel framework, providing a robust and secure foundation for the application.

- **PHP:** The server-side scripting language used for backend development.

- **MySQL:** The relational database management system is employed for efficient data storage.

- **HTML, CSS, JavaScript:** The frontend is developed using standard web technologies for a dynamic and interactive user interface.

## Getting Started

To run CulinaBase on your local machine, follow these steps:

1. **Clone the Repository:**
   ```
   git clone https://github.com/your-username/culinabase.git
   ```

2. **Install Dependencies:**
   ```
   cd culinabase
   composer install
   ```

3. **Database Setup:**
   - Create a new database.
   - Copy the `.env.example` file to `.env` and configure the database connection.

4. **Generate Application Key:**
   ```
   php artisan key:generate
   ```

5. **Migrate Database:**
   ```
   php artisan migrate
   ```

6. **Serve the Application:**
   ```
   php artisan serve
   ```

7. **Access the Application:**
   Open your web browser and go to `http://localhost:8000`.

## Team Members

1. **[Member Name 1]**
   - Role: Project Manager
   - GitHub: [GitHub Profile](https://github.com/member1)

2. **[Member Name 2]**
   - Role: Backend Developer
   - GitHub: [GitHub Profile](https://github.com/member2)

3. **[Member Name 3]**
   - Role: Frontend Developer
   - GitHub: [GitHub Profile](https://github.com/member3)
