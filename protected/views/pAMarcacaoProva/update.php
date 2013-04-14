<?php
$this->breadcrumbs=array(
	$model->CDMarcacao=>array('view','id'=>$model->CDMarcacao),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar marcações', 'url'=>array('index')),
	array('label'=>'Nova marcação', 'url'=>array('create')),
	array('label'=>'Visualizar Marcação', 'url'=>array('view', 'id'=>$model->CDMarcacao)),
	array('label'=>'Gerenciar Marcações', 'url'=>array('admin')),
);
?>

<h1>Editar MarcacaoProva <?php echo $model->CDMarcacao; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelProva'=>$modelProva)); ?>