<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js"></script>

<div id="titlePages">
		Editar plano de etapa
</div>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'planoForm',
	//'type'=>'inline',
    'htmlOptions'=>array('class'=>'well'),
	//'enableAjaxValidation'=>false,
)); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form)); ?>

<?php echo $this->renderPartial('_formPlanoAula', array('model'=>$model,'aulas'=>$aulas,'avs'=>$avs)); ?>

<?php echo $this->renderPartial('_formSave', array('model'=>$model,'form'=>$form)); ?>

<?php $this->endWidget(); ?>