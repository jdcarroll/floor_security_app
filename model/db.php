<?php  
	class DB {
		public function Connect_DB(){
			$user = 'root';
			$pass = 'root';

			$dbh = new PDO('mysql:host=localhost;dbname=Pippy;port=8889',
				$user, $pass);

			return $dbh;
		}
		public function loginUser($user, $pass){
			$dbh = $this->Connect_DB();
			$stmt = $dbh->prepare('SELECT * FROM users WHERE username= :username AND password = :password');
			$stmt->bindParam(':username', $user);
			$stmt->bindParam(':password', $pass);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		public function createUser(){
			$salt = 'seasalt';
			$user = $_POST['uname'];
			$password = $_POST['pword'];
			$md5 = md5($password . $salt);
			$firstName = $_POST['fname'];
			$lastName = $_POST['lname'];
			$email = $_POST['email'];
			if($_POST['admin'] == 1){
				$admin = 0;
			}else{
				$admin = 1;
			}
			$dbh = $this->Connect_DB();
			$stmt = $dbh->prepare("INSERT INTO users (username, 
													  password, 
													  firstname, 
													  lastname, 
													  email, 
													  admin)
								   		  VALUES (:username, 
								   		   		  :password, 
								   		   		  :firstname,
								   		   		  :lastname,
					  			   		   		  :email,
								   		   		  :admin);");
			$stmt->bindParam(':username', $user);
			$stmt->bindParam(':password', $md5);
			$stmt->bindParam(':firstname', $firstName);
			$stmt->bindParam(':lastname', $lastName);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':admin', $admin);
			$stmt->execute();
		}
		public function adminRead(){
			$dbh = $this->Connect_DB();
			$stmt = $dbh->prepare("SELECT group2get.id as groupId,
										  users.id, 
										  users.username, 
									 	  permissions.accessLevel, 
										  floor.floorName
								   FROM users
								   JOIN group2get ON group2get.userid = users.id
								   JOIN floor ON group2get.floorNum =  floor.id
								   JOIN permissions ON group2get.permLevel = permissions.id;");
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		public function permissions(){
			$dbh = $this->Connect_DB();
			$stmt = $dbh->prepare('SELECT * FROM permissions');
			$stmt->execute();
			$result1 = $stmt->fetchAll();
			$stmt2 = $dbh->prepare('SELECT CONCAT(firstname, " ", lastname) as fullname, id FROM users');
			$stmt2->execute();
			$result2 = $stmt2->fetchAll();
			$stmt3 = $dbh->prepare('SELECT floorName FROM floor');
			$stmt3->execute();
			$result3 = $stmt3->fetchAll();
			$results = [];
			array_push($results, $result1, $result2, $result3);
			return $results;
		}
		public function createPerm(){
			$dbh = $this->Connect_DB();
			$user = $_POST['user'];
			$access = $_POST['access'];
			$floor = $_POST['floor'];
			$stmt = $dbh->prepare('INSERT INTO group2get
								   			   (userid, 
								   			   	permLevel, 
								   			   	floorNum)
								   VALUES (:userid,
								   		   :permLevel,
								   		   :floorNum)');
			$stmt->bindParam(':userid', $user);
			$stmt->bindParam(':permLevel', $access);
			$stmt->bindParam(':floorNum', $floor);
			$stmt->execute();
		}
		public function getUser(){
			$id = $_GET['id'];
			$dbh = $this->Connect_DB();
			$stmt = $dbh->prepare('SELECT * FROM users WHERE id = :id');
			$stmt->bindParam('id', $id);
			$stmt->execute();
			$results = $stmt->fetchAll();
			return $results;
		}
		public function updateUser(){
			$dbh = $this->Connect_DB();
			$id = $_POST['id'];
			$user = $_POST['uname'];
			$firstName = $_POST['fname'];
			$lastName = $_POST['lname'];
			$email = $_POST['email'];
			$stmt = $dbh->prepare("UPDATE users SET username = :username, 
													firstname = :firstname, 
													lastname = :lastname,
													email = :email
								   WHERE id = :id");
			$stmt->bindParam(':id', $id);
			$stmt->bindParam(':username', $user);
			$stmt->bindParam(':firstname', $firstName);
			$stmt->bindParam(':lastname', $lastName);
			$stmt->bindParam(':email', $email);
			$stmt->execute();
		}
		public function readUsers(){
			$dbh = $this->Connect_DB();
			$stmt = $dbh->prepare('SELECT * FROM users');
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		public function deleteUser($id){
			$dbh = $this->Connect_DB();
			$stmt = $dbh->prepare("DELETE 
								   FROM group2get 
								   WHERE id = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
		}
		public function delete_user($id){
			$dbh = $this->Connect_DB();
			$stmt = $dbh->prepare("DELETE 
								   FROM users 
								   WHERE id = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
		}
	}
?>