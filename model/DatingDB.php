<?php
/*
 * Sofiya Antonyuk
 * IT 328
 * Dating Website
 * http://sofiya.greenrivertech.net/328/dating
 */

/**
*CREATE TABLE `Members`
*   ( `member_id` INT NOT NULL AUTO_INCREMENT , `fname` TEXT NOT NULL ,
*    `lname` TEXT NOT NULL , `age` TINYINT NOT NULL ,
*    `gender` TEXT , `phone` VARCHAR(14),
*    `email` VARCHAR(30), `state` TEXT, `seeking` TEXT,
*    `bio` VARCHAR(255), `premium` TINYINT(1) NOT NULL , `image` VARCHAR(100),
*    `interests` VARCHAR(255), PRIMARY KEY (`member_id`) ) ENGINE = MyISAM;
*
*    Class provides access to member names in our database
*    @author Sofiya Antonyuk <santonyuk2@mail.greenriver.edu>
*    @version 1.0
*    @copyright 2017
*/

//Connect to DB
class DatingDB
{
	private $_pdo;
	
	function __construct()
	{
		//Require config file may need to change to absolute path in future
		require_once("../../../config.php");
		try
		{
			//Establish DB connection
			$this->_pdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            
			//Keep connection open for reuse to improve performance
			$this->_pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
			
			//Throw an exception whenever a DB error occurs
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch(PDOException $e)
		 {
             die("Error!: ". $e->getMessage());
         } 
		
	}
	
	/**
	 * Function to add a new member into the database.
	 * @param string to set values of the member information
	 */
	//Add a member into the table
	function addMember($fname, $lname, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image, $interests)
        {
           $insert = 'INSERT INTO Members (fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests)
           VALUES(:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)';
           
           $statement = $this->_pdo->prepare($insert);
           $statement->bindValue(':fname', $fname, PDO::PARAM_STR);
           $statement->bindValue(':lname', $lname, PDO::PARAM_STR);
           $statement->bindValue(':age', $age, PDO::PARAM_INT);
           $statement->bindValue(':gender', $gender, PDO::PARAM_STR);
           $statement->bindValue(':phone', $phone, PDO::PARAM_STR);
           $statement->bindValue(':email', $email, PDO::PARAM_STR);
           $statement->bindValue(':state', $state, PDO::PARAM_STR);
           $statement->bindValue(':seeking', $seeking, PDO::PARAM_STR);
           $statement->bindValue(':bio', $bio, PDO::PARAM_STR);
           $statement->bindValue(':premium', $premium, PDO::PARAM_INT);
           $statement->bindValue(':image', $image, PDO::PARAM_STR);
           $statement->bindValue(':interests', $interests, PDO::PARAM_STR);
           
           $statement->execute();
		   
		   //Return ID of inserted row
            return $this->_pdo->lastInsertId();
        }
		
		/**
		 * Function that returns all members in the database.
		 * @return array of all members
		 */
		function allMembers()
        {
          $select = 'SELECT member_id, fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests FROM Members ORDER BY lname';
          $results = $this->_pdo->query($select);
          $resultsArray = array();
          
		  //Map each member id to a row of data for that member
          while($row = $results->fetch(PDO::FETCH_ASSOC))
		  {
            $resultsArray[$row['member_id']] = $row;
          }
          return $resultsArray;
        }
}