<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/13/13
 * Time: 10:23 PM
 * To change this template use File | Settings | File Templates.
 */

//very simple auto-load to avoid include statements
function __autoload($class_name) {
    include $class_name . '.php';
}

