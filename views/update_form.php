<div id="pippy-app">
    <div id="pippy-model"></div>
    <form action="index.php?action=Update_users&id=<?php echo '"'.$results[0]['id'].'"' ?>" method="POST">
        <fieldset>
        <legend>UPDATE USER</legend>
        	<input type="text" name="fname" placeholder="FIRST NAME" value=<?php echo '"'.$results[0]['firstname'].'"' ?>><br>
        	<input type="text" name="lname" placeholder="LAST NAME" value=<?php echo '"'.$results[0]['lastname'].'"' ?>><br>
        	<input type="text" name="email" placeholder="EMAIL" value=<?php echo '"'.$results[0]['email'].'"' ?>><br>
            <input type="text" name="uname" placeholder="USERNAME" value=<?php echo '"'.$results[0]['username'].'"' ?>><br>
            <input type="hidden" name="id" value=<?php echo '"'.$results[0]['id'].'"' ?>><br>
            <input type="submit">
        </fieldset>
    </form>
</div><!-- end #pippy-app -->