<?php

class ApiModule extends CWebModule
{
    public function init()
    {
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'api.models.*',
            'application.models.User.*',
            'api.components.*',
        ));

    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }
}
