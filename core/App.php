<?php

$smartyAppuvWNKgYKZVCNHoCFUtkZ = new Smarty();
$listRoutejkhfskjlhgjkHJKhfdspeoir = new Route();
$KJLhfkjdgfhIUtyfjksdkljsdlkhfaliug = new Upload();

class APP
{

    public static function smarty()
    {
        global $smartyAppuvWNKgYKZVCNHoCFUtkZ;
        return $smartyAppuvWNKgYKZVCNHoCFUtkZ;
    }

    public static function db()
    {
        return classMysql::instance();
    }

    public static function route()
    {
        global $listRoutejkhfskjlhgjkHJKhfdspeoir;
        return $listRoutejkhfskjlhgjkHJKhfdspeoir;
    }

    public static function upload()
    {
        global $KJLhfkjdgfhIUtyfjksdkljsdlkhfaliug;
        return $KJLhfkjdgfhIUtyfjksdkljsdlkhfaliug;
    }

}
