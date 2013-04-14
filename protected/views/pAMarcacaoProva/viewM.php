<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div align="center"><h4>Detalhe da avaliação: <?php echo $model->relAvaliacao->descricao; ?></h4></div>

<?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
    'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		'relDisciplina.NMDisciplina',
		array(
				'label'=>'Turma',
		        'type'=>'raw',
		        'value'=>$model->relTurma->NMTurma.' ('.$model->relTipoTurma->NMTipoTurma.')',
		),
		array(
				'label'=>'Professor',
		        'type'=>'raw',
		        'value'=>$model->relAvaliacao->getProfessor(),
		),
		array(
				'label'=>'Marcada em',
		        'type'=>'raw',
		        'value'=>@strftime('%d/%m/%Y %H:%M:%S', @strtotime($model->DataProvaMarcada)),
		),
		'relAvaliacao.descricao',
		'relAvaliacao.valor',
		'conteudo',
		array(
				'label'=>'Data',
		        'type'=>'raw',
		        'value'=>@strftime('%d/%m/%Y', @strtotime($model->data)),
		),
		'relHorarioInicio.NMHorario',
		'relHorarioFim.NMHorario',



	),
)); 
?>