<?php
include 'environment/dbinit.php';

class Database
{
	var $AESKey		= "ki8m3jop1x";

	var $Host;
	var $Database;
	var $User;
	var $Password;
	
	var $Link_ID  = 0;  // Result of mysql_connect().
	var $Query_ID = 0;  // Result of most recent mysql_query().
	var $Record   = array();  // current mysql_fetch_array()-result.
	var $Row;           // current row number.
	var $LoginError = "";

	var $Errno    = 0;  // error state of query...
	var $Error    = "";
	
//-------------------------------------------------------------
//  This constructor takes care of initializing the host, DB, user and password
//  Modify these values in the dbinit.php file, if necessary
//  Extending classes must remember to call this constructor using parent::__construct();
//-------------------------------------------------------------
	function Database() {
		Environment\DbInit($this->Host, $this->Database, $this->User, $this->Password);
	}

	function connect()
		{
		if( 0 == $this->Link_ID ) {
			$this->Link_ID=mysql_connect( $this->Host, $this->User, $this->Password );
			mysql_set_charset('utf8',$this->Link_ID);	//	Necessary in development for the connection to use UTF 8 encoding -- test on production
		}
		if( !$this->Link_ID )
			$this->halt( "Link-ID == false, connect failed" );
		if( !mysql_query( sprintf( "use %s", $this->Database ), $this->Link_ID ) )
			$this->halt( "cannot use database ".$this->Database );
		} // end function connect

//-------------------------------
//	Queries the database
//-------------------------------
	function query( $Query_String )
		{

		$this->connect();
		$this->Query_ID = mysql_query( $Query_String,$this->Link_ID );
		$this->Row = 0;
		$this->Errno = mysql_errno();
		$this->Error = mysql_error();
		if( !$this->Query_ID )
			$this->halt( "Invalid SQL: ".$Query_String );
		return $this->Query_ID;
		} // end function query

//-------------------------------
//	If error, halts the program
//-------------------------------
	function halt( $msg )
		{
		printf( "</td></tr></table><b>Database error:</b> %s<br>\n", $msg );
		printf( "<b>MySQL Error</b>: %s (%s)<br>\n", $this->Errno, $this->Error );
		die( "Session halted." );
		} // end function halt

//-------------------------------------------
//	Retrieves the next record in a recordset
//-------------------------------------------
	function nextRecord()
		{
		@ $this->Record = mysql_fetch_array( $this->Query_ID );
		$this->Row += 1;
		$this->Errno = mysql_errno();
		$this->Error = mysql_error();
		$stat = is_array( $this->Record );
		if( !$stat )
			{
			@ mysql_free_result( $this->Query_ID );
			$this->Query_ID = 0;
			}
		return $stat;
		} // end function nextRecord

//-------------------------------
//	Retrieves a single record
//-------------------------------
	function singleRecord()
		{
		$this->Record = mysql_fetch_array( $this->Query_ID );
		$stat = is_array( $this->Record );
		return $stat;
		} // end function singleRecord

//---------------------------------------------
//	Returns the number of rows  in a recordset
//---------------------------------------------
	function numRows()
		{
		return mysql_num_rows( $this->Query_ID );
		} // end function numRows

//-------------------------------
//	retrieves the last ID
//-------------------------------	
	function RetrieveLastId()
		{
		$Query = "Select LAST_INSERT_ID() As LastId";
		$this->query( $Query );
		$this->singleRecord();
		return $this->Record[ 'LastId' ];
		} // end function RetrieveLastId

	function loginForm($FormVariables)
		{
		echo "<p>You need to login to access this page. New users, <a href='register.php'>click here to register</a>.</p>\r\n";
		if (isset($this->LoginError))
			echo "<p>".$this->LoginError."</p>";
?>
<form name='form1' method='post'>
	<input type='hidden' name='Login' value='1'>
	<table cellpadding=0 cellspacing=2 border=0 class='bodytext'>
		<tr><td>Username</td><td></td>
			<td><input type='text' value='<?php echo $FormVariables['Username'] ?>' name='Username' style='width:150px'></td>
		<tr><td>Password</td><td></td>
			<td><input type='password' value='<?php echo $FormVariables['Password'] ?>' name='Password' style='width:150px'></td>
		</tr>
		<tr><td></td><td></td>
			<td><input type='submit' value='Login'></td></tr>
	</table>
</form>
<?php
	} // end function loginForm

} // end class Database
?>
