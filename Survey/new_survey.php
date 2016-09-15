<?php
// define variables and set to empty values
$dErr = $eErr = $gErr = $dobErr = $mErr =$pErr=$fErr=$aErr=$sErr=$jErr="";
$value1 = $value2=$value3=$value4=$value5=$value6=$value7=$value8=$value9=$value10=$value11=$value12=$value13=$value14=$value15=$value16=$value17=$value18= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["Date"])) {
     $dErr = "Date is required";
   } else {
     $value10 = $_POST["Date"];
   }
  
   if (empty($_POST["ethnicity"])) {
     $eErr = "Ethnicity is required";
   } else {
     $value1 =$_POST["ethnicity"];
   }
    
   if (empty($_POST["gender"])) {
     $gErr = "Select a gender";
   } else {
     $value2 = $_POST["gender"];
   }

   if (empty($_POST["marital_status"])) {
     $mErr = "Select an option";
   } else {
     $value3 = $_POST["marital_status"];
   }

   if (empty($_POST["dob"])) {
     $dobErr = "Date of birth is required";
   } else {
     $value4 = $_POST["dob"];
   }

  if (empty($_POST["place_id"])) {
     $pErr = " Select an option";
   } else {
     $value5 = $_POST["place_id"];
   }
  if (empty($_POST["alcohol"])) {
     $aErr = "Select an option";
   } else {
     $value6 = $_POST["alcohol"];
   }
   
     if (empty($_POST["smoking"])) {
     $sErr = "Select an option";
   } else {
     $value7 = $_POST["smoking"];
   }
   
     if (empty($_POST["fruit"])) {
     $fErr = "Enter a number";
   } else {
     $value8 = $_POST["fruit"];
   }
   
   if (empty($_POST["junk_food"])) {
     $jErr = "Enter a number";
   } else {
     $value9 = $_POST["junk_food"];
   }
   
$value11 = $_POST['disease_a'];
$value12 = $_POST['year_a'];
$value13 = $_POST['disease_b'];
$value14 = $_POST['year_b'];
$value15 = $_POST['disease_c'];
$value16 = $_POST['year_c'];
$value17 = $_POST['disease_d'];
$value18 = $_POST['year_d'];
 

$link = mysqli_connect('localhost:3306', 'root', 'root','survey_schema')
    or die('Could not connect: ' . mysqli_error());
//echo 'Connected successfully';
echo "<br>";


$sql ="Insert into survey_table(ethnicity,gender,marital_status,dob,place_id,alcohol,smoking,fruit,junk_food,date) VALUES ('$value1','$value2','$value3','$value4','$value5','$value6','$value7','$value8','$value9','$value10')";
echo "<br>";

if (mysqli_query($link, $sql)) {
    $last_id = mysqli_insert_id($link);
   // echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
   // echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

foreach ($_POST['jobs'] as $selectedOption)
if ($selectedOption!= Null){
    $sql_jobs ="Insert into job_survey VALUES($last_id,$selectedOption)" ;
    if (mysqli_query($link,$sql_jobs)){
	//echo "New record created successfully.\n";
	} else {
	//echo "Error: " . $sql_jobs . "<br>" . mysqli_error($link);
	}
	}
else echo "NO value selected";

if($value11!= null){

$sql_disease_a = "Insert into survey_diseases VALUES ($last_id,$value11,$value12)";

if (mysqli_query($link, $sql_disease_a)) {
     // echo "New record created successfully in survey_diseases";
} else {
   // echo "Error: " . $sql_disease_a . "<br>" . mysqli_error($link);
}
}

if($value13!= null){

$sql_disease_b = "Insert into survey_diseases VALUES ($last_id,$value13,$value14)";

if (mysqli_query($link, $sql_disease_b)) {
      //echo "New record created successfully in survey_diseases";
} else {
   // echo "Error: " . $sql_disease_b . "<br>" . mysqli_error($link);
}
}


if($value15!= null){

$sql_disease_c = "Insert into survey_diseases VALUES ($last_id,$value15,$value16)";

if (mysqli_query($link, $sql_disease_c)) {
     // echo "New record created successfully in survey_diseases";
} else {
   // echo "Error: " . $sql_disease_c . "<br>" . mysqli_error($link);
}
}


if($value17!= null){

$sql_disease_d = "Insert into survey_diseases VALUES ($last_id,$value17,$value18)";

if (mysqli_query($link, $sql_disease_d)) {
      //echo "New record created successfully in survey_diseases";
} else {
   // echo "Error: " . $sql_disease_d . "<br>" . mysqli_error($link);
}
}


mysqli_close($link); 
   if($value1 != 0 || $value2!=0 ||$value3!=0||$value4!=0||$value5!=0||$value6!=0||$value7!=0||$value8!=0||$value9!=0||$value10!=0){
 header('Location: http://localhost/survey_success.html'); 
 }
   
}
?>



<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method= "post"/>
<head>
<style>
  .error {color: #FF0000;}
  body {background-image:url("1.jpg")}
  
  h1   {font-family:"Verdana"}
  h1   {color:rgb(43,163,255)}
  p    {color:rgb(43,163,255)}
  p    {font-family:"Georgia"}
  input {color:#747474}
  select {
	color:#747474;
	font-size: 0.9em;
	padding: 8px;
	outline: none;
	margin: 5px 0;
	border: none;
	width: 10%;
	font-family: 'Open Sans', sans-serif;
	font-weight: 600;
     }
  submit {float:none;
	box-shadow: 0px 6px 10px -2px #686868;
	padding: 0.5em 1.5em 0.7em 1.5em;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
}

  submit{
	background: rgb(43,163,255);
	background: -moz-radial-gradient(center, ellipse cover,  rgb(43,163,255) 0%, rgb(50,171,253) 3%, rgb(54,175,252) 6%, rgb(58,177,247) 13%, rgb(54,165,233) 29%, rgb(43,132,195) 61%, rgb(36,110,169) 87%, rgb(34,105,165) 90%, rgb(31,96,156) 94%, rgb(23,73,133) 100%);
	background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgb(43,163,255)), color-stop(3%,rgb(50,171,253)), color-stop(6%,rgb(54,175,252)), color-stop(13%,rgb(58,177,247)), color-stop(29%,rgb(54,165,233)), color-stop(61%,rgb(43,132,195)), color-stop(87%,rgb(36,110,169)), color-stop(90%,rgb(34,105,165)), color-stop(94%,rgb(31,96,156)), color-stop(100%,rgb(23,73,133)));
	background: -webkit-radial-gradient(center, ellipse cover,  rgb(43,163,255) 0%,rgb(50,171,253) 3%,rgb(54,175,252) 6%,rgb(58,177,247) 13%,rgb(54,165,233) 29%,rgb(43,132,195) 61%,rgb(36,110,169) 87%,rgb(34,105,165) 90%,rgb(31,96,156) 94%,rgb(23,73,133) 100%);
	background: -o-radial-gradient(center, ellipse cover,  rgb(43,163,255) 0%,rgb(50,171,253) 3%,rgb(54,175,252) 6%,rgb(58,177,247) 13%,rgb(54,165,233) 29%,rgb(43,132,195) 61%,rgb(36,110,169) 87%,rgb(34,105,165) 90%,rgb(31,96,156) 94%,rgb(23,73,133) 100%);
	background: -ms-radial-gradient(center, ellipse cover,  rgb(43,163,255) 0%,rgb(50,171,253) 3%,rgb(54,175,252) 6%,rgb(58,177,247) 13%,rgb(54,165,233) 29%,rgb(43,132,195) 61%,rgb(36,110,169) 87%,rgb(34,105,165) 90%,rgb(31,96,156) 94%,rgb(23,73,133) 100%);
	background: radial-gradient(ellipse at center,  rgb(43,163,255) 0%,rgb(50,171,253) 3%,rgb(54,175,252) 6%,rgb(58,177,247) 13%,rgb(54,165,233) 29%,rgb(43,132,195) 61%,rgb(36,110,169) 87%,rgb(34,105,165) 90%,rgb(31,96,156) 94%,rgb(23,73,133) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2ba3ff', endColorstr='#174985',GradientType=1 );
	border:1.5px solid #0158B6;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	line-height: 20px;
	font-size: 16px;
	padding: 7px 21px;
	color: #fff;
	font-style:bold;
	font-family: 'Open Sans', sans-serif;
	float: left;
	margin-left: 10px;
	cursor: pointer;
	outline: none;
	-webkit-appearance: none;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
	text-shadow: 0 0 3px #2E2E2E;
}

</style>
</head>

<h1 style="font-size:150%"><u>
NEW SURVEY</u></h1>
<p><span class="error">* required field.</span></p>
<p><b>DATE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "date" name = "Date">
<span class="error">* <?php echo $dErr;?></span>
</p>
<br>
<p> <b>Ethnicity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	 
<select name="ethnicity" >
 <option value = ""> Select</option>
 <option value="American Indian or Alaska Native">American Indian or Alaska Native</option>
 <option value="Asian">Asian</option>
<option value="Black or African American">Black or African American</option>
<option value="Native Hawaiian">Native Hawaiian or Other Pacific Islander</option>
<option value="White">White</option>
<option value="Hispanic or Latino">Hispanic or Latino</option>
 </select><span class="error">* <?php echo $eErr;?></span>


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
 <select name="gender" required >
 <option > Select</option>
 <option value="M">Male</option>
 <option value="F">Female</option> 
 </select><span class="error">* <?php echo $gErr;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 Marital Status&nbsp;&nbsp;&nbsp;	
 <select name="marital_status" >
 <option > Select</option>
 <option value="Single">Single</option>
 <option value="Married">Married</option> 
 <option value="Divorced">Divorced</option> 
 </select><span class="error">* <?php echo $mErr;?></span>
</p>
 <br>
 <p>Date of Birth&nbsp;&nbsp;	 <input type = "date" name = "dob"><span class="error">* <?php echo $dobErr;?></span>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 Location&nbsp;&nbsp;&nbsp;&nbsp;
 <select name="place_id">
<option > Select</option> 
 <option value="1">TOWN A</option>
 <option value="2">TOWN B</option>
 <option value="3">TOWN C</option>
 </select><span class="error">* <?php echo $pErr;?></span>
 </p>
 <br>
 <br>
 <br>
 <p>Alcohol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <select name="alcohol" >
 <option > Select</option>
 <option value="YES">YES</option>
 <option value="NO">NO</option> 
 </select><span class="error">* <?php echo $aErr;?></span>
 
 &nbsp;&nbsp;&nbsp;&nbsp;Smoking&nbsp;&nbsp;&nbsp;
 <select name="smoking" >
<option >Select </option>
 <option value="YES">YES</option>
 <option value="NO">NO</option> 
 </select><span class="error">* <?php echo $sErr;?></span>
 
 &nbsp;&nbsp;&nbsp;&nbsp;Fruit Servings/Week&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	 <input type = "text" name = "fruit"<span class="error">* <?php echo $fErr;?></span>
 &nbsp;&nbsp;&nbsp;&nbsp;Junk Food/Week&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	 <input type = "text" name = "junk_food"<span class="error">* <?php echo $jErr;?></span>
 <p>
 <br>
 <br>
 <b><u>OCCUPATION</u><br>
 <p>
 <select name="jobs[ ]" multiple>
  <option value="">None</option>
  <option value="1">Office Employee</option>
  <option value="2">Farmer</option>
  <option value="3">Industrial Worker</option>
 </select>

 <p>
   <b><u>DISEASE HISTORY<br></u>
   <select name="disease_a" >
 <option value = ""> Select</option>
 <option value="1">Diabetes</option>
 <option value="2">Hyper Tension</option> 
 <option value="3">COPD</option> 
 <option value="4">Myocardial Infraction</option> 
 </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 Diagnosed Year&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "year_a"/>
 <p>
   <select name="disease_b" >
 <option value = ""> Select</option>
 <option value="1">Diabetes</option>
 <option value="2">Hyper Tension</option> 
 <option value="3">COPD</option> 
 <option value="4">Myocardial Infraction</option> 
 </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 Diagnosed Year&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "year_b"/>
 <p>
   <select name="disease_c" >
 <option value = ""> Select</option>
 <option value="1">Diabetes</option>
 <option value="2">Hyper Tension</option> 
 <option value="3">COPD</option> 
 <option value="4">Myocardial Infraction</option> 
 </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 Diagnosed Year&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "year_c"/>
 
 
 <p>
 
 <select name="disease_d" >
 <option value = ""> Select</option>
 <option value="1">Diabetes</option>
 <option value="2">Hyper Tension</option> 
 <option value="3">COPD</option> 
 <option value="4">Myocardial Infraction</option> 
 </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 Diagnosed Year&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "year_d"/>
 
 
 <p>
 <input type = "submit" value = "Submit"/>


<p>
<p>
<p>
</form>
<form action="main_menu.html">
    <input type="submit" value="Main Menu">
</form>



