<?php
$output='';

$conn=mysqli_connect("localhost","root","","zomato");

$order_id=$_POST['order_id'];

$query="SELECT * FROM order_details o JOIN menu m ON m.id=o.menu_id WHERE order_id LIKE '$order_id'";

//echo $query;

$result=mysqli_query($conn,$query);

// $new_array=array();

// $counter=1;
while($row=mysqli_fetch_array($result)){
	$output .='
		<tr>
			<td>1</td>
			<td>'.$row['name'].'</td>
			<td>1</td>
		</tr>
	';
}
$output .="</table></div>";
echo $output;	



?>