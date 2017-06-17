yii2-kz-personalid
===========

[![Build Status](https://travis-ci.org/alexeevdv/yii2-kz-personalid.svg?branch=master)](https://travis-ci.org/alexeevdv/yii2-kz-personalid)

Yii2 extension to deal with Kazakhstan personal identification number
https://ru.wikipedia.org/wiki/%D0%98%D0%BD%D0%B4%D0%B8%D0%B2%D0%B8%D0%B4%D1%83%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9_%D0%B8%D0%B4%D0%B5%D0%BD%D1%82%D0%B8%D1%84%D0%B8%D0%BA%D0%B0%D1%86%D0%B8%D0%BE%D0%BD%D0%BD%D1%8B%D0%B9_%D0%BD%D0%BE%D0%BC%D0%B5%D1%80

It contains:
 - Both server-side and client-side validators
 - Helper to fetch data from identification number

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require alexeevdv/yii2-kz-personalid ^1.0
```

or add

```
"alexeevdv/yii2-kz-personalid": "^1.0"
```

to the ```require``` section of your `composer.json` file.

## Usage

### Validation

#### As standalone validator

```php
use alexeevdv\kz\PersonalidValidator;

//...
$validator = new PersonalidValidator;
$result = $validator->validateValue('123456789012');
//...
```

### In model

```php
use alexeevdv\kz\PersonalidValidator;

public function rules()
{
    //...
    ['personalid', PersonalidValidator::className(), 'message' => 'Wrong personalid value!'],
    //...
}
```

### Helper

```php
use alexeevdv\kz\PersonalidHelper;

$personalid = '850407301166';

/** @var \DateTime $birtdate = 1985-04-07 */  
$birtdate = PersonalidHelper::getBirthDate($personalid);

/** @var int $sex = PersonalidHelper::SEX_MALE */
$sex = PersonalidHelper::getSex($personalid);

/** @var string $serialNumber = 0116 */
$serialNumber = PersonalidHelper::getSerialNumber($personalid);
```
