<head><style>
  body {background-image:url("health.jpg")}
  body {background-size:cover}
  td    {color:rgb(43,163,255)}
  td   {font-style: bold}
  td    {font-size :200%}
  p    {color:rgb(43,163,255)}
  p   {font-style: bold}
  p    {font-size :150%}
  input {color:#747474}
  submit {float:none;
	box-shadow: 0px 6px 10px -2px #686868;
	padding: 0.5em 1.5em 0.7em 1.5em;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;}
	
</style>
</head>
<?php
// Connecting, selecting database
$link = mysqli_connect('localhost:3306', 'root', 'root','survey_schema')
    or die('Could not connect: ' . mysqli_error());
//echo 'Connected successfully';
echo "<br>";

$sql ="select min(Prevalence)*100, town_name from (Select count(sd.d__id)/(select count(*) from survey_schema.survey_diseases)
as Prevalence, town_name from survey_schema.survey_diseases as sd
left join survey_schema.diseases_table as di on di.disease_id = sd.d__id
left join survey_schema.survey_table  as s on s.survey_id = sd.su_id
left join survey_schema.town_table as t on t.town_id = s.place_id
where year(s.date) = 2012 and disease_name = 'diabetes'
group by town_id) as temp; ";
echo "<br>";

$result = mysqli_query($link,$sql);


if (mysqli_query($link, $sql)) {
    
	echo "<br>";
	echo "<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

echo "<p>The town with the lowest prevalence of Diabetes in 2012";
// Printing results in HTML
echo "<table>\n";
if(mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo  "\t<tr>\n";
		foreach ($row as $col_value){
		echo "<td>$col_value</td>\n";
		}
    }
} else {
    echo "0 results";
}

echo "\t</tr>\n";

echo "</table>\n";

// Free resultset
mysqli_free_result($result);

// Closing connection
mysqli_close($link);
?>
<form action="main_menu.html">
    <input type="submit" value="Main Menu">
</form>