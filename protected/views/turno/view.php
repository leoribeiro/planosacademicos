<?php
$this->breadcrumbs=array(
	'Turnos'=>array('index'),
	$model->CDTurno,
);

$this->menu=array(
	array('label'=>'Listar Turno', 'url'=>array('index')),
	array('label'=>'Cadastrar Turno', 'url'=>array('create')),
	array('label'=>'Editar Turno', 'url'=>array('update', 'id'=>$model->CDTurno)),
	array('label'=>'Deletar Turno', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDTurno),'confirm'=>'Tem certeza que deseja excluir este item?')),
	array('label'=>'Gerenciar Turno', 'url'=>array('admin')),
);
?>

<h1>Turno - ID <?php echo $model->CDTurno; ?></h1>

<div class="buttons">
<a href="<? echo Yii::app()->createUrl('Turno/create'); ?>" >
    <img src="<? echo $this->createUrl('images/add.png'); ?>" alt="Novo Turno"/> 
    Novo Turno
</a>
<a href="<? echo Yii::app()->createUrl('Turno/admin'); ?>" class="search-button" >
    <img src="<? echo $this->createUrl('images/c.png'); ?>" alt="Consultar Turnos"/> 
    Consultar Turnos
</a>
</div>
<br />
<br />
<br />
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDTurno',
		'NMTurno',
	),
)); ?>
