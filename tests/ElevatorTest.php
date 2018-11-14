<?php

namespace PFlorek\Elevator\Tests;

use PHPUnit\Framework\TestCase;

class ElevatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider worldElevatedProvider
     * @param array $elevated
     */
    public function foldAndElevate(array $elevated)
    {
        $flattened = \PFlorek\Elevator\array_flatten($elevated);
        var_dump($flattened);
        $this->assertEquals(\PFlorek\Elevator\array_elevate($flattened), $elevated);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function fold_WithoutIterable_ShouldThrowRuntimeException()
    {
        \PFlorek\Elevator\array_flatten('any_scalar');
    }

    /**
     * @test
     * @dataProvider worldFlattenedProvider
     * @param array $flattened
     */
    public function elevateAndFold(array $flattened)
    {
        $elevated = \PFlorek\Elevator\array_elevate($flattened);
        var_dump($elevated);
        $this->assertEquals(\PFlorek\Elevator\array_flatten($elevated), $flattened);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function elevate_WithoutIterable_ShouldThrowRuntimeException()
    {
        \PFlorek\Elevator\array_elevate(0);
    }

    public function worldElevatedProvider()
    {
        return [
            'World Test Data Elevated' => [
                [
                    'World' => [
                        'Asia' => [
                            'Afghanistan' => [
                                '...',
                            ],
                            '...',
                        ],
                        'Africa' => true,
                        'Antarctica' => -25.2,
                        'Europe' => new \stdClass(),
                        'North America' => 1,
                        'Oceania' => [],
                        'South America' => null,
                    ],
                ],
            ],
        ];
    }

    public function worldFlattenedProvider()
    {
        return [
            'World Test Data Flattened' => [
                [
                    'World.Asia.Afghanistan.0' => '...',
                    'World.Asia.0' => '...',
                    'World.Africa' => true,
                    'World.Antarctica' => -25.2,
                    'World.Europe' => new \stdClass(),
                    'World.North America' => 1,
                    'World.Oceania' => [],
                    'World.South America' => null,
                ],
            ],
        ];
    }
}
