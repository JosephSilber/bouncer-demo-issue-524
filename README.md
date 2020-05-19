# Bouncer [issue 524](https://github.com/JosephSilber/bouncer/issues/524) reproduction

This repository aims to reproduce the issue.

To test this:

1. Clone the project.

2. Create the `.env` file by running this in your console:

    ```
    php -r "file_exists('.env') || copy('.env.example', '.env');"
    ```

3. Update the `.env` file's database settings to point to an empty table in your database.

4. Run `php artisan migrate:fresh`

5. Run `php artisan test`
