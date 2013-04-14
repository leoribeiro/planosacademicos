<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('turma-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="titlePages">
		Turmas
</div>

<?php 

		$this->widget('bootstrap.widgets.TbAlert', array(
    	'block'=>true, // display a larger alert block?
    	'fade'=>true, // use transitions?
    	'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    	'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    	),
		)); 

?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Nova turma',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'', // null, 'large', 'small' or 'mini'
    'url'=>$this->createUrl('Turma/create')
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'turma-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered',
	'filter'=>$model,
	'columns'=>array(
		'CDTurma',
		'NMTurma',
		//'CDModalidade',
		array(
			'name'=>'modalidadeNMModalidade',
			'value'=>'$data->relModalidade->NMModalidade',
			'type'=>'text',
			'header'=>'Modalidade',
		),
		array(
			'name'=>'turnoNMTurno',
			'value'=>'$data->relTurno->NMTurno',
			'type'=>'text',
			'header'=>'Turno',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
