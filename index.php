<DOCTYPE html>
<?php
//session_start();
if(isset($_GET["fileName"]))
{
$fname=$_GET["fileName"];
}
if (!isset($fname))
{
?>
<html>
<body>
<form method="post" action="" enctype="multipart/form-data">
<input type="file" name="csv_file" id="csv_file"> CSV File To upload<br/>
<input type="submit"/>
</form>
</body>
</html>
<?php
}
// check for file upload
if(isset($_FILES['csv_file']) && is_uploaded_file($_FILES['csv_file']['tmp_name'])){

//upload directory
$upload_dir ="./upload/";

//creat file name
$file_path =$upload_dir . $_FILES['csv_file']['name'];
$filename= $_FILES['csv_file']['name'];
//echo $filename;
//move uploaded file to upload dir
if (!move_uploaded_file($_FILES['csv_file']['tmp_name'], $file_path)) 
{
//error moving upload file
  echo "Error moving file upload";
  }
  //open the csv file for reading
  $handle = fopen($file_path,'r');

 header('Location: index.php?fileName=' .$filename);
//print  $filename;
}
  if(isset($fname))
  {
  $file_handle= fopen("upload/" .$fname, "r");
   $row =1;
   if(($handle =fopen("upload/" .$fname, "r")) !==FALSE) {
     echo '<table border="1">';

      while (($data = fgetcsv($handle)) !==FALSE) {
        $num = count($data);
	if($row ==1) {
	echo '<thead><tr>';
	} else {
	  echo '<tr>';
	  }

	 for  ($c=0; $c < $num; $c++){
	 //echo $data[$c] ."<br/>\n";
	 if(empty($data[$c])) {
	    $value = "&nbsp;";
	    }else{
	    $value = $data[$c];
	    }
	    if ($row ==1) {
	      echo '<th width="50">' .$value. '</th>';
	      } else{ 
	        echo '<td>' .$value.'</td>';
		}
	      }
	       if($row == 1) {

	       echo '</tr></thead><tbody>';
	    }else {
	      echo '</tr>';
	      }
	      $row++;
	      }
         echo '</tbody><table>';
	  fclose($handle);
}
}
?>

