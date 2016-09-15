<style>
  body {background-image:url("health.jpg")}
  body {background-size:cover}
  p    {color:rgb(43,163,255)}
  p    {font-style: bold}
  p    {font-size :100%}
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

$sql =" select max(frequency) as count,accident_description from 
(select count(accident_id)as frequency, accident_description from accident_table
inner join town_table on accident_table.loca_id = town_table.town_id
where town_name = 'A'
group by accident_description) as temp;";
echo "<br>";

$result = mysqli_query($link,$sql);


if (mysqli_query($link, $sql)) {
    
	echo "<br>";
	echo "<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

echo "<p><b>Most Common Accident Type for Town A</p>";
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