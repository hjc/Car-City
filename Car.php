<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/15/13
 * Time: 2:17 AM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Simple implementation of a car. Provides door functionality in addition to
 *   all the functionality it inherits from LandVehicle. Uses a generic mapping
 *   method to call functions on all the doors.
 *
 * @package     Vehicles
 * @subpackage  Car
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
use VehicleParts\Door;
class Car extends LandVehicle
{
    use Steering\SteeringWheel;
    /** @var int the number of cars we have created */
    public static $car_count = 0;

    /** @var int the current number of this car */
    protected $car_number;

    /** @var int sets the number of doors the car will have */
    protected $door_count;

    /** @var array stores the states of our various doors, as Door objects */
    protected $doors;

    /** @var array Some constant values used in door initialization to tell where the door is on the car */
    protected static $door_locs = ['Driver', 'Passenger', 'Driver-Back', 'Passenger-Back'];

    /**
     * Construct our Car for us. Set its number, increase our car count, set the
     *   number of doors, initialize $doors array so all doors are closed
     *
     * @param int $weight           Vehicle Weight
     * @param int $cap              Maximum capacity of vehicle
     * @param int $top_speed        Maximum speed of vehicle
     * @param int $doors            Number of doors car has
     */
    public function __construct($weight, $cap, $top_speed, $doors = 4) {
        echo PHP_EOL;
        //set car number and increase car count
        $this->car_number = Car::$car_count++;

        //set doors
        $this->door_count = $doors;

        //init $doors array
        for ($i = 0; $i < $doors; $i++) {
            $this->doors[$i] = new Door(Car::$door_locs[$i]);
        }

        echo "Created new Car, name: " . $this->name() . ", NUMBER: " . Car::$car_count .  PHP_EOL;
        echo "Attributes:" . PHP_EOL . "\tWeight: $weight" . PHP_EOL
            . "\tTop Speed: $top_speed" . PHP_EOL . "\tDoors: $doors (all closed and locked)" . PHP_EOL;

        //have parents do the rest
        parent::__construct($weight, $cap, $top_speed, 4);
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
     * All door actions, open, close, lock, and unlock all follow identical logic
     *   and only differ in function calls. So they have been abstracted and generalized
     *   to this. There are wrapper functions below for lock(), unlock(), open(), and close(),
     *   but they just pass the relevant arguments over to this function who does all
     *   the work for doors.
     *
     * @param string $fn            Name of the function we want to call
     * @param int $door             Number of the door we want to open, <0 means all doors
     * @param null|string $gerund   Modifier for $fn to make it fit the annotated description
     *                                better, used for closing.
     */
    protected  function door_map($fn, $door = -1, $gerund = NULL) {
        echo PHP_EOL;

        //see if we need to build the $gerund
        if ($gerund === NULL) {
            $gerund = ucfirst($fn) . "ing";
        }

        //see if we're acting on all doors or what
        if ($door < 0) {
            //yes, acting on all doors
            $this->action($gerund . " all doors");
            $i = 0;

            //loop, grab a door, explain its place, deal with it
            foreach($this->doors as $d) {
                $this->action("$gerund door $i: " . $d->get_location());
                $d->$fn();
                $i++;
            }
        }
        else{
            //no not acting on all doors;
            //if $door is larger than $this->door_count, fix it or we'll get
            // a null reference to an array
            if ($door >= $this->door_count) {
                $door = $this->door_count - 1;
            }
            $this->action("$gerund door $door: " . $this->doors[$door]->get_location());
            $this->doors[$door]->$fn();
        }
    }

    /**
     * Simple function to close the cars doors. A number corresponding to
     *   a door is passed in then the door that matches that has its close()
     *   method called.
     *
     * Passing in nothing or -1 will close all doors.
     *
     * Delegates work to door_map
     *
     * @param int $door     Indicate which door we want to close, -1 is all, $door_count is max
     */
    public function close($door = -1) {
        $this->door_map("close", $door, "Closing");
    }

    /**
     * Simple function to open the cars doors. A number corresponding to
     *   a door is passed in then the door that matches that has its open()
     *   method called.
     *
     * Passing in nothing or -1 will open all doors.
     *
     * Delegates work to door_map
     *
     * @param int $door     Indicate which door we want to open, -1 is all, $door_count is max
     */
    public function open($door = -1) {
        $this->door_map("open", $door);
    }

    /**
     * Simple function to unlock the cars doors. A number corresponding to
     *   a door is passed in then the door that matches that has its unlock()
     *   method called.
     *
     * Passing in nothing or -1 will unlock all doors.
     *
     * Delegates work to door_map
     *
     * @param int $door     Indicate which door we want to unlock, -1 is all, $door_count is max
     */
    public function unlock($door = -1) {
        $this->door_map("unlock", $door);
    }

    /**
     * Simple function to lock the cars doors. A number corresponding to
     *   a door is passed in then the door that matches that has its lock()
     *   method called.
     *
     * Passing in nothing or -1 will lock all doors.
     *
     * Delegates work to door_map
     *
     * @param int $door     Indicate which door we want to lock, -1 is all, $door_count is max
     */
    public function lock($door = -1) {
        $this->door_map("lock", $door);
    }

    /**
     * Another test function.
     * Extend parent tests to test for door methods
     */
    public function test() {
        parent::test();
        echo PHP_EOL . "First open should fail, locked doors" . PHP_EOL;
        $this->open();
        $this->unlock();

        echo PHP_EOL . "This should succeed";
        $this->open();
        $this->close();
        $this->lock();

        echo PHP_EOL . "Should tell us doors are closed already";
        $this->close();

        echo PHP_EOL . "Testing results for single doors";
        $this->open(0);
        $this->unlock(0);
        $this->open(0);
        $this->close(0);
        $this->lock(0);
    }
}
