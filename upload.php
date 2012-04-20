<?php 

require_once('config.php');

require_once('includes/class.upload.php');



if (isset($_FILES['image'])) $pic = $_FILES['image'];



 //---------start uploading Pic

 $handle = new Upload($pic);



    // then we check if the file has been uploaded properly

    // in its *temporary* location in the server (often, it is /tmp)

    if ($handle->uploaded) {



        // yes, the file is on the server

        // now, we start the upload 'process'. That is, to copy the uploaded file

        // from its temporary location to the wanted location

  

       $dir_path = 'uploads/';    

		

		$handle->file_auto_rename = true;

		$handle->Process(ROOT.'/'.$dir_path);

        

        // we check if everything went OK

        if ($handle->processed) {

            // everything was fine !

          $data.= 'File was uploaded successfully';

			

		 $photo_path = $dir_path.$handle->file_dst_name;

        } else {

            // one error occured

		$data.= 'Error:'.$handle->error;    

           	$photo_path = '';

        }

   

        

    } else {

        // if we're here, the upload file failed for some reasons

        // i.e. the server didn't receive the file

     //  $data.= '<fieldset>';

     // $data.= '  <legend>file could not be uploaded on the server</legend>';

       $data.= 'Error: ' . $handle->error . '';

      //$data.= '</fieldset>';

    } 

//--------end uploading Pic 



$Title = 'Upload Photo';

?>

<?php 


if ($photo_path)echo $photo_path;

else echo $data;



//save it now in the db	







?>