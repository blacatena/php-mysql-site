<?php
if (isset($_GET['logout']))
{
	$db->logout();
}

if ($db->LoggedIn)
{
// 	// retrieve user details
	if ( !isset($User_Details) )
	{
		$Query = "SELECT * FROM user WHERE UserId = '".$db->UserId."'";
		$db->query($Query);
		$db->singleRecord();
		$User_Details = $db->Record;
	}
 	echo "<p style='margin:0 10px'>You are logged in as ".$db->Username."</p>\r\n";
	echo "<p><a href='index.php?logout=true'>Logout</a></p>";
} // if not logged in
else
{
//	echo "<form name='form1' method='post' style='margin:0 0 0 10px'>
//	<input type='hidden' name='Login' value='1'>\r\n";
	if (isset($db->LoginError))
		echo $db->LoginError;
?>
	<form name='form1' method='post' style='margin:0 0 0 10px'>
		<table>
			<tr><td>Username</td><td width=5></td><td><input type='text' name='Username' style='width:80px;'></td></tr>
			<tr><td>Password</td><td></td><td><input type='password' name='Password' style='width:80px;'></td></tr>
			<tr><td><input type='submit' value='Login'></input></td><td width=5></td><td><a href='register.php'>New? Register here</a></td></tr>
		</table>
	</form>
<?php
} // end if not logged in
?>