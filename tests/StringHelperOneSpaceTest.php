<?php

namespace Soldatov\Helpers\Tests;

use Soldatov\Helpers\StringHelper;

class StringHelperOneSpaceTest extends BaseTestCase
{
    public function testCurrentString()
    {
        $str = 'One two 3';
        $this->assertEquals($str, StringHelper::oneSpace($str));
    }

    public function testTrimString()
    {
        $this->assertEquals(
            'One two 3',
            StringHelper::oneSpace('One two 3  ')
        );

        $this->assertEquals(
            'One two 3',
            StringHelper::oneSpace('   One two 3  ')
        );

        $this->assertEquals(
            'One two 3',
            StringHelper::oneSpace('   One two 3')
        );

        $this->assertEquals(
            '',
            StringHelper::oneSpace('   ')
        );
    }

    public function testMultiSpacesString()
    {
        $a = var_export(\Soldatov\Helpers\StringHelper::slicer('One two One two', 10), true);

        $this->assertEquals(
            'One two 3',
            StringHelper::oneSpace('One    two 3  ')
        );

        $this->assertEquals(
            'One two 3',
            StringHelper::oneSpace('   One two    3  ')
        );

        $this->assertEquals(
            'One two 3',
            StringHelper::oneSpace('   One         two
              3
')
        );
    }
}
