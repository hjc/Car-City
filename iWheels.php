<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/15/13
 * Time: 12:06 AM
 * To change this template use File | Settings | File Templates.
 */

/**
 * An interface for any vehicle that has wheels at all, this includes cars, planes,
 *  bicycles, etc.
 */

//TransportMethod refers to anything that allows another object to move, a boat's
// rudder would be this, so would a jet's engine
namespace TransportMethod;
interface iWheels
{
    /**
     * All wheels have brakes, this method brings the speed of a Vehicle to 0
     *
     * @return mixed
     */
    public function brake();

    /**
     * All wheels need to be able to be parked, this will just change a flag.
     *
     * @return mixed
     */
    public function park();

    /**
     * Everything that is parked, must be unparked.
     *
     * @return mixed
     */
    public function unpark();

    /**
     * Will tell us if the Vehicle is parked
     *
     * @return mixed
     */
    public function is_parked();
}
