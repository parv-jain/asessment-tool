<?php
require 'connect.php';
$query="SELECT * FROM temp ORDER BY(rating) DESC";
$result=mysqli_query($con,$query);
$data=array();
foreach ($result as $row) {
   $data[] = $row;
}
print json_encode($data);

$query="DELETE FROM temp";
mysqli_query($con,$query);
?>
