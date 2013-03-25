<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/MAO.png','Sistema de Planos Acadêmicos',array('title'=>'Sistema de Controle de Documentos')); ?></div>
		<div id="subtitle">
			<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/cefet.jpg','CEFET-MG Campus Timóteo',array('title'=>'CEFET-MG Campus Timóteo')); ?>
		</div>
	</div><!-- header -->

		<?php 

		$user = Yii::app()->user;
		$isGuest = Yii::app()->user->isGuest;
		$isAdmin = (Yii::app()->user->name == "admin");
		$isUserPriv = false;
		if(Yii::app()->user->checkAccess('professor')){
			$isProfessor = true;
		}
		$this->widget('bootstrap.widgets.TbMenu', array(
	    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
	    'stacked'=>false, 
		'items'=>array(
			array('label'=>'Planos de etapa', 'url'=>array('/pAPlanoEtapa/planos')),
			array('label'=>'Meus planos de etapa', 'url'=>array('/pAPlanoEtapa/admin'),'visible'=>(!$isGuest)),
			array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
		),
	)); ?>
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/nti.jpg', 'Núcleo de Tecnologia da Informação',array('title'=>'Núcleo de Tecnologia da Informação (nti@timoteo.cefetmg.br)')); ?>
		<br />
		<strong>NTI - Núcleo de Tecnologia da Informação</strong> <br /> 

		CEFET-MG Campus Timóteo - <?php echo date('Y'); ?> <br />
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
