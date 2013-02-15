<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/14/13
 * Time: 5:32 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * An interface to describe driving a vehicle with a steering wheel. Has these
 *   methods:
 * - Rotate left, rotate steering wheel to the left directing vehicle to the left
 * - Rotate right, rotate steering wheel to the right directing vehicle to the right
 * - Honk horn, honks the horn.
 * - Turn left, Rotate Left rotates the steering wheel, this is the function that should
 *   be called to actually turn the vehicle. It should call rotate_left
 * - Turn right, Rotate Right rotates the steering wheel, this is the function that should
 *   be called to actually turn the vehicle. It should call rotate_right
 *
 * @package     VehicleControls
 * @subpackage  iSteeringWheel
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
interface iSteeringWheel
{
    /**
     * This method is used to turn the steering wheel, which will turn the wheels.
     *   It is responsible for actually turning left, but should be wrapped with
     *   turn_left in order to keep all vehicles generic and similar.
     *
     * @param float $deg    The number of degrees we want to turn the steering wheel to the left
     * @return mixed
     */
    public function rotate_right($deg);

    /**
     * This method is used to turn the steering wheel, which will turn the wheels.
     *   It is responsible for actually turning right, but should be wrapped with
     *   turn_right in order to keep all vehicles generic and similar.
     *
     * @param float $deg    The number of degrees we want to turn the steering wheel to the left
     * @return mixed
     */
    public function rotate_left($deg);

    /**
     * Should just echo a string that indicates some sort of honk
     *
     * @return mixed
     */
    public function honk();

    /**
     * This function is called to turn the vehicle. It will take in the number of
     *   degrees we want to turn by, and then figure out how to apply that to the
     *   rotate_left function, including multiple calls to the function for more
     *   extreme turns (i.e. 180 degrees)
     *
     * @param float $deg    The number of degrees we want to veer off our path to the left by
     * @return mixed
     */
    public function turn_left($deg);

    /**
     * This function is called to turn the vehicleIt will take in the number of
     *   degrees we want to turn by, and then figure out how to apply that to the
     *   rotate_right function, including multiple calls to the function for more
     *   extreme turns (i.e. 180 degrees)
     *
     * @param float $deg    The number of degrees we want to veer off our path to the right by
     * @return mixed
     */
    public function turn_right($deg);
}