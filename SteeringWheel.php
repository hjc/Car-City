<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/14/13
 * Time: 5:32 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * A trait to describe driving a vehicle with a steering wheel. Has these
 *   methods:
 * - Honk horn, honks the horn.
 * - Turn left, Rotate Left rotates the steering wheel, this is the function that should
 *   be called to actually turn the vehicle. It should call rotate_left
 * - Turn right, Rotate Right rotates the steering wheel, this is the function that should
 *   be called to actually turn the vehicle. It should call rotate_right
 *
 * Last two are inherited from Trait Turn.
 *
 * @package     VehicleControls
 * @subpackage  SteeringWheel
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
namespace Steering;
trait SteeringWheel
{
    use Turn;


    /**
     * Resets the steering wheel to its default, straight position
     *
     * This function should never be called outside the turn functions, thus private
     *
     * @return mixed
     */
    private function turn_reset() {
        echo PHP_EOL;
        $this->action("Resetting steering wheel to original position");
    }

    /**
     * Should just echo a string that indicates some sort of honk
     *
     * @return mixed
     */
    public function honk() {
        echo PHP_EOL;
        $this->action("honking");
        echo "HONK! HONK!";
    }

}