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

//-------------------------------
//-------------------------------
	
	function logSession()
	{
		if ( isset($this->UserId))
			{
// 			$Query = "INSERT INTO visit
// 									( Visit_Date, UserId, IP ) VALUES
// 									( '".date('Y-m-d H:i:s',time())."', ".$this->UserId.", '".$_SERVER['REMOTE_ADDR']."' )";
// 			$this->query($Query);
			}
	} // end function logSession

//-------------------------------
//-------------------------------

	
	function login( $Username, $Password )
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
							AND Password = AES_ENCRYPT('".$_POST['Password']."', '".$this->AESKey."')";
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
			$this->LoggedIn = 1;
			$this->logSession();
			return true;
		} // end if username/password is in database
	} // end function login

//-------------------------------
//-------------------------------
	
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

//-------------------------------
//-------------------------------
	 
	 
	function checkLogin()
	{
		// Check if user has an existing session
			if( isset( $_SESSION[ 'UserId' ] ) )
			{
				$this->LoggedIn  = 1;
				$this->Username  = $_SESSION['Username'];
				$this->UserId    = $_SESSION['UserId'];
				return 1;
			}
		
	} // end function checkLogin
	
}
?>