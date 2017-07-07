<h2>PHOTOS <?= $set; ?></h2>

<?php 
if($images == null || $images == "") {
	echo "<br /><h4><i>No photo(s) uploaded..</i></h4>";
} else {
	$images = json_decode($images);
	
	switch(count($images)) {
		case 1:	
			$img_height = '400px';
		break;
		case 2:
			$img_height = '300px';
		break;
		case 3:
			$img_height = '200px';
		break;
		default:
			$img_height = '155px';
	}

	foreach($images as $image) {
		echo '<p style="text-align: center; margin-bottom:10px;"><img src="'.ToymFileUploads::getFilePath($image).'" height="'.$img_height.'"></img></p> <span></span>';
	}
}

?>