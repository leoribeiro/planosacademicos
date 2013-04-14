<?php
$this->breadcrumbs=array(
	'Disciplinas'=>array('index'),
	$model->CDDisciplina=>array('view','id'=>$model->CDDisciplina),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar disciplina', 'url'=>array('index')),
	array('label'=>'Cadastrar disciplina', 'url'=>array('create')),
	array('label'=>'Visualizar disciplina', 'url'=>array('view', 'id'=>$model->CDDisciplina)),
	array('label'=>'Gerenciar disciplina', 'url'=>array('admin')),
);
?>

<h1>Editar disciplina <?php echo $model->CDDisciplina; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>