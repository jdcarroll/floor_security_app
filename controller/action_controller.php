<?php
//session
session_start();
//error reporting
ini_set('display_errors','On');
//update error reporitng on the fly
error_reporting(E_ALL | E_STRICT);
//include model classes
include("model/db.php");
include("model/login.php");
include("model/view.php");
//instantiate model classes
$views = new Views();
$login = new UserLogin();
$dbh = new DB();
//if action is not empty
if(!empty($_GET['action'])){
    //if action is login
    if($_GET["action"] == 'login'){
        //set user/password variables
        $username = $_POST['uname'];
        $password = $_POST['pword'];
        //run login check
        $user = $login->check_login($username, $password);
        //if user var is not empty and admin is 1
        if(!empty($user) && $user[0]['admin'] == 1){
            //run database adminRead
            $data = $dbh->adminRead();
            //compose admin profile page
            $views->getView('views/header.php');
            $views->getView('views/back.php');
            
            //*************************
            //HAD TO MANUALLY COMPOSE HTML, I KNOW RIGHT?
            //open pippywindow

            // echo '<div class="pippywindow">';
            // //NOTE: needs a $VARFORPROFILEPIC var
            // //NOTE: needs a $VARFORPERMISSIONS
            // echo '<div>'
            //     . '<h1 class="user-name">USER:</h1><p>'
            //     . $username 
            //     . '<p><h1 class="user-perm">ACCESS:</h1><p>' 
            //     . 'ADMIN'
            //     . '</div>'
            //     . '<div>'
            //     . '<h1 class="user-photo-title">PICTURE:</h1><img src="' 
            //     . '$NEEDSVARFORPROFILEPIC' 
            //     . '" height="200" width="200">'
            //     . '</div>';
            $views->getView('views/admin_profile.php', $data);
            $views->getView('views/nav.php');
            //NOT INCLUDING, MOVING EVERYTHING INTO THE USERS LINK
            //echo $views->getView('views/admin.php', $data);
            //close pippywindow
            echo '</div>';
            //*************************
            
            $views->getView('views/footer.php');
        //if user var is not empty and admin is 0
        }else if(!empty($user) && $user[0]['admin'] == 0) {
            //compose user profile page
            $views->getView('views/header.php');
            $views->getView('views/back.php');
            
            //*************************
            //HAD TO MANUALLY COMPOSE HTML, I KNOW RIGHT?
            //open pippywindow
            
            //NOTE: needs a $VARFORPROFILEPIC var
            //NOTE: needs a $VARFORPERMISSIONS
            echo '<div>'
                . '<h1 class="user-name">USER:</h1><p>'
                . $username 
                . '<p><h1 class="user-perm">ACCESS:</h1><p>' 
                . '$NEEDSVARFORPERMISSIONS'
                . '</div>'
                . '<div>'
                . '<h1 class="user-photo-title">PICTURE:</h1><img src="' 
                . '$NEEDSVARFORPROFILEPIC' 
                . '" height="200" width="200">'
                . '</div>';
            //close pippywindow
            
            //*************************
            
            $views->getView('views/footer.php');
        //else compose login page
        }else{
            $views->getView("views/header.php");
            $views->getView("views/login.php");
            $views->getView("views/footer.php");
        }
    //if action is delete
    }else if($_GET["action"] == 'profile'){
            $data = $dbh->adminRead();
            //compose admin profile page
            $views->getView('views/header.php');
            $views->getView('views/back.php');
            $views->getView('views/admin_profile.php', $data);
            $views->getView('views/nav.php');
    }else if($_GET['action'] == 'delete'){
        //get id
        $id = $_GET['id'];
        //delete it
        $dbh->deleteUser($id);
        //run adminRead
        $data = $dbh->adminRead();
        //compose admin profile page
        header('location:?action=users');
    //if action is createUser_form
    }else if($_GET['action'] == 'createUser_form'){
        //compose create form page
        $views->getView("views/header.php");
        $views->getView('views/back.php');
        
        //*************************
        //HAD TO MANUALLY COMPOSE HTML, I KNOW RIGHT?
        //open pippywindow
        
         $views->getView("views/create_form.php");
         $views->getView('views/nav.php');
        //NOT INCLUDING, MOVING EVERYTHING INTO THE USERS LINK
        //echo $views->getView('views/admin.php', $data);
        //close pippywindow
        
        //*************************
        
        $views->getView("views/footer.php");
    //if action is createUser
    }else if($_GET['action'] == 'createUser'){
        //if anything is empty
        if(empty($_POST['fname']) || empty($_POST['lname']) ||
           empty($_POST['email']) || empty($_POST['uname']) || 
           empty($_POST['pword']) || empty($_POST['admin'])){
            //compose create form page
            header('location:?action=createUser_form');
        //else compose admin profile page
        }else{
            $dbh->createUser();
            $data = $dbh->adminRead();
            header('location:?action=users');
        }
    //if action is createPerm_form
    }else if($_GET['action'] == 'createPerm_form'){
        //compose perm page
        $data = $dbh->permissions();
        $views->getView('views/header.php');
        $views->getView('views/back.php');
        
        //*************************
        //HAD TO MANUALLY COMPOSE HTML, I KNOW RIGHT?
        //open pippywindow
        
        $views->getView('views/perm.php', $data);
        $views->getView('views/nav.php');
        //NOT INCLUDING, MOVING EVERYTHING INTO THE USERS LINK
        //echo $views->getView('views/admin.php', $data);
        //close pippywindow
       
        //*************************
        
        $views->getView('views/footer.php');
    //if action is createPerm
    }else if($_GET['action'] == 'createPerm'){
        //run createPerm()
        $dbh->createPerm();
        //run adminRead()
        $data = $dbh->adminRead();
        //compose admin profile page
        header('location:?action=users');
    //if action is users
    }else if($_GET['action'] == 'users'){
        //run readUsers();
        $data = $dbh->readUsers();
        $data2 = $dbh->adminRead();
        //compose user profile page
        $views->getView('views/header.php');
        
        $views->getView('views/back.php');
        
        //*************************
        //HAD TO MANUALLY COMPOSE HTML, I KNOW RIGHT?
        //open pippywindow
        
        $views->getView('views/users.php', $data);
        $views->getView('views/admin.php', $data2);
        $views->getView('views/nav.php');
        //NOT INCLUDING, MOVING EVERYTHING INTO THE USERS LINK
        //echo $views->getView('views/admin.php', $data);
        //close pippywindow
        
        //*************************
        
        $views->getView('views/footer.php');
    //if action is Update_users_form
    }else if($_GET['action'] == 'Update_users_form'){
        //run getUsers()
        $data = $dbh->getUser();
        //compose update form page
        $views->getView('views/header.php');
        $views->getView('views/update_form.php', $data);
        $views->getView('views/nav.php');
        echo "</div>";
        $views->getView('views/footer.php');
    //if action is Update_users
    }else if($_GET['action'] == 'Update_users'){
        //run updateUsers()
        $dbh->updateUser();
        //run readUsers
        $data = $dbh->readUsers();
        //compose user profile page
       header('location:?action=users');
    //if action is delete_users
    }else if($_GET['action'] == 'delete_users'){
        //get id
        $id = $_GET['id'];
        //run delete_user() with id
        $dbh->delete_user($id);
        //run readUsers()
        $data = $dbh->readUsers();
        //compose user profile page
        header('location:?action=users');
    }
//else compose login page
}else {
    $views->getView("views/header2.php");
//    $views->getView("views/login_form.php");
    $views->getView("views/login.php");
    $views->getView("views/footer2.php");
}
?>