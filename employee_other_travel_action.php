 <?php
include('connection.php');

         //   $travel_from_down = $travel_to_down = $travel_departure_date_down = $travel_return_date_down = $travel_airport_down = $travel_flight_down = $travel_flight_class_down=""; 

//if(isset($_POST['employee_id'])) 
//{     
 $employee_name                =$_POST['employee_name'];
		$employee_id                =$_POST['employee_id'];
		$employee_employment_id     = $_POST['employee_employment_id'];
		$travel_type_id             =$_POST['travel_type_id'];

		$travel_place               = $_POST['travel_place'];
		$travel_purpose             = $_POST['travel_purpose'];
		$travel_duration            = $_POST['travel_duration'];
		$travel_details             = $_POST['travel_details'];
		$travel_cost                = $_POST['travel_cost'];
		
		if( $_POST['ticket']=="Two way"){
			$travel_from_down             = $_POST['fromdown'];
		    $travel_to_down               = $_POST['to_down'];
		    $travel_departure_date_down   = $_POST['departure_date_down'];
    	    $travel_return_date_down      = $_POST['return_date_down'];
			
			$originalDate                 = explode("/",$_REQUEST['departure_date_down']);
              $travel_departure_date_down   = $originalDate[2]."-".$originalDate[1]."-".$originalDate[0];
			 
			  $originalDate1                = explode("/",$_REQUEST['return_date_down']);
              $travel_return_date_down      = $originalDate1[2]."-".$originalDate1[1]."-".$originalDate1[0];
			
	        $travel_airport_down          = $_POST['airport_down'];
     	    $travel_flight_down           = $_POST['flight_down'];
		    $travel_flight_class_down     = $_POST['flightclass_down'];
		 }
		
		
		
		
		$travel_eligibility         = $_POST['ticket'];
		
		$travel_from                = $_POST['travel_from'];
		$travel_to                  = $_POST['travel_to'];
		//$travel_departure_date      = $_POST['departure_date'];
	   // $travel_return_date         = $_POST['return_date'];
		
		$originalDate2                 = explode("/",$_REQUEST['departure_date']);
              $travel_departure_date   = $originalDate2[2]."-".$originalDate2[1]."-".$originalDate2[0];
			 
			  $originalDate3               = explode("/",$_REQUEST['return_date']);
              $travel_return_date      = $originalDate3[2]."-".$originalDate3[1]."-".$originalDate3[0];
			  
			  
	    $travel_airport             = $_POST['airport'];
     	$travel_flight              = $_POST['flight'];
		$travel_flight_class        = $_POST['flightclass'];
		
		
		
		        $values["employee_id"]             = $employee_id;
				$values["employee_employment_id"]  = $employee_employment_id;
				$values["travel_type_id"]          =$travel_type_id;
				
				$values["travel_place"] 	       = $travel_place;
				$values["travel_purpose"] 	       = $travel_purpose;
				$values["travel_duration"] 	       = $travel_duration;
				$values["travel_details"] 	       = $travel_details;
				$values["travel_cost"] 	           = $travel_cost;
				
				
				
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
				if($insert){
					//echo " <script>location.href='processvisa_candidate_list.php'</script>";
				} else {  echo "Failed To Apply Leave! Please Try Again"; }
					       
    
        
//}
?>