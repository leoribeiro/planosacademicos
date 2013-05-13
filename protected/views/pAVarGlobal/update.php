<?php
$this->breadcrumbs=array(
	'Pavar Globals'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PAVarGlobal','url'=>array('index')),
	array('label'=>'Create PAVarGlobal','url'=>array('create')),
	array('label'=>'View PAVarGlobal','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PAVarGlobal','url'=>array('admin')),
);
?>

<h1>Update PAVarGlobal <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>