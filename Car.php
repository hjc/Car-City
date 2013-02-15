<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/15/13
 * Time: 2:17 AM
 * To change this template use File | Settings | File Templates.
 */
/**
 * PHP Magic function that gets called every time an undefined class is referenced,
 *  it will include the class if it can.
 *
 * @param string $class_name       The name of the class we want to include.
 */

/*
     * for cars,
     * need doors, count and array[count] of TF to indicate open or closed
     * door status, list number of doors, location (driver, passenger, back driver), locked, open
     * need to lock and unlock doors
     * need to open doors, check if they are locked first
     *
     * for trucks,
     * need to lower beds
     */
use VehicleParts\Door;
class Car extends LandVehicle implements \Steering\iSteeringWheel
{
    /** @var int the number of cars we have created */
    public static $car_count;

    /** @var int the current number of this car */
    protected $car_number;

    /** @var int sets the number of doors the car will have */
    protected $door_count;

    /** @var array stores the states of our various doors, as Door objects */
    protected $doors;

    /**
     * Construct our Car for us. Set its number, increase our car count, set the
     *   number of doors, initialize $doors array so all doors are closed
     *
     * @param int $weight
     * @param int $top_speed
     * @param int $doors
     */
    public function __construct($weight, $top_speed, $doors = 4) {
        echo PHP_EOL;
        //set car number and increase car count
        $this->car_number = Car::$car_count++;

        //set wheel numbers
        $this->num_wheels = 4;

        //set doors
        $this->door_count = $doors;

        //init $doors array
        for ($i = 0; $i < $doors; $i++) {
            $this->doors[$i] = new Door();
        }

        echo "Created new Car, name: " . $this->name() . ", NUMBER: " . Car::$car_count .  PHP_EOL;
        echo "Attributes:" . PHP_EOL . "\tWeight: $weight" . PHP_EOL
            . "\tTop Speed: $top_speed" . PHP_EOL . "\tDoors: $doors (all closed and locked)" . PHP_EOL;

        parent::__construct($weight, 5, 4, $top_speed);
    }

    /**
     * Explain your tire setup, call parent method to print.
     */
    public function check_tire_pressure() {
        echo PHP_EOL;
        $this->action("checking tire pressure");
        echo "Tire 1 is the front left tire." . PHP_EOL
            . "Tire 2 is the front right tire." . PHP_EOL
            . "Tire 3 is the back left tire." . PHP_EOL
            . "Tire 4 is the back right tire." . PHP_EOL;
        parent::check_tire_pressure();
    }

    /**
     * Time to implement the iSteeringWheel Interface
     */

    /**
     * Make some noise for us!
     */
    public function honk(){
        echo PHP_EOL;
        $this->action("honking");
        echo "HONK! HONK!" . PHP_EOL;
    }


}
