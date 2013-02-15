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
    private $open = TRUE;

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
        echo PHP_EOL;
        echo "Unlocking door";
        $this->locked = FALSE;
    }

    /**
     * Simple function lock door by changing $locked and tell us
     */
    public function lock() {
        echo PHP_EOL;
        echo "Locking door";
        $this->locked = TRUE;
    }

    /**
     * Open the door for us if it isn't already
     */
    public function open() {
        if (!$this->open) {
            echo "Opening door";
            $this->open = TRUE;
        }
        else {
            echo "Door already open";
        }
    }

    /**
     * Open the door for us if it isn't already
     */
    public function close() {
        if ($this->open) {
            echo "Closing door";
            $this->open = FALSE;
        }
        else {
            echo "Door already closed";
        }
    }
}
