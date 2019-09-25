<?php

namespace App\Http\Controllers\Forntend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Videos;
use App\Models\Video;
use App\Models\Language;
use App\Models\VideosCaption;
use App\Models\Influencer;
use App\Models\SearchResult;
use App\Models\IpAddress;
use App\Models\Banner;
use App\Models\VideoViews;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ForntendInfluencersController extends Controller
{
    //

     public function index($slug)
    {
    
            $date = new \DateTime();

        if(Session::get('ip_id')){
           $ip_id=Session::get('ip_id');

        }else{
         $ip_add = $_SERVER['REMOTE_ADDR'];
         $ip_add_count = IpAddress::where('ip_add',$ip_add)->first();
         if(is_object($ip_add_count)){
            $ip_id = $ip_add_count->id;
            Session::put('ip_id', $ip_add_count->id);  
         }else{
             $ip_address = new IpAddress;
             $ip_address->ip_add = $ip_add;
             $ip_save = $ip_address->save();
             $ip_id = $ip_address->id;
              Session::put('ip_id', $ip_id); 
            
         }

          }

          $date->modify('-30 minutes');
          $formatted_date = $date->format('Y-m-d H:i:s');
          $search_count =  SearchResult::where('ip_add_id',$ip_id)->where('search_date', '>',$formatted_date)->count();
          $influencer =Influencer::where('slug',$slug)->first();
           $banner = Banner::inRandomOrder()->whereRaw("find_in_set('2',page_type)")->first();
            $language = Language::orderBy('id', 'Asc')->get();
        if(is_object($influencer)){
        return view('forntend.influencers.influencer_home')->with(compact('search_count','influencer','slug','banner','language'));
    	}else{
    		return redirect()->route('home');

    	}
    }


     public function search(Request $request,$slug){
     	$influencer =Influencer::where('slug',$slug)->first();
     	$channel_id = $influencer->channels_id;
     
      $date = new \DateTime();
        if(Session::get('ip_id')){
          $ip_id=Session::get('ip_id');
          }else{
        $ip_add = $_SERVER['REMOTE_ADDR'];
          $ip_add_count = IpAddress::where('ip_add',$ip_add)->first();
         if(is_object($ip_add_count)){
          $ip_id = $ip_add_count->id;
            Session::put('ip_id', $ip_add_count->id);  
         }else{
             $ip_address = new IpAddress;
             $ip_address->ip_add = $ip_add;
             $ip_save = $ip_address->save();
             $ip_id = $ip_address->id;
              Session::put('ip_id', $ip_id); 
         }
       }
    	 $search_text =trim(strip_tags($request->search));
     
        
        $search_text_field = $request->search;
        $search_text = preg_replace("/[^A-Za-z0-9 '\-]/", '', $search_text);

        $search_tx1 = $search_text;

        // $search_text =preg_replace('/(^[\"\'\!+]|[\"\'\!+]$)/', '', $search_text);
         $search_text = addslashes(preg_replace('/!+$/', '', $search_text));
        $search_txt = explode(" ",$search_tx1);

    		if($search_text){
    		$search_language = $request->language;
          $last_serach =  SearchResult::where('ip_add_id',$ip_id)->orderBy('id', 'desc')->first();  


          if(isset($_GET['page'])){
              $offset=$_GET['page']-1;
              $page=$_GET['page']; 
          }else{
            $offset=0;
            $page=1;
          }

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
                    break;
                   
                  } 
            }  
            
          }
   	
       $videos  = Video::select('id','yt_video_id','caption')->where('videos.status',1)->whereIn('channels_id', explode(',',$channel_id))->whereRaw($where)->skip($offset)->take(1)->get();


       
       $video_count  = Video::select('id')->whereIn('channels_id', explode(',',$channel_id))->where('videos.status',1)->whereRaw($where)->count(); 
        if($videos->count()>0){
         
           $next_video_id  = Video::select('id')->whereIn('channels_id', explode(',',$channel_id))->where('videos.status',1)->whereRaw($where)->skip($offset+1)->take(1)->get();

        }else{
             $next_video_id ="";
        }
        


            if($videos->count()>0){
            $search_status =1; 

            }else{
               $page =0;
                 $search_status =0; 
            } 

            if(is_object($last_serach)){

                if($last_serach->search_text!=$search_text_field){
                     $search_result = new SearchResult;
                     $search_result->ip_add_id =$ip_id;
                     $search_result->search_text =$search_text_field; 
                     $search_result->search_date = $date->format('Y-m-d H:i:s');
                     $search_result->search_found_status = $search_status;
                       $save = $search_result->save();

                }

              }else{
               $search_result = new SearchResult;
               $search_result->ip_add_id =$ip_id;
               $search_result->search_text =$search_text_field; 
               $search_result->search_date =date('Y-m-d H:m:s');
               $search_result->search_found_status = $search_status;
               $save = $search_result->save();
             }

                
          $date->modify('-30 minutes');
          $formatted_date = $date->format('Y-m-d H:i:s');
          $search_count =  SearchResult::where('ip_add_id',$ip_id)->where('search_date', '>',$formatted_date)->count();
          }else{
            $videos =array();
            $next_video_id =array();
            $video_count ="";
              $page ="";
              $search_count="";
          

          } 
            $banner = Banner::inRandomOrder()->whereRaw("find_in_set('4',page_type)")->first();
          $language = Language::orderBy('id', 'Asc')->get();
    	    return view('forntend.influencers.influencer_search')->with(compact('videos','search_text','next_video_id','page','video_count','search_count','slug','influencer','banner','language'));

    
    }

     public function ajax_pagination(Request $request,$slug){
      $influencer =Influencer::where('slug',$slug)->first();
     	$channel_id = $influencer->channels_id;
       $search_text = $_GET['search'];
    $search_text =trim(strip_tags($search_text));
     
        $search_text = preg_replace("/[^A-Za-z0-9 '\-]/", '', $search_text);

        $search_tx1 = $search_text;

        // $search_text =preg_replace('/(^[\"\'\!+]|[\"\'\!+]$)/', '', $search_text);
         $search_text = addslashes(preg_replace('/!+$/', '', $search_text));
        $search_txt = explode(" ",$search_tx1);
      $search_language =$_GET['lang'];
      if($search_text){
          if(isset($_GET['page'])){
              $offset=$_GET['page']-1;
              $page=$_GET['page']; 
          }else{
            $offset=0;
            $page=1;
          }

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
                    break;
                   
                  } 
            } 
            
          }
          
      $videos  = Video::select('id','yt_video_id','caption')->whereIn('channels_id', explode(',',$channel_id))->where('videos.status',1)->whereRaw($where)->skip($offset)->take(1)->get();

         if($videos->count()>0){
                $next_video_id  = Video::select('id')->whereIn('channels_id', explode(',',$channel_id))->where('videos.status',1)->whereRaw($where)->skip($offset+1)->take(1)->get();
        
	        }else{

	            $videos ="";
	             $next_video_id ="";
	        }



        }else{
          $videos ="";
             $next_video_id ="";
        }
         return view('forntend.ajax_search_result')->with(compact('videos','search_text','next_video_id','page'));



    }


}
