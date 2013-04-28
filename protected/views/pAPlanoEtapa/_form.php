<?php $this->widget( 'ext.EChosen.EChosen' ); ?>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>

    <legend>Dados do plano</legend>
	<?php
	if(Yii::app()->user->name == "admin"){

		$modelAux = Professor::model()->with('relServidor')->findAll(array('order'=>'relServidor.NMServidor'));
		$data = CHtml::listData($modelAux,'CDProfessor','relServidor.NMServidor');

		echo $form->dropDownListRow($model,'professor',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione um professor'));

		$modelAux = Turma::model()->findAll(array('order'=>'NMTurma'));
		$data = CHtml::listData($modelAux,'CDTurma','NMTurma');

		echo "<br /><br />";

		echo $form->dropDownListRow($model,'turma',$data,array(
			'class'=>'chzn-select',
			'style'=>'width:300px',
			'empty'=>'Selecione uma turma',
			'ajax' => array(
				'type'=>'POST', //request type
				'dataType'=>'html',
				'url'=>CController::createUrl('atualizaDisciplinas'),
				'success'=>'js:function(data){upDisciplinas(data)}',
				'data'=>'js:$("#planoForm").serialize()',
				),

		));

		$modelAux = Disciplina::model()->findAll(array('order'=>'NMDisciplina'));
		$data = CHtml::listData($modelAux,'CDDisciplina','NMDisciplina');

		echo "<br /><br />";

		echo $form->dropDownListRow($model,'disciplina',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione uma disciplina'));

	}
	else{
		$criteria = new CDbCriteria();
		$criteria->compare('Servidor_CDServidor',Yii::app()->user->CDServidor);
		$modelAux = Professor::model()->with('relServidor')->find($criteria);
		echo $form->labelEx($model,'professor');
		echo $modelAux->relServidor->NMServidor;
		echo $form->hiddenField($model,'professor',array('value'=>$modelAux->CDProfessor));

		// listar apenas disciplinas do professor
		$criteria = new CDbCriteria;
		$criteria->with = array('relTurma','relDisciplina');
		$criteria->compare('id_professor',$modelAux->CDProfessor);
		$modelP = ProfessorDisciplina::model()->findAll($criteria);
		$data = array();
		$valueT = "";
		foreach($modelP as $m){
			$d = $m->relDisciplina->CDDisciplina;
			$t = $m->relTurma->CDTurma;
			$data[$d."-".$t] = $m->relDisciplina->NMDisciplina." (".$m->relTurma->NMTurma.")";
			if($d == $model->disciplina && $t == $model->turma){
				$valueT = $d."-".$t;
			}
		}
		echo "<br /><br />";

		echo $form->dropDownListRow($model,'disciplina',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione uma disciplina','options' => array($valueT=>array('selected'=>true))));
	}

	echo "<br /><br />";

	$ano = date("Y");

	echo $form->dropDownListRow($model,'ano',array($ano=>$ano,$ano+1=>$ano+1,'$ano+2'=>$ano+2),array('style'=>'width:90px','empty'=>''));

	echo "<br /><br />";

	?>
	</fieldset>

	<script type="text/javascript">
		function upDisciplinas(resultado){
			$("#PAPlanoEtapa_disciplina").html(resultado);
			$("#PAPlanoEtapa_disciplina").trigger("liszt:updated");
			$("#PAPlanoEtapa_disciplina").chosen();
		}
	</script>


