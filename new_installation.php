<?php

if (isset($_POST['instal-label'])) {
   $install_label = $_POST['instal-label'];
   $install_folder = $_POST['instal-folder'];
   $install_version = $_POST['instal-version'];
   $root_path = 'wordpress-installations/';

   $active_folders = ['install1','install3'];
   $active_labels = ['install1','install3'];

   foreach($active_folders as $folder){
       if ($install_folder == $folder) {
           die('Install Folder already exists! Please try again!');
       }
   }

   foreach($active_labels as $label){
       if ($active_labels == $label) {
           die('Install Label already exists! Please try again!');
       }
   }

   switch($install_version){
       case 'Latest':
           $version_url = 'https://wordpress.org/latest.zip';
           $file_name = 'latest.zip';
           break;
       case '4.9.7':
           $version_url = 'https://wordpress.org/wordpress-4.9.7.zip';
           $file_name = '4-9-7.zip';
           break;
       case '4.9.6':
           $version_url = 'https://wordpress.org/wordpress-4.9.6.zip';
           $file_name = '4-9-6.zip';
           break;
       default:
           die('Invalid version number');
   }

   file_put_contents($root_path.$file_name,fopen($version_url,'r'));

   $zip = new ZipArchive;
   $res = $zip->open($root_path.$file_name);

   if ($res == true) {
       $zip->extractTo($root_path.$install_folder);
       $zip->close();
   }else {
       echo 'WordPress archive cannot be found!';
   }

   unlink($root_path.$file_name);

   $destination = $root_path.$install_folder.'/';
   $wp_source = $destination.'wordpress/';
   $org_files = scandir($wp_source);

   foreach($org_files as $file){
       rename($wp_source.$file, $destination.$file);
   }

   rmdir($root_path.$install_folder.'/wordpress');
}else {
   echo 'not working';
}