<?php 

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['file']['name']);
$uploadok = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//Checking that file is actually image or a fake image.
if (isset($_POST['submit'])) {
	$check = getimagesize($_FILES['file']['tmp_name']);
	if ($check !== false) {
		echo "File is an image - " . $check['mime'] .".";
		$uploadok = 1;
	} else {
		echo "File is not an image.";
		$uploadok = 0;
	}
}

//Checking that file already exists or not.
if (file_exists($target_file)) {
	echo "Sorry! File already exists.";
	$uploadok  = 0;
}

//Checking that size of file is larger than the allowed onr or not.
if ($_FILES['file']['size'] > 50000000) {
	echo "Sorry! File size is greater than the allowed size i.e 500MB.";
	$uploadok = 0;
}
 
//Checking the extension of file for image uploadation process.
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
 	echo "Sorry! File extension 'JPG','JPEG','PNG' and 'GIF' are only allowed.";
 	$uploadok = 0;
 } 

//Now checking that uploadok is 0 or not.
if ($uploadok = 0) {
	echo "Sorry! File is not uploaded.";
} else {
	if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
		echo "Image file - " . $_FILES['file']['name'] . " is uploaded successfully.";
	} else {
		echo "Sorry! There is an error in uploading file.";
	}
}
?>
