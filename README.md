
## Installation

You can install the package via composer:

```bash
composer require prageeth-peiris/laravel-query-builder-to-clickhouse
```

## Usage

```php
// Usage description here

//Add following database connections to config/database.php 

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

//extend from this model and start using clickhouse
use PrageethPeiris\LaravelQueryBuilderToClickhouse\Model;

Class CustomModel extends BaseClickHouseModel {

//this is required if you are doing sub query joining
      protected $tableJoinKey = 'page';

}

//use table with a suffix at runtime
CustomModel::useTableSuffix("in_memory")->insert($data)

//here comes a method to do sub query joining very easily
CustomModel::autoLeftJoinSubQuery(CustomModel::class,OtherModel::GroupBySomething())
->autoLeftJoinSubQuery(CustomModel::class,OtherModel::GroupBySomethingAndSomething())

```

### NOTE
This is an opinionated package so this cache results by raw clickhosue sql query. It will use your default cache driver. to clear cache run
<code>php artisan cache:clear </code>

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
