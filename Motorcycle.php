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
     * @param int $top_speed    The top speed of the motorcycle
     */
    function __construct($weight, $top_speed) {
        echo PHP_EOL;
        $this->motorcycle_number = Motorcycle::$motorcycle_count++;

        //setup wheel count
        $this->num_wheels = 2;

        echo "Created new Motorcycle, name: " . $this->name() . ", NUMBER: " . Motorcycle::$motorcycle_count .  PHP_EOL;
        echo "Attributes:" . PHP_EOL . "\tWeight: $weight" . PHP_EOL
            . "\tTop Speed: $top_speed" . PHP_EOL;

        //$cap = 1; only one person can safely ride in a motorcycle, parent sets weight and
        // capacity
        parent::__construct($weight, 1, 2, $top_speed);
    }

    /**
     * Explain your tire setup, call parent method to print.
     */
    public function check_tire_pressure() {
        echo PHP_EOL;
        $this->action("checking tire pressure");
        echo "Tire 1 is the front tire." . PHP_EOL . "Tire 2 is the back tire." . PHP_EOL;
        parent::check_tire_pressure();
    }

    /**
     * Motorcycles only have one headlight, going to override this to
     *  "show" that difference.
     */
    /**
     * Turns off the motorcycle's headlight and says so
     */
    public function headlights_off() {
        echo PHP_EOL;
        $this->action("Turning Headlight off");
        $this->lights_on = FALSE;
        $this->action("Headlight is off");
    }

    /**
     * Turns on the motorcycle's headlight and says so
     */
    public function headlights_on() {
        echo PHP_EOL;
        $this->action("Turning Headlight on");
        $this->lights_on = TRUE;
        $this->action("Headlight is on");
    }

    /**
     * This function takes in a number of degrees the motorcycle wants to turn left
     *   by and changes the motorcycle's direction to match that. Due to the physical
     *   limitation of a motorcycle (handlebars only rotate 90° at most), we will
     *   simulate "multiple" turns, or just one big looong turn, if the turn is greater
     *   than 90°
     *
     * @param float $deg
     * @return mixed|void
     */
    public function turn_left($deg) {
        echo PHP_EOL;
        $this->action("is turning left by $deg degrees in total");
        //in reality a motorcycle cannot just make a 180 degree turn, it has to
        // be two 90 degree turns (albeit quick ones most of the time). The handles
        // only turn 90 degrees at most. So do multiple turns (equivalent to just
        // holding the handlebars left)
        $i = 0;
        while ($deg > 90) {
            //actually change direction and turn left
            echo "\tTurn #" . ($i + 1) . ": turning left by 90°". PHP_EOL;
            $this->left(90);
            $deg -= 90;
            $i++;
        }

        //again, change direction and turn left
        echo "\tTurn #" . ($i + 1) . ": turning left by {$deg}°". PHP_EOL;
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
        echo PHP_EOL;
        $this->action("is turning right by $deg degrees in total");
        //in reality a motorcycle cannot just make a 180 degree turn, it has to
        // be two 90 degree turns (albeit quick ones most of the time). The handles
        // only turn 90 degrees at most. So do multiple turns (equivalent to just
        // holding the handlebars left)
        $i = 0;
        while ($deg > 90) {
            echo "\tTurn #" . ($i + 1) . ": turning right by 90°" . PHP_EOL;
            //actually change direction and turn left
            $this->right(90);
            $deg -= 90;
            $i++;
        }

        //again, change direction and turn left
        echo "\tTurn #" . ($i + 1) . ": turning right by {$deg}°" . PHP_EOL;
        $this->right($deg);

        //reset handlebars to original positions
        $this->rotate_reset();
    }

    /** stub method to represent resetting the handlebars */
    public function rotate_reset() {
        echo PHP_EOL;
        $this->action("Resetting the handlebars to original position");
    }
}

