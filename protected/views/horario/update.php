<?php
$this->breadcrumbs=array(
	'Horarios'=>array('index'),
	$model->CDHorario=>array('view','id'=>$model->CDHorario),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Horário', 'url'=>array('index')),
	array('label'=>'Cadastrar Horário', 'url'=>array('create')),
	array('label'=>'Visualizar Horário', 'url'=>array('view', 'id'=>$model->CDHorario)),
	array('label'=>'Gerenciar Horário', 'url'=>array('admin')),
);
?>

<h1>Editar Horario <?php echo $model->CDHorario; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>