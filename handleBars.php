<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/14/13
 * Time: 6:33 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * A trait to describe driving a vehicle with handlebars (i.e. Motorcycle). Has these
 *   methods:
 * - Turn Reset, reset the handlebars to their initial positions
 * - Turn left, turn handlebars to the left, directing vehicle to the left
 * - Turn right, turn handlebars to the right, directing vehicle to the right
 *
 * Latter two come from the Turn trait
 *
 * @package     VehicleControls
 * @subpackage  HandleBars
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
namespace Steering;
trait HandleBars  {
    use Turn;

    /** represent resetting the handlebars */
    private  function turn_reset() {
        echo PHP_EOL;
        $this->action("Resetting the handlebars to original position");
    }
}
