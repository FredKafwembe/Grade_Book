<form method="post" action="<?php echo URL; ?>subjects/addGrade">
   
    <br/>
    
        
         <select name="user_id_fk">
          <?php foreach($this->subjectList as $sub) {
            
            printf("<option value='%s'>%s</option>", $sub["user_id_fk"], $sub["first_name"]);
          
        }?>
      </select><br/>
        <label>Mark</label><input type="number" name="percentage" value=""/><br/>
    	<label>Subject</label>
     	 <select name=" subject_id_fk">
        	<?php foreach($this->subjectList as $sub) {
          	
            printf("<option value='%s'>%s</option>", $sub["subject_id"], $sub["name"]);
          
        }?>
      </select><br/>
      
      <label>Test Time</label>
     	 <select name="test_time">   	
          	
        <option value="mid">Mid Term</option>
  			<option value="end">End Of Term</option>
          
        
      </select><br/>


    <label>&nbsp;</label><input type='submit'/>
</form>