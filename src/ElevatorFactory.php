<?php

namespace PFlorek\Elevator;

class ElevatorFactory
{
    /**
     * @var ElevatorFactory
     */
    protected static $instance;

    /**
     * @return \PFlorek\Elevator\Elevator
     */
    public function create()
    {
        return new Elevator();
    }

    /**
     * @return \PFlorek\Elevator\ElevatorFactory
     */
    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}