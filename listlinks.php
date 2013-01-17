<?php

$Query = "SELECT * FROM page";

echo "<ul>";
$db->query($Query);
while ($db->nextRecord())
{
	echo "<li>";
	echo "	<a href='".$db->Record['PageUrl']."'>".$db->Record['PageName']."</a>";
	echo "</li>";
}
echo "</ul>";