<?php
$this->breadcrumbs=array(
	'Pavar Globals'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PAVarGlobal','url'=>array('index')),
	array('label'=>'Create PAVarGlobal','url'=>array('create')),
	array('label'=>'Update PAVarGlobal','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete PAVarGlobal','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PAVarGlobal','url'=>array('admin')),
);
?>

<h1>View PAVarGlobal #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'value',
	),
)); ?>
