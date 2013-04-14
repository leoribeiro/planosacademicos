<?php
$this->breadcrumbs=array(
	'Turnos'=>array('index'),
	$model->CDTurno=>array('view','id'=>$model->CDTurno),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Turno', 'url'=>array('index')),
	array('label'=>'Cadastrar Turno', 'url'=>array('create')),
	array('label'=>'Visualizar Turno', 'url'=>array('view', 'id'=>$model->CDTurno)),
	array('label'=>'Gerenciar Turno', 'url'=>array('admin')),
);
?>

<h1>Editar Turno <?php echo $model->CDTurno; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>