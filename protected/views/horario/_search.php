<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDHorario'); ?>
		<?php echo $form->textField($model,'CDHorario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMHorario'); ?>
		<?php echo $form->textField($model,'NMHorario'); ?>
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