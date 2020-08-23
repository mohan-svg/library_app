<?php  

if (!defined('BASEPATH')) exit('No direct script access allowed');

use LibraryApplication\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';

class Student extends REST_Controller {

	function __construct()
	 {
	   parent::__construct();	   
	   $this->load->model('Student_Model');
	   
	   //Load Authorization Token Library
		$this->load->library('Authorization_Token');
	    	   
	 }


	/**
	* Student Login API
	*--------------------
	* @param: username
	* @param: password
	*--------------------
	* @method : POST
	* @link : Student/login
	*/

	function login_post(){

		header("Access-Control-Allow-Origin: *");
		
		$json = file_get_contents('php://input');
		$student_data = json_decode($json);

        $username = $student_data->username;
		$password = $student_data->password;

	
				if($username !='' && $password !=''){

					$query = $this->Student_Model->verify_student($username,$password);

					if($query==false):

						$this->response(['status'=>false,'message'=>'Wrong username or password'],REST_Controller::HTTP_BAD_REQUEST);
						
					else:
		
						//Generate Token 
						$token_data['id'] = $query['student_id'];
						$token_data['username'] = $query['username'];
						$token_data['full_name'] = $query['student_name'];
						$token_data['email'] = $query['email'];
						$token_data['fees_id'] = $query['payment_status'];
						$token_data['mobile_no'] = $query['mobile_no'];
						$token_data['created'] = $query['created'];
						$token_data['time'] = time();

						$user_token = $this->authorization_token->generateToken($token_data);

						// print_r($this->authorization_token->userData());
						// exit;
						$course = explode(",",$query['enrolled_courses']);
                                $c[0] = $this->Student_Model->getCourse($course[0]);
                                  if(!empty($course[1])){
                                  	$c[1] = $this->Student_Model->getCourse($course[1]);	
                                  }
                 
						$data = array('id' => $query['student_id'],
										'username'=> $query['username'],
									   'full_name' => $query['student_name'],
									   'email' => $query['email'],
									   'mobile_no' => $query['mobile_no'],
									   'fees_status' => $query['payment_value'],
									   'enrolled_courses'=> $c,
									   'created_at' => $query['created'],
									   'token' => $user_token
									 );

						$this->response([
							'status' =>TRUE,
							'message' => 'Student Login Successful',
							'data' => $data
						], REST_Controller::HTTP_OK);
						
					endif;

				} else{

					$this->response(['status'=>false,'message'=>'Please provide username and password'],REST_Controller::HTTP_BAD_REQUEST);
				}


	}

	

	/**
	* Fetching Videos based on Course ID
	* @method : GET
	* @link : Student/fetchVideos/$course_id/$payment_status
	*/

	function fetchVideos_get($c_id = 0){
		//$this->post('course_id');
		
		header("Access-Control-Allow-Origin: *");
		/**
		 * User Token Validation		 
		 */
		$is_valid_token = $this->authorization_token->validateToken();
		
// 		$this->response(['status'=>false,'message'=>$is_valid_token],REST_Controller::HTTP_NOT_FOUND);
		

		// var_dump($is_valid_token);

		if((!empty($is_valid_token)) && ($is_valid_token['status']===TRUE)){
		    
		    $payment_status = $is_valid_token['data']->fees_id;

			if((!empty($c_id) && is_numeric($c_id)) && (!empty($payment_status) && is_numeric($payment_status))):
			
					$videos = $this->Student_Model->get_videos($c_id, $payment_status);
					$this->response(['status'=>true,'videos'=>$videos],REST_Controller::HTTP_OK);
			else:
					$this->response(['status'=>false,'message'=>'Invalid Request'],REST_Controller::HTTP_NOT_FOUND);
			endif;

		} else{

			$this->response(['status'=>false,'message'=>$is_valid_token['message']],REST_Controller::HTTP_BAD_REQUEST);
// 			$this->response(['status'=>false,'message'=>'You are not Authorized User'],REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}

	/**
	* Fetching Audios based on Course ID
	* @method : GET
	* @url : Student/fetchAudios/$course_id
	*/

	function fetchAudios_get($c_id = 0){

		header("Access-Control-Allow-Origin: *");
		/**
		 * User Token Validation		 
		 */
		$is_valid_token = $this->authorization_token->validateToken();

		// var_dump($is_valid_token);

		if(!empty($is_valid_token) AND $is_valid_token['status']===TRUE){
		    
		    $payment_status = $is_valid_token['data']->fees_id;

			if((!empty($c_id) AND is_numeric($c_id)) && (!empty($payment_status) AND is_numeric($payment_status))):
		
					$data = $this->Student_Model->get_audios($c_id,$payment_status);
					$this->response(['status'=>true,'audios'=>$data],REST_Controller::HTTP_OK);

			else:
					$this->response(['status'=>false,'message'=>'Invalid Request'],REST_Controller::HTTP_NOT_FOUND);
			endif;

		} else{

					$this->response(['status'=>false,'message'=>'You are not Authorized User'],REST_Controller::HTTP_BAD_REQUEST);
		}
		
	} 

	/**
	* Fetching Books based on Course ID
	* @method : GET
	* @url : Student/fetchBooks/$course_id/$payment_status
	*/

	function fetchBooks_get($c_id = 0){

		header("Access-Control-Allow-Origin: *");
		/**
		 * User Token Validation		 
		 */
		$is_valid_token = $this->authorization_token->validateToken();

		// var_dump($is_valid_token);

		if(!empty($is_valid_token) AND $is_valid_token['status']===TRUE){
		    
		    $payment_status = $is_valid_token['data']->fees_id;

			if((!empty($c_id) AND is_numeric($c_id)) && (!empty($payment_status) AND is_numeric($payment_status))):
		
					$data = $this->Student_Model->get_books($c_id, $payment_status);
					$this->response(['status'=>true,'books'=>$data],REST_Controller::HTTP_OK);

			else:
					$this->response(['status'=>false,'message'=>'Invalid Request'],REST_Controller::HTTP_NOT_FOUND);
			endif;

		} else{

			$this->response(['status'=>false,'message'=>'You are not Authorized User'],REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}

	/**
	* Student Logout
	* @method : POST
	* @url : Student/logout
	*/

	function logout_post(){
		
	}
	

}//class

?>
