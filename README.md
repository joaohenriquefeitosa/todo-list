# Task API Documentation
This project provides a RESTful API for managing tasks.

## Endpoints
* GET /api/tasks
    * Retrieves a list of all tasks.

* POST /api/tasks
    * Creates a new task.
    * Payload:
    ```
        {
            "title": "Task Title",
            "description": "Task Description",
            "due_date": "YYYY-MM-DD",
            "status": "pending|completed|canceled"
        }
    ```

* GET /api/tasks/{id}
    * Retrieves details of a specific task.

* PUT /api/tasks/{id}
    * Updates an existing task.
    * Payload:
    ```
        {
            "title": "Updated Task Title",
            "description": "Updated Task Description",
            "due_date": "YYYY-MM-DD",
            "status": "pending|completed|canceled"
        }
    ```

* DELETE /api/tasks/{id}
    * Deletes a specific task.


## Running the Application
* Ensure PHP and Composer are installed.

* Install dependencies:
    * composer install

* Copy .env.example to .env and configure your database settings:
```
    DB_CONNECTION=mysql
    DB_HOST=your_database_host
    DB_PORT=your_database_port
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
```

* Run migrations to set up the database schema:
   * ```php artisan migrate```

* Start the server:
   * ```php artisan serve```

* Access the API at http://localhost:8000.

## Running Unit Tests
This project includes unit tests to ensure API functionality.

* To run tests:
    * ```php artisan test```


```
Make sure to update the .env file with your actual database credentials before running the application. Adjust the database configuration (DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD) to match your MySQL setup.
```