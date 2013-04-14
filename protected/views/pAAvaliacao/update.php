<?php
/* @var $this PAAvaliacaoController */
/* @var $model PAAvaliacao */

$this->breadcrumbs=array(
	'Paavaliacaos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PAAvaliacao', 'url'=>array('index')),
	array('label'=>'Create PAAvaliacao', 'url'=>array('create')),
	array('label'=>'View PAAvaliacao', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PAAvaliacao', 'url'=>array('admin')),
);
?>

<h1>Update PAAvaliacao <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>