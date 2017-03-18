<?php

namespace PFlorek\Elevator\Tests;

use PFlorek\Elevator\Elevator;
use PHPUnit\Framework\TestCase;

class ElevatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider worldElevatedProvider
     *
     * @param array $elevated
     */
    public function foldAndElevate(array $elevated) {
        $flattened = Elevator::down($elevated);
        var_dump($flattened);
        $this->assertEquals(Elevator::up($flattened), $elevated);
    }

    /**
     * @test
     * @dataProvider worldFlattenedProvider
     *
     * @param array $flattened
     */
    public function elevateAndFold(array $flattened) {
        $elevated = Elevator::up($flattened);
        var_dump($elevated);
        $this->assertEquals(Elevator::down($elevated), $flattened);
    }

    public function worldElevatedProvider() {
        return [
            'World Test Data Elevated' => [
                [
                    'World' => [
                        'Asia' => [
                            'Afghanistan' => [
                                '...'
                            ],
                            '...'
                        ],
                        'Africa' => true,
                        'Antarctica' => -25.2,
                        'Europe' => new \stdClass(),
                        'North America' => 1,
                        'Oceania' => [],
                        'South America' => null
                    ]
                ]
            ]
        ];
    }

    public function worldFlattenedProvider() {
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
                ]
            ]
        ];
    }
}
