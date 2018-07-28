<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="user";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST['submit']))
{
$name = $conn->real_escape_string($_REQUEST['username']);
$phone = $conn->real_escape_string($_REQUEST['phone']);
$address=$conn->real_escape_string($_REQUEST['address']);
$email = $conn->real_escape_string($_REQUEST['email']);
$file=$_FILES['file'];

$fileName= $_FILES['file']['name'];
$fileTmpName= $_FILES['file']['tmp_name'];
$fileSize= $_FILES['file']['size'];
$fileError= $_FILES['file']['error'];
$fileType= $_FILES['file']['type'];

$fileExt=explode('.',$fileName);
$fileActualExt=strtolower(end($fileExt));

$allowed=array('pdf','doc');
if(in_array($fileActualExt,$allowed))
{
    if($fileError===0)
    {
        if($fileSize < 1000000)
        {
            $fileNameNew=uniqid('',true).".".$fileActualExt;
            $fileDestination='uploads/'.$fileNameNew;
            move_uploaded_file($fileTmpName,$fileDestination);
              
        if($name !=''||$email !='')
        {

            $sql = "INSERT INTO inquiry (name, phone,address ,email) VALUES('$name','$phone','$address','$email')";    
        if ($conn->query($sql) === TRUE) 
        {
            $message = "Form submitted successfully.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }
        }
        else
        {
            echo "File is too large!";
        }
    }
    else
    {
        echo "There was an error uploading your file!";
    }
}
else
{
    echo "You cannot upload files of this type!";
}
  
}


$conn->close();
?>