
## Installation

You can install the package via composer:

```bash
composer require prageeth-peiris/laravel-query-builder-to-clickhouse
```

## Usage

```php
// Usage description here

Add following database connections to config/database.php 

       'bavix::clickhouse' => [
            'driver' => 'bavix::clickhouse',
            'host' => env('CLICKHOUSE_HOST'),
            'port' => env('CLICKHOUSE_PORT',8123),
            'database' => env('CLICKHOUSE_DATABASE'),
            'username' => env('CLICKHOUSE_USER','default'),
            'password' => env('CLICKHOUSE_PASSWORD'),
            'options' => [
                'timeout' => 20,
                'protocol' => 'http'
            ]
        ],
        'clickhouse_custom' => [
            'driver' => 'bavix::clickhouse::custom',
            'host' => env('CLICKHOUSE_HOST'),
            'port' => env('CLICKHOUSE_PORT',8123),
            'database' => env('CLICKHOUSE_DATABASE'),
            'username' => env('CLICKHOUSE_USER','default'),
            'password' => env('CLICKHOUSE_PASSWORD'),
            'options' => [
                'timeout' => 20,
                'protocol' => 'http'
            ]
        ]


change your model connection to "clickhouse_custom"

Class CustomModel extends Model {


  protected  $connection = 'clickhouse_custom';


}


```

### Dependencies

- PHP 8
- Laravel 8
- https://github.com/bavix/laravel-clickhouse
- https://github.com/MariosTheof/laravel-clickhouse-migrations

Read related packages documentation to use their config.



### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email glpspeiris@gmail.com instead of using the issue tracker.

## Credits

-   [Prageeth Peiris](https://github.com/prageeth-peiris)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
