<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pavar-global-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo CHtml::label('Habilitar planos?','habplanos') ?>
	<div id="gender">
	<?php echo CHtml::activeRadioButtonList($model,'value',array('Sim'=>'Sim','Não'=>'Não'),array('separator'=>'')) ?>
	</div>
	<br />

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Salvar' : 'Salvar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<style type="text/css">

           div#gender input
			{
			    float:left;
			}

           div#gender label
           {
                   float:left;
                   margin-left:2px;
                   text-align:left;
                   width:100px;
            }

</style>
