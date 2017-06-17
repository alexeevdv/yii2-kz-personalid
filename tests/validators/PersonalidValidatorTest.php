<?php

namespace tests\validators;

use alexeevdv\kz\validators\PersonalidValidator;

/**
 * Class PersonalidValidatorTest
 * @package tests\validators
 */
class PersonalidValidatorTest extends \Codeception\Test\Unit
{
    /**
     * @var PersonalidValidator
     */
    private $_validator;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $this->_validator = new PersonalidValidator;
        $this->_validator->message = 'Custom message';
    }

    /**
     * @inheritdoc
     */
    protected function _after()
    {
    }


    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation($value, $error)
    {
        $this->assertEquals($error, $this->_validator->validateValue($value), $value);
    }

    /**
     * @return array
     */
    public function validationDataProvider()
    {
        return [
            // required
            ['', ['Custom message', []]],
            [' ', ['Custom message', []]],
            // 12 symbols
            ['12345678901', ['Custom message', []]],
            ['1234567890123', ['Custom message', []]],
            // numeric
            ['abcdefghijkl', ['Custom message', []]],
            ['123456a89012', ['Custom message', []]],
            // checksum
            ['850407401163', ['Custom message', []]],
            // century flag
            ['850407001167', ['Custom message', []]],
            ['850407101163', null],
            ['850407201161', null],
            ['850407301166', null],
            ['850407401162', null],
            ['850407501169', null],
            ['850407601165', null],
            ['850407701161', ['Custom message', []]],
            ['850407801168', ['Custom message', []]],
            ['850407901164', ['Custom message', []]],
        ];
    }
}
