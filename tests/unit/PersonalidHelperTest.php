<?php

namespace tests\unit;

use alexeevdv\kz\PersonalidHelper;
use yii\base\InvalidValueException;

/**
 * Class PersonalidValidatorTest
 * @package tests\unit
 */
class PersonalidHelperTest extends \Codeception\Test\Unit
{
    /**
     * Tests getBirthDate() method
     */
    public function testGetBirthDate()
    {
        $date = \DateTime::createFromFormat('Y-m-d', '1885-04-07');
        $this->assertEquals($date, PersonalidHelper::getBirthDate('850407101165'));
        $this->assertEquals($date, PersonalidHelper::getBirthDate('850407201165'));
        $date = \DateTime::createFromFormat('Y-m-d', '1985-04-07');
        $this->assertEquals($date, PersonalidHelper::getBirthDate('850407301165'));
        $this->assertEquals($date, PersonalidHelper::getBirthDate('850407401165'));
        $date = \DateTime::createFromFormat('Y-m-d', '2085-04-07');
        $this->assertEquals($date, PersonalidHelper::getBirthDate('850407501165'));
        $this->assertEquals($date, PersonalidHelper::getBirthDate('850407601165'));
        $this->assertFalse(PersonalidHelper::getBirthDate('850407701165'));
        $this->assertFalse(PersonalidHelper::getBirthDate('850407801165'));
        $this->assertFalse(PersonalidHelper::getBirthDate('850407901165'));
        $this->assertFalse(PersonalidHelper::getBirthDate('850407001165'));
    }

    /**
     * Tests getSex() method
     */
    public function testGetSex()
    {
        $this->assertEquals(PersonalidHelper::SEX_MALE, PersonalidHelper::getSex('850407101165'));
        $this->assertEquals(PersonalidHelper::SEX_MALE, PersonalidHelper::getSex('850407301165'));
        $this->assertEquals(PersonalidHelper::SEX_MALE, PersonalidHelper::getSex('850407501165'));
        $this->assertEquals(PersonalidHelper::SEX_FEMALE, PersonalidHelper::getSex('850407201165'));
        $this->assertEquals(PersonalidHelper::SEX_FEMALE, PersonalidHelper::getSex('850407401165'));
        $this->assertEquals(PersonalidHelper::SEX_FEMALE, PersonalidHelper::getSex('850407601165'));
        $this->expectException(InvalidValueException::class);
        PersonalidHelper::getSex('850407701165');
    }

    /**
     * Tests getSerialNumber() method
     */
    public function testGetSerialNumber()
    {
        $this->assertEquals('0116', PersonalidHelper::getSerialNumber('850407101165'));
    }
}
