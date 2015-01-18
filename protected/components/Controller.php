<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/with-nav';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function isHome()
    {
        $controller = Yii::app()->getController();
        $defaultController = Yii::app()->defaultController;

        return (($controller->id === $defaultController)
            && ($controller->action->id === $controller->defaultAction))
            ? true : false;
    }

    public function isRoute($route)
    {
        $currentController = Yii::app()->getController();
        list($routeControllerId, $routeActionId) = explode('/', $route); 

        if ($currentController->id == $routeControllerId &&
            $currentController->action->id == $routeActionId)
            return true;
    } 

    public function updateUrl($route, $params)
    {
        return $this->createUrl($route, array_merge($_GET, $params));
    }

    public function isAction($action)
    {
        l($this->action->id);
        return $this->action->id === $action;
    }

    protected function beforeAction($action)
    {
        CHtml::$errorMessageCss = 'error-msg';

        return parent::beforeAction($action);
    }
}
