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
	$folder = "uploads/";
	move_uploaded_file($img_tmp_name,$folder.$img_name);
	
	$query = "INSERT INTO tbl_img(image) VALUES('$img_name')";
	$upload = $db->upload($query);
	if($upload){
		echo "<span class='success'>Image Uploaded Successfullly</span>";
	}else{
		echo "<span class='error'>Image not Uploaded</span>";
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



