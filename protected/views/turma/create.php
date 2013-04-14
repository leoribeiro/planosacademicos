<?php
$this->breadcrumbs=array(
	'Turmas'=>array('index'),
	'Cadastrar',
);

$this->menu=array(
	array('label'=>'Listar Turma', 'url'=>array('index')),
	array('label'=>'Gerenciar Turma', 'url'=>array('admin')),
);
?>

<h1>Cadastrar Turma</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>