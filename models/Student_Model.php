<?php
Class Student_model extends CI_Model
{

    function student_login($username,$password){

          $this->db->where('username',$username);
          $this->db->where('password',$password);
          $query = $this->db->get('registered_student');
          return($query->num_rows()>0)? true : false; 

    }  

    // function getStudent($id = ""){  

    //     if(!empty($id)){

    //         $query = $this->db->get_where('registered_student', array('student_id' =>$id));
    //         return $query->row_array();

    //     } else{

    //         $query=$this->db->get('registered_student');
    //         return $query->result_array();

    //     }  

    // }

    function getCourse($c_id){
        $this->db->where('course_id',$c_id);
        $query = $this->db->get('courses')->row_array();
        return $query;
    }

    function verify_student($username,$password){
        $this->db->where('username',$username);
        $this->db->where('password',md5($password));
        $this->db->join('payment_status','payment_status.p_id=registered_student.payment_status');
        // $this->db->join('courses','courses.course_id=registered_student.enrolled');
        $query = $this->db->get('registered_student');
        return($query->num_rows()==1)? $query->row_array() : false;
    }

    function get_videos($c_id,$payment_status){
        $this->db->where('payment_status',$payment_status);
        $this->db->where('course_id',$c_id);
        $query = $this->db->get('video');
        return $query->result_array(); 

    }

    function get_audios($c_id,$payment_status){
        $this->db->where('payment_status',$payment_status);
        $this->db->where('course_id',$c_id);
        $query = $this->db->get('audio');
        return $query->result_array();

    }

    function get_books($c_id,$payment_status){
        $this->db->where('payment_status',$payment_status);
        $this->db->where('course_id',$c_id);
        $query = $this->db->get('books');
        return $query->result_array();
      
    }

}//class

?>
