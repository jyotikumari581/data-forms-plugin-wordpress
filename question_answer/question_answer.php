<?php
/*
	Plugin Name: JK Questions answers
	Description: JK Questions answers
	Author: Jyoti Kumari
	Version: 4.1.0
*/
function libload()
{
    wp_enqueue_style('style_file' , plugin_dir_url(__FILE__).'style.css');
}
 
add_action('wp_enqueue_scripts','libload');
 

function my_menu_pages(){
 
 add_menu_page('Question List', 'Question Forms', 'edit_posts','list-form','questionnaire_boffin_form_page_mobile','dashicons-format-gallery', 6 );   


add_submenu_page(
    'list-form',          // parent slug
    'Forms',               // page title
    'Forms',               // menu title
    'manage_options',              // capability
    'list-form',  // slug
    'questionnaire_boffin_form_page_mobile' // callback
); 



add_submenu_page(
    'list-form',          // parent slug
    'Questions',               // page title
    'Questions',               // menu title
    'manage_options',              // capability
    'list-questions',  // slug
    'questionnaire_form_page_question' // callback
); 


  
add_submenu_page(
    'list-form',          // parent slug
    'Add New Form',               // page title
    'Add New Form',               // menu title
    'manage_options',              // capability
    'add-form',  // slug
    'questionnaire_form_page_handler' // callback
); 

  
add_submenu_page(
    'list-form',          // parent slug
    'Add New Question',               // page title
    'Add New Question',               // menu title
    'manage_options',              // capability
    'add-question',  // slug
    'questionnaire_question_page_handler' // callback
); 

 
 

 add_submenu_page(
    '',          // parent slug
    'Edit Form',               // page title
    'Edit  Form',               // menu title
    'manage_options',              // capability
    'portfolio-edit',  // slug
    'questionnaire_edit_form_page_handler' // callback
);  

  
 add_submenu_page(
    '',          // parent slug
    'Edit Question',               // page title
    'Edit  Question',               // menu title
    'manage_options',              // capability
    'question-edit',  // slug
    'questionnaire_edit_question_page_handler' // callback
);  

  
 



 add_submenu_page(
    '',          // parent slug
    'Delete Question',               // page title
    'Delete Question',               // menu title
    'manage_options',              // capability
    'portfolio-delete',  // slug
    'portfolio_delete_single' // callback
);  
 
 
 add_submenu_page(
    '',          // parent slug
    'Delete Question',               // page title
    'Delete Question',               // menu title
    'manage_options',              // capability
    'question-delete',  // slug
    'portfolio_delete_question' // callback
);  
 
 
/*
add_submenu_page(
    '',          // parent slug
    'Delete Question',               // page title
    'Delete Question',               // menu title
    'manage_options',              // capability
    'category-delete',  // slug
    'portfolio_delete_category' // callback
); 
*/
 
}
 
add_action('admin_menu', 'my_menu_pages');


/* Delete Category */
/*
function portfolio_delete_category() {
	 global $wpdb;
	 $table_name =  $wpdb->prefix."questionare_categories";
	 $deleteid = $_POST['deleteid'];
	 $wpdb->delete( $table_name, array( 'portfolio_cat_id' => $deleteid ) );
     echo '<script>window.location.replace("?page=portfolio-editcat")</script>';
}
*/


/* Delete Form */

function portfolio_delete_single() {
	  global $wpdb;
	  $table_name =  $wpdb->prefix."questionare";
	  $deleteid = $_POST['deleteid'];
	  $category_selected = $_POST['category_selected'];

	$wpdb->delete( $table_name, array( 'id' => $deleteid ) );
 
	print_r("<p class='greentext' >Item Deleted Successfully</p>");
 
   echo '<script>window.location.replace("?page=list-form")</script>';
 
}



/* Delete Question */

function portfolio_delete_question() {
	  global $wpdb;
	  $table_name =  $wpdb->prefix."all_questions";
	  $deleteid = $_POST['deleteid'];
	 

	  $wpdb->delete( $table_name, array( 'id' => $deleteid ) );
	  print_r("<p class='greentext' >Item Deleted Successfully</p>");
      echo '<script>window.location.replace("?page=list-questions")</script>';
}

 
 
/* Edit Question */

function questionnaire_edit_form_page_handler() {
  global $wpdb;
  $table_name =  $wpdb->prefix."questionare";
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $cid = explode("portfolio-id=",$actual_link);
  $currentport_id = $cid[1];
  $default_row = $wpdb->get_row( "SELECT * FROM $table_name WHERE id='$currentport_id'");
  wp_enqueue_style('style_file' , plugin_dir_url(__FILE__).'style.css');  
  
	$table_name2 =  $wpdb->prefix."all_questions";
 
	$get_questions = $wpdb->get_results( "SELECT * FROM $table_name2" );
?>
<br/>

 <form method="POST" action="?page=list-form" class="fom1">
 <h1>Edit Form</h1>
  <table class="form-table" id="ftable_apps" role="presentation">
  <tbody>
  <tr> 
    <th scope="row"><label>Form Name: </label> </th>
    <td><input type="text" value="<?php echo $default_row->form_name; ?>" name="form_name" required="required"/> </td>
  </tr>
 
  <!--  <tr>
    <th scope="row"><label> Select Questions : </label></th>
	 <td> 
 
		<?php
       // $inc = 1;
	//	foreach($get_questions as $values) {  ?>
			<input type="checkbox" id="select_question<?php //echo $inc;  ?>" name="form_data[]" value="<?php //echo $values->id; ?>">
			<label for="select_question<?php //echo $inc;  ?>"><?php //echo $values->question_name; ?></label><br>
         <?php // $inc++; } ?>
 
	 </td>
   </tr> -->
    <tr>
		<th scope="row"><label>SORT ORDER: </label></th>
		<td><input type="number" class="sort-order-number" name="sort_order" value="<?php echo $default_row->sort_order; ?>" required="required"/>
	    </td>
  </tr>
  <tr>
     <input name="cid" type="hidden" value="<?php echo $currentport_id; ?>"/>
	  <td> </td>
	 <td><input type="submit" name="formedit" value="Save" class="" /></td>
  </tr>
  </tbody>
 </table>
</form>
 
<?php
}


 
/* Edit Form */

function questionnaire_edit_question_page_handler() {
  global $wpdb;
  $table_name =  $wpdb->prefix."all_questions";
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $cid = explode("question-id=",$actual_link);
  $currentport_id = $cid[1];
  $default_row = $wpdb->get_row( "SELECT * FROM $table_name WHERE id='$currentport_id'");
  wp_enqueue_style('style_file' , plugin_dir_url(__FILE__).'style.css'); 
 
   $table_name2 =  $wpdb->prefix."questionare";
   $get_questions = $wpdb->get_results( "SELECT * FROM $table_name2" );
   wp_enqueue_style('style_file' , plugin_dir_url(__FILE__).'style.css');    
 
   $already_added_questions = $default_row->forms;
   $data_forms= explode(' ', $already_added_questions);
?>
<br/>

    <script>
        // jQuery functions to hide and show the div
        jQuery(document).ready(function () {
            jQuery("select").change(function () {
                jQuery(this).find("option:selected")
                       .each(function () {
                    var optionValue = jQuery(this).attr("value");
                    if (optionValue) {
                        jQuery(".box").not("." + optionValue).hide();
                        jQuery("." + optionValue).show();
                    } else {
                        jQuery(".box").hide();
                    }
                });
            }).change();
        });
    </script>


 <form method="POST" action="?page=list-questions" class="fom1">
 <h1>Edit Question</h1>
  <table class="form-table" id="ftable_apps" role="presentation">
  <tbody>
  <tr> 
    <th scope="row"><label>Question Name: </label> </th>
    <td><input type="text" value="<?php echo $default_row->question_name; ?>" name="question_name" required="required"/> </td>
  </tr>
  
  <tr> 
    <th scope="row"><label>Question type: </label> </th>
	<td>
	<select name="question_type">
		<option value="textarea_question" <?php if($default_row->question_type == "textarea"){ ?> selected <?php } ?>>Textarea</option>
		<option value="input_question" <?php if($default_row->question_type == "input"){ ?> selected <?php } ?>>Input</option>
		<option value="checkbox_question" <?php if($default_row->question_type == "checkbox"){ ?> selected <?php } ?>>Checkbox</option>
		<option value="radiobox_question" <?php if($default_row->question_type == "radiobox"){ ?> selected <?php } ?>>Radiobox</option>
    </select>
   </td>
  </tr>
 
 
  <tr> 
    <th scope="row"><label>Question Answer: </label> </th>
    <td>
	 <textarea class="checkbox_question radiobox_question box" style="height: 133px; width: 100%;" type="text" value="<?php echo $default_row->question_answer; ?>" name="question_answer"/><?php echo $default_row->question_answer; ?></textarea>
	 
	</td>
  </tr>
  
  
  <tr>
   <th scope="row"><label>Select Forms:</label></th>
	 <td> 
		<?php 
		 $inc = 1;
		foreach($get_questions as $values) {  ?>
			<input type="checkbox" <?php echo (in_array($values->id, $data_forms)?'checked':''); ?> id="select_question<?php echo $inc; ?>" name="form_data[]" value="<?php echo $values->id; ?>">
			<label for="select_question<?php echo $inc; ?>"><?php echo $values->form_name; ?></label><br>
         <?php $inc++; } ?>  
	 </td>
   </tr>
  
 
  <tr>
		<th scope="row"><label>SORT ORDER: </label></th>
		<td><input type="number" class="sort-order-number" name="sort_order" value="<?php echo $default_row->sort_order; ?>" required="required"/>
	    </td>
  </tr>
  <tr>
     <input name="cid" type="hidden" value="<?php echo $currentport_id; ?>"/>
	  <td> </td>
	 <td><input type="submit" name="formedit" value="Save" class="" /></td>
  </tr>
  </tbody>
 </table>
</form>
 
<?php
}
 
/* Question List Mobile */ 
 
function questionnaire_boffin_form_page_mobile() { 
	
  global $wpdb;
  $table_name =  $wpdb->prefix."questionare";
  $default_row = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY sort_order" );
 
	if (isset($_POST['form1']))
	{ 
	 	$form_name =  $_POST['form_name'];
 	    $sort_order= $_POST["sort_order"];
 	    $submit_btn= $_POST["submit_btn"];
  
 
  	$wpdb->insert($table_name, array(
			'form_name' => $form_name,
			'submit_btn' => $submit_btn,
			'sort_order' => $sort_order,
    ));
 
		print_r("<p class='greentext'  >Data Saved Successfully</p>");
     
		echo '<script>window.location.replace("?page=list-form")</script>';
	 }
  
  
   if (isset($_POST['formedit']))
	{   
	//	$form_data = $_POST['form_data'];
	 	$form_name =  $_POST['form_name'];
 	    $sort_order= $_POST["sort_order"];
	    $currentport_id = $_POST['cid'];
	    $submit_btn= $_POST["submit_btn"];
	     
	//	$form_data_all="";  
	// 	foreach($form_data as $chk1)  
	//	   {  
	//		  $form_data_all.= $chk1." ";  
	//	   }  
 
        $wpdb->update($table_name, array('form_name'=>$form_name, 'submit_btn'=>$submit_btn, 'sort_order'=>$sort_order), array('id'=>$currentport_id));
 
		 print_r("<p class='greentext'  >Data Saved Successfully</p>");
  
		echo '<script>window.location.replace("?page=list-form")</script>';
	}
	
 if(isset($_POST['but_delete'])){
	$table = "bw_questionare";
	if(isset($_POST['delete']))
	{
	  $arrLength = count($_POST['delete']);
	}
	 
      if(isset($_POST['delete']))
          {
            foreach($_POST['delete'] as $deleteid)
		      {
	           $wpdb->delete( $table, array( 'id' => $deleteid ) );
              }
          }
		  if ($arrLength == 1)
		  {
			print_r("<p class='greentext' class='greentext'  > 1 row Deleted Successfully</p>");
		  }
		   else if ($arrLength > 1)
		  {
			print_r("<p class='greentext'>".$arrLength." rows Deleted Successfully</p>");
		  }
	}
      
 
   
  $table_name =  $wpdb->prefix."questionare";
  $default_row = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY sort_order" );
  wp_enqueue_style('style_file' , plugin_dir_url(__FILE__).'style.css');   
  ?>
  <link rel="stylesheet" href="style.css">
  <h1 class="page-title">Forms List </h1> <p> <a href="./admin.php?page=add-form" class="page-title-action">Add New Form +</a>
 
 <form method='post' action=''> 
 <!-- <input type='submit' class="del-port" value='Delete Selected' name='but_delete' onclick="return validate()"><br> -->
 <table class="wp-list-table widefat fixed striped table-view-list forms" id="Mobiletable"> 
     <thead>
	  <tr>
        <th class="manage-checkbox"><input type="checkbox" onClick="toggle(this)" /></th>  
	    <th class="manage-columnbig">Name</th>
	    <th class="manage-columnbig">Submit Button Name</th>
	    <th class="manage-columnbig">Shortcode</th>
	    <th class="manage-columnsmall">Sort Order</th>
	    <th class="manage-columnsmallbig">Action</th>
      </tr>
	  </thead>  
       <?php foreach($default_row as $values) { ?>
       <tr>
	   <td class="port-checkbox"><input type='checkbox' class="delete" name='delete[]' value='<?php  echo $values->id; ?>' id='delcheckboxes' ></td>  
	 
	 <td class="port-name">
	  <?php echo $values->form_name;?>
	 </td>
 
	 <td class="port-yesno">
	  <?php echo $values->submit_btn; ?>
	 </td>
    
	<td class="port-yesno">
	  [question_form_<?php echo  $values->id;?>]
	 </td>
 
	 <td class="port-sort">
	  <?php echo $values->sort_order;?>
	 </td>
 
	 <td class="port-action">
	 <form> </form>
	  <b><a class="fa fa-edit" title="Edit Question" href="?page=portfolio-edit&portfolio-id=<?php echo $values->id; ?>"> Edit </a>  <form action='?page=portfolio-delete&portfolio-id=<?php echo $values->id; ?>' method='post' onSubmit="return confirm('Are you sure you wish to delete?');"> <input type='hidden' name="deleteid" value='<?php echo $values->id;?>'/><input type='hidden' name="category_selected"/><button type='submit' title="Delete Question" class="fa fa-trash" name="" value='Delete' onclick="deleteMobile()"> Delete</button>
	 </form></b>
	 </td>
	 
    </tr>
   <?php } ?>
   </table>
   
   <script type="text/javascript">
    function validate() {
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
		 if (checkedOne == false) 
		 {	
			alert("Please Select Items");
			return false;
		 }
		 else
		 {
			 if (confirm('Are you sure you wish to delete Selected Items?'))
			 {
				return true; 
			 }
			 else
			 {
				 return false;
			 }
		 }
    }
	
	function toggle(source) {
  checkboxes = document.getElementsByClassName('delete');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
	
</script>
    </form>  
 
  <?php
}
 
 
 
 
/* Question List  */ 
 
function questionnaire_form_page_question() {
	
  global $wpdb;
  $table_name =  $wpdb->prefix."all_questions";
  $default_row = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY sort_order" );
 
	if (isset($_POST['form1']))
	{ 
       
	 	$question_name =  $_POST['question_name'];
	 	$question_type =  $_POST['question_type'];
	 	$question_answer =  $_POST['question_answer'];
	    $sort_order= $_POST["sort_order"];
	    $form_data= $_POST["form_data"];

 
       $form_list="";  
       foreach($form_data as $chk1)  
       {  
          $form_list.= $chk1." ";  
       }  
 
 
  	$wpdb->insert($table_name, array(
			'question_name' => $question_name,
			'question_type' => $question_type,
			'question_answer' => $question_answer,
			'forms' => $form_list,
			'sort_order' => $sort_order,
     ));
 
		print_r("<p class='greentext'  >Data Saved Successfully</p>");
     
		echo '<script>window.location.replace("?page=list-questions")</script>';
	 }
  
  
   if (isset($_POST['formedit']))
	{   
		 
	 	$question_name =  $_POST['question_name'];
	 	$question_type =  $_POST['question_type'];
	 	$question_answer =  $_POST['question_answer'];
	    $currentport_id = $_POST['cid'];
	    $sort_order= $_POST["sort_order"];
		$form_data= $_POST["form_data"];

	   $form_list="";  
          foreach($form_data as $chk1)  
             {  
               $form_list.= $chk1." ";  
             }  
 
        $wpdb->update($table_name, array('id'=>$currentport_id, 'question_name'=>$question_name, 'sort_order'=>$sort_order, 'question_type'=>$question_type, 'question_answer'=>$question_answer, 'forms'=>$form_list), array('id'=>$currentport_id));
 
		 print_r("<p class='greentext'  >Data Saved Successfully</p>");
 
		echo '<script>window.location.replace("?page=list-questions")</script>';
	}
	
 if(isset($_POST['but_delete'])){
	$table = "bw_questionare";
	if(isset($_POST['delete']))
	{
	  $arrLength = count($_POST['delete']);
	}
	 
      if(isset($_POST['delete']))
          {
            foreach($_POST['delete'] as $deleteid)
		      {
	           $wpdb->delete( $table, array( 'id' => $deleteid ) );
              }
          }
		  if ($arrLength == 1)
		  {
			print_r("<p class='greentext' class='greentext'  > 1 row Deleted Successfully</p>");
		  }
		   else if ($arrLength > 1)
		  {
			print_r("<p class='greentext'>".$arrLength." rows Deleted Successfully</p>");
		  }
	}
      
 
   
  $table_name =  $wpdb->prefix."all_questions";
  $default_row = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY sort_order" );
  wp_enqueue_style('style_file' , plugin_dir_url(__FILE__).'style.css');   
  ?>
  <link rel="stylesheet" href="style.css">
  <h1 class="page-title">Question List </h1> <a href="./admin.php?page=add-question" class="page-title-action">Add New Question +</a>
 
 <form method='post' action=''> 
<!-- <input type='submit' class="del-port" value='Delete Selected' name='but_delete' onclick="return validate()"><br>  -->
 <table class="wp-list-table widefat fixed striped table-view-list forms" id="Mobiletable"> 
     <thead>
	  <tr>
        <th class="manage-checkbox"><input type="checkbox" onClick="toggle(this)" /></th>  
	    <th class="manage-columnbig">Question</th>
	    <th class="manage-columnbig">Answer</th>
	    <th class="manage-columnsmall">Sort Order</th>
	    <th class="manage-columnsmallbig">Action</th>
      </tr>
	  </thead>  
       <?php foreach($default_row as $values) { ?>
       <tr>
	   <td class="port-checkbox"><input type='checkbox' class="delete" name='delete[]' value='<?php  echo $values->id; ?>' id='delcheckboxes' ></td>  
	 
	 <td class="port-name">
	  <?php echo $values->question_name;?>
	 </td>
 
	 <td class="port-yesno">
	  <?php echo $values->question_answer; ?>
	 </td>
 
	 <td class="port-sort">
	  <?php echo $values->sort_order;?>
	 </td>
 
	 <td class="port-action">
	 <form> </form>
	  <b><a class="fa fa-edit" title="Edit Question" href="?page=question-edit&question-id=<?php echo $values->id; ?>"> Edit </a> <form action='?page=question-delete&question-id=<?php echo $values->id; ?>' method='post' onSubmit="return confirm('Are you sure you wish to delete?');"> <input type='hidden' name="deleteid" value='<?php echo $values->id;?>'/><input type='hidden' name="category_selected" value='<?php echo $values->id;?>'/><button type='submit' title="Delete Question" class="fa fa-trash" name="" value='Delete' onclick="deleteMobile()"> Delete</button>
	 </form></b>
	 </td>
	 
    </tr>
   <?php } ?>
   </table>
   
   <script type="text/javascript">
    function validate() {
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
		 if (checkedOne == false) 
		 {	
			alert("Please Select Items");
			return false;
		 }
		 else
		 {
			 if (confirm('Are you sure you wish to delete Selected Items?'))
			 {
				return true; 
			 }
			 else
			 {
				 return false;
			 }
		 }
    }
	
	function toggle(source) {
  checkboxes = document.getElementsByClassName('delete');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
	
</script>
    </form>  
 
  <?php
}
 

/* Add new Form */ 
 
function questionnaire_form_page_handler() {
 
  global $wpdb;
  $table_name =  $wpdb->prefix."questionare";
 // $default_row = $wpdb->get_row( "SELECT * FROM $table_name WHERE portfolio_id='1'" );
  wp_enqueue_style('style_file' , plugin_dir_url(__FILE__).'style.css');  
 
  ?>
 </script> 
<link rel="stylesheet" href="style.css">
 <br/>
 <form method="POST" action="?page=list-form" class="fom1">
  <h1>Add new Form</h1>
  <table class="form-table" id="ftable_apps" role="presentation">
  <tbody>
   <tr scope="row">
   <th scope="row" colspan="2">
  </th>
 </tr> 
 
  <tr> 
    <th scope="row"><label>Form Name: </label> </th>
    <td><input type="text" value="<?php // echo $default_row->form_name; ?>" name="form_name" required="required"/> </td>
  </tr>
  
   <tr> 
     <th scope="row"><label>Submit Button Name: </label> </th>
     <td><input type="text" name="submit_btn" required=""/> </td>
   </tr>
 
  
   <tr>
		<th scope="row"><label>sort order: </label></th>
		<td><input type="number" class="sort-order-number" name="sort_order" value="<?php //echo $default_row->sort_order; ?>" required="required" />
	    </td>
  </tr>
  <tr>
     <td> </td>
	 <td><input type="submit" name="form1" value="Save" /></td>
  </tr>
  </tbody>
 </table>
</form>
 
 <?php
}
 
 

/* Add new Question */ 
 
function questionnaire_question_page_handler() {
	global $wpdb;
   $table_name2 =  $wpdb->prefix."questionare";
   $get_questions = $wpdb->get_results( "SELECT * FROM $table_name2" );
   wp_enqueue_style('style_file' , plugin_dir_url(__FILE__).'style.css');  
  ?>
 </script> 
<link rel="stylesheet" href="style.css">
 
    <script>
        // jQuery functions to hide and show the div
        jQuery(document).ready(function () {
            jQuery("select").change(function () {
                jQuery(this).find("option:selected")
                       .each(function () {
                    var optionValue = jQuery(this).attr("value");
                    if (optionValue) {
                        jQuery(".box").not("." + optionValue).hide();
                        jQuery("." + optionValue).show();
                    } else {
                        jQuery(".box").hide();
                    }
                });
            }).change();
        });
    </script>

 
 <br/>
 <form method="POST" action="?page=list-questions" class="fom1">
  <h1>Add new Question</h1>
  <table class="form-table" id="ftable_apps" role="presentation">
  <tbody>
   <tr scope="row">
   <th scope="row" colspan="2">
  </th>
 </tr> 
  <tr> 
    <th scope="row"><label>Question Name: </label> </th>
    <td><input type="text" name="question_name" required="required"/> </td>
  </tr>
 
   <tr> 
    <th scope="row"><label>Question type: </label> </th>
	<td>
	<select name="question_type">
		<option value="textarea_question">Textarea</option>
		<option value="input_question">Input</option>
		<option value="checkbox_question">Checkbox</option>
		<option value="radiobox_question">Radiobox</option>
    </select>
   </td>
  </tr>
 
 
  <tr> 
    <th scope="row"><label>Question Answer: </label> </th>
    <td> 
	 <textarea class="checkbox_question radiobox_question box" style="height: 133px; width: 100%;" type="text" name="question_answer" /></textarea>
	</td>
  </tr>
  
  <tr>
		<th scope="row"><label>sort order: </label></th>
		<td><input type="number" class="sort-order-number" name="sort_order" value="<?php //echo $default_row->sort_order; ?>" required="required" />
	    </td>
  </tr>
  
  <tr>
   <th scope="row"><label>Select Forms:</label></th>
	 <td> 
		<?php 
		 $inc = 1;
		foreach($get_questions as $values) {  ?>
			<input type="checkbox" id="select_question<?php echo $inc; ?>" name="form_data[]" value="<?php echo $values->id; ?>">
			<label for="select_question<?php echo $inc; ?>"><?php echo $values->form_name; ?></label><br>
         <?php $inc++; } ?>  
	 </td>
  </tr>
  
  <tr>
     <td> </td>
	 <td><input type="submit" name="form1" value="Save" /></td>
  </tr>
  </tbody>
 </table>
</form>
 
 <?php
}

for($i = 1; $i <= 500; $i++) { 
   $cb = function() use ($i) {
   ob_start();	
   global $wpdb;
   $table_name =  $wpdb->prefix."all_questions";
   $get_questions = $wpdb->get_results( "SELECT * FROM $table_name WHERE forms regexp '(^|[[:space:]])$i([[:space:]]|$)'" );
 
 
   $user = wp_get_current_user();
   $user_id = $user->id;
   $form_id = $i;
   
   $answer_tbale = $wpdb->prefix."answers";
 
    $submit_dtat = 'submit_question'.$form_id;;
    
	if(isset($_POST[$submit_dtat]))
	{ 
	 $all_data = $_POST;
	 
	 foreach($all_data as $key=>$value)
	 {
 
	   if(is_array($value))
	   {
		   $chk="";
	   foreach($value as $chk1)  
       {  
          $chk.= $chk1."##";  
       }  
	   }
	   else
	   {
		   $chk = $value;
	   }
 
		 $wpdb->insert($answer_tbale, array(
			'user_id' => $user_id,
			'question_id' => $key,
			'form_id' => $form_id,
			'answer' => $chk,
		));  
	  }
	}
   
    ?>
	<iframe name="votar<?php echo $i; ?>" style="display:none;"></iframe>
	<form class="question-answer-form" target="votar<?php echo $i; ?>" class="" action="" method="POST">
    <?php
     foreach($get_questions as $value) {
	   echo  '<h3>'.$value->question_name.'</h3>';
	
	 $get_answers = $wpdb->get_results( "SELECT * FROM $answer_tbale where user_id = '$user_id' AND question_id = '$value->id' AND form_id = '$form_id'" );
     $answer_last = "";
       foreach($get_answers as $valueanswer)
	     {	
	       $answer_last = $valueanswer->answer;
	     }
	   
	   if($value->question_type == "textarea_question") {?>
	    
	    <textarea name="<?php echo $value->id; ?>"><?php echo $answer_last; ?></textarea>
	    
	  <?php
	   }
	   
	   if($value->question_type == "input_question") {?>
	    
	     <input class="radio-input-question" type="text" name="<?php echo $value->id; ?>" value="<?php echo $answer_last; ?>"/>
	    <br/> 
	  <?php
	   } 
	   
   if($value->question_type == "checkbox_question") {
	   
	  $answer = explode("##",$answer_last); 
 
	  $inc = 1;
	  $array_answers = preg_split("/\r\n|\n|\r/", $value->question_answer); 
	 foreach($array_answers as $checkvalues)
	   {
	  ?>
	 <input class="radio-input-checkbox" type="checkbox" id="select_question<?php echo $value->id; echo $inc;  echo $form_id;?>" name="<?php echo $value->id; ?>[]" value="<?php echo $checkvalues; ?>" <?php  if (in_array($checkvalues, $answer)) { echo "checked"; } ?>>
	  <label class="radio-label-checkbox" for="select_question<?php echo $value->id; echo $inc; echo $form_id;?>"><?php echo $checkvalues; ?> </label> 
	  <?php
	  $inc++;
	   }
	  }
	  
	  
    if($value->question_type == "radiobox_question") { ?>
	 
	  <?php
	     $inc = 1;
	     $array_answers = preg_split("/\r\n|\n|\r/", $value->question_answer); 
	  foreach($array_answers as $checkvalues)
	   {
	  ?>
	  <input class="radio-input-radio" type="radio" <?php if($answer_last == $checkvalues){ echo "checked";} ?> id="select_question<?php echo $value->id; echo $inc; ?>" name="<?php echo $value->id; ?>" value="<?php echo $checkvalues; ?>">
	  <label class="radio-label-radio" for="select_question<?php echo $value->id; echo $inc; ?>"><?php echo $checkvalues; ?> </label><br>
	  <?php
	  $inc++;
	   }
	  }
      echo '<br/>';
	 }
	 
	 
	  $table_form =  $wpdb->prefix."questionare";
	  $get_form_data = $wpdb->get_results( "SELECT submit_btn FROM $table_form where id = '$form_id'");
	 
	 foreach($get_form_data as $btn_value)
	 {
		 $btn_name = $btn_value->submit_btn;
	 }
	  
	 if(!empty($get_questions))
	 {
     ?>	
     
    <input type="submit" value="<?php if($btn_name) { echo $btn_name; } else { echo "Submit";} ?>" name="submit_question<?php echo $form_id; ?>" onclick="showsuccessfull<?php echo $i; ?>()" class="showsuccessfull" style="padding: 3px 7px; margin-top: 6px;">	
    <span style=" color: green;  padding-left: 3px;" class="hide success-save-text<?php echo $i; ?>">Data Saved Successfully</span>
	<script>
	function showsuccessfull<?php echo $i; ?>() {
    var header = jQuery('.success-save-text<?php echo $i; ?>');
	 setTimeout(function() {
     header.removeClass('hide');
	 jQuery(".success-save-text<?php echo $i; ?>").show().delay(2000).fadeOut();
     }, 50);
	}
	</script>
    </form>

    <?php
	 }
    return ob_get_clean();
    };  

    add_shortcode( "question_form_$i", $cb );
}
 
 
  

 
 
