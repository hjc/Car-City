<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/15/13
 * Time: 4:49 AM
 * To change this template use File | Settings | File Templates.
 */
/**
 * Simple class to implement the concept of a pickup truck. This is just an extended
 *   car that has a bed with loading features, such as raising the tailgate and adding
 *   items. Other than that it is identical to a car.
 *
 * @package     Vehicles
 * @subpackage  PickupTruck
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
use VehicleParts\Door;
class PickupTruck extends Car
{
    /** @var int the number of cars we have created */
    public static $pickuptruck_count = 0;

    /** @var int the current number of this car */
    protected $pickuptruck_number;

    /** @var array hold the item in the truck's load */
    protected $load = [];

    /** @var bool tell us if the loading gate is down, starts out up */
    protected $gate_down = FALSE;

    /**
     * Simple constructor that will init doors, setup class counters, object name, etc.
     *   and then call parent
     *
     * @param int $weight           Weight of vehicle
     * @param int $cap              Maximum capacity of vehicle
     * @param int $top_speed        Top speed of vehicle
     * @param int $doors            # of Doors, defaults to 2 with a pickup truck
     */
    public function __construct($weight, $cap, $top_speed, $doors = 2) {
        echo PHP_EOL;
        //set car number and increase car count
        $this->pickuptruck_number = PickupTruck::$pickuptruck_count++;

        echo "Created new PickupTruck, name: " . $this->name() . ", NUMBER: " . PickupTruck::$pickuptruck_count .  PHP_EOL;
        echo "Attributes:" . PHP_EOL . "\tWeight: $weight" . PHP_EOL
            . "\tTop Speed: $top_speed" . PHP_EOL . "\tDoors: $doors (all closed and locked)" . PHP_EOL;

        parent::__construct($weight, $cap, $top_speed, $doors);
    }

    /**
     * Function to add an item to our pickup truck, item will be a string. If
     *   gate is not down before we load, we will lower it.
     *
     * @param string $item      The item we are adding to the load
     */
    public function load_item($item) {
        echo PHP_EOL;

        $this->action("beginning to load an item");

        //if gate is not down yet, tell us that and then lower it
        if (!$this->gate_down) {
            $this->action("gate not down yet! Lowering", FALSE);
            $this->lower_gate();
        }

        $this->action("loading item: $item onto truck");
        $this->load[] = $item;
        $this->action("$item loaded onto truck");
    }

    /**
     * Simple function to lower the truck's gate so we can add items to its load
     */
    public function lower_gate() {
        echo PHP_EOL;
        if ($this->gate_down) {
            $this->action("gate is already down");
            return;
        }
        $this->action("lowering gate down");
        $this->gate_down = TRUE;
        $this->action("gate is down");
    }

    /**
     * Simple function to raise the truck's gate so we can drive off
     */
    public function raise_gate() {
        echo PHP_EOL;
        if (!$this->gate_down) {
            $this->action("gate is already up");
            return;
        }
        $this->action("raising gate up");
        $this->gate_down = FALSE;
        $this->action("gate is up");
    }

    /**
     * Merely display the items the truck is currently carrying
     */
    public function show_load() {
        echo PHP_EOL;
        $this->action("displaying truck load");

        //if we have nothing, say so and quit
        if (empty($this->load)) {
            $this->action("truck is empty");
            return;
        }
        $i = 1;
        foreach ($this->load as $item) {
            $this->action("Item #$i: " . $item);
            $i++;
        }
    }

    /**
     * Unload the truck. Print the contents in the process.
     */
    public function dropoff() {
        echo PHP_EOL;
        $this->action("beginning to dropoff");
        //if truck is empty, don't bother, just move on
        if (empty($this->load)) {
            $this->action("truck is empty");
            return;
        }

        //if truck is moving, stop it
        if($this->current_speed > 0) {
            $this->change_speed(0);
        }

        //if gate isn't down, lower it
        if (!$this->gate_down){
            //suppress the newline, looks weird
            $this->action("dropoff: dropping gate", FALSE);

            //have to lower gate to grab items
            $this->lower_gate();
        }

        //grab items and "unload" them
        $i = 1;
        foreach ($this->load as $item) {
            $this->action("Unloading item #$i: " . $item );
        }

        //indicate truck has nothing in its bed
        $this->load = [];
        $this->action("truck is now completely empty");

        //reraise gate
        $this->action("dropoff: raising gate again", FALSE);
        $this->raise_gate();
        $this->action("end dropoff");
    }

    /**
     * Even though most trucks can drive with things in their bed and the gate down,
     *   we will pretend this one cannot. It can drive with the gate down, but not if
     *   anything is in, thus we will issue a warning if we try to drive off with
     *   items in the bed and the gate down. Functions purpose is identical to parent
     *   method:
     *
     * Increase the vehicle's speed by providing an acceleration rate (m/s^2) and
     *  a duration (s). Also going to pretend there is no friction.
     *
     * @param float $rate       Acceleration rate, in m^2
     * @param float $duration   Acceleration time, in s
     */
    public function accelerate($rate, $duration) {
        if ($this->gate_down && !empty($this->load)) {
            echo PHP_EOL;
            $this->action("gate is down! Raising it before we leave", FALSE);
            $this->raise_gate();
        }

        //call parent
        parent::accelerate($rate, $duration);
    }

    /**
     * As always, override test to test Truck specific features
     */
    public function test() {
        parent::test();
        $this->raise_gate();
        $this->lower_gate();
        $this->load_item("potato");
        $this->dropoff();

        echo PHP_EOL . "should have to lower gate" . PHP_EOL;
        $this->load_item("dog");
        $this->lower_gate();

        $this->start('1234ac');

        echo PHP_EOL . "should have to raise gate" . PHP_EOL;
        $this->accelerate(55, 15);

        echo PHP_EOL . "should not have to raise gate" . PHP_EOL;
        $this->accelerate(25, 30);

        echo PHP_EOL . "should have to lower gate" . PHP_EOL;
        $this->load_item("Chris");
        $this->show_load();
        $this->raise_gate();

        echo PHP_EOL . "should have to stop". PHP_EOL;
        $this->dropoff();
        $this->lower_gate();

        echo PHP_EOL . "should not have to raise gate" . PHP_EOL;
        $this->accelerate(25, 50);
    }
}
