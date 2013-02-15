<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/15/13
 * Time: 2:51 AM
 * To change this template use File | Settings | File Templates.
 */
/**
 * Simple door class that will be used to represent and encapsulate the various
 *   door concepts a car/truck needs.
 */
namespace VehicleParts;
class Door
{
    /** @var bool tell us if door is locked */
    private $locked = TRUE;

    /** @var bool tell us if door is open */
    private $open = FALSE;

    /** @var string tell us what door this is */
    private $location;

    /**
     * Very simple constructor that lets us store a door's location
     *
     * @param string $loc
     */
    public function __construct($loc) {
        $this->location = $loc;
    }

    /**
     * Return a descriptive string saying where this door is on the car.
     *
     * @return string       The location of this door
     */
    public function get_location() {
       return $this->location;
    }

    /**
     * Return a bool that tells us if door is open.
     *
     * @return bool
     */
    public function check_open() {
        return $this->open;
    }

    /**
     * Return a bool that tells us if door is locked
     *
     * @return bool
     */
    public function check_lock() {
        return $this->locked;
    }

    /**
     * Simple function unlock door by changing $locked and tell us
     */
    public function unlock() {
        echo "From Door: Unlocking door";
        echo PHP_EOL;
        $this->locked = FALSE;
    }

    /**
     * Simple function lock door by changing $locked and tell us
     */
    public function lock() {
        echo "From Door: Locking door";
        echo PHP_EOL;
        $this->locked = TRUE;
    }

    /**
     * Open the door for us if it isn't already
     */
    public function open() {
        if ($this->locked) {
            echo "Door is locked!! Cannot open it! Call unlock() first!";
            echo PHP_EOL;
            return;
        }
        if (!$this->open) {
            echo "From Door: Opening door";
            $this->open = TRUE;
        }
        else {
            echo "Door already open";
        }
        echo PHP_EOL;
    }

    /**
     * Open the door for us if it isn't already
     */
    public function close() {
        if ($this->open) {
            echo "From Door: Closing door";
            $this->open = FALSE;
        }
        else {
            echo "Door already closed";
        }
        echo PHP_EOL;
    }
}