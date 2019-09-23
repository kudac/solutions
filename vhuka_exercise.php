<?php

//vhuka africa exercise
$hostname = "localhost";
$username = "root19";
$password = "root19";
$dbname = "vhuka_exercise";
$conn = mysqli_connect($hostname,$username,$password,$dbname);
mysqli_select_db($conn,$dbname);
$a=array();
$b=array();
$c = array();
$d = array();


if($conn->connect_error){
	die('database error 201');
}

if (isset($_POST['check_ip'])) {
	
$ip_addr = $_POST['ip_address'];

if (isset($_POST['ip_address'])) {
	

	if (filter_var($ip_addr,FILTER_VALIDATE_IP,FILTER_FLAG_IPV4)) {

		$a[$ip_addr] = 'this is a valid IP address';
		array_push($b, $a);
		echo json_encode($b);

		mysqli_query($conn,"INSERT INTO valid_ip(ip_address)values('".$ip_addr."') ");
		
		
		}else {
			$a['status_code'] = 'error 400.';
			array_push($b,$a);
			echo json_encode($b);

	}
	}

}


//get first ip address from database in asc order of time
		//echo 'Ip addresses from db in ascending order';
		$x= mysqli_query($conn,"SELECT ip_address,date_time from valid_ip ORDER BY TIME(date_time) ASC");
		if(mysqli_num_rows($x)>0){
				?><br><br><strong><?php echo 'FETCHED IP ADDRESSES FROM DATABASE';?></stong><br><br><?php
			while($row = mysqli_fetch_array($x)){
		
			
			$c['ip'] = $row['ip_address'];
			$c['time'] = $row['date_time'];
			array_push($d,$c);
			
		}
		echo json_encode($d);
		}
?>
<html>

<form role="form" action="vhuka_exercise.php" method="POST">
	<br>
	<br><br><br>
	<input type="text" name="ip_address" placeholder="insert ip address"><br><br>

	<input type="submit" name="check_ip" value="check ip">

</form>
</html>

