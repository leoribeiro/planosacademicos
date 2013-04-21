<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'professor-disciplina-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php $this->widget( 'ext.EChosen.EChosen' ); ?>


	<?php echo $form->errorSummary($model); ?>

	<?php
		$modelAux = Professor::model()->with('relServidor')->findAll(array('order'=>'relServidor.NMServidor'));
		$data = CHtml::listData($modelAux,'CDProfessor','relServidor.NMServidor');

		echo $form->dropDownListRow($model,'professor',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione um professor'));
	?>
	<br />
	<br />
	<?php echo CHtml::label('Disciplinas','disciplinas'); 
		$modelD = Disciplina::model()->
	    findAll(array('order'=>'NMDisciplina'));
	    $listaD = CHtml::listData($modelD,
		'CDDisciplina','NMDisciplina');

	    $selecionados = array();
		if(!$model->isNewRecord){
			$criteria = new CDbCriteria();
		 	$criteria->compare('id_professor',$model->id_professor);
		 	$modelP = ProfessorDisciplina::model()->findAll($criteria);
		 	foreach($modelP as $m){
		 		$selecionados[$m->id_disciplina] = array('selected'=>'selected');
		 	}
		}

		echo CHtml::activeDropDownList($model,'disciplinas',$listaD,
		array('multiple'=>'multiple',
		'data-placeholder'=>'Selecione as disciplinas',
	  	'style'=>'width:400px',
	  	'class'=>'chzn-select',
	  	'options'=>$selecionados)); 
	?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
