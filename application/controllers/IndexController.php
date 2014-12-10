<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
        // action body
        $test = new Model_Test();
        var_dump($test->getAll());
    }
}