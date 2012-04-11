<?php

class AdminModule extends CWebModule
{
    public $theme = 'default';
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		$this->setLayoutPath('protected/modules/admin/views/layouts');
        $this->layout = 'main';
        
		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
			//'application.components.ActiveRecords.*'
		));
                
                $this->setComponents(array(
                    'errorHandler' => array(
                        'errorAction' => 'admin/default/error'),
                    'user' => array(
                        'class' => 'CWebUser',             
                        'loginUrl' => Yii::app()->createUrl('/admin/default/login'),
                    )
                ));
                
                Yii::app()->theme = 'admin/' . $this->theme;

		// Set theme url
                Yii::app()->themeManager->setBaseUrl( Yii::app()->theme->baseUrl );
                Yii::app()->themeManager->setBasePath( Yii::app()->theme->basePath );
                Yii::app()->user->setStateKeyPrefix('_admin');
	}

	public function beforeControllerAction($controller, $action)
	{
            if(parent::beforeControllerAction($controller, $action))
            {
				
                $controller->layout="column2";
                // this method is called before any module controller action is performed
                // you may place customized code here
                 $route = $controller->id . '/' . $action->id;
           
                 $publicPages = array(
                    'default/login',
                    'default/error',
					'default/register',
                 );
                if (Yii::app()->user->isGuest && !in_array($route, $publicPages))
                {
                    Yii::app()->getModule('admin')->user->setReturnUrl('index');      
             
                    Yii::app()->getModule('admin')->user->loginRequired();                
                }
				else
                {
                    Yii::app()->getModule('admin')->user->setReturnUrl('index');      
                    return true;
                }
            }
            else
                    return false;
	}
}