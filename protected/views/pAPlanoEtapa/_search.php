<?php $this->widget( 'ext.EChosen.EChosen' ); ?>
<form id="pe">
<?php 

	echo "<table><tr><td>";

	$modelAux = Disciplina::model()->findAll(array('order'=>'NMDisciplina'));
	$data = CHtml::listData($modelAux,'CDDisciplina','NMDisciplina');


	echo CHtml::activeDropDownList($model,'disciplina',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione uma disciplina','onchange'=>'atualizaGrid()'));

	echo "</td><td>";

	$modelAux = Turma::model()->findAll(array('order'=>'NMTurma'));
	$data = CHtml::listData($modelAux,'CDTurma','NMTurma');

	echo CHtml::activeDropDownList($model,'turma',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione uma turma','onchange'=>'atualizaGrid()')); 

	echo "</td><td>";

	$modelAux = Professor::model()->with('relServidor')->findAll(array('order'=>'relServidor.NMServidor'));
	$data = CHtml::listData($modelAux,'CDProfessor','relServidor.NMServidor');

	echo CHtml::activeDropDownList($model,'professor',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione um professor','onchange'=>'atualizaGrid()')); 

	echo "</td><td>";

	$modelAux = PAPlanoEtapa::model()->findAll(array(
    'select'=>'ano',
    'distinct'=>true,
    'order'=>'ano',
	));

	$anos = array();
	foreach($modelAux as $a){
		$anos[$a->ano] = $a->ano;
	}

	echo CHtml::activeDropDownList($model,'ano',$anos,array('class'=>'chzn-select','style'=>'width:120px;','empty'=>'Ano','onchange'=>'atualizaGrid()')); 

	echo "</td></tr></table>";
?>
</form>