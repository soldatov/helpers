<?php

namespace Soldatov\Helpers\Tests;

use Soldatov\Helpers\StringHelper;

class StringHelperSlicerTest extends BaseTestCase
{
    public function testCurrentString()
    {
        $str = 'One two 3';
        $row = StringHelper::slicer($str);
        $this->assertEquals($str, $row[0]);
    }

    public function testSlice()
    {
        $str = 'One two One two';
        $row = StringHelper::slicer($str, 10);
        $this->assertEquals($row[0], $row[1]);

        $row = StringHelper::slicer($str, 3);
        $this->assertEquals($row[0], $row[2]);
        $this->assertEquals($row[1], $row[3]);

        $this->assertCount(4, $row);
    }

    public function testSliceLong()
    {
        $str = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, '
            . 'totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta '
            . 'sunt explicabo. But I must explain to you how all (this) mistaken idea of denouncing pleasure and '
            . 'praising pain was born and I will give you a complete account of the system, and expound the actual '
            . 'teachings of the great explorer of the truth, the master-builder of human happiness.';
        $row = StringHelper::slicer($str);

        $this->assertEquals(
            '(this) mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete '
            . 'account of the system, and expound the actual teachings of the great explorer of the truth, the '
            . 'master-builder of human happiness.',
            $row[1]
        );
    }

    public function testEmpty()
    {
        $row = StringHelper::slicer('', 3);
        $this->assertEquals('', $row[0]);
        $this->assertCount(1, $row);
    }

    public function testRu()
    {
        $row = StringHelper::slicer('Съешь [же] ещё этих мягких французских булок да выпей чаю', 11);
        $this->assertCount(6, $row);
        $this->assertEquals('Съешь [же]', $row[0]);
        $this->assertEquals('ещё этих', $row[1]);
        $this->assertEquals('мягких', $row[2]);
        $this->assertEquals('французских', $row[3]);
        $this->assertEquals('булок да', $row[4]);
        $this->assertEquals('выпей чаю', $row[5]);
    }
}
