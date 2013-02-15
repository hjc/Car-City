<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/14/13
 * Time: 2:06 AM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Represents a motorcycle or other two-wheeled vehicle. Very similar to a car, but
 *   no doors, meaning we need two separate classes
 *
 * @package     Vehicles
 * @subpackage  Motorcycle
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
class Motorcycle extends LandVehicle
{
    //include turn functions
    use Steering\HandleBars;
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
        parent::__construct($weight, 1, $top_speed, 2);
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
}

