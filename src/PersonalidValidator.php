<?php

namespace alexeevdv\kz;

use yii\validators\Validator;

/**
 * Class PersonalidValidator
 * @package alexeevdv\kz
 */
class PersonalidValidator extends Validator
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!$this->message) {
            $this->message = 'Wrong identification number';
        }
    }

    /**
     * @inheritdoc
     */
    public function validateValue($value)
    {
        if (strlen($value) !== 12) {
            return [$this->message, []];
        }

        if (!is_numeric($value)) {
            return [$this->message, []];
        }

        $centuryFlag = substr($value, 6, 1);
        if (!in_array($centuryFlag, [1, 2, 3, 4, 5, 6])) {
            return [$this->message, []];
        }

        if (substr($value, 11, 1) != PersonalidHelper::calculateChecksum($value)) {
            return [$this->message, []];
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return <<<JS
            (function (messages, value) {
                if (!value.length) {
                    return;
                }
                if (value.length !== 12) {
                    messages.push($message);
                    return;
                }
                if (!$.isNumeric(value)) {
                   messages.push($message);
                   return;
                }
                var centuryFlag = parseInt(value.substr(6, 1));
                if (centuryFlag < 1 || centuryFlag > 6) {
                   messages.push($message);
                   return;
                }
                
                var calculateChecksum = function (value) {
                    var sum = 0;
                    for (i = 0; i < 11; i++) {
                        sum = sum + (i + 1) * parseInt(value.charAt(i));
                    }
                    var checksum = sum % 11;
                    if (checksum !== 10) {
                        return checksum;
                    }
                    sum = 0;
                    for (i = 0; i < 11; i++) {
                        var t = (i + 3) % 11;
                        if (t === 0) {
                            t = 11;
                        }
                        sum = sum + t * parseInt(value.charAt(i));
                    }
                    return sum % 11;                    
                };
                
                if (parseInt(value.substr(11, 1)) !== calculateChecksum(value)) {
                    messages.push($message);
                }
            })(messages, value);
JS;
    }
}
