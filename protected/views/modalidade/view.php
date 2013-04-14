<?php
$this->breadcrumbs=array(
	'Modalidades'=>array('index'),
	$model->CDModalidade,
);

$this->menu=array(
	array('label'=>'Listar Modalidade', 'url'=>array('index')),
	array('label'=>'Cadastrar Modalidade', 'url'=>array('create')),
	array('label'=>'Editar Modalidade', 'url'=>array('update', 'id'=>$model->CDModalidade)),
	array('label'=>'Deletar Modalidade', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDModalidade),'confirm'=>'Tem certeza que deseja excluir este item?')),
	array('label'=>'Gerenciar Modalidade', 'url'=>array('admin')),
);
?>

<h1>Modalidade - ID <?php echo $model->CDModalidade; ?></h1>
<div class="buttons">
<a href="<? echo Yii::app()->createUrl('Modalidade/create'); ?>" >
    <img src="<? echo $this->createUrl('images/add.png'); ?>" alt="Nova Modalidade"/> 
    Nova Modalidade
</a>
<a href="<? echo Yii::app()->createUrl('Modalidade/admin'); ?>" class="search-button" >
    <img src="<? echo $this->createUrl('images/c.png'); ?>" alt="Consultar Modalidade"/> 
    Consultar Modalidade
</a>
</div>
<br />
<br />
<br />
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDModalidade',
		'NMModalidade',
	),
)); ?>
