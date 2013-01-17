<?php
class Session extends Database
{

	var $Username;     //Username given on sign-up
  	var $UserId;       //Random value generated on current login
	var $UserStatusId;       //Random value generated on current login
	var $LoggedIn;   //Indicates whether the user is logged in or not
	var $CookieExpire; //100 days by default

//-------------------------------
//	This is the session constructor
// 	Creates a session and a session cart
//-------------------------------
	function Session()
	{
		parent::__construct();
		$this->startSession();
		
    /* Determine if user is logged in */
    $this->logged_in = $this->checkLogin();
		$this->CookieExpire = time()+60*60*24*100 ;

		if( !$this->isRegistered( "sessioncart" ) )
			$this->registerCart();
	}

//-------------------------------
//-------------------------------
	function startSession()
	{
		ini_set("session.gc_maxlifetime", "7200");
		session_start();
	}

//-------------------------------
//-------------------------------
	function isRegistered( $sessionvariable )
	{
		if( session_is_registered( $sessionvariable ) )
			return true;
		else
			return false;
	}

//-------------------------------
//-------------------------------
	function register( $sessionvariable )
	{
		//global ${$sessionvariable};
		session_register( $sessionvariable );
	}

//-------------------------------
//-------------------------------
	function registerCart()
	{
		//global $sessioncart;
		$sessioncart = array();
		session_register( "sessioncart" );
	}
	
	
/* //-------------------------------
//	Sets the session cart 
//	it takes in a cart array
//-------------------------------
	function setSessionCart( $cart )
	{
		$sessioncart = $cart;
	}
*/	
	
	function logSession()
		{
		if ( isset($this->UserId) && $this->UserId != -4441)
			{
			$Query = "INSERT INTO visit
									( Visit_Date, UserId, IP ) VALUES
									( '".date('Y-m-d H:i:s',time())."', ".$this->UserId.", '".$_SERVER['REMOTE_ADDR']."' )";
			$this->query($Query);
			}
		} // end function logSession

	
	function login( $Username, $Password, $AutoLogin )
	{
		/* Username error checking */
		if( !$Username || strlen( trim( $Username ) ) == 0 )
		{
			$this->LoginError = "You failed to enter a username.";
			return false;
		}
			
		/* Password error checking */
		if( !$Password )
		{
			$this->LoginError = "You failed to enter a password.";
			return false;
		}
				
		/* Checks that username is in database and password is correct */
		$Query = "SELECT * 
							FROM user 
							WHERE Username = '".$_POST['Username']."' 
							AND Password = AES_ENCRYPT('".$_POST['Password']."', '".$this->AESKey."')
							AND User_LevelId > 0";
		$this->query($Query);
		if( !$this->numRows() )
			{
			$this->LoginError = "Your login was unsuccessful.";
			return false;
			}
		else
			{
			$this->singleRecord();
			/* Username and password correct, register session variables */
			$this->Username  = $_SESSION['Username'] = $_POST['Username'];
			$this->UserId    = $_SESSION['UserId']   = $this->Record['UserId'];
			$this->User_LevelId    = $_SESSION['User_LevelId']   = $this->Record['User_LevelId'];
			$this->Moderator    = $_SESSION['Moderator']   = $this->Record['Moderator'];
			$this->LoggedIn = 1;
			$this->logSession();
			if( $AutoLogin )
				setcookie( "UserId", $this->UserId, $this->CookieExpire );
			return true;
			} // end if username/password is in database
	} // end function login
	
	function logout()
	{
    if( isset( $_COOKIE[ 'UserId' ] ) )
      setcookie( "UserId", $this->UserId, time()-60*60*24*100 );

    /* Unset PHP session variables */
    unset( $_SESSION[ 'Username' ] );
    unset( $_SESSION[ 'UserId' ] );

    $this->LoggedIn = 0;

		session_destroy(); 
	} // end function logout
	 
	 
	function checkLogin()
		{
		// Check if user has an existing session
    if( isset( $_SESSION[ 'UserId' ] ) )
			{
      $this->LoggedIn  = 1;
      $this->Username  = $_SESSION['Username'];
      $this->UserId    = $_SESSION['UserId'];
			$this->User_LevelId = $_SESSION['User_LevelId'];
			if (!isset($_SESSION['Moderator']))
				$_SESSION['Moderator'] = '';
			$this->Moderator    = $_SESSION['Moderator'];
     	return 1;
			}
		
    // Check if user has a cookie
	/*
	if( isset( $_COOKIE[ 'UserId' ] ) )
			{
			//echo "<h1>COOKIE BUT NOT LOGGED IN</h1>";
      $this->LoggedIn  = 1;
			$Query = "SELECT * 
				FROM user 
				WHERE UserId = ".$_COOKIE['UserId'];
			$this->query( $Query );
			$this->singleRecord();
			$_SESSION['UserId']       = $this->UserId       = $_COOKIE['UserId'];
 			$_SESSION['Username']     = $this->Username     = $this->Record['Username'];
			$_SESSION['User_LevelId'] = $this->User_LevelId = $this->Record['User_LevelId'];
			$_SESSION['Moderator']    = $this->Moderator    = $this->Record['Moderator'];
			$this->logSession();
     	return 1;
			}
    else
			{
      //echo "<h1>NO COOKIE, NOT LOGGED IN</h1>";
			$this->LoggedIn  = 0;
      return 0;
			}*/
		} // end function checkLogin
	
}
?>