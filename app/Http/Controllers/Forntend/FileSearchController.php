<?php

namespace App\Http\Controllers\Forntend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

class FileSearchController extends Controller
{
  
    public function __construct()
    {
        set_time_limit(8000000);
    } 

    public function file_search(Request $request)
    {  
      ini_set('max_execution_time',8000000); 
      ini_set('memory_limit',-1);
      $result="
      <script src='".url('forntend/js/jquery-3.2.1.min.js')."' type='text/javascript' ></script>
      <script src='".url('forntend/js/table2csv.js')."' type='text/javascript' ></script>
      <script>
  $(document).ready(function(){    
  $('#download_file').click(function(){
    $('#not_result').table2csv();
   // alert(1);
  });
  });
</script>
<style>
.search_div {
    text-align: center;
    width: 80%;
    margin: auto;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.btn_down{
    float: right;
    width: 125px;
    margin: 0px 0px 10px 10px;
    padding: 5px;
    font-size: 15px;
}
.heading_no_result{
display: inline;
}
</style>";
$result_table="<div class='search_div'>
    <h2>Search Result With Value</h2>
<table>
  <tr>
    <th>Sl No</th>
    <th>Search Text</th>
    <th>Result</th>
  </tr>";

  $not_result_table="<div class='search_div'>
    <h2 class='heading_no_result'>Search Result With Not Value</h2>
    <button id='download_file' class='btn_down'>Download</button>
<table id='not_result'>
  <tr>
    <th>Sl No</th>
    <th>Search Text</th>
    <th>Result</th>
  </tr>";
  $i=1;
  $j=1;
      $dir =  $_SERVER['DOCUMENT_ROOT'];
      $dir_array = explode('/', $dir);
      $dir_array_pop = array_pop($dir_array); 
      $dir = implode('/', $dir_array);
      if(file_exists($dir.'/search_file.txt')){
        
      $file = file_get_contents($dir.'/search_file.txt');
      $search_array = explode(',', $file );
      foreach ($search_array as $search_text) {
         $search_text =preg_replace('/(^[\"\'\!+]|[\"\'\!+]$)/', '', $search_text);
        $search_text = addslashes(preg_replace('/!+$/', '', $search_text));
        $search_txt = explode(" ",$search_text);
        foreach ($search_txt  as $value) {
          $value1 = addslashes(preg_replace('/!+$/', '', $value));
          $results = DB::select( DB::raw("SELECT * FROM INFORMATION_SCHEMA.INNODB_FT_DEFAULT_STOPWORD WHERE value = '$value1'") );
          if($results){
              $where = "caption Rlike '[[:<:]]". $search_text ."[[:>:]]'";
                    break;
            }else{
             if(strlen($value)>3){
                 $search_text1 = '"'.$search_text.'"';
                 $where = "MATCH(`caption`) AGAINST ('".$search_text1."' IN BOOLEAN MODE)";
              }else{
                  $where = "caption Rlike '[[:<:]]". $search_text ."[[:>:]]'"; 
              } 
                
              }
            }  


          $video_count  = Video::select('id')->where('videos.language','us')->where('videos.status',1)->whereRaw($where)->get();
         // $result .= $search_text.' : '.$video_count->count().'</br>';
          if($video_count->count()>0){
          $result_table .=   "<tr>
                          <td>".$i."</td>
                          <td>".$search_text."</td>
                          <td>".$video_count->count()."</td>
                        </tr>";
                          $i++;
          }else{

          $not_result_table .=   "<tr>
                          <td>".$j."</td>
                          <td>".$search_text."</td>
                          <td>".$video_count->count()."</td>
                        </tr>";
                          $j++;

          }              
                      
        
      }
    }else{
        $result_table .=   "<tr>
                          <td>File Not Found</td>
                          
                        </tr>";
    }
      $result_table .="</table></div>";
       $not_result_table .="</table></div>";
      echo $result;
      echo $not_result_table;
      echo $result_table;


    }
}
