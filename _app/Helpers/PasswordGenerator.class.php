<?php

	/*
	PassWord Generator
	 */

	class PassWordGenerator {

		public    $password;
		public    $mode;
		public    $count;
		public    $letters = "abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		public    $numbers = "1234567890";
		public    $signs   = "@!¡¿?/&%$#+[]";

		/*
		Mode "Normal" return only letters
		Mode "Medium" return letters and numbers
		Mode "High"  letters numbers and signs

		Level "Slow" return only caracteres
		Level "high" return base64Encode
		 */


		public function __construct($mode = "Normal", $level = "slow", $count = 8){
            $this->mode  = $mode;
			$this->level = $level;
			$this->count = $count;
            $this->prepare();
		}

		private function prepare(){
			if($this->mode == 'Normal'){
				$pass = substr(str_shuffle($this->letters), 0, $this->count);
			} else if($this->mode == 'Medium'){
				$cantLetters = ceil($this->count / 2);
				$cantNumbers = $this->count - $cantLetters;
				$letters = substr(str_shuffle($this->letters), 0, $cantLetters);
				$numbers = substr(str_shuffle($this->numbers), 0, $cantNumbers);
				$p = $letters.$numbers;
				$pass = str_shuffle($p);
			} else if($this->mode == 'High'){
				$num = ceil($this->count /3);
				$letters = substr(str_shuffle($this->letters), 0, $num);
				$numbers = substr(str_shuffle($this->numbers), 0, $num);
				$signs   = substr(str_shuffle($this->signs), 0, $num);
				$pass = substr(str_shuffle($letters.$numbers.$signs), 0, $this->count);
			}

			if($this->level == "Slow"){
				$this->password = $pass;
			} else {
				$this->password = base64_encode($pass);
			}
			return;
		}




	} //END CLASS


 ?>