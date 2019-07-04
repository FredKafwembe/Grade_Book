<h1> Grade : Edit</h1>

<?php 

echo "the number is";
foreach ($this->subjectList as $key ) {
  # code...
 global $x ;
$x= $key['subject_id'];
 print $x;
}


 ?>for the funtiom
<form method="post" action="<?php echo URL; ?>subjects/updateMark<?php foreach ($this->subjectList as $key ) {
  print_r($key['subject_id']);
}?>">

  
      <label>Mark</label><input type="number" name=" percentage" value="<?php echo $this->subjectList['percentage']; ?>"/><br/>
    	<label>Subject</label>
     	<select name="subject_id">	<?php foreach($this->subjectList as $sub) {
            
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