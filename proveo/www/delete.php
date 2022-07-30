<?php
    include "db.php";
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $q=mysqli_query($con,"DELETE from course_details where id='$id'");
        if($q)
        echo "ok";
        else
        echo "error";
    
    }
 ?>