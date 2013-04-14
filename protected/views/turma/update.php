<?php
$this->breadcrumbs=array(
	'Turmas'=>array('index'),
	$model->CDTurma=>array('view','id'=>$model->CDTurma),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Turma', 'url'=>array('index')),
	array('label'=>'Cadastrar Turma', 'url'=>array('create')),
	array('label'=>'Visualizar Turma', 'url'=>array('view', 'id'=>$model->CDTurma)),
	array('label'=>'Gerenciar Turma', 'url'=>array('admin')),
);
?>

<h1>Editar Turma <?php echo $model->CDTurma; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>