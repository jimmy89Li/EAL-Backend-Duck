<?php
if(isset($_POST["user"]) && isset($_POST["pass"])
		&& $_POST["user"]!=""){
	$filehandle = fopen("users","r");
	
	if($filehandle){
		$line;
		
		while($line = fgets($filehandle)){
			$line = trim(explode("=",$line)[0]);
			
			if($line == $_POST["user"]){
				setcookie("user", $_POST["user"]);
				fclose($filehandle);
				header("location: registerpage.php");
				exit();
			}
		}
		fclose($filehandle);
	}
	//user does not already exist
	$filehandle = fopen("users","a");
	fwrite($filehandle, PHP_EOL.$_POST["user"]."=".$_POST["pass"]);
	fclose($filehandle);
	
	header("location: index.php");
	exit();
}
else{
	header("location: registerpage.php");
	exit();
}
?>