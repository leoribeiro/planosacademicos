<?php
$this->breadcrumbs=array(
	'Horarios',
);

$this->menu=array(
	array('label'=>'Cadastrar Horário', 'url'=>array('create')),
	array('label'=>'Gerenciar Horário', 'url'=>array('admin')),
);
?>

<h1>Horários</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
