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

//base class for all types of vehicles
abstract class Vehicle
{


    function __construct() {

    }

    //change speed, all motorized vehicles do this
    abstract public function accelerate();
    abstract public function decelerate();

    //start engine, all motorized vehicles do this
    abstract public function start($key);

    //stop engine, universal
    abstract public function stop();
}
