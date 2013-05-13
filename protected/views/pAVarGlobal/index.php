<?php
$this->breadcrumbs=array(
	'Pavar Globals',
);

$this->menu=array(
	array('label'=>'Create PAVarGlobal','url'=>array('create')),
	array('label'=>'Manage PAVarGlobal','url'=>array('admin')),
);
?>

<h1>Pavar Globals</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
