<div>
	<h1>Users Table</h1>
	<table>
		<tr>
			<th>User Name</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Admin</th>
			<th>Update</th>
			<th>Delete</th>
		</tr>
		<?php
		foreach ($results as $result) {
			echo "<tr>";
				echo "<td>";
					print_r($result['username']);
				echo "</td>";
				echo "<td>";
					print_r($result['firstname']);
				echo "</td>";
				echo "<td>";
					print_r($result['lastname']);
				echo "</td>";
				echo "<td>";
					print_r($result['email']);
				echo "</td>";
				echo "<td>";
					print_r($result['admin']);
				echo "</td>";
				echo "<td>";
					echo '<a href="index.php?action=Update_users_form&id=' . $result['id'] . '">Update</a><br>';
				echo "</td>";
				echo "<td>";
					echo '<a href="index.php?action=delete_users&id=' . $result['id'] . '">Delete</a><br>';
				echo "</td>";
					
			echo "</tr>";
		}
		?>	
	</table>
</div>
<br>
