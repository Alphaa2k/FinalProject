<?php

$conn = mysqli_connect('localhost', 'mikes', 'm1kes2k20', 'library');

if(!$conn){
  echo "Connection error: " .mysqli_connect_error();
}

 ?>
