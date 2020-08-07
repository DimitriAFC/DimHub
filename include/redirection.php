<?php

if(isset($_SESSION['username']))
{

}
else
{
   header("Location:index.php");
   exit;
}



?>