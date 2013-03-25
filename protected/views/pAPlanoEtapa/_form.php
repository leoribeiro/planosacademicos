<?php $this->widget( 'ext.EChosen.EChosen' ); ?>


	<?php echo $form->errorSummary($model); ?>
	
	<fieldset>
 
    <legend>Dados do plano</legend>
	<?php 

	if(Yii::app()->user->name == "admin"){

		$modelAux = Professor::model()->with('relServidor')->findAll(array('order'=>'relServidor.NMServidor'));
		$data = CHtml::listData($modelAux,'CDProfessor','relServidor.NMServidor');

		echo $form->dropDownListRow($model,'professor',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione uma opção')); 
	}
	else{
		$criteria = new CDbCriteria();
		$criteria->compare('Servidor_CDServidor',Yii::app()->user->CDServidor);
		$modelAux = Professor::model()->with('relServidor')->find($criteria);
		echo $form->labelEx($model,'professor');
		echo $modelAux->relServidor->NMServidor;
		echo $form->hiddenField($model,'professor',array('value'=>$modelAux->CDProfessor));
	}

	$modelAux = Turma::model()->findAll(array('order'=>'NMTurma'));
	$data = CHtml::listData($modelAux,'CDTurma','NMTurma');

	echo "<br /><br />";

	echo $form->dropDownListRow($model,'turma',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione uma opção')); 

	$modelAux = Disciplina::model()->findAll(array('order'=>'NMDisciplina'));
	$data = CHtml::listData($modelAux,'CDDisciplina','NMDisciplina');

	echo "<br /><br />";

	echo $form->dropDownListRow($model,'disciplina',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione uma opção')); 

	echo "<br /><br />";

	$ano = date("Y");

	echo $form->dropDownListRow($model,'ano',array($ano=>$ano,$ano+1=>$ano+1,'$ano+2'=>$ano+2),array('style'=>'width:90px','empty'=>'')); 

	echo "<br /><br />";

	?>
	</fieldset>

