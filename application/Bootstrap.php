<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload()
    {
		// add autoloader empty namespace
		$autoLoader = Zend_Loader_AutoLoader::getInstance();
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
		'basePath' 		=> APPLICATION_PATH,
		'namespace' 	=> '',
	));
                        //base
        new Zend_Loader_Autoloader_Resource(array(
            'basePath' => APPLICATION_PATH,
            'namespace' => '',
            'resourceTypes' => array(
                'models' => array(
                    'path' => 'models/',
                    'namespace' => 'Model_'
                )
            )
        ));
	
	// return it so that it can be stored by the bootstrap
	return $autoLoader;
    }
        protected function _initConfig()
    {
        $config = $this->getOptions();
        Zend_Registry::getInstance()->set('config', $config);
 
        return $config;
    }
        
        protected function _initDB()
    {
        $this->bootstrap('config');
        $config = $this->getResource('config');
 
        if(isset($config['resources']) AND isset($config['resources']['db'])){
            $resource = $config['resources']['db'];
             
            if (isset($resource['adapter'])) {
                $this->_initDbResource($resource);
            } else {
                foreach ($resource as $name => $res) {
                    $this->_initDbResource($res, $name);
                }
            }
        }
    }
     
    private function _initDbResource($database, $name='default_db')
    {
        $db = Zend_Db::factory($database['adapter'], $database);
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        $db->query("SET NAMES 'utf8';");
        $db->query("SET CHARACTER SET 'utf8';");
         
        if (isset($database['default']) AND $database['default'] == true) {
            Zend_Db_Table::setDefaultAdapter($db);
        }
         
        Zend_Registry::set($name . '_db', $db);
    }
    
    

}
