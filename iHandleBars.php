<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/14/13
 * Time: 6:33 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * An interface to describe driving a vehicle with handlebars (i.e. Motorcycle). Has these
 *   methods:
 * - Turn left, turn handlebars to the left, directing vehicle to the left
 * - Turn right, turn handlebars to the right, directing vehicle to the right
 * @package     VehicleControls
 * @subpackage  iHandleBars
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
namespace Steering;
interface iHandleBars
{
    /**
     * This function will turn the vehicle to the left by the number of degrees we pass in,
     *   and will handle more complex turns (i.e. 180 degrees as one long 90 degree turn).
     *
     * @param float $deg    The number of degrees we want to veer off our path to the left by
     * @return mixed
     */
    public function turn_left($deg);

    /**
     * This function will turn the vehicle to the right by the number of degrees we pass in,
     *   and will handle more complex turns (i.e. 180 degrees as one long 90 degree turn).
     *
     * @param float $deg    The number of degrees we want to veer off our path to the left by
     * @return mixed
     */
    public function turn_right($deg);

    /**
     * Rotate the handlebars back into their default, straight position.
     *
     * Named for compatibility with iSteeringWheel, this function should never
     *  be called outside the turn functions. Ideally it should be private, but
     *  that's illegal in an interface and making this an abstract method for a
     *  LandVehicle (only way to force private visibility implementation) just
     *  seems a little too odd.
     *
     * @return mixed
     */
    public function rotate_reset();
}
