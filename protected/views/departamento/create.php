<?php
$this->breadcrumbs=array(
	'Departamentos'=>array('index'),
	'Cadastrar',
);

$this->menu=array(
	array('label'=>'Listar Departamento', 'url'=>array('index')),
	array('label'=>'Gerenciar Departamento', 'url'=>array('admin')),
);
?>

<h1>Cadastrar Departamento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>