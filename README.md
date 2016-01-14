# OSMP

[![OSMP](http://i.imgsafe.org/34a2e47.jpg)](https://github.com/zgabievi/OSMP)

[![Latest Stable Version](https://poser.pugx.org/zgabievi/OSMP/version.png)](https://packagist.org/packages/zgabievi/OSMP)
[![Total Downloads](https://poser.pugx.org/zgabievi/OSMP/d/total.png)](https://packagist.org/packages/zgabievi/OSMP)
[![License](https://poser.pugx.org/zgabievi/OSMP/license)](https://packagist.org/packages/zgabievi/OSMP)

Georgian OSMP System Payment for [Laravel 5.*](http://laravel.com/)

## Table of Contents
- [Installation](#installation)
    - [Composer](#composer)
    - [Laravel](#laravel)
- [Usage](#usage)
- [Protocol](#protocol)
- [Codes](#codes)
- [Config](#config)
- [License](#license)

## Installation

### Composer

Run composer command in your terminal.

    composer require zgabievi/osmp

### Laravel

Open `config/app.php` and find the `providers` key. Add `OSMPServiceProvider` to the array.

```php
Gabievi\OSMP\OSMPServiceProvider::class
```

Find the `aliases` key and add `Facade` to the array. 

```php
'OSMP' => Gabievi\OSMP\OSMPFacade::class
```

## Usage

Create route in your `routes.php`

```php
Route::get('billing', function () {
	// LISTENERS

	return OSMP::init();
})->middleware('osmp.auth');
```

Middleware is required if you want to make Basic Authentication

In place of `// LISTENERS` you can write `osmp` listeners:

```php
Event::listen('osmp.*', function (...$args) {
	if ($args[0] == 'check') {
		// flash session data for check operation
		session()->flash('osmp.check', [
			'fullname' => 'Zura Gabievi',
			'account' => '000000'
		]);
	} else {
		// flash session data for pay operation
		session()->flash('osmp.pay', [
			'fullname' => 'John Doe',
			'account' => '000001'
		]);
	}
});
```

Flashed session data will be used in XML response as additional information

You can call `Response` early to show some kind of error.
For example:

```php
return OSMP::Response(5);
```

This will output:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<response>
	<result>5</result>
	<comment>User does not exist</comment>
</response>
```

## Protocol

This is the protocol for provider:

- `http(s)://yoursite.com/billing/?command=check&account=000000`
- `http(s)://yoursite.com/billing/?command=pay&txn_id=1234567&account=000000&sum=10.45`

Command: check/pay are required

## Codes

| Key | Description                        |
|-----|------------------------------------|
| 0   | Operation was successful           |
| 1   | Server Timeout                     |
| 4   | Wrong format of the user's account |
| 5   | User does not exist                |
| 7   | Payments are prohibited            |
| 215 | Transaction duplication            |
| 275 | Wrong amount                       |
| 300 | Fatal Error                        |

## Config

Publish OSMP config file using command:

```
php artisan vendor:publish
```

Created file `config\osmp.php`. Inside you can change configuration as you wish.

## License

OSMP is an open-sourced laravel package licensed under the MIT license

## TODO
- [ ] Create tests
