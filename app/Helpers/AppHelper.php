<?php
namespace App\Helpers;
use DateTime;

class AppHelper
{
    public static function convertDate($date){
        if($date == null){
            return "-";
        }else{
            $date=DateTime::createFromFormat("d/m/Y", $date);
            $date= $date->format('Y-m-d');
            return $date;
        }
        
        
    } 
    public static function convertDateYmd($date){
        if($date == null){
            return "-";
        }else{
            $date=DateTime::createFromFormat("d/m/Y", $date);
            $date= $date->format('Y/m/d');
            return $date;
        }
        
        
    } 
       public static function pathFile($folderSurat,$folderNosurat)
       {

              // return public_path(). DIRECTORY_SEPARATOR .'file'. DIRECTORY_SEPARATOR .$folderSurat. DIRECTORY_SEPARATOR .$folderNosurat; 
              return public_path(). '/' .'file'. '/' .$folderSurat. '/' .$folderNosurat; 
               //un comment ini ketika publish
              // return base_path(). '/' .'file'. '/' .$folderSurat. '/' .$folderNosurat; 
       }

       public static function savePath($folderSurat,$folderNosurat,$filename)
       {
              return  'file/'.$folderSurat. '/' .$folderNosurat.'/'.$filename;
               //un comment ini ketika publish
              // return  'project/file/'.$folderSurat. '/' .$folderNosurat.'/'.$filename;
       }
       public static function pathFileFoto($avatar){
              if($avatar==""){
                  return public_path(). '/' .'img'; 
              }else{
                  return public_path() . '/' . 'img' . '/' . $avatar;
              }
              
      
          }

          public static function pathFoto($folder,$Nosurat){
            // base_path()

            // return base_path().'/'.'FOTO'. '/' .$folder. '/'  .$Nosurat ; 
              return public_path().'/'.'FOTO'. '/' .$folder. '/'  .$Nosurat ; 
              
      
          }
          //tmbah folder project ketika publish
          public static function savePathFoto($folderSurat,$folderNosurat,$filename){
              return  public_path().'/FOTO/'.$folderSurat. '/' .$folderNosurat.'/'.$filename;
              //un comment ini ketika publish
              // return  'project/FOTO/'.$folderSurat. '/' .$folderNosurat.'/'.$filename;
          }
          public static function savePathFotoDB($folderSurat,$folderNosurat,$filename){
            return  '/FOTO/'.$folderSurat. '/' .$folderNosurat.'/'.$filename;
            //un comment ini ketika publish
            // return  'project/FOTO/'.$folderSurat. '/' .$folderNosurat.'/'.$filename;
        }
          
//       

     
}