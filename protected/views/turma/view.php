<?php
$this->breadcrumbs=array(
	'Turmas'=>array('index'),
	$model->CDTurma,
);

$this->menu=array(
	array('label'=>'Listar Turma', 'url'=>array('index')),
	array('label'=>'Cadastrar Turma', 'url'=>array('create')),
	array('label'=>'Editar Turma', 'url'=>array('update', 'id'=>$model->CDTurma)),
	array('label'=>'Deletar Turma', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDTurma),'confirm'=>'Tem certeza que deseja excluir este item?')),
	array('label'=>'Gerenciar Turma', 'url'=>array('admin')),
);
?>

<h1>Turma - ID <?php echo $model->CDTurma; ?></h1>
<div class="buttons">
<a href="<? echo Yii::app()->createUrl('Turma/create'); ?>" >
    <img src="<? echo $this->createUrl('images/add.png'); ?>" alt="Nova Turma"/> 
    Nova Turma
</a>
<a href="<? echo Yii::app()->createUrl('Turma/admin'); ?>" class="search-button" >
    <img src="<? echo $this->createUrl('images/c.png'); ?>" alt="Consultar Turmas"/> 
    Consultar Turmas
</a>
</div>
<br />
<br />
<br />
<?php 
    $disciplinas = array();
    foreach($model->relTurmaDisciplina as $disc){
		$disciplinas[] =$disc->NMDisciplina;
	}
	
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDTurma',
		'NMTurma',
		'relModalidade.NMModalidade',
		'relTurno.NMTurno',
		array(
			'label'=>'Disciplinas',
			'value'=>implode(', ',$disciplinas),
			'filter'=>false,
		),
	),
)); ?>
