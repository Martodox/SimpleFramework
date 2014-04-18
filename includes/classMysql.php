<?php

class classMysql
{

    private $connection;
    private $prepareQuery;
    private $charset = "utf8";
    private $return = true;

    private function __construct()
    {

        $host = config_MySql_host;
        $dbname = config_MySql_dbname;
        $username = config_MySql_username;
        $password = config_MySql_password;

        $this->connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$this->charset", '' . $username . '', '' . $password . '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function instance()
    {
        return new classMysql();
    }

    public static function query()
    {
        $instance = new classMysql();
        $ar = func_get_args();
        $instance->prepare($ar[0]);

        for ($i = 1; $i < count($ar); $i++) {
            if (empty($ar[$i][2])) {
                $ar[$i][2] = 'str';
            }
            $ar[$i][0] = stripslashes(htmlspecialchars($ar[$i][0]));
            $ar[$i][2] = $instance->getDataType($ar[$i][2]);
            $instance->prepareQuery->bindParam($ar[$i][1], $ar[$i][0], intval($ar[$i][2]));
        }

        return $this->execute();
    }

    public static function simpleQuery($query = null, $forceReturn = false)
    {
        $instance = new classMysql();
        $instance->checkReturn($query);
        $zapytanie = $instance->connection->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $zapytanie->execute();
        if ($instance->return || $forceReturn) {
            return $zapytanie->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public static function lastId()
    {
        $instance = new classMysql();
        return $instance->connection->lastInsertId();
    }

    public static function getDbname()
    {

        return config_MySql_dbname;
    }

    private function checkReturn($query = null)
    {
        $query = explode(" ", $query);
        $sqlCommands = array('delete', 'insert', 'replace', 'update', 'create');
        if (!in_array(strtolower($query[0]), $sqlCommands)) {
            $this->return = true;
        } else {
            $this->return = false;
        }
    }

    private function prepare($query)
    {
        $this->checkReturn($query);
        $this->prepareQuery = null;
        $this->prepareQuery = $this->connection->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    }

    private function execute()
    {
        try {
            $this->prepareQuery->execute();
            if ($this->return) {
                return $this->prepareQuery->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    private function getDataType($short)
    {

        switch ($short) {
            case 'bool':
                return 'PDO::PARAM_BOOL';
            case 'null':
                return 'PDO::PARAM_NULL';
            case 'int':
                return 'PDO::PARAM_INT';
            case 'lob':
                return 'PDO::PARAM_LOB';
            case 'str':
            default:
                return 'PDO::PARAM_STR';
        }
    }

}
