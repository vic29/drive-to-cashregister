<?php
include_once('simplehtmldom_1_5/simple_html_dom.php');


	//db_megnyit();
	if($_FILES['import']['name'])
	{
		$fileUrl = 'uploads/' . upload();
		
		$html = file_get_html($fileUrl);
		foreach($html->find('table.eredmenytabla tr') as $element) 
			echo $element->children(1);
		//echo file_get_html($fileUrl)->plaintext;
	}



function upload(){
	if(!$_FILES['import']['error'])
	{
		//now is the time to modify the future file name and validate the file
		$new_file_name = strtolower($_FILES['import']['tmp_name']); //rename file
		//move it to where we want it to be
		
		if (file_exists('uploads') && is_writable('uploads')) {
			if(move_uploaded_file($_FILES['import']['tmp_name'], 'uploads/'.$new_file_name))
				echo('Congratulations!  Your file was accepted.');
			else echo('error');
		}
		else {
			echo 'Upload directory is not writable, or does not exist.';
		}
		return $new_file_name;
	}
	//if there is an error...
	else
	{
		//set that to be the returned message
		echo('Ooops!  Your upload triggered the following error:  '.$_FILES['import']['error']);
	}
}


?>