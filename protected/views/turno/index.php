<?php
$this->breadcrumbs=array(
	'Turnos',
);

$this->menu=array(
	array('label'=>'Cadastrar Turno', 'url'=>array('create')),
	array('label'=>'Gerenciar Turno', 'url'=>array('admin')),
);
?>

<h1>Turnos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
