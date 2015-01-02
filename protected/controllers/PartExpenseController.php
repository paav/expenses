<?php

class PartExpenseController extends Controller
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
        $model = $this->loadModel($id); 

        $relatedExpensesDp = new CActiveDataProvider('JobExpense', array(
            'criteria'=>array(
                'condition'=>'t.id=:id',
                'params'=>array(':id'=>$model->bound_id),
                'with'=>array('job','contractor'),
            )
        ));

		$this->render('view',array(
			'model'=>$model,
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

        $model = new PartExpense;

		if(isset($_POST['PartExpense']))
		{ 
			$model->attributes=$_POST['PartExpense'];
            $model->expense_type_id = Expense::TYPE_PART;
            $model->validate();

			if($model->save()) {
                if(isset($_POST['boundIds']))
                    Expense::model()->updateByPk($_POST['boundIds'], array('bound_id'=>$model->id));

				$this->redirect(array('view','id'=>$model->id));
            }
		}

        $contractorsDp = new CActiveDataProvider('Contractor', array(
            'criteria'=>array(
                'scopes'=>array('type'=>array(Contractor::TYPE_STORE))
            ),
        ));

        $parts = Part::model()->findAll(); 
        $jobs = Job::model()->findAll(); 
        $contractors = Contractor::model()->type(Contractor::TYPE_STORE)
                                          ->findAll();

        $jobsDp = new CActiveDataProvider('Job'); 
        $expenses = Expense::model()->findAll('part_id IS NOT NULL OR job_id IS NOT NULL');
        $connectedExpenses = JobExpense::model()->findAll('bound_id=:id', array(
            ':id'=>$model->id,
        ));
        $expensesDp = new CActiveDataProvider(('job' == 'part') ? 'PartExpense' : 'PartExpense');
        $allExpensesDp = new CActiveDataProvider('PartExpense', array(
            'criteria' => array(
                'condition' => 'bound_id IS NULL',
            )
        ));

        $connectedExpensesDp = new CActiveDataProvider('PartExpense', array(
            'criteria' => array(
                'condition' => 'bound_id=:thisId',
                'params' => array(':thisId' => $model->id),
            )
        ));

        $this->render('create',array(
            'expenseType'=>'job',
            'model'=>$model,
            'parts'=>$parts,
            'jobs'=>$jobs,
            'contractors'=>$contractors,
            'jobsDp'=>$jobsDp,
            'expenses'=>$expenses,
            'contractorsDp'=>$contractorsDp,
            'expensesDp'=>$expensesDp,
            'connectedExpensesDp'=>$connectedExpensesDp,
            'connectedExpenses'=>$connectedExpenses,
            'allExpensesDp'=>$allExpensesDp,
        ));
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

        $model = PartExpense::model()->findByPk($id);

		if(isset($_POST['PartExpense']))
		{
			$model->attributes=$_POST['PartExpense'];

			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
            }
		}

        $contractorsDp = new CActiveDataProvider('Contractor', array(
            'criteria'=>array(
                'scopes'=>array('type'=>array(Contractor::TYPE_STORE))
            ),
        ));

        $parts = Part::model()->findAll(); 
        $jobs = Job::model()->findAll(); 
        $contractors = Contractor::model()->type(Contractor::TYPE_STORE)->findAll();
        $connectedExpenses = PartExpense::model()->findAll('bound_id=:id', array(
            ':id'=>$model->id,
        ));  

        $jobsDp = new CActiveDataProvider('Job'); 
        $expenses = Expense::model()->findAll('part_id IS NOT NULL OR job_id IS NOT NULL');
        //$connectedExpensesDp = new CActiveDataProvider(('job' == 'part') ? 'PartExpense' : 'PartExpense');
        $connectedExpensesDp = new CActiveDataProvider('PartExpense', array(
            'criteria' => array(
                'condition' => 'bound_id=:thisId',
                'params' => array(':thisId' => $model->id),
            )
        ));

        $allExpensesDp = new CActiveDataProvider('PartExpense', array(
            'criteria' => array(
                'condition' => 'bound_id<>:thisId',
                'params' => array(':thisId' => $model->id),
            )
        ));

        $this->render('create',array(
            'expenseType'=>'job',
            'model'=>$model,
            'parts'=>$parts,
            'jobs'=>$jobs,
            'contractors'=>$contractors,
            'jobsDp'=>$jobsDp,
            'expenses'=>$expenses,
            'contractorsDp'=>$contractorsDp,
            'connectedExpensesDp'=>$connectedExpensesDp,
            'connectedExpenses'=>$connectedExpenses,
            'allExpensesDp'=>$allExpensesDp,
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
}
