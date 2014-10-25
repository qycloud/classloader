### ClassLoader:

ClassLoader is a tool to auto loading the missing class while the file's name starts with lowercase char.

### Getting Started:

* Create composer.json file in root directory of  your application:

```json
 {
    "require": {
        "php": ">=5.4.0",
        "nanjingboy/classloader": "*"
    }
}
```
* Install it via [composer](https://getcomposer.org/doc/00-intro.md)


### Usage Example:
Imagine the following application structure:

```
application
├── models
│   └─── user.php
```

If we want to access the class  Models\User, we should register a classLoader like this:

```php
<?php
require __DIR__ . '/vendor/autoload.php';
$classLoader = new CloassLoader();
$classLoader->addPrefix('Models', __DIR__);
$classLoader->register();
```

### License:
MIT