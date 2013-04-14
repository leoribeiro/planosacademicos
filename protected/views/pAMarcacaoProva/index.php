<?php
$this->breadcrumbs=array(
	'Marcacao Provas',
);

$this->menu=array(
	array('label'=>'Marcar uma prova', 'url'=>array('create')),
	array('label'=>'Gerenciar Marcações', 'url'=>array('admin')),
);
?>

<h1>Provas Marcadas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
