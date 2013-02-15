<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/14/13
 * Time: 2:06 AM
 * To change this template use File | Settings | File Templates.
 */

class Motorcycle extends LandVehicle implements Steering\iHandleBars
{
    /** @var int Keep track of how many motorcycles we have */
    public static $motorcycle_count = 0;

    /** @var int The individual number of this motorcycle */
    protected $motorcycle_number;

    /**
     * Construct this motorcycle by setting its motorcycle number, increasing
     *   motorcycle count and calling parent constructor to do generic Vehicle
     *   maintenance.
     *
     * @param int $weight       The weight of the vehicle, in lbs.
     * @param int $top_speed     The max number of people the vehicle can hold
     */
    function __construct($weight, $top_speed) {
        $this->motorcycle_number = Motorcycle::$motorcycle_count++;

        //setup wheel count and read tire pressures
        $this->wheel_count = 2;
        //$this->read_tire_pressure();

        //set top speed
        $this->top_speed = $top_speed;
        echo "Created new Motorcycle, name: " . $this->name() . PHP_EOL;

        //$cap = 1; only one person can safely ride in a motorcycle
        parent::__construct($weight, 1);
    }

    /**
     * Explain your tire setup, call parent method to print.
     */
    public function check_tire_pressure() {
        echo PHP_EOL;
        echo $this->name() . " checking tire pressure";
        echo "Tire 1 is the front tire." . PHP_EOL . "Tire 2 is the back tire." . PHP_EOL;
        parent::check_tire_pressure();
    }

    //make a garage class, maybe use namespaces there

    //PUSH TO BITBUCKET

    /**
     * Motorcycles only have one headlight, going to override this to
     *  "show" that difference.
     */

    /**
     * Turns off the motorcycle's headlight and says so
     */
    public function headlights_off() {
        $this->lights_on = FALSE;
        echo $this->name() . ": Turning Headlight off" . PHP_EOL;
    }

    /**
     * Turns on the motorcycle's headlight and says so
     */
    public function headlights_on() {
        $this->lights_on = TRUE;
        echo $this->name() . ": Turning Headlight on" . PHP_EOL;
    }

    /**
     * This function takes in a number of degrees the motorcycle wants to turn left
     *   by and changes the motorcycle's direction to match that. Due to the physical
     *   limitation of a motorcycle (handlebars only rotate 90° at most), we will
     *   simulate "multiple" turns, or just one big turn, if the turn is greater
     *   than 90°
     *
     * @param float $deg
     * @return mixed|void
     */
    public function turn_left($deg) {
        echo $this->name() . " is turning left by $deg total" . PHP_EOL;
        //in reality a motorcycle cannot just make a 180 degree turn, it has to
        // be two 90 degree turns (albeit quick ones most of the time). The handles
        // only turn 90 degrees at most. So do multiple turns (equivalent to just
        // holding the handlebars left)
        $i = 0;
        while ($deg > 90) {
            //actually change direction and turn left
            echo "Turn #" . ($i + 1) . ": turning left by 90°". PHP_EOL;
            $this->left(90);
            $deg -= 90;
            $i++;
        }

        //again, change direction and turn left
        echo "Turn #" . ($i + 1) . ": turning left by {$deg}°". PHP_EOL;
        $this->left($deg);

        //reset handlebars to original positions
        $this->rotate_reset();
    }

    /**
     * This function takes in a number of degrees the motorcycle wants to turn right
     *   by and changes the motorcycle's direction to match that. Due to the physical
     *   limitation of a motorcycle (handlebars only rotate 90° at most), we will
     *   simulate "multiple" turns, or just one big turn, if the turn is greater
     *   than 90°
     *
     * @param float $deg
     * @return mixed|void
     */
    public function turn_right($deg) {
        echo $this->name() . " is turning right by $deg degrees in total" . PHP_EOL;
        //in reality a motorcycle cannot just make a 180 degree turn, it has to
        // be two 90 degree turns (albeit quick ones most of the time). The handles
        // only turn 90 degrees at most. So do multiple turns (equivalent to just
        // holding the handlebars left)
        $i = 0;
        while ($deg > 90) {
            echo "Turn #" . ($i + 1) . ": turning right by 90°" . PHP_EOL;
            //actually change direction and turn left
            $this->right(90);
            $deg -= 90;
            $i++;
        }

        //again, change direction and turn left
        echo "Turn #" . ($i + 1) . ": turning right by {$deg}°" . PHP_EOL;
        $this->right($deg);

        //reset handlebars to original positions
        $this->rotate_reset();
    }

    /** stub method to represent resetting the handlebars */
    public function rotate_reset() {
        echo $this->name() . ": Resetting the handlebars to original position!" . PHP_EOL;
    }
}

