<?php 
include 'inc/header.php';
include 'lib/config.php';
include 'lib/Database.php';


$db = new Database();

?>


	<div class="myform">
<?php
if(isset($_POST['submit'])){
	$permited = array('jpg','jpeg','png','gif');
	$img_name = $_FILES['image']['name'];
	$img_size = $_FILES['image']['size'];
	$img_tmp_name = $_FILES['image']['tmp_name'];
	
	$img_explode = explode('.',$img_name);
	//print_r($img_explode);
	$img_ext  = strtolower(end($img_explode));
	$img_uname = substr(md5(time()),0,10).'.'.$img_ext;
	$img_fname = "uploads/".$img_uname;
	
	//upload with image validation.
	if(empty($img_fname)){
		echo "<span class = 'error'>Please Select an Image !</span>";
	}else if($img_size>512000){
		echo "<span class = 'error'>Image size Should be leass then 500KB !</span>";
	}else if(in_array($img_ext,$permited)==false){
		echo "<span class = 'error'>You can upload only:". implode(',', $permited) ."</span>";
	}else{	
		move_uploaded_file($img_tmp_name,$img_fname);
		
		$query = "INSERT INTO tbl_img(image) VALUES('$img_fname')";
		$upload = $db->upload($query);
		if($upload){
			echo "<span class='success'>Image Uploaded Successfullly</span>";
		}else{
			echo "<span class='error'>Image not Uploaded</span>";
		}
	}
	
}
?>

	<form action="index.php" method="POST" enctype="multipart/form-data">
		<table>
		
			<tr>
				<td>Select Image</td>
				<td><input type="file" name="image" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="Upload" /></td>
			</tr>
			
		</table>
	</form>
	</div>
<?php include 'inc/footer.php';?>



