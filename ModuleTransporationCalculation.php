<?php

//Connecting to DB//
$host = 'localhost';
$user = 'root';
$pw = 'ehtkshfkdy232323';
$dbName = 'kbdlab';
$dbConnect = mysqli_connect($host, $user, $pw, $dbName);

//Transporation Variable Setting//
$Trans_CompanyName = "SELECT * FROM transportation WHERE ID='$CompanyName'";
$Trans_Type = "SELECT * FROM transportation WHERE ID='$TypeofTransportation'";
$Trans_AxleNum = "SELECT * FROM transportation WHERE ID='$AxleNumber'";
$Trans_Length = "SELECT * FROM transportation WHERE ID='$Length'";
$Trans_Width = "SELECT * FROM transportation W
ERE ID='$Width'";	
$Trans_Height =		 "SELECT * FROM transportation WHERE ID='$Height'";
$Trans_WeightCapacity = "SELECT * FROM transportation WHERE ID='$WeightCapacity'";
//Alternativez$Transportation = "SELECT * FROM transportation";

//Module Variable Setting//
$Module_CompanyName = "SELECT * FROM Module WHERE ID='$CompanyName'";
$Module_Type = "SELECT * FROM Module WHERE ID='$ModuleType'";
$Module_Length = "SELECT * FROM Module WHERE ID='$Length'";
$Module_Width = "SELECT * FROM Module WHERE ID='$Width'";
$Module_Height = "SELECT * FROM Module WHERE ID='$Height'";
$Module_Weight = "SELECT * FROM Module WHERE ID='$Weight'";
//Alternative//
$Module = "SELECT * FROM module";

//Transporation Array//
$Transportation_retval = mysql_query($Transportation,$dbConnect);
$Transporation_row_command ='$Transporation_row = mysql_fetch_assoc($Transportation_retval)';

//Module Array//
$Module_retval = mysql_query($Module,$dbConnect);
$Module_row_command = '$Module_row = mysql_fetch_assoc($Module_retval)';

//K Variable Setting//
$K=0

//X Variable Setting//
$Result=0

//Comparing the Length, Width, Height and Weight//
while($Transporation_row_command){
	while ($Module_row_command){
		$L_Difference = $Transportation_row['Length']-$Module_row['Length'];
		$W_Difference = $Transportation_row['Width']-$Module_row['Width'];
		$Weight_Difference = $Transportation_row['Weight']-$Module_row['Weight'];
		if((1.3*$Transportation_row['Length']) > $Module_row['Length'] && 1.3*$Transportation_row['Width']) > $Module_row['Width'] && Transportation_row['WeightCapacity'] > Module_row['Weight'] && $K >= abs($L_Difference)+abs($W_Difference)+abs($H_Difference){
			$K = abs($L_Difference)+abs($W_Difference)+abs($H_Difference)
			$Combined_Height=$Transportation_row['Height']+$Module_row['Height'];
			//Insert Result into an array//
			$Result = array('$Transporation_row['CompanyName']','$Transporation_row['TypeofTransporation']','$Transporation_row['AxleNumber']','$Transporation_row['Length']','$Transporation_row['Width']','{$Combined_Height}','$Transporation_row['WeightCapacity']','$Module_row['CompanyName']','$Module_row['ModuleType']','$Module_row['Length']','$Module_row['Width']','$Module_row['Height']','$Module_row['Weight']','Good');
		}
		//Length too big//
		elseif(2.15*$Transportation_row['Length']) > $Module_row['Length'] && 1.3*$Transportation_row['Width']) > $Module_row['Width'] && Transportation_row['WeightCapacity'] > Module_row['Weight'] && $K >= abs($L_Difference)+abs($W_Difference)+abs($H_Difference){
			$K = abs($L_Difference)+abs($W_Difference)+abs($H_Difference)
			//Insert Result into an array//
			$Result = array('$Transporation_row['CompanyName']','$Transporation_row['TypeofTransporation']','$Transporation_row['AxleNumber']','$Transporation_row['Length']','$Transporation_row['Width']','{$Combined_Height}','$Transporation_row['WeightCapacity']','$Module_row['CompanyName']','$Module_row['ModuleType']','$Module_row['Length']','$Module_row['Width']','$Module_row['Height']','$Module_row['Weight']','Two Attached Sideways');
		}
		//Width too big//
		elseif(1.3*$Transportation_row['Length']) > $Module_row['Length'] && 2.15*$Transportation_row['Width']) > $Module_row['Width'] && Transportation_row['WeightCapacity'] > Module_row['Weight'] && $K >= abs($L_Difference)+abs($W_Difference)+abs($H_Difference){
			//Insert Result into an array//
			$Result = array('$Transporation_row['CompanyName']','$Transporation_row['TypeofTransporation']','$Transporation_row['AxleNumber']','$Transporation_row['Length']','$Transporation_row['Width']','{$Combined_Height}','$Transporation_row['WeightCapacity']','$Module_row['CompanyName']','$Module_row['ModuleType']','$Module_row['Length']','$Module_row['Width']','$Module_row['Height']','$Module_row['Weight']','Two Attached Front and Back');
		}
		//Length and Width too big//
		elseif(2.15*$Transportation_row['Length']) > $Module_row['Length'] && 2.15*$Transportation_row['Width']) > $Module_row['Width'] && Transportation_row['WeightCapacity'] > Module_row['Weight'] && $K >= abs($L_Difference)+abs($W_Difference)+abs($H_Difference){
			//Insert Result into an array//
			$Result = array('$Transporation_row['CompanyName']','$Transporation_row['TypeofTransporation']','$Transporation_row['AxleNumber']','$Transporation_row['Length']','$Transporation_row['Width']','{$Combined_Height}','$Transporation_row['WeightCapacity']','$Module_row['CompanyName']','$Module_row['ModuleType']','$Module_row['Length']','$Module_row['Width']','$Module_row['Height']','$Module_row['Weight']','Two Attached Sideways and Front and Back');
		}
		//Weight too big//
		elseif(Transportation_row['WeightCapacity'] < Module_row['Weight']){
			$Result = array('DEFAULT','DEFAULT','DEFAULT','DEFAULT','DEFAULT','DEFAULT','DEFAULT','$Module_row['CompanyName']','$Module_row['ModuleType']','$Module_row['Length']','$Module_row['Width']','$Module_row['Height']','$Module_row['Weight']','No Matching Transportation; Needs Module Weight Modification');
		}
		else{
			$Result = array('DEFAULT','DEFAULT','DEFAULT','DEFAULT','DEFAULT','DEFAULT','DEFAULT','$Module_row['CompanyName']','$Module_row['ModuleType']','$Module_row['Length']','$Module_row['Width']','$Module_row['Height']','$Module_row['Weight']','No Matching Transportation; Module too Large in Size');
		}
	}
	//Out of Second While and Inserting Data to the Database///
	mysqli_query($dbConnect,"INSERT INTO Result ('DEFAULT','{$Result[0]}','{$Result[1]}','{$Result[2]}','{$Result[3]}','{$Result[4]}','{$Result[5]}','{$Result[6]}','{$Result[7]}','{$Result[8]}','{$Result[9]}','{$Result[10]}','{$Result[11]}','{$Result[12]}'");
}

//From Database display Results with Echo//
$Result_retval = mysql_query($Result,$dbConnect);
while($Result_row = mysql_fetch_assoc($Result_retval)){
	if({$Result_row[13]}=='Good'){
		echo "For {$Result_row[8]}({$Result_row[7]}), {$Result_row[3]}(From {$Result_row[2]}) is suitable <br>"
		echo "Transportation Length: {$Result_row[4]} Width: {$Result_row[5]} Weight Capacity: {$Result_row[7]} <br>"
		echo "Module Length: {$Result_row[10]} Width: {$Result_row[11]} Weight: {$Result_row[12]} <br>"
		echo "Combined Height: {$Result_row[6]} <br><br>"
	}
	elseif({$Result_row[13]}=='Two Attached Sideways'){
		echo "For {$Result_row[8]}({$Result_row[7]}), {$Result_row[3]}(From {$Result_row[2]}) is suitable <br>"
		echo "Two of the mentioned transportation have to be attached sideways <br>"
		echo "Transportation Length: {$Result_row[4]} Width: {$Result_row[5]} Weight Capacity: {$Result_row[7]} <br>"
		echo "Module Length: {$Result_row[10]} Width: {$Result_row[11]} Weight: {$Result_row[12]} <br>"
		echo "Combined Height: {$Result_row[6]} <br><br>"
	}
	elseif({$Result_row[13]}=='Two Attached Front and Back'){
		echo "For {$Result_row[8]}({$Result_row[7]}), {$Result_row[3]}(From {$Result_row[2]}) is suitable <br>"
		echo "Two of the mentioned transportation have to be attached front and back <br>"
		echo "Transportation Length: {$Result_row[4]} Width: {$Result_row[5]} Weight Capacity: {$Result_row[7]} <br>"
		echo "Module Length: {$Result_row[10]} Width: {$Result_row[11]} Weight: {$Result_row[12]} <br>"
		echo "Combined Height: {$Result_row[6]} <br><br>"
	}
	elseif({$Result_row[13]}=='Two Attached Sideways and Front and Back'){
		echo "For {$Result_row[8]}({$Result_row[7]}), {$Result_row[3]}(From {$Result_row[2]}) is suitable <br>"
		echo "Two of the mentioned transportation have to be attached both sideways and front and back <br>"
		echo "Transportation Length: {$Result_row[4]} Width: {$Result_row[5]} Weight Capacity: {$Result_row[7]} <br>"
		echo "Module Length: {$Result_row[10]} Width: {$Result_row[11]} Weight: {$Result_row[12]} <br>"
		echo "Combined Height: {$Result_row[6]} <br><br>"
	}
	elseif({$Result_row[13]}=='No Matching Transportation; Needs Module Weight Modification'){
		echo "{$Result_row[8]}({$Result_row[7]}) is too heavy to be transported by any of the options available"
	}
	elseif({$Result_row[13]}=='No Matching Transportation; Module too Large in Size'){
		echo "{$Result_row[8]}({$Result_row[7]}) is too large in size to be transported by any of the options available <br><br>"
	}
}



