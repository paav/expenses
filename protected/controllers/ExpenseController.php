<?php

class ExpenseController extends Controller
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
				//'actions'=>array('delete','index','view','create','update'),
				'actions'=>array('index', 'delete'),
				'users'=>array('@'),
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
        //$relatedExpensesDp = new CActiveDataProvider('Expense', array(
            //'criteria'=>array(
                //'condition'=>'bound_id=:id',
                //'params'=>array(':id'=>$id),
            //)
        //));

		//$this->render('//expense/view',array(
			//'model'=>$this->loadModel($id),
            //'relatedExpenses'=>$relatedExpensesDp,
		//));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($expenseType = 'part')
	{
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $expenseItemClass = ucfirst($expenseType);
        $class = $expenseItemClass . 'Expense';
        $model = new $class;

		if(isset($_POST[$class]))
		{
			$model->attributes=$_POST[$class];
            $model->type=$expenseType;
            $model->validate();

			if($model->save()) {
                if(isset($_POST['boundIds']))
                    Expense::model()->updateByPk($_POST['boundIds'], array('bound_id'=>$model->id));
				$this->redirect(array('view','id'=>$model->id));
            }
		} else {
            echo $model->count();
            exit();
            if ($expenseType == 'job' && $model->count() != 0)
                $model = $class::model()->maxRun()->find();

            $contractorsDp = new CActiveDataProvider('Contractor', array(
                'criteria'=>array(
                    'scopes'=>array('onlyFor'=>array($expenseType))
                ),
            ));

            $parts = Part::model()->findAll(); 
            $jobs = Job::model()->findAll(); 
            $contractors = Contractor::model()->onlyFor($expenseType)->findAll();

            $jobsDp = new CActiveDataProvider('Job'); 
            $expenses = Expense::model()->findAll('part_id IS NOT NULL OR job_id IS NOT NULL');
            $connectedExpenses = Expense::model()->findAll('type<>:type AND bound_id=:id', array(
                ':type'=>$expenseType,
                ':id'=>$model->id,
            ));
            $expensesDp = new CActiveDataProvider(($expenseType == 'part') ? 'JobExpense' : 'PartExpense');
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
                'expenseType'=>$expenseType,
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

        $model = Expense::model()->findByPk($id);
        $modelClass = get_class($model);

        $tmpMap = [
            'hello' => 'hello',
            'PartExpense' => 'part',
            'JobExpense' => 'job',
        ];

        $expenseType = $tmpMap[$modelClass];

		if(isset($_POST[$modelClass]))
		{
			$model->attributes=$_POST[$modelClass];
            $model->type=$expenseType;
            $model->validate();

			if($model->save()) {
                if(isset($_POST['boundIds']))
                    Expense::model()->updateByPk($_POST['boundIds'], array('bound_id'=>$model->id));
                if(isset($_POST['unboundIds']))
                    Expense::model()->updateByPk($_POST['unboundIds'], array('bound_id'=>'NULL'));
				$this->redirect(array('view','id'=>$model->id));
            }
		} else {
            $contractorsDp = new CActiveDataProvider('Contractor', array(
                'criteria'=>array(
                    'scopes'=>array('onlyFor'=>array($expenseType))
                ),
            ));

            $parts = Part::model()->findAll(); 
            $jobs = Job::model()->findAll(); 
            $contractors = Contractor::model()->onlyFor($expenseType)->findAll();
            $connectedExpenses = Expense::model()->findAll('type<>:type AND bound_id=:id', array(
                ':type'=>$expenseType,
                ':id'=>$model->id,
            ));  

            $jobsDp = new CActiveDataProvider('Job'); 
            $expenses = Expense::model()->findAll('part_id IS NOT NULL OR job_id IS NOT NULL');
            //$connectedExpensesDp = new CActiveDataProvider(($expenseType == 'part') ? 'JobExpense' : 'PartExpense');
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
                'expenseType'=>$expenseType,
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
            $this->redirect(array('expense/index'));
			//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $searchForm = new SearchForm;
        $sortHelper = new PaavSortHelper(array(
            // Valid attrs for sorting.
            // First element is set as sort by element.
            // Attr => SQL ORDER BY clause substring.
            'date' => 'date',
            'run' => 'run',
            'type' => 'expenseType.name',
            'cost' => 'cost',
        ));

        $SqlOrder = $sortHelper->getSqlOrder($_GET);

        $criteria = new CDbCriteria(array(
            'select' => array(
                '*',
                'IFNULL(cost, unit_price * quantity) AS cost',
            ),
            'with' => array(
                'expenseType',
                'part',
                'part.type' => array(
                    'alias' => 'partType',
                ),
                'job',
            ),
            'order' => $SqlOrder,
            'condition' => 'user_id=:user_id',
            'params' => array(
                ':user_id' => Yii::app()->user->id 
            )
        ));

        if (isset($_GET['SearchForm'])) {
            $searchForm->attributes = $_GET['SearchForm'];

            if ($searchForm->validate()) {
                $searchString = $searchForm->searchString;

                // TODO: move from here.
                $viewDatePatterns = [
                    'dd.MM.yyyy',
                    'dd.MM.yy',
                    'MM.yyyy',
                    'MM.yy',
                    'yy',
                    'yyyy',
                    'dd.MM',
                    'd.M.yy',
                ];

                // Get DB date formats, e.g. yyyy-MM-dd
                foreach ($viewDatePatterns as $datePattern)
                    $dbDatePatterns[] = str_replace('.', '-', strrev(
                        $datePattern));

                foreach ($viewDatePatterns as $index => $datePattern) {
                    $timestamp = CDateTimeParser::parse(trim($searchString),
                                                        $datePattern);
                    if ($timestamp) {
                        $searchString = yii::app()->dateFormatter->format(
                            $dbDatePatterns[$index], $timestamp);

                        break;
                    }
                }

                $searchCriteria = new CDbCriteria();
                $searchCriteria->compare('date', $searchString, true, 'OR'); 
                $searchCriteria->compare('expenseType.name', $searchString,
                                         true, 'OR'); 
                $searchCriteria->compare('part.name', $searchString, true,
                                         'OR'); 
                $searchCriteria->compare('partType.name', $searchString, true,
                                         'OR'); 
                $searchCriteria->compare('job.name', $searchString, true, 'OR'); 

                $criteria->mergeWith($searchCriteria);
            }
        }

        $count = Expense::model()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);

        $allExpenses = Expense::model()->findAll($criteria);

		$allExpensesDp = new CActiveDataProvider('Expense',array(
            'criteria' => array(
                'order' => 'date ASC',
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));

		$this->render('index',array(
            'allExpenses' => $allExpenses,
			'allExpensesDp'=> $allExpensesDp,
            'pages' => $pages,
            'searchForm' => $searchForm,
            'sortHelper' => $sortHelper,
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

	public function getAbsUrlByModel($model, $action, array $params = array())
	{
		$route = get_class($model) . '/' . $action;

		return $this->createAbsoluteUrl($route, $params);
	}

}
