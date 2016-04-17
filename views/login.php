    <div id="reveal-top" class="reveal"></div>
    <div id="reveal-button">ACCESS</div>
    <div id="admin-button"><img id="admin-button" src="public/img/admin-icon.png" height="80" width="80"></div>
    <div id="back-button"><img id="back-button" src="public/img/arrow-icon.png" height="80" width="80"></div>
    <div id="pippy-app">
        <div id="pippy-model"></div>
        <form id="user-login" action="index.php?action=login" method="POST">
            <fieldset>
            <legend>ACCESS</legend>
                <input type="text" name="uname" placeholder="USERNAME"><br>
                <input type="password" name="pword" placeholder="PASSWORD"><br>
                <button id="user-login-button" class="login-button">SUBMIT</button>
            </fieldset>
        </form>
        <form id="admin-login" action="index.php?action=login" method="POST" class="hidden">
            <fieldset>
            <legend>ADMIN ACCESS</legend>
                <input type="text" name="uname" placeholder="USERNAME"><br>
                <input type="password" name="pword" placeholder="PASSWORD"><br>
                <!--<div class="login-button" id="admin-login-button">SUBMIT</div>-->
                <button id="admin-login-button" class="login-button">SUBMIT</button>
            </fieldset>
        </form>
    </div>
    <div id="reveal-bottom" class="reveal"></div>
    <script>
        (function(){
            var revealed = false;
            var adminRevealed = false;
            $('#reveal-button').click(function(){
                console.log('reveal button clicked');
                if(revealed){
                }else{
                    revealed = true;
                    $('#reveal-button').hide();
                    $('#reveal-top').slideUp();
                    $('#reveal-bottom').slideUp();
                    console.log('how hidden');
                };
            });
            $("#user-login").submit(function(e){
                console.log('user login submitted');
            });
            $("#admin-login").submit(function(e){
                console.log('admin login submitted');
            });
            $('#user-login-button').click(function(){
                console.log('user login button clicked');
            });
            $('#admin-login-button').click(function(){
                console.log('admin login button clicked');
            });
            $('#admin-button').click(function(){
                console.log('admin button clicked');
                if(adminRevealed){
                    $('#admin-login').hide();
                    $('#user-login').show();
                    adminRevealed = false;
                }else{
                    $('#user-login').hide();
                    $('#admin-login').show();
                    adminRevealed = true;
                };
            });
            $('#back-button').click(function(){
                console.log('back button clicked');
                if(revealed){
                    revealed = false;
                    $('#reveal-button').show();
                    $('#reveal-top').slideDown();
                    $('#reveal-bottom').slideDown();
                    console.log('now shown');
                }else{
                    revealed = true;
                    $('#reveal-button').hide();
                    $('#reveal-top').slideUp();
                    $('#reveal-bottom').slideUp();
                    console.log('how hidden');
                };
            });
        })();
    </script>
    <script>
        window.deg2rad = function(deg) { return deg * (Math.PI / 180); };
        initHTML5();
    </script>