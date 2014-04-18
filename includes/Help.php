<?php

class Help
{

    public static function printer($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '<pre>';
    }

    public static function dumprint($arr)
    {
        echo '<pre>';
        var_dump($arr);
        echo '<pre>';
    }

}
