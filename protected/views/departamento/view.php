<?php
$this->breadcrumbs=array(
	'Departamentos'=>array('index'),
	$model->CDDepartamento,
);

$this->menu=array(
	array('label'=>'Listar Departamento', 'url'=>array('index')),
	array('label'=>'Cadastrar Departamento', 'url'=>array('create')),
	array('label'=>'Editar Departamento', 'url'=>array('update', 'id'=>$model->CDDepartamento)),
	array('label'=>'Deletar Departamento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDDepartamento),'confirm'=>'Tem certeza que deseja excluir este item?')),
	array('label'=>'Gerenciar Departamento', 'url'=>array('admin')),
);
?>

<h1>Visualizar Departamento #<?php echo $model->CDDepartamento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDDepartamento',
		'NMDepartamento',
	),
)); ?>
