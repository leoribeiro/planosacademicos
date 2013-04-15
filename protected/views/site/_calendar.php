
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'juiDialog',
                'options'=>array(
                    'title'=>'Detalhes da avaliação',
                    'autoOpen'=>false,
                    'modal'=>true,
                    'width'=>600,
                    'height'=>450,
                ),
                ));
$this->endWidget();
?>
<?php
// Use the PHP time() function to find out the timestamp for the current time
$current_time = time();

// Get the first day of the month
$month_start = mktime(0,0,0,$month, 1, $year); 

// Get the name of the month
$month_name = date('n', $month_start); 
$mes=array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
$month_name =  $mes[$month_name];

// Figure out which day of the week the month starts on.
$first_day = date('D', $month_start);

// Assign an offset to decide which number of day of the week the month starts on.
switch($first_day)
{
case "Sun":
	$offset = 0;
	break;
case "Mon":
	$offset = 1;
	break;
case "Tue":
	$offset = 2;
	break;
case "Wed":
	$offset = 3;
	break;
case "Thu":
	$offset = 4;
	break;
case "Fri":
	$offset = 5;
	break;
case "Sat":
	$offset = 6;
	break;
}

// determine how many days were in last month.
//	Note: The cal_days_in_month() function returns the number of days in a month for the specified year and calendar.
//  Gregorian Calendar: http://en.wikipedia.org/wiki/Gregorian_calendar
//  Define this using the constant: CAL_GREGORIAN
if($month == 1)
	$num_days_last = cal_days_in_month(CAL_GREGORIAN, 12, ($year -1));
else
	$num_days_last = cal_days_in_month(CAL_GREGORIAN, ($month - 1), $year);

// determine how many days are in the this month.
$num_days_current = cal_days_in_month(CAL_GREGORIAN, $month, $year); 

// Count through the days of the current month -- building an array
for($i = 0; $i < $num_days_current; $i++)
{
	$num_days_array[] = $i+1;
} 

// Count through the days of last month -- building an array
for($i = 0; $i < $num_days_last; $i++)
{
	$num_days_last_array[] = '';
}

if($offset > 0){
	$offset_correction = array_slice($num_days_last_array, -$offset, $offset);
	$new_count = array_merge($offset_correction, $num_days_array);
	$offset_count = count($offset_correction);
}
else
{
	$new_count = $num_days_array;
}

// How many days do we now have?
$current_num = count($new_count);

// Our display is to be 35 cells so if we have less than that we need to dip into next month
if($current_num > 35)
{
	$num_weeks = 6;
	$outset = (42 - $current_num);
}
else if($current_num < 35)
{
	$num_weeks = 5;
	$outset = (35 - $current_num);
}
if($current_num == 35)
{
	$num_weeks = 5;
	$outset = 0;
}

// Outset Correction
for($i = 1; $i <= $outset; $i++)
{
	$new_count[] = '';
}

// Now let's "chunk" the $new_count array
// into weeks. Each week has 7 days
// so we will array_chunk it into 7 days.
$weeks = array_chunk($new_count, 7);

$last_month = $month == 1 ? 12 : $month - 1;
$next_month = $month == 12 ? 1 : $month + 1;
?>

<?php

$modelTurma = Turma::model()->findByPk($turma);

?>
<div id="calendar_wrapper" align="center">
<div id="titlePages">
		Calendário
</div>
<div align="left">
	Turma: 
<?php
	$modelAux = Turma::model()->findAll(array('order'=>'NMTurma'));
	$data = CHtml::listData($modelAux,'CDTurma','NMTurma');

	echo CHtml::dropDownList('turma',$turma,$data,array(
		'style'=>'width:200px',
		//'empty'=>'Selecione uma turma',
		'ajax' => array(
			'type'=>'POST', //request type
			//'dataType'=>'html',
			'url'=>CController::createUrl('calendar',array('partial'=>true)),
			'update'=>'#calendar_wrapper',
			'data'=>'js:{\'CDTurma\': $(this).val()}',
			),
		'id' => 'send-link-'.uniqid(),

	));
?>
</div>
<br />
 <table id="calendar" class="table table-bordered table-striped">
 <tr><td><div align="center" >
 <?php
 	echo CHtml::ajaxLink('&laquo; Anterior',CController::createUrl('calendar',array('partial'=>true)),
	  array(
	    'type' => 'POST',
		'data' => array('ControleAntProx' => '1'),
	    'update'=>'#calendar_wrapper',
	  ),
	  array(
	  	'id' => 'send-link-'.uniqid(),
	  )
 );
?>
 </div></td><td colspan=5 class="month">
 <div align="center"><strong><?php echo $modelTurma->NMTurma; ?></strong></div>
 </td><td><div align="center" >
 <?php echo CHtml::ajaxLink('Próximo &raquo;',CController::createUrl('calendar',array('partial'=>true)),
	  array(
	    'type' => 'POST',
		'data' => array('ControleAntProx' => '2'),
	    'update'=>'#calendar_wrapper',
	  ),
	  array(
	  	'id' => 'send-link-'.uniqid(),
	  )
	);
 ?>
 </div></td></tr>
 <tr>
 	<td colspan=7>
 		<div align="center"><b><?php echo $month_name." ".$year; ?></b></div>
 	</td>
 </tr>
 <tr class="daynames">
 			<td>Domingo</td><td>Segunda</td><td>Terça</td>
 			<td>Quarta</td><td>Quinta</td><td>Sexta</td><td>Sábado</td>
</tr>
<?php
$tabela = "";
foreach($weeks as $week){
	$tabela .= '<tr class="week">';
	foreach($week as $day)
	{
		$datacelula = $year."-".$month."-".$day;
		$lista = PAMarcacaoProva::model()->with(array('relTipoTurma','relDisciplina'))
		->findAll(array('select'=>'CDMarcacao,data,CDTipoTurma',
		    'condition'=>'data=:DATADEHOJE AND CDTurma=:TURMADIA',
		    'params'=>array(':DATADEHOJE'=>$datacelula,':TURMADIA'=>$turma),
		));
		// verificar turmas para as cores
		$turmaCheia = 0;
		$turmaT = 0;
		foreach($lista as $registro){
			$tipoturma = $registro->relTipoTurma->CDTipoTurma;
			if($tipoturma == 1){
				$turmaCheia++;
			}
			else if(($tipoturma == 2) or ($tipoturma == 3)){
				$turmaT++;
			}
		}

		// Celula para dia atual
		if($day == date('d', $current_time) && $month == date('m', $current_time) && $year == date('Y', $current_time)){
		$tabela.= '<td class="today">'.$day.'<br>';
		if(!is_null($lista)){
					$tabela.= '<ul>';
					foreach($lista as $registro){
						$disc = $registro->relDisciplina->SGDisciplina;
						$tipoturma = $registro->relTipoTurma->CDTipoTurma;
						if($tipoturma != 1){
							$tipoturma = ' ('.$registro->relTipoTurma->NMTipoTurma.')';
						}
						else {
							$tipoturma = '';
						}
					    if(strlen($disc) > 13){
						   $disc = substr_replace($disc, '...', 13);
					    }
						$tabela.= '<li>';
						$tabela.= CHtml::ajaxLink($disc.$tipoturma,
					        $this->createUrl('PAMarcacaoProva/viewM',array('id'=>$registro->CDMarcacao)),
						        array(
						        	//'dataType'=>'html',
						            'success'=>'function(r){$("#juiDialog").html(r).dialog({ width: 600, heigth: 450 }).dialog("open"); return false;}'
						        ),
						        array('id' => 'link-'.uniqid(),'title'=>CHtml::encode($registro->relDisciplina->NMDisciplina))
						);
					}
					$tabela.= '</ul>';
		}
		$tabela.= '</td>';
		}
		// Célula para outros dias
		else{
			if(($turmaCheia == 2) or ($turmaT == 4) or ($turmaT == 3) or 
			(($turmaCheia == 1) and ($turmaT == 2))){
				$tabela.= '<td style="width: 14%" class="dayf">'.$day.'<br>';
			}
			else if(($turmaCheia == 1) or ($turmaT == 2) or ($turmaT == 1)){
				$tabela.= '<td style="width: 14%" class="dayd">'.$day.'<br>';
			}
			else{
				$tabela.= '<td style="width: 14%" class="days">'.$day.'<br>';
			}

			
			if(!is_null($lista)){
					$tabela.= '<ul>';
					foreach($lista as $registro){
						    $disc = $registro->relDisciplina->SGDisciplina;
							$tipoturma = $registro->relTipoTurma->CDTipoTurma;
							if($tipoturma != 1){
								$tipoturma = ' ('.$registro->relTipoTurma->NMTipoTurma.')';
							}
							else {
								$tipoturma = '';
							}
						    if(strlen($disc) > 13){
							   $disc = substr_replace($disc, '...', 13);
						    }
							$tabela.= '<li>';
					    	$tabela.= CHtml::ajaxLink($disc.$tipoturma,
					        $this->createUrl('PAMarcacaoProva/viewM',array('id'=>$registro->CDMarcacao)),
						        array(
						        	//'dataType'=>'html',
						            'success'=>'function(r){$("#juiDialog").html(r).dialog({ width: 600, heigth: 450 }).dialog("open"); return false;}'
						        ),
						        array('id' => 'link-'.uniqid(),'title'=>CHtml::encode($registro->relDisciplina->NMDisciplina))
							);
							$tabela.= '</li>';
					}
					$tabela.= '</ul>';


			}
			$tabela.= '</td>';
		}

	}
	$tabela.= '</tr>';
}
echo $tabela;
?>

</table>
<table><tr><td  bgcolor=#3F5D7D width=5 height=5 align=left>&nbsp;</td>
	<td align=left width=80> = Hoje.</td>
	<td  bgcolor=#FF9900 width=5 height=5 align=left>&nbsp;</td>
	<td align=left width=110> = Dia de prova.</td>
	<td  bgcolor=#990000 width=5 height=5 align=left>&nbsp;</td>
	<td align=left> = Dia com duas provas.</td></tr>
</table>
<?php
	Yii::app()->session['monthCal'] = $month;
	Yii::app()->session['yearCal'] = $year;
	Yii::app()->session['turmaCal'] = $turma;
?>
</div>