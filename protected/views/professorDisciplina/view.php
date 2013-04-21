<?php
$this->breadcrumbs=array(
	'Professor Disciplinas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProfessorDisciplina','url'=>array('index')),
	array('label'=>'Create ProfessorDisciplina','url'=>array('create')),
	array('label'=>'Update ProfessorDisciplina','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProfessorDisciplina','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProfessorDisciplina','url'=>array('admin')),
);
?>

<h1>View ProfessorDisciplina #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_professor',
		'id_disciplina',
	),
)); ?>
