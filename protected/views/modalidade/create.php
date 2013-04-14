<?php
$this->breadcrumbs=array(
	'Modalidades'=>array('index'),
	'Cadastrar',
);

$this->menu=array(
	array('label'=>'Listar Modalidade', 'url'=>array('index')),
	array('label'=>'Gerenciar Modalidade', 'url'=>array('admin')),
);
?>

<h1>Cadastrar Modalidade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>