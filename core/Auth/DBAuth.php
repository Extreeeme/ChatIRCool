<?php
namespace Core\Auth;
use Core\Database\Database;
/**
* classe pour la connexion au site via une base de donné
*/
class DBAuth
{
	protected $db;
	function __construct(Database $db)
	{
		$this->db = $db;
	}

	public function login($username, $password)
	{
		$user = $this->db->prepare("SELECT *
									FROM users
									WHERE name = ?
									AND valid_at IS NOT NULL",
									[$username], null, true);
		if($user){
			if ($user->password === sha1($password)) {
				$_SESSION['Auth'] = $user->id;
				return true;
			}
		}
		return false;
	}

	public function mymail($email, $name)
	{
		require_once dirname(__DIR__, 2)."/vendor/function.php";
		$user = $this->db->prepare("SELECT *
									FROM users
									WHERE name = ?",
									[$name], null, true);
		my_mail(
				$email,
				$name,
				"Confirmation de votre compte",
				"Mail de confirmation : Merci de cliquer sur le lien pour confirmer votre  compte<br/>\n\n http://chat-ircool.loc/index.php?p=confirm&id=$user->id&token=$user->valid_token"
				);
		return true;
	}

	public function confirm($id, $token)
	{
		$user = $this->db->prepare("SELECT *
										FROM users
										WHERE id = ?",
										[$id], null, true);
		if($user && $user->valid_token == $token){
			$user = $this->db->prepare("UPDATE users
											SET valid_token = NULL,
											valid_at = NOW()
											WHERE id = ?",
											[$id], null, true);
			return true;
		}else{
			return false;
		}
	}

	public function register($username, $password, $passwordRetype, $email)
	{
		if(empty($username) || !preg_match('/^[a-zA-Z0-9_]+$/', $username)){
			return false;
		}elseif(empty($password) || $password != $passwordRetype){
			return false;
		}elseif(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
			return false;
		}else{
			$user = $this->db->prepare("SELECT *
									FROM users
									WHERE name = ?",
									[$username], null, true);
			if($user){
				return false;
			}

			$user = $this->db->prepare("SELECT *
										FROM users
										WHERE email = ?",
										[$email], null, true);

			if($user){
				return false;
			}

			if($password === $passwordRetype){
				require_once dirname(__DIR__, 2)."/vendor/function.php";
				$token = str_random(60);
				$password = sha1($password);
				// INSERT INTO user SET pseudo = ?, mail = ?, password = ?, valid_token = ?
				$this->db->prepare("INSERT INT0 users
										SET name = ?,
											email = ?,
											password = ?,
											va1id_token = ?",
										[$username, $email, $password, $token], null, true);
				return true;
			}else{
				return false;
			}
		}
	}

	public function logged()
	{
		return isset($_SESSION['Auth']);
	}

	public function getUserId()
	{
		if ($this->logged()) {
			return $_SESSION['Auth'];
		}else{
			return false;
		}

	}

	public function sendMessage($message, $color="b")
	{
		if (empty($_POST['message'])){

		}else{
			$message = htmlspecialchars($message);
			$color = "b";
			if($message[0] == "/"){
				if($message[1] == "V"){
					$color = "V";
					$message = substr($message, 3);
				}elseif($message[1] == 'r'){
					$messageTab = explode(' ', $message);
					$idMessage = $messageTab[1];

					$this->db->prepare("DELETE FROM timelines
											WHERE id = ?",
											[$idMessage], null, true);
					return true;
				}
			}
			$user = $this->db->prepare("SELECT *
										FROM users
										WHERE id = ?",
										[$_SESSION['Auth']], null, true);
			$this->db->prepare("INSERT INTO timelines
											SET name = ?,
												message = ?,
												color = ?",
											[$user->name, $message, $color], null, true);
			return true;
		}

	}

}