<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/13/13
 * Time: 10:23 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * PHP Magic function that gets called every time an undefined class is referenced,
 *  it will include the class if it can.
 *
 * @param string $class_name       The name of the class we want to include.
 */
function __autoload($class_name) {
    include dirname(__FILE__) . $class_name . '.php';
}

/**
 * A class that represents the very basic concept of a Vehicle.
 *
 * Is an abstract class defining generic functions that all vehicles share:
 * - Start
 * - Stop
 * - Accelerate
 * - Decelerate
 *
 * @package     Vehicles
 * @subpackage  VehicleGeneric
 * @author      Hayden Chudy <hjc1710@gmail.com>
 *
 * @var
 * @var
 * @static int
 */
abstract class Vehicle
{
    /** @var int contains total count of vehicles */
    public static $vehicle_count = 0;

    /** @var int holds vehicle's current speed */
    public $current_speed = 0;

    /** @var int holds vehicle's top speed */
    public $top_speed;

    /**
     * Construct the object, increasing vehicle count
     */
    function __construct() {
        ++Vehicle::$vehicle_count;
    }

    /**
     * Increase the vehicle's speed by providing an acceleration rate (m/s^2) and
     *  a duration (s).
     *
     * @param float $rate          Acceleration rate, in m^2
     * @param float $duration      Acceleration time, in s
     */
    abstract public function accelerate($rate, $duration);

    /**
     * Decrease the vehicle's speed by providing an acceleration rate (m/s^2) and
     *  a duration (s).
     *
     * @param float $rate          Acceleration rate, in m^2
     * @param float $duration      Acceleration time, in s
     */
    abstract public function decelerate($rate, $duration);

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
