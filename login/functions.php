<?php 

class func 
{
	public static function checkLoginState($dbh)
	{
		if (!isset($_SESSION))
		{
			session_start();
		}
		if (isset($_COOKIE['userid']) && isset($_COOKIE['token']))
		{
			$query = "SELECT * FROM SESSIONS WHERE SESSION_USER_ID = :userid AND SESSION_TOKEN = :token";

			$userid = $_COOKIE['userid'];
			$token = $_COOKIE['token'];

			$stmt = $dbh->prepare($query);
			$stmt->execute(array(':userid' => $userid, 
								 ':token' => $token));

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($row['SESSION_USER_ID'] > 0)
			{
				if (
					$row['SESSION_USER_ID'] == $_COOKIE['userid'] &&
					$row['SESSION_TOKEN']  == $_COOKIE['token']
					)
				{
					if (
					$row['SESSION_USER_ID'] == $_SESSION['userid'] &&
					$row['SESSION_TOKEN']  == $_SESSION['token']
						)
					{
						return true;
					}
					else
					{
						func::createSession($_COOKIE['username'], $_COOKIE['userid'], $_COOKIE['token']);
						return true;
					}
				}
			}
		}
	}

	public static function createRecord($dbh, $user_username, $user_id, $user_type)
	{
		$query = "INSERT INTO SESSIONS (SESSION_USER_ID, SESSION_TOKEN) VALUES (:user_id, :token);";
		
		$dbh->prepare("DELETE FROM SESSIONS WHERE SESSION_USER_ID= :SESSION_USER_ID;")->execute(array(':SESSION_USER_ID' => $user_id));

		$token = func::createString(30);
		$serial = func::createString(30);

		func::createCookie($user_username, $user_id, $token, $user_type);
		func::createSession($user_username, $user_id,  $token,$user_type);

		$stmt = $dbh->prepare($query);
		$stmt->execute(array(':user_id' => $user_id,
							 ':token' => $token));
	}

	public static function createCookie($user_username, $user_id, $token, $user_type)
	{
		setcookie('userid', $user_id, time() + (86400) * 30, "/");
		setcookie('username', $user_username, time() + (86400) * 30, "/");
		setcookie('token', $token, time() + (86400) * 30, "/");
		setcookie('usertype', $user_type, time() + (86400) * 30, "/");
	}

	public static function deleteCookie()
	{
		setcookie('userid', '', time() - 1, "/");
		setcookie('username', '', time()  - 1, "/");
		setcookie('token', '', time()  - 1, "/");
		setcookie('usertype', '', time()  - 1, "/");
	}

	public static function createSession($user_username, $user_id, $token, $user_type)
	{
		if (!isset($_SESSION))
		{
			session_start();
		}
		$_SESSION['userid'] = $user_id;
		$_SESSION['token'] = $token;
		$_SESSION['userType'] = $user_type;
		$_SESSION['username'] = $user_username;
	}

	public static function createString($len)
	{
		$string = "1qay2wsx3edc4rfv5tgb6zhn7ujm8ik9olpAQWSXEDCVFRTGBNHYZUJMKILOP";
		
		return substr(str_shuffle($string), 0, 30);
	}
}

 ?>