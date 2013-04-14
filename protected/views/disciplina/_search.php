<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDDisciplina'); ?>
		<?php echo $form->textField($model,'CDDisciplina'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMDisciplina'); ?>
		<?php echo $form->textField($model,'NMDisciplina',array('size'=>30,'maxlength'=>30)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'SGDisciplina'); ?>
		<?php echo $form->textField($model,'SGDisciplina',array('size'=>5,'maxlength'=>5)); ?>
	</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'relCoordenacao.NMCoordenacao'); ?>
			<?php 
			$lista =CHtml::listData(Coordenacao::model()->findAll(array('order'=>'NMCoordenacao')), 'NMCoordenacao', 'NMCoordenacao');
			echo CHtml::activeDropDownList($model,'coordenacaoNMCoordenacao',$lista,
				array('empty'=>'Escolha a coordenação', 'style'=>'width:250px'));
		 	?>
		</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->