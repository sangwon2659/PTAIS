<!DOCTYPE html>
<html>
<head>
  <title>Module Transportation</title>
  <link rel="stylesheet" type="text/css" href="Module_Transportation.css"/>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script>
    $(function() {

    });
    function AJAX() {
      console.log(1);
      $.ajax({
            url: 'ModuleTransportationCalculation.php',
data: ""
      });
    }
  </script>
</head>
<body>
  <header id="main-header">
    <div class="container">
      <h1>Module Transportation</h1>
    </div>
  </header>
  <br>
  <br>
  <div class="container">
  <h3>Selecting Module to Transport</h3>
  </div>
  <br>

<?php

$username = "root"; 
$password = "ehtkshfkdy232323"; 
$database = "nationalroad";     
$mysqli = mysqli_connect("localhost", $username, $password, $database); 
$query = "SELECT * FROM module";

echo '<table>';
echo '<table border="0" cellspacing="4" cellpadding="2"> 
      <tr align="center"> 
          <td> <font face="Arial">Check Box</font> </td> 
          <td> <font face="Arial">Company Name</font> </td> 
          <td> <font face="Arial">Type</font> </td> 
          <td> <font face="Arial">Length</font> </td> 
          <td> <font face="Arial">Width</font> </td> 
          <td> <font face="Arial">Height</font> </td> 
          <td> <font face="Arial">Weight</font> </td>
      </tr>';
$i=0;
echo "<form action='ModuleTransportationCalculation.php' method='POST'>";
$_row = array();
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
array_push($_row, $row);

        $field0name = '';
        $field1name = $row["CompanyName"];
        $field2name = $row["Type"];
        $field3name = $row["Length"];
        $field4name = $row["Width"];
        $field5name = $row["Height"];
        $field6name = $row["Weight"]; 
        echo "<tr> 
                  <td><input type=\"checkbox\" name=\"Name-" . $i++ . "\"/>$field0name</td>
                  <td>$field1name</td> 
                  <td>$field2name</td> 
                  <td>$field3name</td> 
                  <td>$field4name</td> 
                  <td>$field5name</td> 
                  <td>$field6name</td>
              </tr>";
    } 

    $result->free();
echo "<script> var DB = " . json_encode($_row) . "</script>";
echo '<tr><td><button type="button" onclick="AJAX()";>Next Step</button></td></tr>';
echo '</form>';

} 

?>