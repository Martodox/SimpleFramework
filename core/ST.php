<?php

class ST
{

    public static function gP($class)
    {

        return APP::route()->getRoutePacage()[$class][$_SESSION['lang']];
    }

    public static function gC($class)
    {
        return APP::route()->getRoutePacage()[$class][$_SESSION['lang']];
    }

    public static function gAM($class)
    {
        return APP::route()->getRouteActions()['Model'][$class][$_SESSION['lang']];
    }

    public static function gAC($class)
    {
        return APP::route()->getRouteActions()['Controller'][$class][$_SESSION['lang']];
    }

//    public static function gL($dialog)
//    {
//        return $this->langArray[$dialog][$_SESSION['lang']];
//    }

    public static function currentPacage()
    {
        return APP::route()->getGlobalRewrite()['pacage'];
    }

    public static function currentComponent()
    {
        return APP::route()->getGlobalRewrite()['component'];
    }

    public static function currentAction()
    {
        return APP::route()->getGlobalRewrite()['action'];
    }

    public static function currentActionFile()
    {
        return APP::route()->getGlobalRewrite()['file'];
    }

    public static function isActionSet($name = null)
    {
        if ($name != null)
            if (APP::route()->getGlobalRewrite()['action'] != $name)
                return false;

        if (empty(APP::route()->getGlobalRewrite()['action']))
            return false;

        return true;
    }

    public static function currentVars($id = false)
    {
        if ($id === false) {
            return APP::route()->getGlobalRewrite()['vars'];
        }
        if (null !== APP::route()->getGlobalRewrite()['vars'][$id]) {
            return APP::route()->getGlobalRewrite()['vars'][$id];
        } else {
            return false;
        }
    }

}
