
<hr>

<h1>Permissions table</h1>
<div class="huh">
	<table>
		<tr>
			<th>User Name</th>
			<th>Permission Level</th>
			<th>Floor Number</th>
			<th>Delete</th>
		</tr>
		<?php
		foreach ($results as $result) {
			echo "<tr>";
				echo "<td>";
					print_r($result['username']);
				echo "</td>";
				echo "<td>";
					print_r($result['accessLevel']);
				echo "</td>";
				echo "<td>";
					print_r($result['floorName']);
				echo "</td>";
				echo "<td>";
				echo '<a href="index.php?action=delete&id=' . $result['groupId'] . '">Delete</a><br>';
				echo "</td>";	
			echo "</tr>";
		}
		?>	
	</table>
</div>