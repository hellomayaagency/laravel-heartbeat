# Monitor Laravel Queue and Schedule

This package runs a queued job and a scheduled command once every 5 minutes and a route to check that this has happened successfully.

This route will return a 200 or a 503 HTTP status which is useful for monitoring software such as StatusCake.

## Limitations

This package relies on the database queue driver being used.

## Installation

Install the package via composer:

```bash
composer require yadda/laravel-heartbeat
```

Enable the scheduled heartbeat command:

```php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // ...

    // Note: don't change the interval!
    $schedule->command('heartbeat')->everyFiveMinutes();
}
```

Run the heartbeat command:

```bash
php artisan heartbeat
```

Add a route to the heartbeat status page:

```php
// routes/web.php
Route::get('heartbeat', '\Yadda\LaravelHeartbeat\Http\Controllers\HeartbeatController@index');

// or

Route::get('heartbeat', [HeartbeatController::class, 'index');
```

## Usage

Navigate to the route you created above, e.g. `example.com/heartbeat`. You should see a status page.

The status page will return a 200 status page if everything is working as expected.

If problems are found with the schedule or queue a 503 status will be returned instead.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email jake@maya.agency instead of using the issue tracker.

## Credits

-   [Jake Gully](https://github.com/yadda)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
