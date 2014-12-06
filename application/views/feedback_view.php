<div id="form-feedback" class="widget">
	<?php
		echo validation_errors();

		$form_data = array('name'=>'form_feedback');
		echo form_open('feedback',$form_data);

        echo form_label('Name:', 'name');
		$input_data=array('name'=>'name','type'=>'text','id'=>'form-feedback-name');
		echo form_input($input_data);
		
		echo form_label('Room no.:', 'room');
		$input_data=array('name'=>'room','type'=>'text','id'=>'form-feedback-room');
		echo form_input($input_data);

        echo form_label('Phone no.:', 'phone');
        $input_data=array('name'=>'phone','type'=>'text','id'=>'form-feedback-phone');
        echo form_input($input_data);
		
		echo form_label('E-mail:', 'email');
		$input_data=array('name'=>'email','type'=>'text','id'=>'form-feedback-email');
		echo form_input($input_data);
		
		echo form_label('Opinion:', 'opinion');
		$input_data=array('name'=>'opinion','type'=>'textarea','id'=>'form-feedback-opinion');
		echo form_textarea($input_data);
		
		echo form_submit('feed_submit','Submit');
        echo form_close();
	?>
</div>