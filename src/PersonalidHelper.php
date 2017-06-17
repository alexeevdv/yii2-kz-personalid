<?php

namespace alexeevdv\kz;

use yii\base\InvalidValueException;

/**
 * Class PersonaidHelper
 * @package alexeevdv\kz
 */
class PersonalidHelper
{
    const SEX_FEMALE = 0;
    const SEX_MALE = 1;

    /**
     * @param string $personalid
     * @return bool|\DateTime
     */
    public static function getBirthDate($personalid)
    {
        $date = substr($personalid, 0, 6);
        switch ($personalid{6}) {
            case '1':
            case '2':
                $date = '18' . $date;
                break;
            case '3':
            case '4':
                $date = '19' . $date;
                break;
            case '5':
            case '6':
                $date = '20' . $date;
                break;
            default:
                return false;
        }
        return \DateTime::createFromFormat('Ymd', $date);
    }

    /**
     * @param string $personalid
     * @return int
     * @throws InvalidValueException
     */
    public static function getSex($personalid)
    {
        $sexFlag = $personalid{6};
        if (in_array($sexFlag, ['1', '3', '5'])) {
            return static::SEX_MALE;
        }
        if (in_array($sexFlag, ['2', '4', '6'])) {
            return static::SEX_FEMALE;
        }
        throw new InvalidValueException('`personalid` value is incorrect');
    }

    /**
     * @param string $personalid
     * @return string
     */
    public static function getSerialNumber($personalid)
    {
        return substr($personalid, 7, 4);
    }

    /**
     * @param string $value
     * @return int
     */
    public static function calculateChecksum($value)
    {
        $sum = 0;
        for ($i = 0; $i < 11; $i++) {
            $sum = $sum + ($i + 1) * $value{$i};
        }
        $checksum = $sum % 11;
        if ($checksum != 10) {
            return $checksum;
        }
        $sum = 0;
        for ($i = 0; $i < 11; $i++) {
            $t = ($i + 3) % 11;
            if ($t == 0) {
                $t = 11;
            }
            $sum = $sum + $t * $value{$i};
        }
        return $sum % 11;
    }
}
