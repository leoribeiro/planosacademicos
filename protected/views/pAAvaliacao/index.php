<?php
/* @var $this PAAvaliacaoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Paavaliacaos',
);

$this->menu=array(
	array('label'=>'Create PAAvaliacao', 'url'=>array('create')),
	array('label'=>'Manage PAAvaliacao', 'url'=>array('admin')),
);
?>

<h1>Paavaliacaos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
