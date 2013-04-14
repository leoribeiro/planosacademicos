<?php
$this->breadcrumbs=array(
	'Disciplinas'=>array('index'),
	$model->CDDisciplina,
);

$this->menu=array(
	array('label'=>'Listar disciplina', 'url'=>array('index')),
	array('label'=>'Cadastrar disciplina', 'url'=>array('create')),
	array('label'=>'Editar disciplina', 'url'=>array('update', 'id'=>$model->CDDisciplina)),
	array('label'=>'Deletar disciplina', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDDisciplina),'confirm'=>'Tem certeza que deseja excluir este item?')),
	array('label'=>'Gerenciar disciplina', 'url'=>array('admin')),
);
?>

<h1>Disciplina - ID <?php echo $model->CDDisciplina; ?></h1>
<div class="buttons">
<a href="<? echo Yii::app()->createUrl('Disciplina/create'); ?>" >
    <img src="<? echo $this->createUrl('images/add.png'); ?>" alt="Nova Disciplina"/> 
    Nova Disciplina
</a>
<a href="<? echo Yii::app()->createUrl('Disciplina/admin'); ?>" class="search-button" >
    <img src="<? echo $this->createUrl('images/c.png'); ?>" alt="Consultar Disciplinas"/> 
    Consultar Disciplinas
</a>
</div>
<br />
<br />
<br />
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDDisciplina',
		'NMDisciplina',
		'relCoordenacao.NMCoordenacao'
	),
)); ?>
