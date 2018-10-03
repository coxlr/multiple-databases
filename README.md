## About

Example project showing use of multiple MySQL databases in laravel app with phpunit.

## To Install 

Run the following commands

```git clone https://github.com/coxy121/multiple-databases.git```

```cd multiple-databases && composer install```

```mv .env.example .env```

```php artisan key:generate```

Update database connection details

Create 2 MySQL databases on the same connection called testing_a and testing_b


Run ```php artisan migrate --seed```

## To Test

run ```php artisan serve```

visit http://127.0.0.1:8000/

You will see 6 collections dumped out to the page.

run ```phpunit```

You will see 6 dumped to the terminal

In routes/web.php there are 6 different queries being run to fetch the data that are all being dumped out, to show examples of data being successfully retrieved from databases joined over different connections.

**Note:** If you run ```phpunit``` you will need to rerun ```php artisan migrate --seed``` to view the browser version again.

## Resolution

I am not sure if this is the expected behavior, but I was able to resolve this by ensuring that during phpunit testing the connection used was always the default connection as specified in the phpunit.xml file using a trait on the model.

```
trait MySQL2ConnectionTrait
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = app()->environment(['testing']) ? 'mysql' : 'mysql2';

        $this->table = 'testing_b.'.$this->getTable();
    }
}
```