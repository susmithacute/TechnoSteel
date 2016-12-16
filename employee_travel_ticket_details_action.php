<?php
include('connection.php');
            $travel_from_down = $travel_to_down = $travel_departure_date_down = $travel_return_date_down = $travel_airport_down = $travel_flight_down = $travel_flight_class_down=""; 
//if(isset($_POST['fdata'])) 
//{
        $employee_name                =$_POST['employee_name'];
		$employee_id                =$_POST['employee_id'];
		$employee_employment_id     = $_POST['employee_employment_id'];
		$travel_type_id             =$_POST['travel_type_id'];
		$travel_leave               = $_POST['employee_leaves'];
		$travel_cost               = $_POST['travel_cost'];
		
		
		if( $_POST['eligibility']=="up and down"){
			$travel_from_down             = $_REQUEST['from_downs'];
		    $travel_to_down               = $_POST['to_down'];
		   // $travel_departure_date_down   = $_POST['departure_date_down'];
    	   // $travel_return_date_down      = $_POST['return_date_down'];
			
			 
			 
			$originalDate1                = explode("/",$_POST['return_date_down']);
            $travel_return_date_down      = $originalDate1[2]."-".$originalDate1[1]."-".$originalDate1[0];
			
	        $travel_airport_down          = $_POST['airport_down'];
     	    $travel_flight_down           = $_POST['flight_down'];
		    $travel_flight_class_down     = $_POST['flightclass_down'];
		 }
		   $travel_eligibility         = $_POST['eligibility'];
		   $travel_from              = $_POST['from'];
		   $travel_to                = $_POST['to'];
		   
		   $travel_from_db=explode("/",$_REQUEST['departure_date']);
           $travel_departure_date=$travel_from_db[2]."-".$travel_from_db[1]."-".$travel_from_db[0];
           $travel_to_db=explode("/",$_REQUEST['return_date']);
           $travel_return_date=$travel_to_db[2]."-".$travel_to_db[1]."-".$travel_to_db[0];
		   
	       $travel_airport           = $_POST['airport'];
     	   $travel_flight            = $_POST['flight'];
		   $travel_flight_class      = $_POST['flight_class'];
		
		
		
		        $values["employee_id"]             = $employee_id;
				$values["employee_employment_id"]  = $employee_employment_id;
				$values["travel_type_id"]          =$travel_type_id;
				$values["travel_leave"] 	       = $travel_leave;
				$values["travel_cost"] 	       = $travel_cost;
				
				
				$values["travel_eligibility"] 	   = $travel_eligibility;
				$values["travel_from"] 		       = $travel_from;
				$values["travel_to"] 		       = $travel_to;
				  // $values["date"]  = $date;
	            $values["travel_departure_date"]   = $travel_departure_date;
			   $values["travel_return_date"] 	   = $travel_return_date;

               
								   
				$values["travel_airport"] 		   = $travel_airport;
				$values["travel_flight"] 		   = $travel_flight;
			    $values["travel_flight_class"] 	   = $travel_flight_class;
				
				$values["travel_from_down"]          = $travel_from_down;
				$values["travel_to_down"] 	         = $travel_to_down;				 
	            $values["travel_departure_date_down"]= $travel_departure_date_down;
			    $values["travel_return_date_down"]    = $travel_return_date_down;	
				$values["travel_airport_down"] 		 = $travel_airport_down;
				$values["travel_flight_down"] 	     = $travel_flight_down;
			    $values["travel_flight_class_down"]  = $travel_flight_class_down;
				
				
			
				$insert = $db->secure_insert("sm_employee_travel", $values);
				    
    
        
//}
?>