<?php
   namespace App\Views;

   Class mainViews{
     public static function render($filename){
       include('pages/'.$filename.'.php');
     }
   }
?>