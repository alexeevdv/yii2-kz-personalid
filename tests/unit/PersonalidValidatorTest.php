<?php

namespace testsunit;

use alexeevdv\kz\PersonalidValidator;
use yii\base\Model;

/**
 * Class PersonalidValidatorTest
 * @package tests\unit
 */
class PersonalidValidatorTest extends \Codeception\Test\Unit
{
    /**
     * @var \tests\UnitTester
     */
    public $tester;

    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation($value, $error)
    {
        $validator = new PersonalidValidator;
        $validator->message = 'Custom message';
        $this->tester->assertEquals($error, $validator->validateValue($value), $value);
    }

    /**
     * @return array
     */
    public function validationDataProvider()
    {
        return [
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

    /**
     * @test
     */
    public function clientValidateAttribute()
    {
        $validator = new PersonalidValidator;
        $js = $validator->clientValidateAttribute(new Model, 'attribute', 'view');
        $this->tester->assertNotEmpty($js, 'There should be some JS for client validation');
    }
}
