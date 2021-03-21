<?php
//Função para se trabalhar com DATAS no PHP
class workData{
	//DATA ATUAL DO SERVIDOR POR EXTENSO
	public function dataAtual(){
		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8','pt_BR.utf-8', 'portuguese');
		echo strftime('%A, %d de %B de %Y', strtotime('today'));
		
	}
	//RETORNA UM ARRAY COM A DATA POR EXTENSO 
	function DataExtenso($data){  
		//VALIDA O FORMATO DA DATA
		$data = $this->validateDate($data);
		//DIVIDE AS DATAS
		$Day 	 =  substr($data,8,2);
		$Month 	 =  substr($data,5,2);
		$Year 	 =  substr($data,0,4);
		$DayWeek =  date("w", mktime(0,0,0,$Month,$Day,$Year) );
		//CONFIGURAÇÃO DO MÊS
		switch ($Month):
			case 1:  $Month = "Janeiro"; 	break;
			case 2:  $Month = "Fevereiro";	break;
			case 3:  $Month = "Março"; 		break;
			case 4:  $Month = "Abril"; 		break;
			case 5:  $Month = "Maio"; 		break;
			case 6:  $Month = "Junho"; 		break;
			case 7:  $Month = "Julho"; 		break;
			case 8:  $Month = "Agosto"; 	break;
			case 9:  $Month = "Setembro"; 	break;
			case 10: $Month = "Outubro";  	break;
			case 11: $Month = "Novembro"; 	break;
			case 12: $Month = "Dezembro"; 	break;
		endswitch;
		//CONFIRGURAÇÃO DA SEMNANA
		switch($DayWeek): 				
			case"0": $DayWeek = "Domingo";	   		break;
			case"1": $DayWeek = "Segunda-Feira"; 	break;
			case"2": $DayWeek = "Terça-Feira";   	break;
			case"3": $DayWeek = "Quarta-Feira";  	break;
			case"4": $DayWeek = "Quinta-Feira";  	break;
			case"5": $DayWeek = "Sexta-Feira";   	break;
			case"6": $DayWeek = "Sábado";			break;
		endswitch;
	
		$Data = ['Week' => $DayWeek, 'Day' => $Day, 'Month' => $Month, 'Year' => $Year];
		return $Data;
	}
	//RETORNA UM ARRAY DA QUANTIDADE DE DIAS, MESES E ANO ENTRE DUAS DATAS
	function diferencaDatas($Datas){
		$dataStart = $this->validateDate($Datas['dtStart']);
		$dataEnd   = $this->validateDate($Datas['dtEnd']);
        //VALIDA SE A DADA INICIO E MENOR QUE A DATA FIM
        if(strtotime($dataStart) > strtotime($dataEnd)):
			$Result =  "A Data Incial deve ser menor que a Data Final";
		else:
			$Start = new DateTime($dataStart);
			$End = new DateTime($dataEnd);
			$Interval = $Start->diff( $End );
			$Result = ['Year' => $Interval->y, 'Month' => $Interval->m, 'Day' => $Interval->d];
    	endif;
    	return $Result;
	}
	//ADICIONAS DIAS UTEIS A PARTIR DE UMA DATA
	function add_dias_uteis($Data,$int_qtd_dias_somar = 7) {
		$str_data = $this->validateDate($Data);
	    $array_data = explode('-', $str_data);
	    $count_days = 0;
	    $int_qtd_dias_uteis = 0;   
	    while ( $int_qtd_dias_uteis < $int_qtd_dias_somar ):
	        $count_days++;
	            if (($dias_da_semana = gmdate('w', strtotime('+'.$count_days.' day', mktime(0, 0, 0, $array_data[1], $array_data[2], $array_data[0]))) ) != '0' && $dias_da_semana != '6'):
	            $int_qtd_dias_uteis++;
	        endif;
	    endwhile;
	    return gmdate('d/m/Y',strtotime('+'.$count_days.' day',strtotime($str_data)));
	}
	//ADDICIONA OU SUBTRAI DIAS/MESES/ANOS A PARTIR DE UMA DATA
	function add_sub_dias($Data = NULL){
		$Periodo = ($Data['Periodo'] == 'D' ? 'days' : ($Data['Periodo'] == 'M' ? 'month' :'year'));
		$Valor = $Data['Valor'];
		$Data = $this->validateDate($Data['Data']);
		$Result = date('d/m/Y', strtotime("{$Valor} {$Periodo}", strtotime($Data)));
		return $Result;
	}
	//VALIDA A DATA E RETORNO NO PADRÃO YYY-MM-DD
	function validateDate($Data){
		
		$Strdata = substr($Data,0,10);
	    if (preg_match("@/@",$Strdata) == 1):
	        $Strdata = implode("-", array_reverse(explode("/",$Strdata)));
	    else:
	    	$tmp = explode("-",$Strdata);
	    	if(strlen($tmp[0]) == 2):;
		    	$Strdata = implode("-", array_reverse(explode("-",$Strdata)));
		    endif;
	    endif;
	    
	    $dataCheck = explode("-", $Strdata);
	    
		if (!checkdate($dataCheck[1], $dataCheck[2], $dataCheck[0])):
            echo "<p>Data Informada e inválida: ".$Strdata ."</p>";
            return;
        endif;
        return $Strdata;
        
	}
}
?>