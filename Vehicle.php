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
 * NOTE: I normally do not use this much string interpolation, due to security,
 *   but I have forgone that for ease.
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
    function __construct($weight, $cap, $top_speed = NULL) {
        //make a salt for this vehicle's password
        $this->vehicle_salt = $this->create_salt();

        //set vehicle number and then increment vehicle count
        $this->vehicle_number = Vehicle::$vehicle_count++;

        //handle initing all general characteristics that all vehicles have
        $this->weight = $weight;
        $this->capacity = $cap;

        //not all vehicles have a hard set top speed, so we let that be NULL
        $this->top_speed = $top_speed;

        echo "Created new Vehicle, NUMBER: " . Vehicle::$vehicle_count . PHP_EOL;
    }

    /**
     * Simple function to format an object into a proper name using some generic
     *   methods.
     *
     * @return string   Formatted name of this object
     */
    protected function name() {
        //get the current class name
        $class = get_class($this);

        //the vehicle number for every vehicle type is stored like: class_number,
        // i.e. motorcycle_number. Create a var so we can access that
        $count_name = strtolower($class) . '_number';

        //use our var, get our number and class
        return $class . "#" . $this->$count_name;
    }

    /**
     * Since all methods are annotated, they all contain echoes, most begin
     *   are like this:
     *     objectName: action!
     *   This gets old to write, simple wrapper, have the option to suppress newlines
     *
     * @param string $str              The action we're going to print.
     * @param bool $eol|TRUE    Determines if we should print the EOL after this action.
     */
    protected  function action($str, $eol = TRUE) {
        echo $this->name() . ": " . $str . "!";
        echo $eol ? PHP_EOL : "";
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
        $this->action(
            "is accelerating by {$rate}m/s^2 for $duration seconds for a total speed increase of: {$speed_increase}m/s"
        );

        if ($this->current_speed + $speed_increase >= $this->top_speed){
            $this->action("has reached its top speed of: {$this->top_speed}m/s");
            $this->current_speed = $this->top_speed;
        }
        else {
            $this->current_speed += $speed_increase;
        }
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
        $this->action(
            "is decelerating by {$rate}m/s^2 for $duration seconds for a total speed decrease of: {$speed_decrease}m/s"
        );

        if ($this->current_speed - $speed_decrease <= 0) {
            $this->action("has reach a speed of 0 m/s and has stopped");
            $this->current_speed = 0;
        }
        else {
            $this->current_speed -= $speed_decrease;
        }
    }

    /**
     * Provide a method for a vehicle to change its speed to one passed in, will
     *   still accelerate or decelerate though because we can't just magically
     *   change speed.
     *
     * @param float $speed
     */
    public function change_speed($speed) {
        echo PHP_EOL;
        $this->action("is changing speed to $speed");

        //get difference in desired and current speed, use it to get rate, we
        // will always use a duration of 5 seconds.
        $diff = abs($this->current_speed - $speed);
        $dura = 5;
        $rate = $diff / $dura;

        //figure out if we're acceling or deceling
        if ($speed > $this->current_speed) {
            $this->accelerate($rate, $dura);
        }
        else {
            $this->decelerate($rate, $dura);
        }
    }

    /**
     * Very simple function that will make changes to the direction variable that
     *  correspond to the vehicle moving to the left. We will implement it as a
     *  method so child classes do not need to know how to manipulate direction
     *  in order to use.
     *
     * @param float $deg        The amount of degrees we want to turn to the left
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
     * @param float $deg        The amount of degrees we want to turn to the right
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
     * Set and store a password in a vehicle for later use. This serves as a key for
     *  a vehicle;
     *
     * @param string $string    The string that we are going to hash and store. This becomes the vehicle's
     *                          password/key and is used to "activate" it
     */
    function set_password($string) {
        echo PHP_EOL;
        $this->action("setting new password of: $string");
        $this->hashed_password = hash('sha256', $string . $this->vehicle_salt);
        $this->action("successfully set new password");
    }

    /**
     * Turn the vehicle's windshield wipers on and say so
     */
    public function wipers_on() {
        echo PHP_EOL;
        $this->action("turning windshield wipers on");
        $this->wipers_on = TRUE;
        $this->action("windshield wipers are on");
    }

    /**
     * Turn the vehicle's windshield wipers off and say so
     */
    public function wipers_off() {
        echo PHP_EOL;
        $this->action("turning windshield wipers off");
        $this->wipers_on = FALSE;
        $this->action("windshield wipers are off");
    }

    /**
     * Simple function to see if the windshield wipers are on
     */
    public function check_wipers() {
        echo PHP_EOL;
        $this->action("checking wipers");
        $this->action($this->wipers_on ? "windshield wipers are on" : "windshield wipers are off");
    }

    /**
     * Turn the vehicle's headlights off
     */
    public function headlights_off() {
        echo PHP_EOL;
        $this->action("turning headlights off");
        $this->lights_on = FALSE;
        $this->action("headlights are off");

    }

    /**
     * Turn the vehicle's headlights on
     */
    public function headlights_on() {
        echo PHP_EOL;
        $this->action("turning headlights on");
        $this->lights_on = TRUE;
        $this->action("headlights are on");
    }

    /**
     * Simple function to see if the vehicle's headlights are on
     */
    public function check_headlights() {
        echo PHP_EOL;
        $this->action("checking headlights");
        $this->action($this->lights_on ? "headlights are on" : "headlights are off");
    }

    /**
     * Get the current speed of this vehicle
     */
    public function get_speed() {
        echo PHP_EOL;
        $this->action("checking current speed");
        $this->action("current speed is: {$this->current_speed}");
    }

    /**
     * Get the current direction of this vehicle
     */
    public function get_direction() {
        echo PHP_EOL;
        $this->action("checking current direction");
        if ($this->direction == 0) {
            $this->action("is facing true north");
        }
        else {
            $this->action("is facing {$this->direction}° clockwise from true north");
            if ($this->direction < 90) {
                $this->action("is facing north east");
            }
            elseif ($this->direction == 90) {
                $this->action("is facing east");
            }
            elseif ($this->direction < 180) {
                $this->action("is facing south east");
            }
            elseif ($this->direction == 180) {
                $this->action("is facing south");
            }
            elseif ($this->direction < 270) {
                $this->action("is facing south west");
            }
            elseif ($this->direction == 270) {
                $this->action("is facing west");
            }
            else {
                //direction must be greater than 270. 360 resets the direction
                // back to zero, so first if will catch it, thus we are facing NW
                $this->action("is facing north west");
            }
        }
        //xdegrees clockwise from north

    }

    /**
     * Tell us the state of the engine, ie is it on or not (note vehicle turns it off
     *   automatically).
     */
    public function engine_state() {
        echo PHP_EOL;
        $this->action("checking engine");
        if ($this->engine_on) {
            $this->action("engine is on! Don't forget to turn it off");
        }
        else {
            $this->action("engine is off");
        }
    }

    /**
     * Start the vehicle. Will let Vehicle Types implement it since some start
     *   different than others.
     *
     * @param string $key       A password the user provides to start their vehicle (high-tech, huh?)
     */
    abstract public function start($key);

    /**
     * Stop the vehicle.
     */
    abstract public function stop();
}