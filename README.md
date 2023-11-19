# TircoEcommerce

This is an ecommerce website I have been working on for the last couple of weeks, it is far from 1.0,I would say it is a rough 0.2 at this point,but I posted it anyway in order to track my progress, I will try to update it monthly.
Currently I am working on the cart.php file, right now that file is a mess but soon it will be working properly

## Database Setup

To set up the database for this project, follow these steps:

1. **Database Creation:**
   - Create a new database in your MySQL/MariaDB server. You can use a tool like phpMyAdmin or run SQL commands.

2. **Import SQL File:**
   - Locate the `sql` folder in the root of the project.
   - Find the SQL file named `your_sql_file.sql` inside the `sql` folder.
   - Import this SQL file into your newly created database. This will create the necessary tables and insert sample data.

      Example using the command line:
      ```bash
      mysql -u your_username -p your_database_name < sql/your_sql_file.sql
      ```

   - Make sure to replace `your_username` and `your_database_name` with your actual MySQL username and the name of the database you created.

3. **Database Connection:**
   - Open the `includes/connect.php` file.
   - Update the following variables with your database connection details:

     ```php
     $servername = "your_servername";
     $username = "your_username";
     $password = "your_password";
     $dbname = "your_database_name";
     ```

4. **Start the Application:**
   - Now you should be able to run the application. Open the project in your web browser and navigate to the index page (`index.php`).

If you encounter any issues, ensure that your database server is running, and the connection details in `includes/connect.php` are accurate.
