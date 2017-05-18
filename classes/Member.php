<?php
/*
 * Sofiya Antonyuk
 * IT 328
 * Dating Website
 * http://sofiya.greenrivertech.net/328/dating
 */

 /**
  * Class to represent a regular member on the dating site.
  * @author Sofiya Antonyuk <santonyuk2@mail.greenriver.edu>
  * @version 1.0
  * @copyright 2017
  */
class Member
{
	protected $fname;
	protected $lname;
	protected $age;
	protected $gender;
	protected $phone;
	protected $email;
	protected $state;
	protected $seeking;
	protected $bio;
	
	/**
	 * Function to create a new member and the default values.
	 */
	//construct function to set default values for new members
	function __construct($fname="first name", $lname="last name", $age="age",
						 $gender="gender", $phone="phone number", $email="email",
						 $state="state", $seeking="seeking", $bio="bio")
	{
		$this->fname = $fname;
		$this->lname = $lname;
		$this->age = $age;
		$this->gender = $gender;
		$this->phone = $phone;
		$this->email = $email;
		$this->state = $state;
		$this->seeking = $seeking;
		$this->bio = $bio;
	}
	
	/**
	 * Function to set members first name.
	 * Sets default to "Unknown" if field is empty.
	 * @param string members first name
	 */
	//getter and setter for first name
	function setFname($fname)
	{
		if($fname == "")
		{
			$fname = "Unkown";
        }
		$this->fname = $fname;
	}
	
	/**
	 * Function to get members first name.
	 * @return string members first name
	 */
	function getFname()
	{
		return $this->fname;
	}
	
	/**
	 * Function to set members last name.
	 * Sets default to "Unknown" if field is empty.
	 * @param string members last name
	 */
	//getter and setter for last name
	function setLname($lname)
	{
		if($lname == "")
		{
			$lname = "Unkown";
        }
		$this->lname = $lname;
	}
	
	/**
	 * Function to get members last name.
	 * @return string members last name
	 */
	function getLname()
	{
		return $this->lname;
	}
	
	/**
	 * Function to set members age.
	 * Sets default to "18" if field is empty.
	 * @param string members age
	 */
	//getter and setter for age
	function setAge($age)
	{
		if($age < 18)
		{
			$age = 18;
        }
		$this->age = $age;
	}
	
	/**
	 * Function to get members age.
	 * @return string members age
	 */
	function getAge()
	{
		return $this->age;
	}
	
	/**
	 * Function to set members gender.
	 * @param string members gender
	 */
	//getter and setter for gender
	function setGender($gender)
	{
		$this->gender = $gender;
	}
	
	/**
	 * Function to get members gender.
	 * @return string members gender
	 */
	function getGender()
	{
		return $this->gender;
	}
	
	/**
	 * Function to set members phone number.
	 * @param string members phone number
	 */
	//getter and setter for phone
	function setPhone($phone)
	{
		$this->phone = $phone;
	}
	
	/**
	 * Function to get members phone number.
	 * @return string members phone number
	 */
	function getPhone()
	{
		return $this->phone;
	}
	
	/**
	 * Function to set members email.
	 * @param string members email
	 */
	//getter and setter for email
	function setEmail($email)
	{
		$this->email = $email;
	}
	
	/**
	 * Function to get members email.
	 * @return string members email
	 */
	function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * Function to set members state of residence.
	 * Sets default to "State" if field is empty.
	 * @param string members state
	 */
	//getter and setter for state
	function setState($state)
	{
		if($state == "")
		{
			$state = "State";
        }
		$this->state = $state;
	}
	
	/**
	 * Function to get members state of residence.
	 * @return string members state
	 */
	function getState()
	{
		return $this->state;
	}
	
	/**
	 * Function to set members seeking gender preference.
	 * @param string members seeking gender
	 */
	//getter and setter for seeking
	function setSeeking($seeking)
	{
		$this->seeking = $seeking;
	}
	
	/**
	 * Function to get members seeking gender preference.
	 * @return string members seeking gender
	 */
	function getSeeking()
	{
		return $this->seeking;
	}
	
	/**
	 * Function to set members biography.
	 * @param string members biography
	 */
	//getter and setter for bio
	function setBio($bio)
	{
		$this->bio = $bio;
	}
	
	/**
	 * Function to get members biography.
	 * @return string members biography
	 */
	function getBio()
	{
		return $this->bio;
	}
}
