<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
     {
       parent::__construct();
       $this->load->model('Admin_Model');
       $this->load->helper('file');
      
     }
	
	public function index()
	{
		    $this->load->view('header');
        $this->load->view('adminLogin');
        $this->load->view('footer');
       
    }

       
	function signin_verification(){
            $this->form_validation->set_rules('username','Email','required|valid_email');
            $this->form_validation->set_rules('password','Password','required|min_length[8]');

            if($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('error',validation_errors());
                redirect('admin');
            } else{
                
                $query = $this->Admin_Model->check_signin($this->input->post('username'), $this->input->post('password'));

                if($query)
                {                       
                    $admin_info = $this->Admin_Model->read_admin_information($this->input->post('username'));

                    $session_data = array('admin_id'=> $admin_info->admin_id,
                                            'admin_username'=> $admin_info->username,
                                            'admin_name'=> $admin_info->admin_name,
                                            );

                    $this->session->set_flashdata('success','Hi Admin you are ready to go');

                    $this->session->set_userdata('admin_logged_in','true');
                    $this->session->set_userdata($session_data);

                    redirect('admin_dashboard');
                } else{
                    $this->session->set_flashdata('error','Username or Password is incorrect, Please check!');
                    redirect('admin');
                }
            }
    }

    //Admin

    function logout()
    {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_username');  
        $this->session->unset_userdata('admin_name'); 
        $this->session->unset_userdata('admin_logged_in'); 
        $this->session->sess_destroy();
        redirect('admin');  

    }

function admin_dashboard(){

        if($this->session->userdata('admin_logged_in')=='true'){
            
            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('admin_dashboard');
            $this->load->view('admin_footer');
        
        } else{
            redirect('admin');
        }
        
}

function register_student(){

        if($this->session->userdata('admin_logged_in')=='true'){

            $data['students'] = $this->Admin_Model->get_registered_student_list();
            $data['courses'] = $this->Admin_Model->get_course_list();
            $data['payment_status'] = $this->Admin_Model->get_payment_status();
                        
            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('register_student_page',$data);
            $this->load->view('admin_footer');
        
        } else{
            redirect('admin');
        }
        
}

  function allStudentData(){

      if($this->session->userdata('admin_logged_in')=='true'){

            $data = $this->Admin_Model->get_all_students();

            echo json_encode($data);
        
        } else{
            redirect('admin');
        }


  }


function save_student_data(){

        if($this->session->userdata('admin_logged_in')=='true'){

            $this->form_validation->set_rules('student_name','Student Name','required');
            $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[registered_student.email]',array('is_unique'=>'This %s already exist please enter another email'));
            $this->form_validation->set_rules('mobile_no','Mobile No','required|max_length[10]|min_length[10]|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('course[]','Course','required');
            $this->form_validation->set_rules('username','Username','required|is_unique[registered_student.username]',
            array('is_unique'=>'This %s already exist please enter another username'));
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('password2','Retype-Password','matches[password]');

            if($this->form_validation->run()== true):
                
                $courses = implode(",",$this->input->post('course'));
                  $id = $this->Admin_Model->insert_student_data($courses);

                  $vData['data'] = $this->Admin_Model->get_student_by_id($id);
                
                  $response['message'] = "<div class=\"alert alert-success\">Student has been registered successfully</div>";
                  $response['status'] = 1;

               else:

                  // $this->session->set_flashdata('error', validation_errors());

                  $response['status'] = 0;
                  $response['student_name'] = strip_tags(form_error('student_name'));
                  $response['email'] = strip_tags(form_error('email'));
                  $response['mobile_no'] = strip_tags(form_error('mobile_no'));
                  $response['course'] = strip_tags(form_error('course'));
                  $response['username'] = strip_tags(form_error('username'));
                  $response['password'] = strip_tags(form_error('password'));
                  $response['password2'] = strip_tags(form_error('password2'));

              endif;

            echo json_encode($response);
        
        } else{
            redirect('admin');
        }
        
}


    function getStudentbyId(){
       
      if($this->session->userdata('admin_logged_in')=='true'){

          $id = $this->uri->segment(2);  
          $data['student'] = $this->Admin_Model->get_student_by_id($id);
          $data['courses'] = $this->Admin_Model->get_course_list();
          $data['payment_status'] = $this->Admin_Model->get_payment_status();            
          $html =$this->load->view('edit_student',$data,true);
          $response['html'] = $html;
          echo json_encode($response);

      } else{

          redirect('admin');

      }
    }


    function update_student_data(){



      if($this->session->userdata('admin_logged_in')=='true'){

            $this->form_validation->set_rules('student_name','Student Name','required');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('mobile_no','Mobile No','required|max_length[10]|min_length[10]|regex_match[/^[0-9]{10}$/]');
            // $this->form_validation->set_rules('course','Course','required');
            $this->form_validation->set_rules('username','Username','required');
            // $this->form_validation->set_rules('password','Password','required');
            
            if($this->form_validation->run()== true):
                  if($this->input->post('password')!=''){
                      $password = md5(trim($this->input->post('password')));
                  } else{
                      $password = $this->input->post('old_password');
                  }

                  // echo $password;
                  $courses = implode(",",$this->input->post('course'));
                  $query = $this->Admin_Model->update_student($this->input->post('stud_id'),$password,$courses);

                  if($query):

                    $response['status'] = 1;

                    $response['html'] = "<div class=\"alert alert-success\">Student data updated successfully</div>";

                  else:

                    $response['status'] = 2;
                    $response['html'] = "<div class=\"alert alert-warning\">All data are same as previous</div>";

                  endif;

            else:

                  $response['status'] = 0;
                  $response['student_name'] = strip_tags(form_error('student_name'));
                  $response['email'] = strip_tags(form_error('email'));
                  $response['mobile_no'] = strip_tags(form_error('mobile_no'));
                  $response['course'] = strip_tags(form_error('course'));
                  $response['username'] = strip_tags(form_error('username'));
                  $response['password'] = strip_tags(form_error('password'));
                  

            endif;  

                  echo json_encode($response);

      } else{

          redirect('admin');

      }
    }

    function delete_student_data(){

      if($this->session->userdata('admin_logged_in')=='true'){

          $query = $this->Admin_Model->delete_student_by_id($this->uri->segment(2));

          if($query){

              
              $response['html'] = "<div class=\"alert alert-success\">Student data deleted successfully</div>";

          } else{
              $response['html'] = "<div class=\"alert alert-danger\">Some error occured ! Please Try Again</div>";
          }

          echo json_encode($response);

      } else{

          redirect('admin');

      }

    }


    function add_new_gre_video(){
      if($this->session->userdata('admin_logged_in')=='true'){

            $data['videos'] = $this->Admin_Model->get_gre_videos(); 
            $data['payment_status']=$this->Admin_Model->get_payment_status();           

            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('add_gre_video',$data);
            $this->load->view('admin_footer');

         } else{

          redirect('admin');

      }

    }

     function add_new_gre_book(){
      
        if($this->session->userdata('admin_logged_in')=='true'){

            $data['books'] = $this->Admin_Model->get_gre_books();    
            $data['payment_status']=$this->Admin_Model->get_payment_status();           

            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('add_gre_book',$data);
            $this->load->view('admin_footer');

         } else{

          redirect('admin');

      }
      
    }

     function add_new_gre_audio(){
        
        if($this->session->userdata('admin_logged_in')=='true'){

            $data['audios'] = $this->Admin_Model->get_gre_audios();   
            $data['payment_status']=$this->Admin_Model->get_payment_status();            

            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('add_gre_audio',$data);
            $this->load->view('admin_footer');

         } else{

          redirect('admin');

      }
      
    }

    function insert_gre_video(){

      if($this->session->userdata('admin_logged_in')=='true'){

          if(!empty($_FILES['video']['name'])):

              $video = $this->upload_video('gre',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('video_title'));
          else:
              $video = $this->input->post('videourl');
          endif;

              // echo $video;

              $query = $this->Admin_Model->insert_video(1,$video);

              if($query):
                  $this->session->set_flashdata('success','GRE Video inserted successfully');
                  redirect('add_gre_video');
              else:
                  $this->session->set_flashdata('error','Error while inserted GRE video! Please try again');
                  redirect('add_gre_video');

              endif;

         } else{

          redirect('admin');

      }
    }

    


    function fetch_topics(){
        if($this->session->userdata('admin_logged_in')=='true'){
            
            $response = $this->Admin_Model->get_topics($this->input->post('subsection'));   
            echo json_encode($response);

        } else{

            redirect('admin');

        }
    }

    function insert_gre_audio(){
      if($this->session->userdata('admin_logged_in')=='true'){

              $audio = $this->upload_audio('gre',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('audio_title'));

              // echo $video;

              $query = $this->Admin_Model->insert_audio(1,$audio);

              if($query):
                  $this->session->set_flashdata('success','GRE Audio inserted successfully');
                  redirect('add_gre_audio');
              else:
                  $this->session->set_flashdata('error','Error while inserting GRE Audio! Please try again');
                  redirect('add_gre_audio');

              endif;

         } else{

              redirect('admin');

      }
    }

    function insert_gre_book(){
      if($this->session->userdata('admin_logged_in')=='true'){

              $book = $this->upload_book('gre',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
              // $attached_audio = $this->upload_audio1('gre',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
              // echo $book;
              $attached_audio=$this->input->post('attaudio');

              $query = $this->Admin_Model->insert_book(1,$book,$attached_audio);

              if($query):
                  $this->session->set_flashdata('success','GRE Book inserted successfully');
                  redirect('add_gre_book');
              else:
                  $this->session->set_flashdata('error','Error while inserting GRE Book! Please try again');
                  redirect('add_gre_book');

              endif;

         } else{

              redirect('admin');
      }
    }

    function update_gre_book(){

       if($this->session->userdata('admin_logged_in')=='true'){

            // echo $this->input->post('id')."  subSection:".$this->input->post('subSection')." ".$this->input->post('topic_name')." ".$this->input->post('book_title');

            if(!empty($_FILES['book']['name'])):
                $book = $this->upload_book('gre',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
            else:
                $book = $this->input->post('book_link');
            endif;

            if(!empty($_FILES['attaudio']['name'])):
                $audio = $this->upload_audio1('gre',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
            else:
                $audio = $this->input->post('audio_link');
             
            endif;  
         
              $query = $this->Admin_Model->update_book($this->input->post('id'),$book,$audio);
              // echo $query;
              if($query):
                  $this->session->set_flashdata('success','GRE Book updated successfully');
                  redirect('add_gre_book');
              else:
                  $this->session->set_flashdata('error','Error while updating GRE Book! Please try again');
                  redirect('add_gre_book');

              endif;

         } else{

              redirect('admin');
        }

    }

     function update_gre_video(){

       if($this->session->userdata('admin_logged_in')=='true'){

            if(!empty($_FILES['video']['name'])):
                $video = $this->upload_video('gre',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('video_title'));
            else:
                $video = $this->input->post('uploaded_video');
            endif;

                     
              $query = $this->Admin_Model->update_video($this->input->post('id'),$video);
              // echo $query;
              if($query):
                  $this->session->set_flashdata('success','GRE Video updated successfully');
                  redirect('add_gre_video');
              else:
                  $this->session->set_flashdata('error','Error while updating GRE Video! Please try again');
                  redirect('add_gre_video');

              endif;

         } else{

              redirect('admin');
        }

    }

    function update_gre_audio(){

       if($this->session->userdata('admin_logged_in')=='true'){

            if(!empty($_FILES['audio']['name'])):
                $audio = $this->upload_audio('gre',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('audio_title'));
            else:
                $audio = $this->input->post('uploaded_audio');
            endif;

                     
              $query = $this->Admin_Model->update_audio($this->input->post('id'),$audio);
              // echo $query;
              if($query):
                  $this->session->set_flashdata('success','GRE Audio updated successfully');
                  redirect('add_gre_audio');
              else:
                  $this->session->set_flashdata('error','Error while updating GRE Audio! Please try again');
                  redirect('add_gre_audio');

              endif;

         } else{

              redirect('admin');
        }

    }


    function update_ielts_book(){

       if($this->session->userdata('admin_logged_in')=='true'){

            // echo $this->input->post('id')."  subSection:".$this->input->post('subSection')." ".$this->input->post('topic_name')." ".$this->input->post('book_title');

            if(!empty($_FILES['book']['name'])):
                $book = $this->upload_book('ielts',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
            else:
                $book = $this->input->post('book_link');
            endif;

            if(!empty($_FILES['attaudio']['name'])):
                $audio = $this->upload_audio1('ielts',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
            else:
                $audio = $this->input->post('audio_link');
             
            endif;  
 
              $query = $this->Admin_Model->update_book($this->input->post('id'),$book,$audio);
              // echo $query;
              if($query):
                  $this->session->set_flashdata('success','IELTS Book updated successfully');
                  redirect('add_ielts_book');
              else:
                  $this->session->set_flashdata('error','Error while updating IELTS Book! Please try again');
                  redirect('add_ielts_book');

              endif;

         } else{

              redirect('admin');
        }

    }


     function update_ielts_video(){

       if($this->session->userdata('admin_logged_in')=='true'){

            if(!empty($_FILES['video']['name'])):
                $video = $this->upload_video('ielts',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('video_title'));
            else:
                $video = $this->input->post('uploaded_video');
            endif;

                     
              $query = $this->Admin_Model->update_video($this->input->post('id'),$video);
              // echo $query;
              if($query):
                  $this->session->set_flashdata('success','IELTS Video updated successfully');
                  redirect('add_ielts_video');
              else:
                  $this->session->set_flashdata('error','Error while updating IELTS Video! Please try again');
                  redirect('add_ielts_video');

              endif;

         } else{

              redirect('admin');
        }

    }

    function update_ielts_audio(){

       if($this->session->userdata('admin_logged_in')=='true'){

            if(!empty($_FILES['audio']['name'])):
                $audio = $this->upload_audio('ielts',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('audio_title'));
            else:
                $audio = $this->input->post('uploaded_audio');
            endif;

                     
              $query = $this->Admin_Model->update_audio($this->input->post('id'),$audio);
              // echo $query;
              if($query):
                  $this->session->set_flashdata('success','IELTS Audio updated successfully');
                  redirect('add_ielts_audio');
              else:
                  $this->session->set_flashdata('error','Error while updating IELTS Audio! Please try again');
                  redirect('add_ielts_audio');

              endif;

         } else{

              redirect('admin');
        }

    }

     function update_toefl_book(){

       if($this->session->userdata('admin_logged_in')=='true'){

            // echo $this->input->post('id')."  subSection:".$this->input->post('subSection')." ".$this->input->post('topic_name')." ".$this->input->post('book_title');

            if(!empty($_FILES['book']['name'])):
                $book = $this->upload_book('toefl',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
            else:
                $book = $this->input->post('book_link');
            endif;

            if(!empty($_FILES['attaudio']['name'])):
                $audio = $this->upload_audio1('toefl',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
            else:
                $audio = $this->input->post('audio_link');
             
            endif;  
              
              $query = $this->Admin_Model->update_book($this->input->post('id'),$book,$audio);
              // echo $query;
              if($query):
                  $this->session->set_flashdata('success','TOEFL Book updated successfully');
                  redirect('add_toefl_book');
              else:
                  $this->session->set_flashdata('error','Error while updating TOEFL Book! Please try again');
                  redirect('add_toefl_book');

              endif;

         } else{

              redirect('admin');
        }

    }

    function update_toefl_video(){

       if($this->session->userdata('admin_logged_in')=='true'){

            if(!empty($_FILES['video']['name'])):
                $video = $this->upload_video('toefl',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('video_title'));
            else:
                $video = $this->input->post('uploaded_video');
            endif;

                     
              $query = $this->Admin_Model->update_video($this->input->post('id'),$video);
              // echo $query;
              if($query):
                  $this->session->set_flashdata('success','TOEFL Video updated successfully');
                  redirect('add_toefl_video');
              else:
                  $this->session->set_flashdata('error','Error while updating TOEFL Video! Please try again');
                  redirect('add_toefl_video');

              endif;

         } else{

              redirect('admin');
        }

    }

    function update_toefl_audio(){

       if($this->session->userdata('admin_logged_in')=='true'){

            if(!empty($_FILES['audio']['name'])):
                $audio = $this->upload_audio('toefl',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('audio_title'));
            else:
                $audio = $this->input->post('uploaded_audio');
            endif;
                     
              $query = $this->Admin_Model->update_audio($this->input->post('id'),$audio);
              // echo $query;
              if($query):
                  $this->session->set_flashdata('success','TOEFL Audio updated successfully');
                  redirect('add_toefl_audio');
              else:
                  $this->session->set_flashdata('error','Error while updating TOEFL Audio! Please try again');
                  redirect('add_toefl_audio');

              endif;

         } else{

              redirect('admin');
        }

    }

    function upload_video($course,$subsection,$topic,$title){

        if($topic==''){
           $path = 'videos/'.$course.'/'.$subsection.'/';
        } else{
           $path = 'videos/'.$course.'/'.$subsection.'/'.$topic.'/';
        }
            
          if(!file_exists($path)){
              mkdir($path,0777);
          }
          $config['upload_path'] = $path; 
          $config['allowed_types'] = 'mp4|webm|avi|flv|3gp|ogg';
          $config['max_size'] = '200000';
          //$config['remove_spaces'] = TRUE; // max_size in kb
          $config['overwrite'] = TRUE;
          
          $config['file_name'] = $title;
 
          //Load upload library
          $this->load->library('upload',$config); 
 
          // File upload
          if($this->upload->do_upload('video')){
              // Get data about the file
              $uploadData = $this->upload->data();
              $video = $path.$uploadData['file_name'];
              // $video = $data['upload_data']['full_path'];

          } else{
           
              echo $this->upload->display_errors();
              $video ='';
          
          }

          return $video;
    }

    function upload_audio($course,$subsection,$topic,$title){

        if($topic==''){
          $path = 'audios/'.$course.'/'.$subsection.'/';
        } else{
          $path = 'audios/'.$course.'/'.$subsection.'/'.$topic.'/';
        }
             
          if(!file_exists($path)){
              mkdir($path,0777);
          }
          $config['upload_path'] = $path; 
          $config['allowed_types'] = 'mp3|wav|m4a|mp4|wmv';
          $config['max_size'] = '200000';
          //$config['remove_spaces'] = TRUE; // max_size in kb
          $config['overwrite'] = TRUE;
          
          $config['file_name'] = $title;
 
          //Load upload library
          $this->load->library('upload',$config); 
 
          // File upload
          if($this->upload->do_upload('audio')){
              // Get data about the file
              $uploadData = $this->upload->data();
              $audio = $path.$uploadData['file_name'];
              // $video = $data['upload_data']['full_path'];

          } else{
           
              echo $this->upload->display_errors();
              $audio ='';
          
          }

          return $audio;
    }

    function upload_book($course,$subsection,$topic,$title){
          
          if($topic==''){
              $path = 'books/'.$course.'/'.$subsection.'/';
            } else{
              $path = 'books/'.$course.'/'.$subsection.'/'.$topic.'/';
            }
         
          if(!file_exists($path)){
              mkdir($path,0777);
          }

          $config['upload_path'] = $path; 
          $config['allowed_types'] = 'pdf';
          $config['max_size'] = '200000';
          //$config['remove_spaces'] = TRUE; // max_size in kb
          $config['overwrite'] = TRUE;
          
          $config['file_name'] = $title;
 
          //Load upload library
          $this->load->library('upload',$config); 
 
          // File upload
          if($this->upload->do_upload('book')){
              // Get data about the file
              $uploadData = $this->upload->data();
              $book = $path.$uploadData['file_name'];
              // $video = $data['upload_data']['full_path'];

          } else{
           
              echo $this->upload->display_errors();
              $book ='';
          
          }

          return $book;
    }

    function upload_audio1($course,$subsection,$topic,$title){

        if($topic==''){
            $path = 'books/'.'attached_audio/'.$course.'/'.$subsection.'/';
        } else{
            $path = 'books/'.'attached_audio/'.$course.'/'.$subsection.'/'.$topic.'/';
        }
             
          if(!file_exists($path)){
              mkdir($path,0777);
          }

          $config['upload_path'] = $path; 
          $config['allowed_types'] = 'mp3|wav|m4a|mp4|wmv';
          $config['max_size'] = '50000';
          //$config['remove_spaces'] = TRUE; // max_size in kb
          $config['overwrite'] = TRUE;
          
          $config['file_name'] = $title;
 
          //Load upload library
          $this->load->library('upload',$config); 
 
          // File upload
          if($this->upload->do_upload('attaudio')){
              // Get data about the file
              $uploadData = $this->upload->data();
              $audio = $path.$uploadData['file_name'];
              // $video = $data['upload_data']['full_path'];

          } else{
           
              echo $this->upload->display_errors();
              $audio ='';
          
          }

          return $audio;
    }


    //IELTS Subject

    function add_new_ielts_video(){
      if($this->session->userdata('admin_logged_in')=='true'){

            $data['videos'] = $this->Admin_Model->get_ielts_videos();        
            $data['payment_status']=$this->Admin_Model->get_payment_status();       

            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('add_ielts_video',$data);
            $this->load->view('admin_footer');

         } else{

          redirect('admin');

      }

    }

     function add_new_ielts_book(){
      
        if($this->session->userdata('admin_logged_in')=='true'){

            $data['books'] = $this->Admin_Model->get_ielts_books();     
            $data['payment_status']=$this->Admin_Model->get_payment_status();          

            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('add_ielts_book',$data);
            $this->load->view('admin_footer');

         } else{

          redirect('admin');

      }
      
    }

     function add_new_ielts_audio(){
        
        if($this->session->userdata('admin_logged_in')=='true'){

            $data['audios'] = $this->Admin_Model->get_ielts_audios();  
            $data['payment_status']=$this->Admin_Model->get_payment_status();             

            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('add_ielts_audio',$data);
            $this->load->view('admin_footer');

         } else{

          redirect('admin');

      }
      
    }

    function insert_ielts_video(){

      if($this->session->userdata('admin_logged_in')=='true'){
              $topic_name ='';

              $video = $this->upload_video('ielts',$this->input->post('subSection'),$topic_name,$this->input->post('video_title'));

              // echo $video;

              $query = $this->Admin_Model->insert_video(2,$video);

              if($query):
                  $this->session->set_flashdata('success','IELTS Video inserted successfully');
                  redirect('add_ielts_video');
              else:
                  $this->session->set_flashdata('error','Error while inserting IELTS video! Please try again');
                  redirect('add_ielts_video');

              endif;

         } else{

          redirect('admin');

      }
    }

    function insert_ielts_audio(){
      if($this->session->userdata('admin_logged_in')=='true'){

              $audio = $this->upload_audio('ielts',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('audio_title'));

              // echo $video;

              $query = $this->Admin_Model->insert_audio(2,$audio);

              if($query):
                  $this->session->set_flashdata('success','IELTS Audio inserted successfully');
                  redirect('add_ielts_audio');
              else:
                  $this->session->set_flashdata('error','Error while inserting IELTS Audio! Please try again');
                  redirect('add_ielts_audio');

              endif;

         } else{

              redirect('admin');

            }
    }

    function insert_ielts_book(){
      if($this->session->userdata('admin_logged_in')=='true'){

              $book = $this->upload_book('ielts',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
              // $attached_audio = $this->upload_audio1('ielts',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
              // echo $book;
              $attached_audio=$this->input->post('attaudio');

              $query = $this->Admin_Model->insert_book(2,$book,$attached_audio);

              if($query):
                  $this->session->set_flashdata('success','IELTS Book inserted successfully');
                  redirect('add_ielts_book');
              else:
                  $this->session->set_flashdata('error','Error while inserting IELTS Book! Please try again');
                  redirect('add_ielts_book');

              endif;

         } else{

              redirect('admin');
      }
    }

    //TOEFL Subject

    function add_new_toefl_video(){
      if($this->session->userdata('admin_logged_in')=='true'){

            $data['videos'] = $this->Admin_Model->get_toefl_videos();   
            $data['payment_status']=$this->Admin_Model->get_payment_status();            

            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('add_toefl_video',$data);
            $this->load->view('admin_footer');

         } else{

          redirect('admin');

      }

    }

     function add_new_toefl_book(){
      
        if($this->session->userdata('admin_logged_in')=='true'){

            $data['books'] = $this->Admin_Model->get_toefl_books();   
            $data['payment_status']=$this->Admin_Model->get_payment_status();            

            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('add_toefl_book',$data);
            $this->load->view('admin_footer');

         } else{

          redirect('admin');

      }
      
    }

     function add_new_toefl_audio(){
        
        if($this->session->userdata('admin_logged_in')=='true'){

            $data['audios'] = $this->Admin_Model->get_toefl_audios();
            $data['payment_status']=$this->Admin_Model->get_payment_status();               

            $this->load->view('admin_header');
            $this->load->view('admin_sidebar');
            $this->load->view('add_toefl_audio',$data);
            $this->load->view('admin_footer');

         } else{

          redirect('admin');

      }
      
    }

    function insert_toefl_video(){

      if($this->session->userdata('admin_logged_in')=='true'){
              $topic_name ='';

              $video = $this->upload_video('toefl',$this->input->post('subSection'),$topic_name,$this->input->post('video_title'));

              // echo $video;

              $query = $this->Admin_Model->insert_video(3,$video);

              if($query):
                  $this->session->set_flashdata('success','TOEFL Video inserted successfully');
                  redirect('add_toefl_video');
              else:
                  $this->session->set_flashdata('error','Error while inserting TOEFL video! Please try again');
                  redirect('add_toefl_video');

              endif;

         } else{

          redirect('admin');

      }
    }

    function insert_toefl_audio(){
      if($this->session->userdata('admin_logged_in')=='true'){

              $audio = $this->upload_audio('toefl',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('audio_title'));

              // echo $video;

              $query = $this->Admin_Model->insert_audio(3,$audio);

              if($query):
                  $this->session->set_flashdata('success','TOEFL Audio inserted successfully');
                  redirect('add_toefl_audio');
              else:
                  $this->session->set_flashdata('error','Error while inserting TOEFL Audio! Please try again');
                  redirect('add_toefl_audio');

              endif;

         } else{

              redirect('admin');

            }
    }

    function insert_toefl_book(){

      if($this->session->userdata('admin_logged_in')=='true'){

              $book = $this->upload_book('toefl',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
              // $attached_audio = $this->upload_audio1('ielts',$this->input->post('subSection'),$this->input->post('topic_name'),$this->input->post('book_title'));
              // echo $book;
              $attached_audio=$this->input->post('attaudio');

              $query = $this->Admin_Model->insert_book(3,$book,$attached_audio);

              if($query):
                  $this->session->set_flashdata('success','TOEFL Book inserted successfully');
                  redirect('add_toefl_book');
              else:
                  $this->session->set_flashdata('error','Error while inserting TOEFL Book! Please try again');
                  redirect('add_toefl_book');

              endif;

         } else{

              redirect('admin');
         }
    }


    //deleting part - GRE,IELTS, TOEFL

    function delete_gre_video(){
       if($this->session->userdata('admin_logged_in')=='true'){
          $query= $this->Admin_Model->delete_video($this->input->post('video_id'),$this->input->post('video_link'));

         // unlink(FCPATH.$this->input->post('video_link'));
           if($query):
                $this->session->set_flashdata('success','video deleted successfully');
           else:
               $this->session->set_flashdata('error','video not deleted ! Please try again');
           endif;

           redirect('add_gre_video');

         } else{

              redirect('admin');
      }
    }

    function delete_gre_book(){
       if($this->session->userdata('admin_logged_in')=='true'){
          $query= $this->Admin_Model->delete_book($this->input->post('book_id'),$this->input->post('book_link'));

         // unlink(FCPATH.$this->input->post('video_link'));
           if($query):
                $this->session->set_flashdata('success','book deleted successfully');
           else:
               $this->session->set_flashdata('error','book not deleted ! Please try again');
           endif;

           redirect('add_gre_book');

         } else{

              redirect('admin');
      }
    }

    function delete_gre_audio(){
       if($this->session->userdata('admin_logged_in')=='true'){
          $query= $this->Admin_Model->delete_audio($this->input->post('audio_id'),$this->input->post('audio_link'));

         // unlink(FCPATH.$this->input->post('video_link'));
           if($query):
                $this->session->set_flashdata('success','audio deleted successfully');
           else:
               $this->session->set_flashdata('error','audio not deleted ! Please try again');
           endif;

           redirect('add_gre_audio');

         } else{

              redirect('admin');
      }
    }

     function delete_ielts_video(){
       if($this->session->userdata('admin_logged_in')=='true'){
          $query= $this->Admin_Model->delete_video($this->input->post('video_id'),$this->input->post('video_link'));

         // unlink(FCPATH.$this->input->post('video_link'));
           if($query):
                $this->session->set_flashdata('success','video deleted successfully');
           else:
               $this->session->set_flashdata('error','video not deleted ! Please try again');
           endif;

            redirect('add_ielts_video');

         } else{

            redirect('admin');
      }
    }


    function delete_ielts_book(){
       if($this->session->userdata('admin_logged_in')=='true'){
          $query= $this->Admin_Model->delete_book($this->input->post('book_id'),$this->input->post('book_link'));

         // unlink(FCPATH.$this->input->post('video_link'));
           if($query):
                $this->session->set_flashdata('success','book deleted successfully');
           else:
               $this->session->set_flashdata('error','book not deleted ! Please try again');
           endif;

           redirect('add_ielts_book');

         } else{

              redirect('admin');
      }
    }

    function delete_ielts_audio(){
       if($this->session->userdata('admin_logged_in')=='true'){
          $query= $this->Admin_Model->delete_audio($this->input->post('audio_id'),$this->input->post('audio_link'));

         // unlink(FCPATH.$this->input->post('video_link'));
           if($query):
                $this->session->set_flashdata('success','audio deleted successfully');
           else:
               $this->session->set_flashdata('error','audio not deleted ! Please try again');
           endif;

           redirect('add_ielts_audio');

         } else{

              redirect('admin');
      }
    }

     function delete_toefl_video(){
       if($this->session->userdata('admin_logged_in')=='true'){
            $query= $this->Admin_Model->delete_video($this->input->post('video_id'),$this->input->post('video_link'));

            // unlink(FCPATH.$this->input->post('video_link'));
             if($query):
                  $this->session->set_flashdata('success','video deleted successfully');
             else:
                 $this->session->set_flashdata('error','video not deleted ! Please try again');
             endif;

              redirect('add_toefl_video');

         } else{

              redirect('admin');
           }
    }


    function delete_toefl_book(){
       if($this->session->userdata('admin_logged_in')=='true'){
          $query= $this->Admin_Model->delete_book($this->input->post('book_id'),$this->input->post('book_link'));

         // unlink(FCPATH.$this->input->post('video_link'));
           if($query):
                $this->session->set_flashdata('success','book deleted successfully');
           else:
               $this->session->set_flashdata('error','book not deleted ! Please try again');
           endif;

           redirect('add_toefl_book');

         } else{

              redirect('admin');
      }
    }

    function delete_toefl_audio(){
       if($this->session->userdata('admin_logged_in')=='true'){
          $query= $this->Admin_Model->delete_audio($this->input->post('audio_id'),$this->input->post('audio_link'));

         // unlink(FCPATH.$this->input->post('video_link'));
           if($query):
                $this->session->set_flashdata('success','audio deleted successfully');
           else:
               $this->session->set_flashdata('error','audio not deleted ! Please try again');
           endif;

           redirect('add_toefl_audio');

         } else{

              redirect('admin');
      }
    }


}
