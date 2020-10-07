<?php
/**
 * Plugin Name: Mytable
 * Description: You can Easily manage Your Customer
 * Version: 1.0.0
 */

if(!defined('ABSPATH'))
{
	die('invalid');
}



add_shortcode('form_shortcode','fn_form_shortcode');

function fn_form_shortcode()
{
	?>
<form id="myform">
<div class="form-group"> <label for="Name">Name:</label>
    <input type="text" class="form-control" placeholder="Enter your Name" id="email" name="name">
  </div>
  <div class="form-group"> 
  <input type="hidden" class="form-control" value="enquiry_form_submit"  name="action">
  </div>
  <div class="form-group"> <label for="email">Email address:</label>
    <input type="email" class="form-control" placeholder="Enter Your email" id="email" name="email">
  </div>
   <div class="form-group"> <label for="phone">Phone Number:</label>
    <input type="Text" class="form-control" placeholder="Enter Your PhoneNumber" id="email" name="phone">
  </div>
   <div class="form-group"> <label for="message">Message:</label>
    <textarea  class="form-control" placeholder="Enter Your Message" name="message"></textarea>
  </div>

<button type="button" id="submit_demo_1">Submit</button>
</form>
<script>

	jQuery(document).ready(function(){
		jQuery("#submit_demo_1").on("click",function(){
		 var data = jQuery("#myform").serialize();
        jQuery.ajax({
           		url:"<?php echo admin_url('admin-ajax.php') ?>",
           		type:"post",
           		data:data,
           		dataType:"JSON",
           		success:function(res)
           		{
           			alert("Form Successfully Submitted");
           		}
           	});
	});
	});
   

		
</script>
<?php
}



