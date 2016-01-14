# OSMP

`routes.php`

```php
Route::get('billing', function () {
	Event::listen('osmp.*', function (...$args) {
		if ($args[0] == 'check') {
			session()->flash('osmp.check', [
				'fullname' => 'Zura Gabievi',
				'account' => '000000'
			]);
		} else {
			session()->flash('osmp.pay', [
				'fullname' => 'John Doe',
				'account' => '000001'
			]);
		}
	});


	return OSMP::init();
})->middleware('osmp.auth');
```