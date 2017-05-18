<?php
/*
 * Sofiya Antonyuk
 * IT 328
 * Dating Website
 * http://sofiya.greenrivertech.net/328/dating
 */
    
 /**
  * @author Sofiya Antonyuk <santonyuk2@mail.greenriver.edu>
  * @version 1.0
  * @copyright 2017
  */
 
    // Require autoload file
    require_once('vendor/autoload.php');
    
    session_start();
    
    // Create an instance of the base class
    $f3 = Base::instance();
    
    //Set debug level
    $f3->set('DEBUG', 3);
    
    // Default route
    $datingDB = new DatingDB();
    
    $f3->route('GET /',
        function() {
            $view = new View;
            echo $view->render('pages/home.html');
        });
    
    // Routing between pages
    $f3->route('GET /personalinformation',
        function() {
            $view = new View;
            echo $view->render('pages/personalinformation.html');
         });    
          
    $f3->route('POST /profile',
        function($f3){
            // Check if membership was checked
            if(isset($_POST['membership']))
            {
                $premiumMember = new PremiumMember();
                $premiumMember->setFname($_POST['firstName']);
                $premiumMember->setLname($_POST['lastName']);
                $premiumMember->setAge($_POST['age']);
                $premiumMember->setGender($_POST['gender']);
                $premiumMember->setPhone($_POST['phone']);
                $_SESSION['member'] = $premiumMember;
                
                $f3->set('summaryRoute', './interests');
            }
            else
            {
                $member = new Member();
                $member->setFname($_POST['firstName']);
                $member->setLname($_POST['lastName']);
                $member->setAge($_POST['age']);
                $member->setGender($_POST['gender']);
                $member->setPhone($_POST['phone']);
                $_SESSION['member'] = $member;
                
                $f3->set('summaryRoute', './summary');
            }
            $view = new View;
            echo $view->render('pages/profile.html');
        });
                    
    $f3->route('POST /interests',
        function($f3){
            
            $member = $_SESSION['member'];
           
            //echo var_dump($member); for debugging to see what's in object
            
            $member->setEmail($_POST['email']);
            $member->setState($_POST['state']);
            $member->setSeeking($_POST['genderSeeking']);
            $member->setBio($_POST['biography']);
            
           $_SESSION['member'] = $member;
           $view = new View;
           if ($member instanceof PremiumMember)
            {
                echo $view->render('pages/interests.html');
            }
            else {
                $f3->set('fName', $member->getFname());
                $f3->set('lName', $member->getLname());
                $f3->set('age', $member->getAge());
                $f3->set('gender', $member->getGender());
                $f3->set('phone', $member->getPhone());
                $f3->set('email', $member->getEmail());
                $f3->set('state', $member->getState());
                $f3->set('seeking', $member->getSeeking());
                $f3->set('bio', $member->getBio());
                $f3->set('indoorInterests', []);
                $f3->set('outdoorInterests', []);
                echo $view->render('pages/summary.html');
            }
        });
    
     $f3->route('POST /summary',
        function($f3)
        {
            //echo "Hello!";
            $member = $_SESSION['member'];
            
            //echo "<pre>";
            //echo var_dump($member);
            //echo "</pre>";
            
            if($member instanceof PremiumMember)
            {
                $member->setIndoorInterests($_POST['indoor_interests']);
                $indoorInterests = $member->getIndoorInterests();
                $member->setOutdoorInterests($_POST['outdoor_interests']);
                $outdoorInterests = $member->getOutdoorInterests();
            }
            $f3->set('fName', $member->getFname());
            $f3->set('lName', $member->getLname());
            $f3->set('age', $member->getAge());
            $f3->set('gender', $member->getGender());
            $f3->set('phone', $member->getPhone());
            $f3->set('email', $member->getEmail());
            $f3->set('state', $member->getState());
            $f3->set('seeking', $member->getSeeking());
            $f3->set('bio', $member->getBio());
            $f3->set('indoorInterests', $indoorInterests); //$member->getIndoorInterests());
            $f3->set('outdoorInterests', $outdoorInterests); //$member->getOutdoorInterests());
            
            //echo "<pre>";
            //echo "member getIndoorInterests() <br>";
            //print_r($member->getIndoorInterests());
            //echo "variable indoorInterests <br>";
            //print_r($indoorInterests);
            //echo "member getOUtdoorInterests()<br>";
            //print_r($member->getOutdoorInterests());
            //echo "variable outdoorInterests<br>";
            //print_r($outdoorInterests);
            //echo "</pre>";
            
            
            if($member instanceof PremiumMember)
            {
                $datingDB = $GLOBALS['datingDB'];
                $interests = "";
                
                if($indoorInterests != null)
                {
                    foreach($indoorInterests as $value)
                    {
                        $interests .= $value . ", ";
                    }
                }
                
                if($outdoorInterests != null)
                {
                    foreach($outdoorInterests as $value)
                    {
                        $interests .= $value . ", ";
                    }
                }
                
                //echo "<pre>";
                //echo "variable indoorInterests <br>";
                //print_r($indoorInterests);
                //echo "variable outdoorInterests<br>";
                //print_r($outdoorInterests);
                //echo "interests variable<br>";
                //print_r($interests);
                //echo "</pre>";
                
                $datingDB->addMember($member->getFname(), $member->getLname(), $member->getAge(),
                $member->getGender(), $member->getPhone(), $member->getEmail(),
                $member->getState(), $member->getSeeking(), $member->getBio(),
                '1', '',  $interests);
            }
            else
            {
                echo "I got into the default Member creation statement";
                $datingDB = $GLOBALS['datingDB'];
                $datingDB->addMember($member->getFname(), $member->getLname(), $member->getAge(),
                $member->getGender(), $member->getPhone(), $member->getEmail(),
                $member->getState(), $member->getSeeking(), $member->getBio(), '0', '',  ''); 
            }
            
            // set default pic
            $f3->set('pic', "images/defaultpic.jpg");
            
            // Make sure file upload isn't empty
            if($_FILES["fileToUpload"]["size"] != 0) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check == false) {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG") {
                    echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                    $uploadOk = 0;
                }
                
                // if upload is ok
                if($uploadOk == 1) {
                    // Split the file name on the . to get the extension later
                    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
                    $extension = end($temp);
                    // set the file name and move the temp file
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/userPic." . $extension);
    
                    $f3->set('pic', "uploads/userPic." . $extension);
                }
            }
            
           $view = new View;
           echo $view->render('pages/summary.html');
        });
     
     $f3->route('GET /admin',
                     function($f3){
                        $members = $GLOBALS['datingDB']->allMembers();
                        $f3->set('members', $members);
                        $view = new View;
                        echo $view->render('pages/admin.html');
                     }); 
    
    // Run fat free
    $f3->run();