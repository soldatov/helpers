<?php

namespace Soldatov\Helpers;

use Soldatov\GetType\Types;
use Soldatov\Helpers\Exceptions\BadVarTypeException;

class VarHelper extends BaseHelper
{
    /**
     * @param $var
     * @param array $types
     * @throws BadVarTypeException
     */
    public static function checkVarType($var, array $types = [Types::TYPE_STRING]): void
    {
        $type = gettype($var);

        if (!in_array($type, $types)) {
            throw new BadVarTypeException($type, $types);
        }
    }
}