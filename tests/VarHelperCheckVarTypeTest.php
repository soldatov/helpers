<?php

namespace Soldatov\Helpers\Tests;

use Soldatov\GetType\Types;
use Soldatov\Helpers\Exceptions\BadVarTypeException;
use Soldatov\Helpers\VarHelper;
use stdClass;

class VarHelperCheckVarTypeTest extends BaseTestCase
{
    public function testCheckStr()
    {
        $var = 'test';
        VarHelper::checkVarType($var, [Types::TYPE_STRING]);
        VarHelper::checkVarType($var, [Types::TYPE_INTEGER, Types::TYPE_STRING]);
        $this->expectException(BadVarTypeException::class);
        VarHelper::checkVarType($var, [Types::TYPE_INTEGER]);
    }

    public function testCheckObj()
    {
        $var = new stdClass();
        VarHelper::checkVarType($var, [Types::TYPE_OBJECT]);
        VarHelper::checkVarType($var, [Types::TYPE_STRING, Types::TYPE_OBJECT]);
        $this->expectException(BadVarTypeException::class);
        VarHelper::checkVarType($var, [Types::TYPE_INTEGER]);
    }

    public function testCheckFloat()
    {
        $var = 0.0;
        VarHelper::checkVarType($var, [Types::TYPE_FLOAT]);
        VarHelper::checkVarType($var, [Types::TYPE_STRING, Types::TYPE_FLOAT]);
        $this->expectException(BadVarTypeException::class);
        VarHelper::checkVarType($var, [Types::TYPE_INTEGER]);
    }

    public function testCheckInt()
    {
        $var = 0;
        VarHelper::checkVarType($var, [Types::TYPE_INTEGER]);
        VarHelper::checkVarType($var, [Types::TYPE_STRING, Types::TYPE_INTEGER]);
        $this->expectException(BadVarTypeException::class);
        VarHelper::checkVarType($var, [Types::TYPE_STRING]);
    }

    public function testCheckArray()
    {
        $var = [];
        VarHelper::checkVarType($var, [Types::TYPE_ARRAY]);
        VarHelper::checkVarType($var, [Types::TYPE_STRING, Types::TYPE_ARRAY]);
        $this->expectException(BadVarTypeException::class);
        VarHelper::checkVarType($var, [Types::TYPE_STRING]);
    }
}