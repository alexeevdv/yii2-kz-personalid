yii2-kz-personaid-validator
===========

Yii2 validator to validate Kazakhstan personal identification number;
https://ru.wikipedia.org/wiki/%D0%98%D0%BD%D0%B4%D0%B8%D0%B2%D0%B8%D0%B4%D1%83%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9_%D0%B8%D0%B4%D0%B5%D0%BD%D1%82%D0%B8%D1%84%D0%B8%D0%BA%D0%B0%D1%86%D0%B8%D0%BE%D0%BD%D0%BD%D1%8B%D0%B9_%D0%BD%D0%BE%D0%BC%D0%B5%D1%80

This validator can perform both server-side and client-side validation.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require alexeevdv/yii2-kz-personaid-validator ^1.0
```

or add

```
"alexeevdv/yii2-kz-personaid-validator": "^1.0"
```

to the ```require``` section of your `composer.json` file.

## Usage

### As standalone validator

```php
use alexeevdv\kz\validators\PersonalidValidator;

//...
$validator = new PersonalidValidator;
$result = $validator->validateValue('123456789012');
//...
```

### In model

```php
use alexeevdv\kz\validators\PersonalidValidator;

public function rules()
{
    //...
    ['personalid', PersonalidValidator::className(), 'message' => 'Wrong personalid value!'],
    //...
}
```
