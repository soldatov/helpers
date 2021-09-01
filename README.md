# Helpers

Helpers that extend the standard functionality of the PHP.

## StringHelper

### StringHelper::parseToBool

Helps to recognize a boolean value.

```php
use Soldatov\Helpers\StringHelper;

var_dump(StringHelper::parseToBool('да')); // bool(true)
var_dump(StringHelper::parseToBool('Yes')); // bool(true)
var_dump(StringHelper::parseToBool('  yes')); // bool(true)
var_dump(StringHelper::parseToBool('YES  ')); // bool(true)
var_dump(StringHelper::parseToBool('Y')); // bool(true)
var_dump(StringHelper::parseToBool('y')); // bool(true)
var_dump(StringHelper::parseToBool('t')); // bool(true)
var_dump(StringHelper::parseToBool('1')); // bool(true)
var_dump(StringHelper::parseToBool(1)); // bool(true)
var_dump(StringHelper::parseToBool(true)); // bool(true)
/* etc. */

var_dump(StringHelper::parseToBool('нет')); // bool(false)
var_dump(StringHelper::parseToBool('no')); // bool(false)
var_dump(StringHelper::parseToBool('n')); // bool(false)
var_dump(StringHelper::parseToBool('false')); // bool(false)
var_dump(StringHelper::parseToBool('none')); // bool(false)
var_dump(StringHelper::parseToBool('0')); // bool(false)
var_dump(StringHelper::parseToBool(0)); // bool(false)
var_dump(StringHelper::parseToBool(false)); // bool(false)
/* etc. */
```

### StringHelper::parseJson

```php
use Soldatov\Helpers\StringHelper;
StringHelper::parseJson('asd'); // Fatal error: Uncaught JsonException: Syntax error in ...
```

```php
use Soldatov\Helpers\StringHelper;
var_export(StringHelper::parseJson('{"a": 123}')); // array ('a' => 123,)
var_export(StringHelper::parseJson('  {"a":    123}    ')); // array ('a' => 123,)
```

### StringHelper::oneSpace
Removes extra spaces from a string.

```php
use Soldatov\Helpers\StringHelper;
var_export(StringHelper::oneSpace('One    two 3  ')); // 'One two 3'
```

### StringHelper::slicer
Splits a string by words into substrings that are no more than a certain length.
Supports UTF-8.

```php
use Soldatov\Helpers\StringHelper;
var_export(StringHelper::slicer('One two One three', 10)); // array (0 => 'One two', 1 => 'One three')
```

## VarHelper

### VarHelper::checkVarType

Checks if a variable is of a specific type.

```php
use Soldatov\GetType\Types;
use Soldatov\Helpers\VarHelper;

$var = 'test';
VarHelper::checkVarType($var, [Types::TYPE_STRING]); // ok
VarHelper::checkVarType($var, [Types::TYPE_INTEGER, Types::TYPE_FLOAT]); // BadVarTypeException
```
