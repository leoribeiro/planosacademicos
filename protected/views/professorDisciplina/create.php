<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js"></script>

<div id="titlePages">
		Relacionar professor a disciplinas
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model,'dados'=>$dados)); ?>