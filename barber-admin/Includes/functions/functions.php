
<?php
    
    /*
    	=========================================================================================================================
		Title Function That Echo The Page Title In Case The Page Has The Variable $pageTitle And Echo Default Title For Other Pages
		=========================================================================================================================
	*/

	function getTitle()
	{
		global $pageTitle;
		if(isset($pageTitle))
			echo $pageTitle.' | Twin & Dad Barbershop ';
		else
			echo "Barbershop | Twin & Dad Barbershop ";
	}

	/*
		=============================================================
		** Count Items Function
		** This function counts and return the number of elements in a given table
		==============================================================

	*/

	function countColumn ($column, $table) {
		@include 'connect.php';
		$sql = "SELECT COUNT($column) as count FROM $table";
		$result =mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)){
		return $row["count"];
		}
	}
	
    // function countItems($item,$table)
	// {
	// 	global $con;
	// 	$stat_ = $con->prepare("SELECT COUNT($item) FROM $table");
	// 	$stat_->execute();
		
	// 	return $stat_->fetchColumn();
	// }

	// function countRow($item, $table)
	// {
		//global $conn;
		// $sql = "SELECT COUNT $item FROM $table ";
		// $result = $conn->query($sql);
		// $row = $result->fetch_assoc();
        // include 'connect.php';
	// 	$sql = "SELECT COUNT($item) FROM $table";
    //     $result = mysqli_query($conn, $sql);
    //     $roww = mysqli_num_rows ($result);
    //     return $roww;
	// }
    /*
		=============================================================
		** Check Items Function
		** Function to Check Item In Database [Function with Parameters]
		** $select = the item to select [Example : user, item, category]
		** $from = the table to select from [Example : users, items, categories]
		** $value = The value of select [Example: Ossama, Box, Electronics]
		==============================================================

	*/

	function checkItem($select, $from, $value)
	{
		global $con;
		$statment = $con->prepare("SELECT $select FROM $from WHERE $select = ? ");
		$statment->execute(array($value));
		$count = $statment->rowCount();
		
		return $count;
	}

	/*
		==============================================
		TEST INPUT FUNCTION, IS USED FOR SANITIZING USER INPUTS
		AND REMOVE SUSPICIOUS CHARS and Remove Extra Spaces
		==============================================

	*/

	function test_input($data) 
	{
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}




