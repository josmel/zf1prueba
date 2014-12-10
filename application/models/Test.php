<?php

class Model_Test extends Zend_Db_Table_Abstract {

    protected $_name = 'test';
    
    public function getAll() {
        $result =  parent::fetchAll();
        return $result->count() > 0 ? $result->toArray():null;
    }


}


