<?php
Class Admin_model extends CI_Model
{

  
    function check_signin($username,$password)
    {
      $this->db->where('username',$username);
      $this->db->where('password',$password);
      $query = $this->db->get('admin');

      return ($query->num_rows()==1)? true:false;
    }

    function read_admin_information($username){
      $this->db->where('username',$username);
      $query = $this->db->get('admin');

      return $query->row();
    }

    function get_registered_student_list(){    
      $this->db->join('payment_status','payment_status.p_id=registered_student.payment_status');
      $this->db->join('courses','courses.course_id=registered_student.enrolled_courses');     
      return $this->db->get('registered_student')->result_array();

    }

    function get_all_students(){
        $query = $this->db->get('registered_student');

        if($query->num_rows() > 0):

          return $query->result();

        else:
          return false;

        endif;
    }

    function get_student_by_id($id){
        $this->db->where('student_id',$id);
        $this->db->join('payment_status','payment_status.p_id=registered_student.payment_status');
        $this->db->join('courses','courses.course_id=registered_student.enrolled_courses');     
        $query = $this->db->get('registered_student');

        return $query->row_array();

    }

    function get_course_list(){
      return $this->db->get('courses')->result_array();
    }

    function get_payment_status(){
      return $this->db->get('payment_status')->result_array();
    }
 
   function  insert_student_data($courses){
      
      $arrayData = array('username' => trim($this->input->post('username')),
                         'password' => md5(trim($this->input->post('password'))),
                         'student_name' => trim($this->input->post('student_name')), 
                         'email' => trim($this->input->post('email')),
                         'mobile_no' => trim($this->input->post('mobile_no')),
                         'enrolled_courses' => $courses,
                         'payment_status' => $this->input->post('payment_status'),
                         'created' => date('Y-m-d H:i:s')
                        );

      $this->db->insert('registered_student',$arrayData);

      return $this->db->insert_id();

   }

   function update_student($id,$password,$courses){
      $arrayData = array('username' => trim($this->input->post('username')),
                       'password' => $password,
                       'student_name' => trim($this->input->post('student_name')), 
                       'email' => trim($this->input->post('email')),
                       'mobile_no' => trim($this->input->post('mobile_no')),
                       'enrolled_courses' => $courses                       
                      );
      $this->db->where('student_id',$id);
      $this->db->update('registered_student',$arrayData);

      return($this->db->affected_rows()>0)? true:false;

   }

   function delete_student_by_id($id){

      $this->db->where('student_id',$id);
      $this->db->delete('registered_student');

      return($this->db->affected_rows()>0)? true:false;

   }

//GRE Subject Video Audio Books
   function get_gre_videos(){
      $this->db->where('course_id',1);
      $this->db->join('payment_status','payment_status.p_id=video.payment_status');
      return $this->db->get('video')->result_array();
   }

   function get_gre_books(){
      $this->db->where('course_id',1);
      $this->db->join('payment_status','payment_status.p_id=books.payment_status');
      return $this->db->get('books')->result_array();
   }

   function get_gre_audios(){
      $this->db->where('course_id',1);
      $this->db->join('payment_status','payment_status.p_id=audio.payment_status');
      return $this->db->get('audio')->result_array();
   }

  //IELTS Subject Video Audio Books
   function get_ielts_videos(){
      $this->db->where('course_id',2);
      $this->db->join('payment_status','payment_status.p_id=video.payment_status');
      return $this->db->get('video')->result_array();
   }

   function get_ielts_books(){
      $this->db->where('course_id',2);
      $this->db->join('payment_status','payment_status.p_id=books.payment_status');
      return $this->db->get('books')->result_array();
   }

   function get_ielts_audios(){
      $this->db->where('course_id',2);
      $this->db->join('payment_status','payment_status.p_id=audio.payment_status');
      return $this->db->get('audio')->result_array();
   } 

   //TOEFL Subject Video Audio Books
   function get_toefl_videos(){
      $this->db->where('course_id',3);
      $this->db->join('payment_status','payment_status.p_id=video.payment_status');
      return $this->db->get('video')->result_array();
   }

   function get_toefl_books(){
      $this->db->where('course_id',3);
      $this->db->join('payment_status','payment_status.p_id=books.payment_status');
      return $this->db->get('books')->result_array();
   }

   function get_toefl_audios(){
      $this->db->where('course_id',3);
      $this->db->join('payment_status','payment_status.p_id=audio.payment_status');
      return $this->db->get('audio')->result_array();
   } 

   function insert_video($course_id,$video){
      $arrayData = array('course_id' => $course_id, 
                        'payment_status' => $this->input->post('payment_status'),             
                         'subsection' => $this->input->post('subSection'),
                         'topic_name' => $this->input->post('topic_name'),
                         'video_title' => $this->input->post('video_title'),
                         'video' => $video,
                         'created_at' => date('Y-m-d H:i:s')
                        );

      $this->db->insert('video',$arrayData);
      return($this->db->affected_rows()>0)? true : false;
  }

  function insert_book($course_id,$book,$audio){
      $arrayData = array('course_id' => $course_id,
                          'payment_status' => $this->input->post('payment_status'), 
                         'subsection' => $this->input->post('subSection'),
                         'topic_name' => $this->input->post('topic_name'),
                         'book_title' => $this->input->post('book_title'),
                         'book' => $book,
                         'attached_audio' => $audio,
                         'created_at' => date('Y-m-d H:i:s')
                        );

      $this->db->insert('books',$arrayData);
      return($this->db->affected_rows()>0)? true : false;
  }

  function insert_audio($course_id,$audio){
      $arrayData = array('course_id' => $course_id,
                        'payment_status' => $this->input->post('payment_status'), 
                         'subsection' => $this->input->post('subSection'),
                         'topic_name' => $this->input->post('topic_name'),
                         'audio_title' => $this->input->post('audio_title'),
                         'audio' => $audio,
                         'created_at' => date('Y-m-d H:i:s')
                        );

      $this->db->insert('audio',$arrayData);
      return($this->db->affected_rows()>0)? true : false;
  }


  function update_book($id,$book,$audio){
      $arrayData = array('payment_status' => $this->input->post('payment_status'), 
                        'subsection' => $this->input->post('subSection'),
                         'topic_name' => $this->input->post('topic_name'),
                         'book_title' => $this->input->post('book_title'),
                         'book' => $book,
                         'attached_audio' => $audio,
                        );
      $this->db->where('id',$id);
      $query = $this->db->update('books',$arrayData);

      if($query):
          return true;
      else:
          return false;
      endif;
      
  }

  function update_video($id,$video){
    $arrayData = array('payment_status' => $this->input->post('payment_status'),
    'subsection' => $this->input->post('subSection'),
    'topic_name' => $this->input->post('topic_name'),
    'video_title' => $this->input->post('video_title'),
    'video' => $video);

    $this->db->where('id',$id);
    $query = $this->db->update('video',$arrayData);

    if($query):
          return true;
      else:
          return false;
      endif;
  }

  function update_audio($id,$audio){
    $arrayData = array('payment_status' => $this->input->post('payment_status'),
    'subsection' => $this->input->post('subSection'),
    'topic_name' => $this->input->post('topic_name'),
    'audio_title' => $this->input->post('audio_title'),
    'audio' => $audio);

    $this->db->where('id',$id);
    $query = $this->db->update('audio',$arrayData);

    if($query):
          return true;
      else:
          return false;
      endif;
  }

  function get_topics($subsection){
      $this->db->where('subsection',$subsection);
      $query = $this->db->get('topic');
      return $query->result_array();
  }


//deleting purpose

  function delete_video($id,$link){
    $this->db->where('id',$id);
    $this->db->delete('video');
    if($this->db->affected_rows()>0):
          if($link!=''):
              unlink(FCPATH.$link);
          endif;
          return true;
    else:
          return false;
    endif;

  }

  function delete_audio($id,$link){
    $this->db->where('id',$id);
    $this->db->delete('audio');
    if($this->db->affected_rows()>0):
          if($link!=''):
              unlink(FCPATH.$link);
          endif;
          return true;
    else:
          return false;
    endif;

  }

  function delete_book($id,$link){
    $this->db->where('id',$id);
    $this->db->delete('books');
    if($this->db->affected_rows()>0):
          if($link!=''):
              unlink(FCPATH.$link);
          endif;
          return true;
    else:
          return false;
    endif;

  }
 

}//class

?>
