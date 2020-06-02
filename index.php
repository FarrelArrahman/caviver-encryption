<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Caviver Encryptor and Decryptor</title>
		<style type="text/css">
			.red {
				color: #f00;
			}
		</style>
	</head>
	<body>
		<h1 align="center">Caesar, Vigenere and Vernam Encryption</h1>
		<table width="800" align="center">
			<tr>
				<td width="50%" valign="top">
					<fieldset>
						<legend><b>Caesar</b></legend>
						<form action="convert.php" method="post">
							<input type="text" name="caesar_key" id="caesar_key" placeholder="Masukkan key..." autocomplete="off" / value="">
							<small class="red">Catatan: Key yang digunakan hanya berupa kombinasi angka. Misalnya; 5, 22, 101, dst.</small>
							<textarea rows="4" name="caesar_plaintext" id="caesar_plaintext" cols="105" placeholder="Masukkan plain text..."></textarea><br/>
							<center>
								<small class="red">Catatan: Plain Text hanya berupa kombinasi huruf tanpa angka.</small><br><br>
								<input type="submit" name="caesar_encrypt" value="Encrypt" /><input type="submit" name="caesar_decrypt" value="Decrypt" /><input type="reset" value="Reset" />
							</center>
						</form>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="50%" valign="top">
					<fieldset>
						<legend><b>Vigenere</b></legend>
						<form action="convert.php" method="post">
							<input type="text" name="vigenere_key" id="vigenere_key" placeholder="Masukkan key..." autocomplete="off" / value="">
							<small class="red">Catatan: Key yang digunakan hanya berupa kombinasi kata tanpa angka. Misalnya; abc, saya, terserah, dst.</small>
							<textarea rows="4" name="vigenere_plaintext" id="vigenere_plaintext" cols="105" placeholder="Masukkan plain text..."></textarea><br/>
							<center>
								<small class="red">Catatan: Plain Text hanya berupa kombinasi huruf tanpa angka.</small><br><br>
								<input type="submit" name="vigenere_encrypt" value="Encrypt" /><input type="submit" name="vigenere_decrypt" value="Decrypt" /><input type="reset" value="Reset" />
							</center>
						</form>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td width="50%" valign="top">
					<fieldset>
						<legend><b>Vernam</b></legend>
						<form action="convert.php" method="post">
							<input type="text" name="vernam_key" id="vernam_key" placeholder="Masukkan key..." autocomplete="off" / value="">
							<small class="red">Catatan: Key yang digunakan berupa kombinasi kata dan/atau angka. Misalnya; c9, a5h144p, b0ss, dst.</small>
							<textarea rows="4" name="vernam_plaintext" id="vigenere_plaintext" cols="105" placeholder="Masukkan plain text..."></textarea><br/>
							<select name="vernam_delimiter">
								<option selected="" disabled="" value=" ">Pilih delimiter...</option>
								<option value=" ">Whitespace</option>
								<option value=".">Dot</option>
								<option value="-">Dash</option>
								<option value="_">Underscore</option>
							</select>
							<center>
								<small class="red">Catatan: Plain Text hanya berupa kombinasi huruf dan/atau angka.</small><br><br>
								<input type="submit" name="vernam_encrypt" value="Encrypt" /><input type="submit" name="vernam_decrypt" value="Decrypt" /><input type="reset" value="Reset" />
							</center>
						</form>
					</fieldset>
				</td>
			</tr>
			<?php
			if(isset($_SESSION['result'])){
			?>
			<tr>
				<td valign="top" colspan="3">
					<fieldset>
						<legend><b>Result</b></legend>
						<small>
							<?php echo $_SESSION['message']; ?>
						</small>
						<textarea cols="105"><?php echo $_SESSION['result']; ?></textarea>
					</fieldset>
				</td>
			</tr>
			<?php session_destroy(); }?>
		</table>
	</body>
</html>