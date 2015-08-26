<?php

/*
V0.95 13 Mar 2001 (c) 2000, 2001 John Lim (jlim@natsoft.com.my). All rights reserved.
  Released under Lesser GPL library license. See License.txt.
  Set tabs to 8.
  
  MySQL code that supports transactions. For MySQL 3.23 or later.
  Code from James Poon <jpoon88@yahoo.com>
  
  Requires mysql client. Works on Windows and Unix.
*/


include_once("$ADODB_DIR/adodb-mysql.inc.php");


class ADODB_mysqlt extends ADODB_mysql {
	var $databaseType = 'mysqlt';
	
	function BeginTrans()
	{       
		$this->Execute('SET AUTOCOMMIT=0');
		$this->Execute('BEGIN');
		return true;
	}
	
	function CommitTrans()
	{
		$this->Execute('COMMIT');
		$this->Execute('SET AUTOCOMMIT=1');
		return true;
	}
	
	function RollbackTrans()
	{
		$this->Execute('ROLLBACK');
		$this->Execute('SET AUTOCOMMIT=1');
		return true;
	}

}

class ADORecordSet_mysqlt extends ADORecordSet_mysql{	
	var $databaseType = "mysqlt";
	
	function ADORecordSet_mysqlt($queryID) {
		return $this->ADORecordSet_mysql($queryID);
	}
}
?>