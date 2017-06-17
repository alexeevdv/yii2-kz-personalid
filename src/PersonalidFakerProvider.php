<?php

namespace alexeevdv\kz;

use alexeevdv\kz\PersonalidHelper;

/**
 * Class Personalid
 * @package alexeevdv\kz
 */
class PersonalidFakerProvider extends \Faker\Provider\Base
{
    /**
     * @return string
     */
    public function personalid()
    {
        $date = \Faker\Provider\DateTime::dateTimeBetween(new \DateTime('1800-01-01 00:00:00'));
        $personalid = $date->format('ymd');

        $female = 0;
        $male = 1;
        $sex = mt_rand($female, $male);

        $century = substr($date->format('Y'), 0, 2) + 1;
        if ($female) {
            if ($century == 19) {
                $personalid .= '2';
            }
            if ($century == 20) {
                $personalid .= '4';
            }
            if ($century == 21) {
                $personalid .= '6';
            }
        } else {
            if ($century == 19) {
                $personalid .= '1';
            }
            if ($century == 20) {
                $personalid .= '3';
            }
            if ($century == 21) {
                $personalid .= '5';
            }
        }

        $personalid .= mt_rand(1000, 9999);

        $checksum = PersonalidHelper::calculateChecksum($personalid);

        if ($checksum == 10) {
            return $this->personalid();
        }

        return $personalid . $checksum;
    }
}
