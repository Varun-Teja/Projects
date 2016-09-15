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

$sql =" select tow.town_name
from town_table as tow left join accident_table as acc
on tow.town_id = acc.loca_id
group by tow.town_id
having count(accident_id)=0;";
echo "<br>";

$result = mysqli_query($link,$sql);


if (mysqli_query($link, $sql)) {
    
	echo "<br>";
	echo "<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

echo "<p>The Prevalence of Diabetes in town B in year 2014</p>";
// Printing results in HTML
echo "<table>\n";
if(mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
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
mysqli_free_result($result);

// Closing connection
mysqli_close($link);
?>

<form action="main_menu.html">
    <input type="submit" value="Main Menu">
</form>