<?php

namespace Exercise;

Class Config {

    public static function getConfig()
    {
        return include(__DIR__.'/../config.php');
    }
}