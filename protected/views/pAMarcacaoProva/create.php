<div id="titlePages">
		Marcar avaliação prevista
</div>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'marcacaoprova-form',
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $this->renderPartial('_dadosPlano', array('model'=>$modelP)); ?>

<?php echo $this->renderPartial('_dadosAvaliacao', array('modelT'=>$model,'model'=>$modelAv,'form'=>$form)); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelP'=>$modelP,'form'=>$form)); ?>

<?php $this->endWidget(); ?>