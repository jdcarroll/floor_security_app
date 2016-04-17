<?php
?>
<div id="pippy-app-permissions">
    <div id="pippy-model"></div>
    <form action="index.php?action=createPerm" method="POST">
        <fieldset>
        <legend>CREATE USER PERMISSIONS</legend>
        	<select name='user'>
                <option value="">Select a User</option>
                <?php  
                    for ($x = 0; $x < sizeof($results[1]); $x++) {
                        $value = $results[1][$x]['id'];
                        echo "<option value='$value'>";
                        echo $results[1][$x]['fullname'];
                        echo "</option>";
                    }
                ?>
            </select><br>
            <select name='access'>
                <option value="">Select Access</option>
                <?php  
                for ($x = 0; $x < sizeof($results); $x++) {
                    $value = $x +1;
                    echo "<option value='$value'>";
                    echo $results[0][$x]['accessLevel'];
                    echo "</option>";
                }                     
                ?>
            </select><br>
            <select name='floor'>
                <option value="">Select a Floor</option>
                <?php  
                for ($x = 0; $x < sizeof($results[2]); $x++) {
                    $value = $x +1;
                    echo "<option value='$value'>";
                    echo $results[2][$x]['floorName'];
                    echo "</option>";
                }
                ?>
            </select><br>
            <input type="submit">
        </fieldset>
    </form>
</div><!-- end #pippy-app-permissions -->