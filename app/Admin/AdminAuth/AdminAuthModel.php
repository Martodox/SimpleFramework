<?php

APP::route()->addMAction('login', 'pl', 'zaloguj', 'en', 'login');

class AdminAuthModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        self::addCSS();
    }

}
