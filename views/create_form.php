<div id="pippy-app-createuser">
    <div id="pippy-model"></div>
    <form action="index.php?action=createUser" method="POST">
        <fieldset>
        <legend>CREATE USER</legend>
        	<input type="text" name="fname" placeholder="FIRST NAME"><br>
        	<input type="text" name="lname" placeholder="LAST NAME"><br>
        	<input type="text" name="email" placeholder="EMAIL"><br>
            <input type="text" name="uname" placeholder="USERNAME"><br>
            <input type="password" name="pword" placeholder="PASSWORD"><br>
            <select name='admin'>
                <option value="">Select User</option>
                <option value="1">User</option>
                <option value="2">Admin</option>
            </select><br>
            <input type="submit">
        </fieldset>
    </form>
</div><!-- end #pippy-app -->