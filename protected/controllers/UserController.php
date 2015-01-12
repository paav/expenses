<?php

class UserController extends Controller
{
	/**
	 * Registration page
	 */
	public function actionCreate()
	{
        $model = new User();

        $this->_handleRequest($model);
	}

	//public function actionDelete()
	//{
		//$this->render('delete');
	//}

    public function actionUpdate($id)
    {
        $model = User::model()->findByPk($id);

        $this->_handleRequest($model);
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

    private function _handleRequest($model)
    {
        $genders = Gender::model()->findAll();

        if (isset($_POST['User'])) {
            $dbPassword = $model->password;
            $model->attributes = $_POST['User'];

            if ($model->validate()) {
                if ($model->isNewRecord)
                    $model->insert();
                else {
                    if ($model->password == '') {
                        $model->password = $dbPassword;
                        $model->setScenario('hashedPwd');
                    }

                    $model->update();
                }

                $this->redirect(array(Yii::app()->homeUrl));
            }
        }

        $this->render('edit',array(
            'model'=>$model,
            'genders' => $genders,
        ));
    }
}
