<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     *  VARIABLE AVAILABLE:
     *
     *  $is_loggedin
     *  $message
     *
     * MODEL NEEDED TO LOAD
     * status_model
     *
     */
?>



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
        <?php if(isset($message)): ?>
            <?php echo '<div id="message" class="widget">'; ?>
            <p><?php echo $message; ?></p>
            <?php echo '</div>'; ?>
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

    <div id="form-status" class="widget">
        <div class="head"><?php echo "<h4>Your Status...</h4>" ?></div>
        <?php
            echo "<br />";
            echo validation_errors();
            echo form_open('home/status', array('name'=>'form-status'));
            echo form_input(array('name'=>'status-body', 'id'=>'status-body'));

            $options = array(
                '1'  => 'Public',
                '0'    => 'Private'
            );

            $shirts_on_sale = array('small', 'large');
            echo form_dropdown('status-type', $options, '0');

            echo form_submit('form-status-submit', 'Broadcast!');
            echo form_close();
        ?>

    </div>


    <div id="debug" class="widget">
        <?php //echo $this->session->userdata('user_agent'); ?>
    </div>

    <!-- add module like this --- !-->




</div>

