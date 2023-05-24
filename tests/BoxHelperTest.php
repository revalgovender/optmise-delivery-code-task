<?php

namespace tests;

use Reval\BoxHelper;
use PHPUnit\Framework\TestCase;

class BoxHelperTest extends TestCase
{
    protected BoxHelper $subject;

    protected function setUp(): void
    {
        $this->subject = new BoxHelper();
    }

    public function testItWillCalculateVolumeOfBoxInCm3(): void
    {
        // Arrange.
        $box = ['dimensions' => [10, 20, 30]];

        // Act.
        $result = $this->subject->calculateVolumeInCm3($box);

        // Assert.
        $this->assertEquals(6, $result);
    }

    public function testItWillSortBoxesByVolume(): void
    {
        // Arrange.
        $boxes = [
            ['volumeCm3' => 2],
            ['volumeCm3' => 3],
            ['volumeCm3' => 1],
        ];

        // Act.
        $result = $this->subject->sortBoxesByVolume($boxes);

        // Assert.
        $this->assertEquals(1, $result[0]['volumeCm3']);
        $this->assertEquals(2, $result[1]['volumeCm3']);
        $this->assertEquals(3, $result[2]['volumeCm3']);
    }
}
