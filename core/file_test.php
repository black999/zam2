<!DOCTYPE html>
<html>
<head>
	<title>test pobrania pliku</title>
</head>
<body>
	<?php 
	if (isset($_POST['submit'])) {
		$rok = date('Y');
		$miesiac = date('m');
		$plik = date('YmdHisu') . ".pdf";
		$base_dir = "e:/uploads/";
		$target_dir = $base_dir . $rok . "/" . $miesiac . "/";
		if (!is_dir($base_dir . $rok)){
			mkdir($base_dir . $rok) or die('Nie można utworzyć katalogu ' . $base_dir . $rok);
			if (!is_dir($base_dir . $rok . "/" . $miesiac)){
				mkdir($target_dir) or die ('Nie można utworzyć katalogu ' . $target_dir);
			};
		};
		// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$target_file = $target_dir . $plik;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		// if(isset($_POST["submit"])) {
		// 	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		// 	if($check !== false) {
		// 		echo "File is an image - " . $check["mime"] . ".";
		// 		$uploadOk = 1;
		// 	} else {
		// 		echo "File is not an image.";
		// 		$uploadOk = 0;
		// 	}
		// }
		// Check if file already exists
		if ($_FILES['fileToUpload']['type'] != 'application/pdf'){
			echo "plik nie jest dokumentem PDF <br>";
			$uploadOk = 0;
		}
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		// 	&& $imageFileType != "gif" ) {
		// 	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		// 	$uploadOk = 0;
		// }
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
?>
	<form method="POST" enctype="multipart/form-data">
		<!-- MAX_FILE_SIZE must precede the file input field -->
    	<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
		pobranie pliku <input type="file" name="fileToUpload">
		<button type="submit" name="submit">prześlij plik</button>
	</form>
</body>
</html>