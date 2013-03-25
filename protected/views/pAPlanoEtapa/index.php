<?php
$this->breadcrumbs=array(
	'Paplano Etapas',
);

$this->menu=array(
	array('label'=>'Create PAPlanoEtapa','url'=>array('create')),
	array('label'=>'Manage PAPlanoEtapa','url'=>array('admin')),
);
?>

<h1>Paplano Etapas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
