# nia - mixed map component

Mixed maps encapsulate a native php assoc array with non type hinted values and provides common methods.

## Tests
To run the unit test use the following command:

    $ cd /path/to/nia/component/
    $ phpunit --bootstrap=vendor/autoload.php tests/

## How to use
The following sample shows you how to use the mixed map component and to decorate the map to a read-only map.

```php
	// create a read/write map.
	$map = new Map([
	    'foo' => 123,
	    'bar' => '456'
	]);
	
	// add 'baz' and remove 'bar'
	$map->set('baz', new stdClass())->remove('bar');
	
	foreach ($map as $name => $value) {
	    var_dump($name, $value);
	}
	
	// make it read-only (ReadOnlyMap does not contain any methods to manipulate the map)
	$map = new ReadOnlyMap($map);
	
	foreach ($map as $name => $value) {
	    var_dump($name, $value);
	}
```
