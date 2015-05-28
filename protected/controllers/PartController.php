<?php

class PartController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','upate'),
				'users'=>array('*'),
			),
            /*
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
            */
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Part();
        $this->handleRequest($model);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=Part::model()->findByPk($id);
        $this->handleRequest($model);
	}

    /**
     *
     * @param
     */
    protected function handleRequest($model)
    {
        if (isset($_GET['ptvi_id'])) {
            $class = Part::getSubclass($_GET['ptvi_id']); 
            $model = new $class();
        }
            
        $modelClass = get_class($model);

        if (isset($_POST[$modelClass])) {
            $model->attributes = $_POST[$modelClass];

            if ($model->save())
                $this->redirect(array('partExpense/create'));
        }

        $rootTypes = PartType::model()->findAll('parent_id is NULL');

        $typesDp = new CActiveDataProvider('PartType', array(
            'pagination' => false)); 

        $vendors = Vendor::model()->findAll(array(
            'order' => 'name'));

        if (isset($rootType))
            $types = PartType::model()->findAll('parent_id=?', array($rootType->id));
        else {
           $rootType = new PartType(); 
           $types = array();
        }

		$this->render('create',array(
			'model'     => $model,
            'rootTypes' => $rootTypes,
            'rootType'  => $rootType,
            'types'     => $types,
            'vendors'   => $vendors,
            'typesDp'   => $typesDp,
		));
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
        $this->redirect(array('partExpense/create'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Part');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Part('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Part']))
			$model->attributes=$_GET['Part'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Part the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Part::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Part $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='part-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    /**
     *
     * @return
     */
    public function typeToView($type)
    {
        $views = array(
            Part::TYPE_GENERIC   => '_generic',
            Part::TYPE_FLUID     => '_fluid',
            Part::TYPE_MOTOR_OIL => '_motoroil',
            Part::TYPE_ACCESSORY => '_accessory',
        );
        
        return $views[$type];
    }
}
