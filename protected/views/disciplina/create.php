<?php
$this->breadcrumbs=array(
	'Disciplinas'=>array('index'),
	'Cadastrar',
);

$this->menu=array(
	array('label'=>'Listar disciplina', 'url'=>array('index')),
	array('label'=>'Gerenciar disciplina', 'url'=>array('admin')),
);
?>

<h1>Cadastrar disciplina</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>