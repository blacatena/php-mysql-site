<?php 
	if (false) {	//	This never gets written... it just makes the page parser happy by balancing the seemingly unbalanced tags
?>
	<div><table><tr><td> THIS NEVER GETS OUTPUT
<?php
	}
?>
					</td>
					<td>
						<div class="right">
							Right
<?php
							$Query = "SELECT * FROM content WHERE ColumnId = 3 ORDER BY SortSeq";
							
							$db->query($Query);
							while ($db->nextRecord())
							{
								echo "<HR/>";
								echo $db->Record['Content'];
							}

?>
						</div>
					</td>
				</tr>
		</table>
		<hr/>
			<div class="footer">
<?php
				$Query = "SELECT * FROM content WHERE ColumnId = 4 ORDER BY SortSeq";
				
				$db->query($Query);
				while ($db->nextRecord())
				{
					echo $db->Record['Content'];
					echo "<HR/>";
				}

?>
				This is the very bottom.
			</div>
		</div>
	</body>
</html>