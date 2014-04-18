<?php

class Controller
{

    public $model;
    private $template;

    public function __construct($model)
    {

        $this->model = $model;
        $this->template = substr(get_class($this->model), 0, -5);
    }

    public function setTpl($tpl)
    {
        $this->template = $tpl;
    }

    public function display($tpl = null)
    {
        $tpl = ($tpl === null || devmode ? $this->template : $tpl);

        APP::smarty()->display($tpl . '.tpl');
    }

    public function setLanguage()
    {

        $_SESSION['lang'] = $this->model->lng->currentVars(0);
        $location = rootpatch;
        $vars = $this->model->lng->currentVars(1);
        if (!empty($vars)) {
            $location .= $vars;
        }
        header('Location: ' . $location);
    }

    public function setTitle($title)
    {
        $this->model->setTitle($title);
    }

}
