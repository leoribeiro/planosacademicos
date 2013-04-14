<div id="titlePages">
		Avaliações marcadas
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
<?php
/* @var $this PAAvaliacaoController */
/* @var $model PAAvaliacao */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#paavaliacao-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'paavaliacao-grid',
	'dataProvider'=>$model->search("marcadas"),
	'filter'=>$model,
	'enableSorting'=>false,
	'type'=>'striped bordered',
	'columns'=>array(
		'descricao',
		array(
			'name'=>'turma',
			'value'=>'$data->getTurma()',
			'type'=>'text',
			'header'=>'Turma',
		),
		array(
			'name'=>'disciplina',
			'value'=>'$data->getDisciplina()',
			'type'=>'text',
			'header'=>'Disciplina',
		),
		array(
			'name'=>'data',
			'value'=>'$data->getData()',
			'type'=>'text',
			'header'=>'Data da avaliação',
		),
		array(
			'name'=>'bimestre',
			'value'=>'$data->getBimestre()',
			'type'=>'text',
			'header'=>'Bimestre',
			'htmlOptions' => array(
                'style'=>'width:20px;',
            ),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update}',
			'buttons' => array(
				'view' => array(
				            'label'=>'Visualizar avaliação',
							'url'=> 'Yii::app()->createUrl("PAMarcacaoProva/view", array("id" => $data->id))',
				),
				'update' => array(
				            'label'=>'Editar marcação de avaliação',
							'url'=> 'Yii::app()->createUrl("PAMarcacaoProva/update", array("id" => $data->id))',
				),
				),
		),
	),
)); ?>