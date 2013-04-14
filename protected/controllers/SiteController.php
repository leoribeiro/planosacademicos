<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->redirect(array('//site/calendar'));
		//$this->render('//pAPlanoEtapa/planos');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionCalendar(){

		if(isset($_POST['ControleAntProx'])){
			$month = Yii::app()->session['monthCal'];
			$year = Yii::app()->session['yearCal'];
			$turma = Yii::app()->session['turmaCal'];
			if($_POST['ControleAntProx'] == 1){
				if($month == 1)
				{
					$month = 12;
					$year = $year - 1;
				}
				else
				{
					$month = $month - 1;
				}
			}
			else if($_POST['ControleAntProx'] == 2){
				if($month == 12)
				{
					$month = 1;
					$year = $year + 1;
				}
				else
				{
					$month = $month + 1;
				}
			}
		}
		// inicialmente, mes corrente e ano corrente
		else {

			$month = date('m', time());
			$year = date('Y', time());
			if(isset($_POST['CDTurma'])){
				$turma = $_POST['CDTurma'];
			}
			else if (isset($_POST['MarcacaoProva']['CDTurma'])) {
				$turma = $_POST['MarcacaoProva']['CDTurma'];
			}
			else{
				$lista = Turma::model()->find(array(
				    'select'=>'CDTurma','order'=>'NMTurma'
				));
				$turma = $lista->CDTurma;
			}

		}
		if(isset($_GET['partial']))
			$this->renderPartial('calendar',array('turma'=>$turma,'month'=>$month,'year'=>$year),false,true);
		else
			$this->render('calendar',array('turma'=>$turma,'month'=>$month,'year'=>$year));
	}
}