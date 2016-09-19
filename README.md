# laravel-osmp

> Some great updates are comming soon...

[![Latest Stable Version](https://poser.pugx.org/zgabievi/osmp/version?format=flat-square)](https://packagist.org/packages/zgabievi/osmp) [![Total Downloads](https://poser.pugx.org/zgabievi/osmp/d/total?format=flat-square)](https://packagist.org/packages/zgabievi/osmp) [![License](https://poser.pugx.org/zgabievi/osmp/license?format=flat-square)](https://packagist.org/packages/zgabievi/osmp)

| OSMP       |     |
|:----------:|:----|
| [![OSMP](https://i.imgsafe.org/fbbe2a3dfd.png)](https://github.com/zgabievi/laravel-osmp) | OSMP payment system integration for [Laravel 5.*](http://laravel.com/). Trying to make it perfect, easy to use and awesome package :tada: Pull requests are welcome. |

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

**Attention!** You need to disable `short_open_tag` in your `php.ini` file, to use xml response;

Follow this url for more information: [ini.short-open-tag](http://php.net/manual/en/ini.core.php#ini.short-open-tag)


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
		session()->flash('osmp', [
			'result' => 0,
			'data' => [
				'fullname' => 'Zura Gabievi',
				'account' => '000000'
			]
		]);
	} else {
		// flash session data for pay operation
		session()->flash('osmp', [
			'result' => 0,
			'data' => [
				'fullname' => 'John Doe',
				'account' => '000001'
			]
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

laravel-osmp is licensed under a  [MIT License](https://github.com/zgabievi/laravel-osmp/blob/master/LICENSE).

## TODO
- [ ] Create tests for checking funtionality
- [ ] Create separated file for response codes
- [ ] Make artisan command that will create reponse codes php file
- [ ] Make artisan command that will register routes for user
- [ ] Make OSMP object more Model like
