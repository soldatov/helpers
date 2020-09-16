<?php

namespace Soldatov\Helpers;

use Soldatov\Helpers\Exceptions\BadParameterException;
use Soldatov\Helpers\Exceptions\BadVarTypeException;

class StringHelper extends BaseHelper
{
    private static $strTrue = ['true', 't', '1', 'y', 'yes'];
    private static $strFalse = ['false', 'f', '0', 'n', 'no', 'none'];

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
}