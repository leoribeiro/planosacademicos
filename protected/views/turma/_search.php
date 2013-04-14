<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDTurma'); ?>
		<?php echo $form->textField($model,'CDTurma'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMTurma'); ?>
		<?php echo $form->textField($model,'NMTurma',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'relModalidade.NMModalidade'); ?>
		<?php 
		$lista =CHtml::listData(Modalidade::model()->findAll(), 'NMModalidade', 'NMModalidade');
		echo CHtml::activeDropDownList($model,'modalidadeNMModalidade',$lista,
			array('empty'=>'Escolha a modalidade', 'style'=>'width:150px'));
	 	?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'relTurno.NMTurno'); ?>
		<?php 
		$lista =CHtml::listData(Turno::model()->findAll(), 'NMTurno', 'NMTurno');
		echo CHtml::activeDropDownList($model,'turnoNMTurno',$lista,
			array('empty'=>'Escolha o turno', 'style'=>'width:150px'));
	 	?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->