## About Foundation

Example project showing use of multiple MySQL databases in laravel app with phpunit.

## To Install 

Run the following commands

git clone https://github.com/coxy121/multiple-databases.git

Copy .env.example file as .env and update database connection details

Create 2 MySQL databases on the same connection called testing_a and testing_b

Run composer install

Run php artisan migrate --seed

## To Test

run php artisan serve

visit http://127.0.0.1:8000/

You will see 6 collections dumped out to the page.

run phpunit

You will see one collections and 5 empty collections dumped to the terminal