<?php

namespace Soldatov\Helpers\Tests;

use JsonException;
use Soldatov\Helpers\Exceptions\BadParameterException;
use Soldatov\Helpers\StringHelper;
use stdClass;

class StringHelperParseBoolTest extends BaseTestCase
{
    public function testParseTrue()
    {
        var_dump(StringHelper::parseToBool('Yes'));

        $this->assertTrue(StringHelper::parseToBool('true'));
        $this->assertTrue(StringHelper::parseToBool('true  '));
        $this->assertTrue(StringHelper::parseToBool('  true  '));
        $this->assertTrue(StringHelper::parseToBool('  True  '));
        $this->assertTrue(StringHelper::parseToBool('y'));
        $this->assertTrue(StringHelper::parseToBool(' y'));
        $this->assertTrue(StringHelper::parseToBool(' Y'));
        $this->assertTrue(StringHelper::parseToBool('t'));
        $this->assertTrue(StringHelper::parseToBool(' t'));
        $this->assertTrue(StringHelper::parseToBool('T'));
        $this->assertTrue(StringHelper::parseToBool('T '));
        $this->assertTrue(StringHelper::parseToBool('1'));
        $this->assertTrue(StringHelper::parseToBool('1  '));
        $this->assertTrue(StringHelper::parseToBool('yes'));
        $this->assertTrue(StringHelper::parseToBool('YES'));
        $this->assertTrue(StringHelper::parseToBool('yeS'));
        $this->assertTrue(StringHelper::parseToBool('  yeS'));
        $this->assertTrue(StringHelper::parseToBool('  yeS  '));
        $this->assertTrue(StringHelper::parseToBool('yeS  '));

        $this->assertTrue(StringHelper::parseToBool(1));
        $this->assertTrue(StringHelper::parseToBool(100));
        $this->assertTrue(StringHelper::parseToBool(1.0));
        $this->assertTrue(StringHelper::parseToBool(true));
    }

    public function testParseFalse()
    {
        $this->assertFalse(StringHelper::parseToBool('false'));
        $this->assertFalse(StringHelper::parseToBool('  false'));
        $this->assertFalse(StringHelper::parseToBool('  false  '));
        $this->assertFalse(StringHelper::parseToBool('false  '));
        $this->assertFalse(StringHelper::parseToBool('False'));
        $this->assertFalse(StringHelper::parseToBool('FALSE'));
        $this->assertFalse(StringHelper::parseToBool('  FALSE'));
        $this->assertFalse(StringHelper::parseToBool('0'));
        $this->assertFalse(StringHelper::parseToBool(' 0'));
        $this->assertFalse(StringHelper::parseToBool('n'));
        $this->assertFalse(StringHelper::parseToBool('f'));
        $this->assertFalse(StringHelper::parseToBool('F'));
        $this->assertFalse(StringHelper::parseToBool('F '));
        $this->assertFalse(StringHelper::parseToBool('N'));
        $this->assertFalse(StringHelper::parseToBool('N  '));
        $this->assertFalse(StringHelper::parseToBool(' N  '));
        $this->assertFalse(StringHelper::parseToBool(' No  '));
        $this->assertFalse(StringHelper::parseToBool('NO'));
        $this->assertFalse(StringHelper::parseToBool('NOne'));

        $this->assertFalse(StringHelper::parseToBool(0));
        $this->assertFalse(StringHelper::parseToBool(0.0));
        $this->assertFalse(StringHelper::parseToBool(false));
    }

    public function testParseError()
    {
        $obj = new stdClass();

        $this->expectException(BadParameterException::class);
        StringHelper::parseToBool($obj);

        $this->expectException(BadParameterException::class);
        StringHelper::parseToBool(5.5);

        $this->expectException(BadParameterException::class);
        StringHelper::parseToBool('ttt');

        $this->expectException(BadParameterException::class);
        StringHelper::parseToBool('');

        $this->expectException(BadParameterException::class);
        StringHelper::parseToBool(' ');
    }

    public function testDefault()
    {
        $obj = new stdClass();
        $this->assertTrue(StringHelper::parseToBool($obj, true));
        $this->assertFalse(StringHelper::parseToBool($obj, false));
        $this->assertTrue(StringHelper::parseToBool(5.5, true));
        $this->assertFalse(StringHelper::parseToBool(5.5, false));
        $this->assertTrue(StringHelper::parseToBool('ttt', true));
        $this->assertFalse(StringHelper::parseToBool('ttt', false));
        $this->assertTrue(StringHelper::parseToBool('', true));
        $this->assertFalse(StringHelper::parseToBool('', false));
        $this->assertTrue(StringHelper::parseToBool(' ', true));
        $this->assertFalse(StringHelper::parseToBool(' ', false));
    }

    public function testParseJson()
    {
        $this->assertParsedRow(StringHelper::parseJson('{"a": 123, "b": [2, 3]}'));
        $this->assertParsedRow(StringHelper::parseJson('  {"a": 123, "b": [2, 3]}'));
        $this->assertParsedRow(StringHelper::parseJson('     {"a": 123,    "b": [2, 3]}     '));
    }

    public function testParseJsonError()
    {
        $this->expectException(JsonException::class);
        StringHelper::parseJson('{"a: 123, "b": [2, 3]}');
    }

    private function assertParsedRow($row)
    {
        $this->assertIsArray($row);
        $this->assertArrayHasKey('a', $row);
        $this->assertArrayHasKey('b', $row);
        $this->assertIsInt($row['a']);
        $this->assertEquals(123, $row['a']);
        $this->assertIsArray($row['b']);
        $this->assertArrayHasKey(0, $row['b']);
        $this->assertArrayHasKey(1, $row['b']);
        $this->assertEquals(2, $row['b'][0]);
        $this->assertEquals(3, $row['b'][1]);
    }
}