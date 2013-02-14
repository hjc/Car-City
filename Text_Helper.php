<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/14/13
 * Time: 12:46 AM
 * To change this template use File | Settings | File Templates.
 */

/**
 * A simple to trait to do some basic text tasks.
 *
 * They include:
 * - Generate random letters
 * - Make a password salt
 */
trait Text_Helper
{
    /**
     * Create some random letters for us and return them.
     *
     * @param int $amt      How many random letters we want
     * @return string       The random letters we asked for
     */
    function random_letters($amt) {
        $st = '';
        for($i = 0; $i < $amt; $i++) {
            $st .= chr(97 + mt_rand(0, 25));
        }
    }

    /**
     * Creates a salt from the current time and some random letters.
     *
     * Setting default timezone here for ease.
     *
     * @return string The salt we want
     */
    public function create_salt() {
        date_default_timezone_set('America/Chicago');
        $dt = new DateTime();
        $salt = $this->random_letters(8);
        return $dt->format('Y-m-d H:i:s') . $salt;
    }
}
