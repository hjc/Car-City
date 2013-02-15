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
class Car extends LandVehicle
{
    use Steering\SteeringWheel;
    /** @var int the number of cars we have created */
    public static $car_count = 0;
    private static $door_locs = ['Driver', 'Passenger', 'Driver-Back', 'Passenger-Back'];

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
            $this->doors[$i] = new Door(Car::$door_locs[$i]);
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
     * Simple function to unlock the cars doors. A number corresponding to
     *   a door is passed in then the door that matches that has its unlock()
     *   method called.
     *
     * Passing in nothing or -1 will unlock all doors.
     *
     * @param int $door     Indicate which door we want to unlock, -1 is all, $door_count is max
     */
    public function unlock($door = -1) {
        echo PHP_EOL;
        //unlock all doors? Keeping it as < 0 sanitizes us against any negative
        // subscript problems we might have if we just checked for $door == -1
        if ($door < 0) {
            //yes
            $this->action("Unlocking all doors");
            $i = 0;

            //loop, grab a door, explain its place, unlock it
            foreach($this->doors as $d) {
                $this->action("Unlocking door $i: " . $d->get_location());
                $d->unlock();
            }
        }
        else{
            //no; if $door is larger than $this->door_count, fix it or we'll get
            // a null reference to an array
            if ($door >= $this->door_count) {
                $door = $this->door_count - 1;
            }
            $this->action("Unlocking door $door: " . $this->doors[$door]->get_location());
            $this->doors[$door]->unlock();
        }
    }

    /**
     * Simple function to lock the cars doors. A number corresponding to
     *   a door is passed in then the door that matches that has its lock()
     *   method called.
     *
     * Passing in nothing or -1 will lock all doors.
     *
     * @param int $door     Indicate which door we want to lock, -1 is all, $door_count is max
     */
    public function lock($door = -1) {
        echo PHP_EOL;
        //lock all doors? Keeping it as < 0 sanitizes us against any negative
        // subscript problems we might have if we just checked for $door == -1
        if ($door < 0) {
            //yes
            $this->action("Locking all doors");
            $i = 0;

            //loop, grab a door, explain its place, unlock it
            foreach($this->doors as $d) {
                $this->action("Locking door $i: " . $d->get_location());
                $d->lock();
                $i++;
            }
        }
        else{
            //no; if $door is larger than $this->door_count, fix it or we'll get
            // a null reference to an array
            if ($door >= $this->door_count) {
                $door = $this->door_count - 1;
            }
            $this->action("Locking door $door: " . $this->doors[$door]->get_location());
            $this->doors[$door]->lock();
        }
    }

    /**
     * Simple function to open the cars doors. A number corresponding to
     *   a door is passed in then the door that matches that has its open()
     *   method called.
     *
     * Passing in nothing or -1 will lock all doors.
     *
     * @param int $door     Indicate which door we want to lock, -1 is all, $door_count is max
     */
    public function open($door = -1) {
        echo PHP_EOL;
        //lock all doors? Keeping it as < 0 sanitizes us against any negative
        // subscript problems we might have if we just checked for $door == -1
        if ($door < 0) {
            //yes
            $this->action("Locking all doors");
            $i = 0;

            //loop, grab a door, explain its place, unlock it
            foreach($this->doors as $d) {
                $this->action("Locking door $i: " . $d->get_location());
                $d->lock();
                $i++;
            }
        }
        else{
            //no; if $door is larger than $this->door_count, fix it or we'll get
            // a null reference to an array
            if ($door >= $this->door_count) {
                $door = $this->door_count - 1;
            }
            $this->action("Locking door $door: " . $this->doors[$door]->get_location());
            $this->doors[$door]->lock();
        }
    }

    public function test() {
        parent::test();
        $this->unlock();
        $this->lock();
    }
}
