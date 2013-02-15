<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/14/13
 * Time: 2:06 AM
 * To change this template use File | Settings | File Templates.
 */

class Motorcycle extends LandVehicle
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
        $this->read_tire_pressure();

        //set top speed
        $this->top_speed = $top_speed;
        echo "Created new Motorcycle";

        //$cap = 1; only one person can safely ride in a motorcycle
        parent::__construct($weight, 1);
    }

    /**
     * Explain your tire setup, call parent method to print.
     */
    function check_tire_pressure() {
        echo "Tire 1 is the front tire.\nTire 2 is the back tire.";
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
    function headlights_off() {
        $this->headlights_on = FALSE;
        echo "Turning Motorcycle Headlight off";
    }

    /**
     * Turns on the motorcycle's headlight and says so
     */
    function headlights_on() {
        $this->headlights_on = TRUE;
        echo "Turning Motorcycle Headlight on";
    }
}
