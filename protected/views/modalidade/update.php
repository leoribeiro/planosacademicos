<?php
$this->breadcrumbs=array(
	'Modalidades'=>array('index'),
	$model->CDModalidade=>array('view','id'=>$model->CDModalidade),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Modalidade', 'url'=>array('index')),
	array('label'=>'Cadastrar Modalidade', 'url'=>array('create')),
	array('label'=>'Visualizar Modalidade', 'url'=>array('view', 'id'=>$model->CDModalidade)),
	array('label'=>'Gerenciar Modalidade', 'url'=>array('admin')),
);
?>

<h1>Editar Modalidade <?php echo $model->CDModalidade; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>