<tr>
      <td><?php //echo $count ;?></td>
      <td><?php echo $data['student_name'] ;?></td>
      <td><?php echo $data['email'] ;?></td>
      <td><?php echo $data['mobile_no'] ;?></td>
      <td><?php echo $data['username'] ;?></td>
      <td><?php echo $data['course_selected'] ;?></td>
      <td><?php echo $data['created'] ;?></td>                     

      <td><?php echo date('d-m-Y H:i:s',strtotime($data['modified'])); ?></td>
      <td>
        <button type="button" name="delete" class="btn btn-warning" data-toggle="modal" data-target="#myModalu<?php echo $data['student_id']; ?>">Edit</button>
        <button type="button" name="delete" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $data['student_id']; ?>">Delete</button>
      </td>
</tr>