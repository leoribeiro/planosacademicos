<div id="titlePages">
		Professores e suas disciplinas
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
    'label'=>'Relacionar professor a disciplinas',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'', // null, 'large', 'small' or 'mini'
    'url'=>$this->createUrl('ProfessorDisciplina/create')
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'professor-disciplina-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'professor',
		array(
			'name'=>'disciplinas',
			'value'=>'$data->getDisciplinas()',
			'type'=>'text',
			'header'=>'Turma',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
