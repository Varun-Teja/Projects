
<head><style>
body {background-image:url("health.jpg")}
  body {background-size:cover}

.CSSTableGenerator {
	margin:0px;padding:0px;
	width:30%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}.CSSTableGenerator table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:40%;
	margin:0px;padding:0px;
}.CSSTableGenerator tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.CSSTableGenerator table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.CSSTableGenerator table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.CSSTableGenerator tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.CSSTableGenerator tr:hover td{
	
}
.CSSTableGenerator tr:nth-child(odd){ background-color:#aad4ff; }
.CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }.CSSTableGenerator td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:center;
	padding:7px;
	font-size:20px;
	font-family:Arial;
	font-weight:bold;
	color:#000000;
}.CSSTableGenerator tr:last-child td{
	border-width:0px 1px 0px 0px;
}.CSSTableGenerator tr td:last-child{
	border-width:0px 0px 1px 0px;
}.CSSTableGenerator tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
		background:-o-linear-gradient(bottom, #005fbf 5%, #003f7f 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #003f7f) );
	background:-moz-linear-gradient( center top, #005fbf 5%, #003f7f 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#003f7f");	background: -o-linear-gradient(top,#005fbf,003f7f);

	background-color:#005fbf;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}


.CSSTableGenerator tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
</style>
</head>

<div class="CSSTableGenerator" >


<?php
// Connecting, selecting database
$link = mysqli_connect('localhost:3306', 'root', 'root','survey_schema')
    or die('Could not connect: ' . mysqli_error());
//echo 'Connected successfully';
echo "<br>";

$value = $_POST['place_id'];

$sql1 = "select gender,(count(*)/(select count(*) from survey_table where place_id = $value))*100 from survey_table where place_id = $value group by gender;";
$result1 = mysqli_query($link,$sql1);


if (mysqli_query($link, $sql1)) {
    
	echo "<br>";
	echo "<br>";
} else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($link);
}


// Printing results in HTML
echo "<b>POPULATION DISTRIBUTION ";
echo "<table>";
echo "<tr><td>GENDER</td>";
echo "<td>Percentage</td></tr>";
if(mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result1)) {
        echo  "\t<tr>\n";
		foreach ($row as $col_value){
		echo "\t\t<td>$col_value</td>\n";
		}
    }
} else {
    echo "0 results";
}

echo "\t</tr>\n";

echo "</table>\n";

// Free resultset
mysqli_free_result($result1);
echo "<br><br><br>";
$sql2 = "select ethnicity,(count(survey_id)/(select count(*) from survey_table where place_id = $value))*100 from survey_table where place_id = $value group by ethnicity;";
$result2 = mysqli_query($link,$sql2);


if (mysqli_query($link, $sql2)) {
    
	echo "<br>";
	echo "<br>";
} else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($link);
}


// Printing results in HTML
echo "<b>ETHNICITY DISTRIBUTION ";
echo "<table>";
echo "<tr><td>Ethnicity</td>";
echo "<td>Percentage</td></tr>";
if(mysqli_num_rows($result2) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result2)) {
        echo  "\t<tr>\n";
		foreach ($row as $col_value){
		echo "\t\t<td>$col_value</td>\n";
		}
    }
} else {
    echo "0 results";
}

echo "\t</tr>\n";

echo "</table>\n";

// Free resultset
mysqli_free_result($result2);


echo "<br><br><br>";
$sql3 = "select smoking,count(*)/(select count(*) from survey_table where place_id = $value)*100 as Percentage from survey_table where place_id = $value group by smoking";
$result3 = mysqli_query($link,$sql3);


if (mysqli_query($link, $sql3)) {
    
	echo "<br>";
	echo "<br>";
} else {
    echo "Error: " . $sql3 . "<br>" . mysqli_error($link);
}


// Printing results in HTML
echo "<b>SMOKERS DISTRIBUTION ";
echo "<table>";
echo "<tr><td>SMOKING</td>";
echo "<td>Percentage</td></tr>";
if(mysqli_num_rows($result3) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result3)) {
        echo  "\t<tr>\n";
		foreach ($row as $col_value){
		echo "\t\t<td>$col_value</td>\n";
		}
    }
} else {
    echo "0 results";
}

echo "\t</tr>\n";

echo "</table>\n";

// Free resultset
mysqli_free_result($result3);


echo "<br><br><br>";
$sql4 = "select alcohol,count(*)/(select count(*) from survey_table where place_id = $value)*100 as Percentage from survey_table where place_id = $value group by alcohol";
$result4 = mysqli_query($link,$sql4);


if (mysqli_query($link, $sql4)) {
    
	echo "<br>";
	echo "<br>";
} else {
    echo "Error: " . $sql4 . "<br>" . mysqli_error($link);
}


// Printing results in HTML
echo "<b> Alcoholics Distribution ";
echo "<table>";
echo "<tr><td>Alcohol</td>";
echo "<td>Percentage</td></tr>";
if(mysqli_num_rows($result4) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result4)) {
        echo  "\t<tr>\n";
		foreach ($row as $col_value){
		echo "\t\t<td>$col_value</td>\n";
		}
    }
} else {
    echo "0 results";
}

echo "\t</tr>\n";

echo "</table>\n";

// Free resultset
mysqli_free_result($result4);

echo "<br><br><br>";
$sql5 ="select disease_name, count(s.survey_id)/(select count(survey_id) from survey_table where place_id = $value)*100 as percentage from survey_table as s inner join survey_diseases as sd on sd.su_id = s.survey_id inner join diseases_table as d on d.disease_id = sd.d__id inner join town_table on s.place_id = town_table.town_id where town_name = (select town_name from town_table where town_id = $value) group by disease_name;" ;
$result5 = mysqli_query($link,$sql5);


if (mysqli_query($link, $sql5)) {
    
	echo "<br>";
	echo "<br>";
} else {
    echo "Error: " . $sql5 . "<br>" . mysqli_error($link);
}


// Printing results in HTML
echo "<b> Disease Statistics ";
echo "<table>";
echo "<tr><td>Disease Name</td>";
echo "<td>Percentage Distribution</td></tr>";
if(mysqli_num_rows($result5) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result5)) {
        echo  "\t<tr>\n";
		foreach ($row as $col_value){
		echo "\t\t<td>$col_value</td>\n";
		}
    }
} else {
    echo "0 results";
}

echo "\t</tr>\n";

echo "</table>\n";

// Free resultset
mysqli_free_result($result5);

mysqli_close($link);
?>
</div><br><br>
</form>
<form action="main_menu.html">
    <input type="submit" value="Main Menu">
</form>