<?php
	
	header('Content-type: text/html; charset=utf-8');
	
	if (!isset($db))
	{
		include ('utilities/database.php');
		include ('utilities/session.php');
		$db = new Session;
	}
	
	if (isset($_POST['Login']))
		$db->login( $_POST['Username'], $_POST['Password']);
	
?><!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="layout.css" />
	</head>
	<body>
		<div style="width: 960px" class="center">
			<div class="center">
				<h1>PHP MySQL Play Site</h1>
				<div class="header">
<?php
				$Query = "SELECT * FROM content WHERE ColumnId = 0 ORDER BY SortSeq";
				
				$db->query($Query);
				while ($db->nextRecord())
				{
					echo "<HR/>";
					echo $db->Record['Content'];
				}

?>
				<hr/>
				</div>
			</div>
			<table>
				<tr>
					<td>
						<div class="left">
<?php
							include 'login.php';
?>
							<br/><br/>Left<br/><br/>
<?php						
							$Query = "SELECT * FROM content WHERE ColumnId = 1 ORDER BY SortSeq";
							
							$db->query($Query);
							while ($db->nextRecord())
							{
								echo "<HR/>";
								echo $db->Record['Content'];
							}

?>
						</div>
					</td>
					<td>
<?php 
	if (false) {	//	This never gets written... it just makes the page parser happy by balancing the seemingly unbalanced tags
?>
	</td></tr></table></div>	THIS NEVER GETS OUTPUT
<?php 
	}
?>