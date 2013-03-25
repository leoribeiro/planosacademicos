<div id="titlePages">
		Planos de etapa
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
    'label'=>'Novo Plano de etapa',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'', // null, 'large', 'small' or 'mini'
    'url'=>$this->createUrl('pAPlanoEtapa/create')
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'paplano-etapa-grid',
    'type'=>'striped bordered',
	'dataProvider'=>$model->search('prof'),
	//'filter'=>$model,
    'enableSorting' => false,
	'columns'=>array(
		array(
            'name' => 'relDisciplina.NMDisciplina',
            'value' => '$data->relDisciplina->NMDisciplina',
            'header' => 'Disciplina',
        ),
        array(
            'name' => 'relProfessor.relServidor.NMServidor',
            'value' => '$data->relProfessor->relServidor->NMServidor',
            'header' => 'Professor',
        ),
		'relTurma.NMTurma',
		'ano',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
