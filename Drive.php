<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/15/13
 * Time: 3:09 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Steering;
trait Drive
{
    /**
     * This function takes in a number of degrees the motorcycle wants to turn left
     *   by and changes the motorcycle's direction to match that. Due to the physical
     *   limitation of a motorcycle (handlebars only rotate 90° at most), we will
     *   simulate "multiple" turns, or just one big looong turn, if the turn is greater
     *   than 90°
     *
     * @param float $deg
     * @return mixed|void
     */
    public function turn_left($deg) {
        echo PHP_EOL;
        $this->action("is turning left by $deg degrees in total");
        //in reality a motorcycle cannot just make a 180 degree turn, it has to
        // be two 90 degree turns (albeit quick ones most of the time). The handles
        // only turn 90 degrees at most. So do multiple turns (equivalent to just
        // holding the handlebars left)
        $i = 0;
        while ($deg > 90) {
            //actually change direction and turn left
            echo "\tTurn #" . ($i + 1) . ": turning left by 90°". PHP_EOL;
            $this->left(90);
            $deg -= 90;
            $i++;
        }

        //again, change direction and turn left
        echo "\tTurn #" . ($i + 1) . ": turning left by {$deg}°". PHP_EOL;
        $this->left($deg);

        //reset handlebars to original positions
        $this->rotate_reset();
    }

    /**
     * This function takes in a number of degrees the motorcycle wants to turn right
     *   by and changes the motorcycle's direction to match that. Due to the physical
     *   limitation of a motorcycle (handlebars only rotate 90° at most), we will
     *   simulate "multiple" turns, or just one big turn, if the turn is greater
     *   than 90°
     *
     * @param float $deg
     * @return mixed|void
     */
    public function turn_right($deg) {
        echo PHP_EOL;
        $this->action("is turning right by $deg degrees in total");
        //in reality a motorcycle cannot just make a 180 degree turn, it has to
        // be two 90 degree turns (albeit quick ones most of the time). The handles
        // only turn 90 degrees at most. So do multiple turns (equivalent to just
        // holding the handlebars left)
        $i = 0;
        while ($deg > 90) {
            echo "\tTurn #" . ($i + 1) . ": turning right by 90°" . PHP_EOL;
            //actually change direction and turn left
            $this->right(90);
            $deg -= 90;
            $i++;
        }

        //again, change direction and turn left
        echo "\tTurn #" . ($i + 1) . ": turning right by {$deg}°" . PHP_EOL;
        $this->right($deg);

        //reset handlebars to original positions
        $this->rotate_reset();
    }

    /** stub method to represent resetting the main controlling device */
    abstract public function rotate_reset();
}
