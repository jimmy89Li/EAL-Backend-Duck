<?php
if(isset($_POST["user"]) && isset($_POST["pass"])
		&& $_POST["user"]!=""){
	
	$filecontent = file_get_contents("users");
	
	$userlist = json_decode($filecontent, true);
	
	if(is_array($userlist)){
		foreach($userlist as $user){
			if($_POST["user"] == $user["user"]){
				setcookie("user", $_POST["user"]);
				fclose($filehandle);
				header("location: registerpage.php");
				exit();
			}
		}
	
		array_push($userlist, array("user"=>$_POST["user"], "pass"=>$_POST["pass"]));
	}
	
	else{
		$userlist = array("user"=>$_POST["user"], "pass"=>$_POST["pass"]);		
	}
	
	$filehandle = fopen("users","w");
	fwrite($filehandle, json_encode($userlist));
	fclose($filehandle);
}
else{
	header("location: registerpage.php");
	exit();
}
?>