<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div id="container">

    <div id="nav_main" class="widget">
        <div class="head"><h4>Navigation</h4></div>
        <ul>
            <!-- Public nav !-->
            <a href="<?php echo site_url("landing/"); ?>"><li>Home</li></a>
            <a href="#"><li>Notice</li></a>
            <a href="<?php echo site_url("contact_us/"); ?>"><li>Contact</li></a>
            <a href="<?php echo site_url("feedback/"); ?>"><li>Feedback</li></a>
            <!-- private nav !-->
            <?php if($is_loggedin): ?>
            <a href="#"><li>Profile</li></a>
            <a href="#"><li>Chat</li></a>
            <a href="#"><li>Discussion</li></a>
            <a href="<?php echo site_url("landing/logout"); ?>"><li>Logout</li></a>

            <?php endif; ?>
        </ul>
    </div>

    <div id="status_and_mess" class="widget">
        <?php if(isset($message)):?>
        <div id="message" class="widget">
            <p><?php echo $message; ?></p>
        </div>
        <?php endif; ?>

        <div id="status-public" class="widget">
            <div class="head"><?php echo "<h4>Peoples say...</h4>" ?></div>
            <?php
            echo "<ul>";

            $sts = new Status_model() ;
            $public_statuses = $sts->get_public_status_front_page();

            foreach($public_statuses as $status)
            {
                echo "<li><blockquote><b>".$status->get_username()."</b></blockquote> says... ".$status->body."</li>\n"."<hr /><br /><br />";
            }

            echo "</ul>" ;
            ?>
        </div>
    </div>

    <?php if( isset($is_loggedin)&&!$is_loggedin): ?>
    <div id="form-login" class="widget">    <!-- In this front_page you need to add a div with an id and class="widget" !-->
        <div class="head"><h4>Login</</h4></div>
        <br />
        <p><?php echo validation_errors(); ?></p>
        <?php $form_data = array( 'name' => 'form-login'); ?>
        <?php echo form_open('landing/login', $form_data); ?>
        <?php echo form_label('Username :', 'username') ; ?>
        <?php $input_data = array( 'type' => 'text', 'id' => 'form-login-input-username', 'name' => 'username') ; ?>
        <?php echo form_input($input_data); ?>
        <?php echo "<br /><br />"; ?>
        <?php echo form_label('Password :', 'password'); ?>
        <?php $input_data = array( 'type' => 'password', 'id' => 'form-login-input-password', 'name' => 'password'); ?>
        <?php echo form_input($input_data); ?>
        <?php echo form_submit('form-login-submit', 'Go!');?>
        <?php echo form_close();?>
    </div>
    <?php endif; ?>

    <div id="form-sign-up" class="widget">
        <div class="head"><h4>Sign Up</</h4></div>
        <br/>
        <?php
            echo validation_errors();

            $form_data = array('name'=>'form_sign_up');
            echo form_open('landing/sign_up',$form_data);

            echo form_label('Username:', 'username');
            $input_data=array('name'=>'username','type'=>'text','id'=>'form-sign-up-name');
            echo form_input($input_data);
            echo "<br /><br />";

            echo form_label('Password:', 'password');
            $input_data=array('name'=>'password','type'=>'password','id'=>'form-sign-up-password');
            echo form_input($input_data);
            echo "<br /><br />";

            echo form_label('password Confirm:', 'passconfm');
            $input_data=array('name'=>'passconfm','type'=>'password','id'=>'form-sign-up-password-confirm');
            echo form_input($input_data);
        echo "<br /><br />";

            echo form_label('Phone no.:', 'phone');
            $input_data=array('name'=>'phone','type'=>'text','id'=>'form-sign-up-phone');
            echo form_input($input_data);
        echo "<br /><br />";

            echo form_label('E-mail:', 'email');
            $input_data=array('name'=>'email','type'=>'text','id'=>'form-sign-up-email');
            echo form_input($input_data);
        echo "<br /><br />";

            echo form_label('Gender:', 'gender');
            $data = array(
                'name'        => 'gender',
                'value'       => 'm',
                'checked'     => TRUE,
            );
            echo form_radio($data);

            echo form_label('male', 'form-sign-up-gender-male');
            $data = array(
                'name'        => 'gender',
                'value'       => 'f',
                'checked'     => FALSE,
            );
            echo form_radio($data);

            echo form_label('female', 'form-sign-up-gender-female');
        echo "<br /><br />";

            echo form_label('Address:', 'address');
            $input_data=array('name'=>'address','type'=>'text','id'=>'form-sign-up-address');
            echo form_input($input_data);
        echo "<br /><br />";

            echo form_submit('sign_up_submit','Submit');
        echo "<br /><br />";
            echo form_close();
        ?>
    </div>

    <div id="debug" class="widget">
        <?php //echo $this->session->userdata('user_agent'); ?>
    </div>

    <!-- add module like this --- !-->




</div>

