<?php
$this->breadcrumbs=array(
	'Turnos'=>array('index'),
	'Cadastrar',
);

$this->menu=array(
	array('label'=>'Listar Turno', 'url'=>array('index')),
	array('label'=>'Gerenciar Turno', 'url'=>array('admin')),
);
?>

<h1>Cadastrar Turno</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>