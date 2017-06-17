<?php

namespace tests;

use alexeevdv\kz\PersonalidValidator;

/**
 * Class PersonalidTest
 * @package tests\faker\provider
 */
class PersonalidFakerProviderTest extends \Codeception\Test\Unit
{
    /**
     * Tests personalid provider
     */
    public function testProvider()
    {
        $faker = new \Faker\Generator();
        $faker->addProvider(new \alexeevdv\kz\PersonalidFakerProvider($faker));

        $personalid = $faker->personalid();

        $validator = new PersonalidValidator;
        $this->assertNull($validator->validateValue($personalid), $personalid);
    }
}
