<?php
$this->breadcrumbs=array(
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Marcações', 'url'=>array('index')),
	array('label'=>'Cadastrar Marcações', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('marcacao-prova-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Histórico de provas marcadas</h1>
<div class="buttons">
<!--
<button type="submit" class="positive">
    <img src="/examples/buttons/tick.png" alt=""/> 
    Save
</button>
-->
<a href="<? echo Yii::app()->createUrl('MarcacaoProva/create'); ?>" >
    <img src="<? echo $this->createUrl('images/add.png'); ?>" alt=""/> 
    Nova Prova
</a>
<a href="#" class="search-button" >
    <img src="<? echo $this->createUrl('images/search.png'); ?>" alt=""/> 
    Pesquisa Avançada
</a>
<br />
<br />
</div>
<?php //echo CHtml::link('Pesquisa Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
    $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']); 
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'marcacao-prova-grid',
	'dataProvider'=>$model->search('Historico'),
	'filter'=>$model,
	'columns'=>array(
		'CDMarcacao',
		array(
			'name'=>'disciplinaNMDisciplina',
			'value'=>'$data->relDisciplina->NMDisciplina',
			'type'=>'text',
			'header'=>'Disciplina',
		),
		array(
			'name'=>'turmaNMTurma',
			'value'=>'$data->relTurma->NMTurma',
			'type'=>'text',
			'header'=>'Turma',
		),
		array(
			'name'=>'provaNMProva',
			'value'=>'$data->relProva->NMProva',
			'type'=>'text',
			'header'=>'Prova',
		),
		array(
			'name'=>'professorNMProfessor',
			'value'=>'$data->relProfessor->relServidor->NMServidor',
			'type'=>'text',
			'header'=>'Professor',
		),
		array(
			'name'=>'DATA',
			'value'=>'date("d/m/Y",strtotime($data->DATA))',
			'type'=>'text',
			'header'=>'Data da prova',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
		      array(
		           'onchange'=>"$.fn.yiiGridView.update('marcacao-prova-grid',{ data:{pageSize: $(this).val() }})",
				   'style'=>' font-size: 12px; padding: 0px;margin-bottom: 0px;',
		      )),
		),
	),
)); ?>
