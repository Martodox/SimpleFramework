<?php

class Model
{

    public $siteTitle;

    public function __construct()
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['user']['logged'] = false;
            $_SESSION['user']['level'] = 0;
        }



        if (empty($_SESSION['formValidate']['new'])) {
            $_SESSION['formValidate']['new'] = $this->uniqueId();
        }

        $_SESSION['formValidate']['old'] = $_SESSION['formValidate']['new'];
        $_SESSION['formValidate']['new'] = static::uniqueId();


        $this->siteTitle = serviceName;
        $pacage = APP::route()->getGlobalRewrite()['pacage'];
        $component = APP::route()->getGlobalRewrite()['component'];

        APP::smarty()->setTemplateDir(array(
            'root' => ABSPATH . 'app/templates/',
            ABSPATH . "app/templates/$pacage",
            'comp' => ABSPATH . "app/templates/$pacage/$component"
        ));

        APP::smarty()->setCompileDir(ABSPATH . 'storage/smarty/compile');
        APP::smarty()->setCacheDir(ABSPATH . 'storage/smarty/cache');
        APP::smarty()->caching = 0;
        APP::smarty()->force_compile = true;
        APP::smarty()->cache_lifetime = 1;
        APP::smarty()->
                assign("rootpatch", rootpatch, true)->
                assign("temproot", rootpatch . 'app/templates/', true)->
                assign('comproot', rootpatch . "app/templates/$pacage/$component/", true)->
                assign('packroot', rootpatch . "app/templates/$pacage/", true)->
                assign('siteTitle', $this->siteTitle)->
                assign('isLogin', $_SESSION['user']['logged'], true)->
                assign('loginLevej', $_SESSION['user']['level'])->
                assign('formValidateToken', $_SESSION['formValidate']['new'], true)->
                assign('serviceName', serviceName)->
                assign('extraCSS');
    }

    public static function uniqueId()
    {
        return sha1(mt_rand() . uniqid() . mt_rand() . uniqid() . mt_rand() . uniqid());
    }

    public static function getSalt()
    {
        return hash('sha256', mt_rand() . uniqid() . mt_rand() . uniqid() . mt_rand() . uniqid());
    }

    public static function getIp()
    {
        if ($_SERVER['REMOTE_ADDR'] == "::1" || $_SERVER['REMOTE_ADDR'] == "::" || !preg_match("/^((?:25[0-5]|2[0-4][0-9]|[01]?[0-9]?[0-9]).){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9]?[0-9])$/m", $_SERVER['REMOTE_ADDR'])) {
            $ip = '127.0.0.1';
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public static function getRandString($len)
    {
        return strtoupper(substr(rtrim(base64_encode(md5(microtime())), "="), 0, $len));
    }

    public static function serverVar($where, $name = null)
    {
        //get secure var from post, get, and cookie arrays
        //work needs to be done to secure it even further
        $var = null;
        switch ($where) {
            case 'post':
                if ($name === null) {
                    $var = $_POST;
                } else {
                    $var = $_POST[$name];
                }
                break;
            case 'get':
                if ($name === null) {
                    $var = $_GET;
                } else {
                    $var = $_GET[$name];
                }
                break;
            case 'session':
                if ($name === null) {
                    $var = $_SESSION;
                } else {
                    $var = $_SESSION[$name];
                }
                break;
            case 'cookie':
                if ($name === null) {
                    $var = $_COOKIE;
                } else {
                    $var = $_COOKIE[$name];
                }
                break;
            default:
                $name = 'post';
                $var = null;
                break;
        }
        if (is_array($var)) {
            return $var;
        }
        return htmlspecialchars($var);
    }

    public function addTitle($text)
    {
        $title = $this->siteTitle . ' &#124; ' . $text;
        APP::smarty()->assign('siteTitle', $title);
    }

    public static function checkLogin($level = 1)
    {
        if ($_SESSION['user']['logged'] && $_SESSION['user']['level'] >= $level) {
            return true;
        }
        return false;
    }

    public static function checkLoginRedirect($level = 1)
    {
        if (!$_SESSION['user']['logged'] || !$_SESSION['user']['level'] >= $level) {
            self::redirect('Admin', 'AdminAuth', 'login');
        }
    }

    public static function redirect($pacage = null, $controll = null, $action = null, $var = null)
    {
        $location = rootpatch;
        $location = ($pacage !== null) ? $location = $location . APP::route()->returnPacage($pacage) . '/' : $location;
        $location = ($controll !== null) ? $location = $location . APP::route()->returnComponent($controll) . '/' : $location;
        $location = ($action !== null) ? $location = $location . APP::route()->returnAction($action) . '/' : $location;
        $location = ($var !== null) ? $location = $location . $var . '/' : $location;
        header("Location: " . $location);
        die();
    }

    public static function addCSS($name = 'style.css')
    {
        $pacage = APP::route()->getGlobalRewrite()['pacage'];
        $component = APP::route()->getGlobalRewrite()['component'];
        $href = rootpatch . "app/templates/$pacage/$component/style.css";
        $val = '<link rel="stylesheet" href="' . $href . '" type="text/css" media="screen" />';
        APP::smarty()->assign('extraCSS', $val);
    }

}
