<?php
$this->breadcrumbs=array(
	'Horarios'=>array('index'),
	'Cadastrar',
);

$this->menu=array(
	array('label'=>'Listar Horário', 'url'=>array('index')),
	array('label'=>'Gerenciar Horário', 'url'=>array('admin')),
);
?>

<h1>Cadastrar Horário</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>