<?php
$this->breadcrumbs=array(
	'Horarios'=>array('index'),
	$model->CDHorario,
);

$this->menu=array(
	array('label'=>'Listar Horário', 'url'=>array('index')),
	array('label'=>'Cadastrar Horário', 'url'=>array('create')),
	array('label'=>'Editar Horário', 'url'=>array('update', 'id'=>$model->CDHorario)),
	array('label'=>'Deletar Horário', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDHorario),'confirm'=>'Tem certeza que deseja excluir este item?')),
	array('label'=>'Gerenciar Horário', 'url'=>array('admin')),
);
?>

<h1>Horario - ID <?php echo $model->CDHorario; ?></h1>
<div class="buttons">
<a href="<? echo Yii::app()->createUrl('Horario/create'); ?>" >
    <img src="<? echo $this->createUrl('images/add.png'); ?>" alt="Novo Horário"/> 
    Novo Horário
</a>
<a href="<? echo Yii::app()->createUrl('Horario/admin'); ?>" class="search-button" >
    <img src="<? echo $this->createUrl('images/c.png'); ?>" alt="Consultar Horários"/> 
    Consultar Horários
</a>
</div>
<br />
<br />
<br />
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDHorario',
		'NMHorario',
		'relTurno.NMTurno',
	),
)); ?>
