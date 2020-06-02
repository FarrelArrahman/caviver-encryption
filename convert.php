<?php
	session_start();
	
	// Variable Declaration
	$key = "";
	$plain = "";
	$method = "";
	$encOrDec = "";
	$result = "";

	// characterToDecimal(): Fungsi ini digunakan untuk mengubah karakter huruf menjadi bilangan desimal
	function characterToDecimal($c){
		$i = ord($c);
		if ($i >= 97 && $i <= 122){
			return ($i - 96);
		} else if ($i >= 65 && $i <= 90){
			return ($i - 38);
		} else {
			return null;
		}
	}


	// decimalToCharacter(): fungsi ini digunakan untuk mengubah bilangan desimal menjadi karakter huruf
	function decimalToCharacter($d){
		if ($d >= 1 && $d <= 26){
			return (chr($d + 96));
		} else if ($d >= 27 && $d <= 52){
			return (chr($d + 38));
		} else {
			return null;
		}
	}

	function vigenereEncrypt($a, $b){
		$i = $a + $b - 1;
		if ($i > 26){
			$i = $i - 26;
		}
		return (decimalToCharacter($i));
	}

	function vigenereDecrypt($a, $b){
		$i = $a - $b + 1;
		if ($i < 1){
			$i = $i + 26;
		}
		return (decimalToCharacter($i));
	}

	function charToBinary($c){
		return sprintf("%08d", decbin(ord($c)));
	}

	function vernamEncrypt($a, $b){
		return charToBinary($a ^ $b);
	}

	function vernamDecrypt($a, $b){
		$char = chr(bindec($b));
		return chr(bindec(charToBinary($a ^ $char)));
	}

	// Caesar Encrypt Handler
	if(isset($_POST['caesar_encrypt'])){
		$method = "Caesar";
		$encOrDec = "enkripsi";

		$key = $_POST['caesar_key'];
		$plain = $_POST['caesar_plaintext'];

		$_SESSION['key'] = $key;
		$_SESSION['plain'] = $plain;

		$key_split = str_split($key);
		$char_split = str_split($plain);

		$split_num = [];

		$i = 0;

		while($key > 52){
			$key -= 52;
		}

		// echo $key;

		foreach($char_split as $char){
			if(characterToDecimal($char) != null){
				$split_num[$i] = characterToDecimal($char);
			} else {
				$split_num[$i] = $char;
			}
			$i++;
		}

		foreach($split_num as $num) {
			if(($num + $key) > 52){
				if(decimalToCharacter($num) != null){
					$result .= decimalToCharacter(($num + $key) - 52);
				} else {
					$result .= $num;
				}
			} else {
				if(decimalToCharacter($num) != null){
					$result .= decimalToCharacter($num + $key);
				} else {
					$result .= $num;
				}
			}
		}

	} else if(isset($_POST['caesar_decrypt'])){
		$method = "Caesar";
		$encOrDec = "dekripsi";

		$key = $_POST['caesar_key'];
		$plain = $_POST['caesar_plaintext'];

		$_SESSION['key'] = $key;
		$_SESSION['plain'] = $plain;

		$key_split = str_split($key);
		$plain_split = str_split($plain);

		$split_num = [];

		$i = 0;

		while($key > 52){
			$key -= 52;
		}

		// echo $key;

		foreach($plain_split as $char){
			if(characterToDecimal($char) != null){
				$split_num[$i] = characterToDecimal($char);
			} else {
				$split_num[$i] = $char;
			}
			$i++;
		}

		foreach($split_num as $num) {
			if(($num + $key) < 1){
				if(decimalToCharacter($num) != null){
					$result .= decimalToCharacter(($num - $key) + 52);
				} else {
					$result .= $num;
				}
			} else {
				if(decimalToCharacter($num) != null){
					$result .= decimalToCharacter($num - $key);
				} else {
					$result .= $num;
				}
			}
		}
	} else if(isset($_POST['vigenere_encrypt'])){
		$method = "Vigenere";
		$encOrDec = "enkripsi";

		$key = $_POST['vigenere_key'];
		$plain = $_POST['vigenere_plaintext'];

		$_SESSION['key'] = $key;
		$_SESSION['plain'] = $plain;

		$key_length = strlen($key);
		$plain_length = strlen($plain);
		$key_split = str_split($key);
		$key_split2 = [];
		$plain_split = str_split($plain);

		$i = 0;

		for($j = 0; $j < $plain_length; $j++){
            if ($i == $key_length){
                $i = 0;
            }
            
            $key_split2[$j] = $key_split[$i];
            $i++;
        }

        for($k = 0; $k < $plain_length; $k++){
            $a = characterToDecimal($key_split2[$k]);
            $b = characterToDecimal($plain_split[$k]);
            if (($a && $b) != null){
                $result .= vigenereEncrypt($a, $b);
            } else {
                $result .= $plain_split[$k];
            }
        }
	} else if($_POST['vigenere_decrypt']){
		$method = "Vigenere";
		$encOrDec = "enkripsi";

		$key = $_POST['vigenere_key'];
		$plain = $_POST['vigenere_plaintext'];

		$_SESSION['key'] = $key;
		$_SESSION['plain'] = $plain;

		$key_length = strlen($key);
		$plain_length = strlen($plain);
		$key_split = str_split($key);
		$key_split2 = [];
		$plain_split = str_split($plain);

		$i = 0;

		for($j = 0; $j < $plain_length; $j++){
            if ($i == $key_length){
                $i = 0;
            }
            
            $key_split2[$j] = $key_split[$i];
            $i++;
        }

        for($k = 0; $k < $plain_length; $k++){
            $a = characterToDecimal($key_split2[$k]);
            $b = characterToDecimal($plain_split[$k]);
            if (($a && $b) != null){
                $result .= vigenereDecrypt($b, $a);
            } else {
                $result .= $plain_split[$k];
            }
        }
	} else if($_POST['vernam_encrypt']){
		$method = "Vernam";
		$encOrDec = "enkripsi";

		$key = $_POST['vernam_key'];
		$plain = $_POST['vernam_plaintext'];
		$delimiter = $_POST['vernam_delimiter'];

		$key_length = strlen($key);
		$plain_length = strlen($plain);
		$key_split = str_split($key);
		$plain_split = str_split($plain);


		$i = 0;

		for($j = 0; $j < $plain_length; $j++){
			if($i == $key_length){
				$i = 0;
			}

			$key_split2[$j] = $key_split[$i];
			$i++;
		}

		for($k = 0; $k < $plain_length; $k++){
			$a = $key_split2[$k];
			$b = $plain_split[$k];

			if(($a && $b) != null){
				$result .= vernamEncrypt($a, $b);
				if($k < $plain_length - 1) $result .= $delimiter;
			} else {
				$result .= $plain_split[$k];
				if($k < $plain_length - 1) $result .= $delimiter;
			}
		}

	} else if($_POST['vernam_decrypt']){
		$method = "Vernam";
		$encOrDec = "dekripsi";

		$key = $_POST['vernam_key'];
		$plain = $_POST['vernam_plaintext'];
		$delimiter = $_POST['vernam_delimiter'];

		if(!empty($delimiter)){
			$encrypted_split = explode($delimiter, $plain);
		} else {
			$encrypted_split = str_split($plain, 8);
		}

		$encrypted_length = count($encrypted_split);
		$key_length = strlen($key);
		// $plain_length = strlen($plain);
		$key_split = str_split($key);
		$plain_split = str_split($plain);

		$i = 0;

		for($j = 0; $j < $encrypted_length; $j++){
			if($i == $key_length){
				$i = 0;
			}

			$key_split2[$j] = $key_split[$i];
			$i++;
		}

		// var_dump($encrypted_plain);
		// echo $encrypted_length;

		for($j = 0; $j < $encrypted_length; $j++){
			$a = $key_split2[$j];
			$b = $encrypted_split[$j];

			if(($a && $b) != null){
				$result .= vernamDecrypt($a, $b);
				// if($k < $plain_length - 1) $result2 .= $delimiter;
			} else {
				$result .= $plain_split[$k];
				// if($k < $plain_length - 1) $result2 .= $delimiter;
			}
		}
	}

	$_SESSION['result'] = $result;
	$_SESSION['message'] = "Hasil ".$encOrDec." dengan metode ".$method." dari plain text \"".$plain."\" dengan key ".$key." adalah: ";
	header("Location:index.php");
?>