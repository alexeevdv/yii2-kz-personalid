<?php

namespace tests\faker\provider;

use alexeevdv\kz\PersonalidValidator;

/**
 * Class PersonalidTest
 * @package tests\faker\provider
 */
class PersonalidTest extends \Codeception\Test\Unit
{
    /**
     * Tests personalid provider
     */
    public function testProvider()
    {
        $faker = new \Faker\Generator();
        $faker->addProvider(new \alexeevdv\kz\faker\provider\Personalid($faker));

        $personalid = $faker->personalid();

        $validator = new PersonalidValidator;
        $this->assertNull($validator->validateValue($personalid), $personalid);
    }
}
