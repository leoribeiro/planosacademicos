<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('disciplina-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="titlePages">
		Disciplinas
</div>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Nova disciplina',
    'type'=>'primary',
    'size'=>'',
    'url'=>$this->createUrl('Disciplina/create')
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'disciplina-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>'striped bordered',
	'columns'=>array(
		'CDDisciplina',
		'NMDisciplina',
		'SGDisciplina',
	array(
		'name'=>'coordenacaoNMCoordenacao',
		'value'=>'$data->relCoordenacao->NMCoordenacao',
		'type'=>'text',
		'header'=>'Coordenação',
	),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
