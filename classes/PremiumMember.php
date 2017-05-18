<?php
/*
 * Sofiya Antonyuk
 * IT 328
 * Dating Website
 * http://sofiya.greenrivertech.net/328/dating
 */

 /**
  * Class to represent a premium member on the dating site which includes
  * all feautures as the member class and adds interests and option to add a profile picture.
  * @author Sofiya Antonyuk <santonyuk2@mail.greenriver.edu>
  * @version 1.0
  */
 class PremiumMember extends Member
 {
				private $_indoorInterests;
				private $_outdoorInterests;
				
				/**
					* Function to set the indoor interests.
					* @param string of premium member's indoor interests
					*/
				//getter and setter for indoor interests
				function setIndoorInterests($_indoorInterests)
				{
					$this->_indoorInterests = $_indoorInterests;
				}
				
				/**
					* Function to set the indoor interests.
					* @return string of premium member's indoor interests
					*/
				function getIndoorInterests()
				{
					return $this->_indoorInterests;
				}
				
				/**
					* Function to set the outdoor interests.
					* @param string of premium member's outdoor interests
					*/
				//getter and setter for outdoor interests
				function setOutdoorInterests($_outdoorInterests)
				{
					$this->_outdoorInterests = $_outdoorInterests;
				}
				
				/**
					* Function to set the outdoor interests.
					* @return string of premium member's outdoor interests
					*/
				function getOutdoorInterests()
				{
					return $this->_outdoorInterests;
				}
	
 }
