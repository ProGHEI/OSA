<?php 
header("Content-type: application/pdf"); 
header("Content-Disposition: attachment; filename=$_GET[pdf]"); 
readfile($_GET['pdf']); 
?>