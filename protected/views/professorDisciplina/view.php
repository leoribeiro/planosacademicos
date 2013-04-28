<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js"></script>

<div id="titlePages">
		Professor e suas disciplinas
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model,'dados'=>$dados,'viewT'=>true)); ?>
