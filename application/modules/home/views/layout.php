<?php 
  require_once("template/top.php"); 
  require_once("template/slider.php");  
  require_once("template/category.php");  
  require_once("template/best.php");
  $this->load->view($template);
  require_once("template/footer.php");
?>