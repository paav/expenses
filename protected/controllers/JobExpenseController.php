<?php

class JobExpenseController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		//	'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('delete','index','view','create','update'),
				'users'=>array('*'),
			),
            /*
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
            */
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
        $relatedExpensesDp = new CActiveDataProvider('PartExpense', array(
            'criteria'=>array(
                'condition'=>'bound_id=:id',
                'params'=>array(':id'=>$id),
            )
        ));

		$this->render('view',array(
			'model'=>$this->loadModel($id),
            'relatedExpensesDp'=>$relatedExpensesDp,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $model = new JobExpense;
        $model->run = JobExpense::model()->maxRun()->find()->run ?: null;

        $this->handleRequest($model);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $model = JobExpense::model()->findByPk($id);

        $this->handleRequest($model);
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
            $this->redirect(array('site/index'));
			//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Expenses');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Expenses('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Expenses']))
			$model->attributes=$_GET['Expenses'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionUnbind($id)
    {
        echo '<pre>';
        var_dump($_POST);
        exit();
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Expenses the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Expense::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Expenses $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='expenses-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	/**
	 * My methods are below
	 */

    protected function handleRequest($model)
    {
		if (isset($_POST['JobExpense'])) {

			$model->attributes = $_POST['JobExpense'];
            $model->expense_type_id = Expense::TYPE_JOB;

            if ($model->save()) {

                if (isset($_POST['idsToBind']))
                    Expense::model()->updateByPk($_POST['idsToBind'],
                        array('bound_id' => $model->id));
                
                if (isset($_POST['idsToUnbind']))
                    Expense::model()->updateByPk($_POST['idsToUnbind'],
                        array('bound_id '=> 'NULL'));

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $partsAll = Part::model()->findAll(array('order' => 'name')); 
        $jobsAll = Job::model()->findAll(array('order' => 'name')); 

        $boundToModelExpenses = Expense::model()->findAll('bound_id=:id', array(
            ':id'=> $model->id,
        ));

        $boundToNothingExpenses = PartExpense::model()->findAll(
            'bound_id is NULL');

        $df = yii::app()->dateFormatter;

        $model->formatForView(true);

        $this->render('edit', array(
            'model' => $model,
            'partsAll' => $partsAll,
            'jobsAll' => $jobsAll,
            'boundToModelExpenses' => $boundToModelExpenses,
            'boundToNothingExpenses' => $boundToNothingExpenses,
            'df'=> $df,
        ));
    }
}
