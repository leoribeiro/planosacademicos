<?php
/* @var $this PAAvaliacaoController */
/* @var $model PAAvaliacao */

$this->breadcrumbs=array(
	'Paavaliacaos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PAAvaliacao', 'url'=>array('index')),
	array('label'=>'Manage PAAvaliacao', 'url'=>array('admin')),
);
?>

<h1>Create PAAvaliacao</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>