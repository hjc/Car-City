<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/13/13
 * Time: 10:23 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * A class that represents the very basic concept of a Vehicle.
 *
 * Is an abstract class defining generic functions that all vehicles share:
 * - Start
 * - Stop
 * - Accelerate
 * - Decelerate
 *
 * Also implements a few persistent elements, namely a password and salt that,
 *  in theory, would replace the physical key.
 *
 * @package     Vehicles
 * @subpackage  VehicleGeneric
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
abstract class Vehicle
{
    //helps us make the salt and has other useful methods
    use Text_Helper;
    /** @var int Contains total count of vehicles */
    public static $vehicle_count = 0;

    /** @var int Holds vehicle's top speed */
    public $top_speed;

    /** @var int The weight of the vehicle */
    public $weight;

    /** @var int How many people the vehicle can hold. */
    public $capacity;

    /** @var int The individual number of this vehicle */
    protected $vehicle_number = 0;

    /** @var int Holds vehicle's current speed */
    protected $current_speed = 0;

    /** @var bool Is the engine on? alternatively, is the car started? */
    protected $engine_on = FALSE;

    /** @var string A salt we will append to our vehicle's password for safety */
    protected $vehicle_salt;

    /** @var string The hashed password that starts the vehicle, we will see if the
     *              key matches this after it has been hashed. */
    protected $hashed_password;

    /** @var bool Are the headlights on? */
    protected $lights_on = FALSE;

    /** @var bool Are the windshield wipers on? */
    protected $wipers_on = FALSE;

    /** @var float Indicates the direction this vehicle is facing, 0 degrees is true
     *              North, positive values move the direction to the right of true North,
     *              negative go left  */
    protected $direction = 0.0;

    /**
     * Construct the object, increasing vehicle count, making a future salt, and
     *  setting the vehicle number.
     *
     * @param int $weight       The weight of the vehicle, in lbs.
     * @param int $cap     The max number of people the vehicle can hold
     */
    function __construct($weight, $cap) {
        //make a salt for this vehicle's password
        $this->vehicle_salt = $this->create_salt();

        //set vehicle number and then increment vehicle count
        $this->vehicle_number = Vehicle::$vehicle_count++;

        $this->weight = $weight;
        $this->capacity = $cap;

        echo "Created new Vehicle" . PHP_EOL;
    }

    //TODO: Implement a vehicle number function
    //TODO: Implement a get heading direction

    protected function name() {
        $class = get_class($this);

        $count_name = strtolower($class) . '_number';
        return $class . "#" . $this->$count_name;
    }


    /**
     * Set and store a password in a vehicle for later use. This serves as a key for
     *  a vehicle;
     *
     * @param string $string    The string that we are going to hash and store. This becomes the vehicle's
     *                          password/key and is used to "activate" it
     */
    function set_password($string) {
        echo "Successfully set new password for vehicle: " . $this->name() . PHP_EOL;
        $this->hashed_password = hash('sha256', $string . $this->vehicle_salt);
    }

    /**
     * Turn the vehicle's windshield wipers on and say so
     */
    public function wipers_on() {
        $this->wipers_on = TRUE;
        echo get_class($this) . " turning windshield wipers on!" . PHP_EOL;
    }

    /**
     * Turn the vehicle's windshield wipers off and say so
     */
    public function wipers_off() {
        $this->wipers_on = FALSE;
        $class = get_class($this);

        $count_name = strtolower($class) . '_number';
        echo '<br>' . $count_name . '<br>';
        echo $class . "#" . $this->$count_name . " turning windshield wipers off!" . PHP_EOL;
    }

    /**
     * Simple function to see if the windshield wipers are on
     */
    public function check_wipers() {
        echo $this->wipers_on ? "Windshield wipers are on!" . PHP_EOL : "Windshield wipers are off!" . PHP_EOL;
    }

    /**
     * Turn the vehicle's headlights off
     */
    public function headlights_off() {
        $this->lights_on = FALSE;
        echo get_class($this) . " turning headlights off!" . PHP_EOL;
    }

    /**
     * Turn the vehicle's headlights on
     */
    public function headlights_on() {
        $this->lights_on = TRUE;
        echo get_class($this) . " turning headlights on!" . PHP_EOL;
    }

    /**
     * Simple function to see if the vehicle's headlights are on
     */
    public function check_headlights() {
        echo $this->lights_on ? "Headlights are on!" . PHP_EOL : "Headlights are off!" . PHP_EOL;
    }

    public function read_speed() {
        echo "STUB READ SPEED\n";
        echo $this->current_speed;
    }

    public function read_direction() {
        echo $this->direction;
        echo "STUB READ DIREC\n";

    }

    /**
     * Very simple function that will make changes to the direction variable that
     *  correspond to the vehicle moving to the left. We will implement it as a
     *  method so child classes do not need to know how to manipulate direction
     *  in order to use.
     *
     * @param float $deg
     */
    protected function left($deg) {
        $this->direction -= $deg;

        //keep the direction ranging between 0 and 360 so it's easy to figure out where we're
        // facing
        if ($this->direction < 0) {
            $this->direction += 360;
        }
    }

    /**
     * See above
     *
     * @param float $deg
     */
    protected function right($deg) {
        $this->direction += $deg;

        //keep the direction ranging between 0 and 360 so it's easy to figure out where we're
        // facing
        if ($this->direction >= 360) {
            $this->direction -= 360;
        }
    }

    /**
     * Increase the vehicle's speed by providing an acceleration rate (m/s^2) and
     *  a duration (s). Also going to pretend there is no friction.
     *
     * @param float $rate       Acceleration rate, in m^2
     * @param float $duration   Acceleration time, in s
     */
    public function accelerate($rate, $duration) {
        //if $rate is negative, pass it off to decelerate
        if ($rate < 0) {
            $this->decelerate(abs($rate), $duration);
            return;
        }
        echo PHP_EOL;

        $speed_increase = $rate * $duration;

        //tell us what's happening
        echo $this->name()
            . ": is accelerating by {$rate}m/s^2 for $duration seconds for a total speed increase of: {$speed_increase}m/s"
            . PHP_EOL;

        $this->current_speed += $speed_increase;
    }

    /**
     * Decrease the vehicle's speed by providing an acceleration rate (m/s^2) and
     *  a duration (s). If the rate is negative, pass it to acceleration
     * (negative deceleration == acceleration)
     *
     * @param float $rate          Acceleration rate, in m^2
     * @param float $duration      Acceleration time, in s
     */
    public function decelerate($rate, $duration) {
        //if $rate is negative, pass it off to accelerate
        if ($rate < 0) {
            $this->accelerate(abs($rate), $duration);
            return;
        }
        echo PHP_EOL;

        $speed_decrease = $rate * $duration;

        //tell us what's happening
        echo $this->name()
            . ": is decelerating by {$rate}m/s^2 for $duration seconds for a total speed decrease of: {$speed_decrease}m/s"
            . PHP_EOL;

        $this->current_speed -= $speed_decrease;
    }

    /**
     * Provide a method for a vehicle
     *
     * @param $speed
     */
    public function change_speed($speed) {
        echo PHP_EOL;
        echo $this->name() . ": is changing speed to $speed";

        $diff = abs($this->current_speed - $speed);
        $dura = 5;
        $rate = $diff / $dura;

        if ($speed > $this->current_speed) {
            $this->accelerate($rate, $dura);
        }
        else {
            $this->decelerate($rate, $dura);
        }
    }

    /**
     * Start the vehicle.
     *
     * @param string $key       A password the user provides to start their vehicle (high-tech, huh?)
     */
    abstract public function start($key);

    /**
     * Stop the vehicle.
     */
    abstract public function stop();
}