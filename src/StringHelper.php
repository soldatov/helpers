<?php

namespace Soldatov\Helpers;

use JsonException;
use Soldatov\Helpers\Exceptions\BadParameterException;
use Soldatov\Helpers\Exceptions\BadVarTypeException;

class StringHelper extends BaseHelper
{
    private static $strTrue = ['true', 't', '1', 'y', 'yes', 'да'];
    private static $strFalse = ['false', 'f', '0', 'n', 'no', 'none', 'нет'];

    /**
     * @param bool|int|string $value
     * @param bool $default If null, will return an exception on error. If bool, return $default.
     * @return bool
     * @throws BadParameterException
     */
    public static function parseToBool($value, bool $default = null): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        if (is_integer($value)) {
            return (bool)$value;
        }

        if ($value === 0.0) {
            return false;
        }

        if ($value === 1.0) {
            return true;
        }

        try {
            VarHelper::checkVarType($value);
        } catch (BadVarTypeException $exception) {
            if (is_null($default)) {
                throw new BadParameterException(
                    'Value type not allowed and no default value set.',
                    'value',
                    'parseToBool',
                    $exception->getCode(),
                    $exception
                );
            }

            return $default;
        }

        $value = trim($value);

        if ($value === '') {
            if (is_null($default)) {
                throw new BadParameterException(
                    'The value is empty and no default value is set.',
                    'value',
                    'parseToBool'
                );
            }

            return $default;
        }

        $value = mb_strtolower($value);

        if (in_array($value, self::$strTrue)) {
            return true;
        }

        if (in_array($value, self::$strFalse)) {
            return false;
        }

        if (is_null($default)) {
            throw new BadParameterException(
                'The value is empty and no default value is set.',
                'value',
                'parseToBool'
            );
        }

        return $default;
    }

    /**
     * @param string $json
     * @return mixed
     * @throws JsonException
     */
    public static function parseJson(string $json)
    {
        return json_decode(trim($json), true, 512, JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_IGNORE);
    }


    /**
     * Replaces multiple spaces with one
     * @param string $str
     * @return string
     */
    public static function oneSpace(string $str): string
    {
        return trim(preg_replace('|\s+|', ' ', $str));
    }


    /**
     * Splits a string into an array of strings of no more than a certain length
     * @param string $str
     * @param int $width Max string width
     * @return array|string[]
     */
    public static function slicer(string $str, int $width = 255): array
    {
        $str = self::oneSpace($str);
        $break = '{{break'.substr(md5(time() . '_' . microtime()), 0, 8).'}}';
        $str = self::mb_wordwrap($str, $width, $break, true);

        return explode($break, $str);
    }
}
