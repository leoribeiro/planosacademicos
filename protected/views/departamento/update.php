<?php
$this->breadcrumbs=array(
	'Departamentos'=>array('index'),
	$model->CDDepartamento=>array('view','id'=>$model->CDDepartamento),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Departamento', 'url'=>array('index')),
	array('label'=>'Cadastrar Departamento', 'url'=>array('create')),
	array('label'=>'Visualizar Departamento', 'url'=>array('view', 'id'=>$model->CDDepartamento)),
	array('label'=>'Gerenciar Departamento', 'url'=>array('admin')),
);
?>

<h1>Editar Departamento <?php echo $model->CDDepartamento; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>