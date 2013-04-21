<?php
$this->breadcrumbs=array(
	'Professor Disciplinas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProfessorDisciplina','url'=>array('index')),
	array('label'=>'Create ProfessorDisciplina','url'=>array('create')),
	array('label'=>'View ProfessorDisciplina','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ProfessorDisciplina','url'=>array('admin')),
);
?>

<h1>Update ProfessorDisciplina <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>