<?php

class ContractorController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
                'actions'=>array('index','view','create','update','admin','delete'),
                'users'=>array('*'),
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
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
	public function actionCreate($id = null)
	{
        if ($id !== null && !ContractorType::model()->findByPk($id))
            throw new CHttpException(404, 'The requested contractor type does not exist.');

        $model=new Contractor();
        $model->type_id = $id; 

        $address = new Address();

        $this->handleRequest($model, $address);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        if (!isset($model->addressr) || !($model->addressr instanceof Address))
            throw new CHttpException(500, "Model's address relation property doesn't contain Address object");

        $address = $model->addressr;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $this->handleRequest($model, $address);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Contractor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contractor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contractor']))
			$model->attributes=$_GET['Contractor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contractor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
        $model=Contractor::model()->findByPk($id, array(
            'with' => array('head', 'addressr')
        ));

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contractor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contractor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    protected function handleRequest($model, $address)
    {
        $newHead = new ContractorHead('nested');

        if (isset($_POST['addHead']) && $_POST['ContractorHead']) {
            $newHead->attributes = $_POST['ContractorHead'];
            $newHead->save();

        } elseif (isset($_POST['Contractor'], $_POST['Address'])) {
			$model->attributes = $_POST['Contractor'];
			$address->attributes = $_POST['Address'];

            $model->validate();
            $address->validate();

            if (!$model->hasErrors() && !$address->hasErrors()) {
                $trans = Yii::app()->db->beginTransaction();
        
                try {
                    $address->save(false);

                    $model->address_id = $address->id;
                    $model->save(false);

                    $trans->commit();
                } catch (Exception $e) { 
                    $trans->rollback();

                    throw new CHttpException(500, $e->errorMessage);
                }

                $this->redirect(Yii::app()->user->returnUrl);
            }
		}

        $request = Yii::app()->request;
        $prevUrl = $request->urlReferrer;
        $currentUrl = $request->hostInfo . $request->url;

        if ($currentUrl !== $prevUrl)
            Yii::app()->user->returnUrl = $prevUrl;

        $headsDp = new CActiveDataProvider('ContractorHead', array(
            'criteria' => array(
                'order'     => 't.name',
                'distinct'  => true,
                'join'      => 'LEFT OUTER JOIN contractor ON t.id = head_id',
                'condition' => 'type_id=:id OR type_id is NULL',
                'params'    => array(':id' => $model->type_id)
            ),
            'pagination' => array(
                'pageSize' => 10
            )
        )); 

        if (is_null($model->type_id))
            $types = ContractorType::model()->findAll();
        else
            $types = array();

		$this->render('edit',array(
			'model'   => $model,
            'headsDp' => $headsDp,
            'newHead' => $newHead,
            'types'   => $types,
            'address' => $address,
		));
      
    }
     
}
