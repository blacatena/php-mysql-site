<?php
namespace Environment;
/**
 * 
 * COPY THIS FILE into your environment folder.
 * 
 * You may change that copy, which will be used to access the database, should you wish to change the host, name, user or password used to access YOUR database.
 * 
 * DO NOT change this file. This is the basic copy to be used by new developers to set up their environments.
 * 
 */
function DbInit(&$Host, &$Database, &$User, &$Password)
	{
 		$Host     = "localhost";		// Hostname of our MySQL server.
 		$Database = "phpmysqlsite";		// Logical database name on that server.
 		$User     = "phpuser";			// User und Password for database access.
		$Password = "phppass";
	}