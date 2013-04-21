<?php
$this->breadcrumbs=array(
	'Professor Disciplinas',
);

$this->menu=array(
	array('label'=>'Create ProfessorDisciplina','url'=>array('create')),
	array('label'=>'Manage ProfessorDisciplina','url'=>array('admin')),
);
?>

<h1>Professor Disciplinas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
