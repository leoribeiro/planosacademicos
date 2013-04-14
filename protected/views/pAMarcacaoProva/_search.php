<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'relDisciplina.NMDisciplina'); ?>
		<?php 
		$lista =CHtml::listData(Disciplina::model()->findAll(array('order'=>'NMDisciplina')), 'NMDisciplina', 'NMDisciplina');
		echo CHtml::activeDropDownList($model,'disciplinaNMDisciplina',$lista,
			array('empty'=>'Escolha a disciplina', 'style'=>'width:250px'));
	 	?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'relTurma.NMTurma'); ?>
		<?php 
		$lista =CHtml::listData(Turma::model()->findAll(array('order'=>'NMTurma')), 'NMTurma', 'NMTurma');
		echo CHtml::activeDropDownList($model,'turmaNMTurma',$lista,
			array('empty'=>'Escolha a Turma', 'style'=>'width:250px'));
	 	?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'relServidor.NMServidor'); ?>
		<?php 
		$criteria = new CDbCriteria;
		$criteria->with = array('relServidor');
		$criteria->together = true;
		$criteria->order = 'relServidor.NMServidor';
		$modelProfessor = Professor::model()->findAll($criteria);
		$lista = CHtml::listData($modelProfessor,'relServidor.NMServidor', 'relServidor.NMServidor');
		echo CHtml::activeDropDownList($model,'professorNMProfessor',$lista,
			array('empty'=>'Escolha o professor', 'style'=>'width:250px'));
	 	?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->