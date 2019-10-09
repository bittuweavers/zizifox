<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Auth;
use App\Helpers\JsonApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Language;
use App\Models\VideosCaption;
use App\Models\Settings;
use App\Helpers\Interfaces\ResponseCodesInterface;

class VideosController extends Controller implements ResponseCodesInterface
{
	use JsonApiResponseHelper;
	
	public function getVideosList(Request $request){
		$video_details =array();
		$settings = new Settings();
        $api_status =  $settings->getSettings('api-status');
        if($api_status =='1'){
         $token = $request->header('Authorization');
         $api_token =  $settings->getSettings('api-token');
        if($api_token==$token){
            $errors = Validator::make($request->all(), ['search' => 'required','search_language' => 'required'])->errors();
      if(!empty($errors->all())){
        return $this->sendFailedResponse($errors->toArray(), self::HTTP_CODE_BAD_REQUEST);
      } else {
  
		$pagination = $request->page_limit;
		$search_text = $request->search;
		if($search_text){
		if(isset($_GET['page'])){
          $offset=$_GET['page']-1;
          $page=$_GET['page']; 
          }else{
            $offset=0;
            $page=1;
          }
			/*if($pagination){
				$pagination =$pagination;
			}else{
				$pagination =10;
			} */
        $search_language = $request->search_language;
        $search_text =trim(strip_tags($request->search));
        
        $search_text_field = $request->search;
        $search_text = preg_replace('/[^A-Za-z0-9\-]/', '', $search_text);
        $search_text = addslashes(preg_replace('/!+$/', '', $search_text));
        $search_txt = explode(" ",$search_text);
        if($search_text){
        foreach ($search_txt  as $value) {

             if(strlen($value)>3){
             $search_text1 = '"'.$search_text.'"';
             $where = "MATCH(`caption`) AGAINST ('".$search_text1."' IN BOOLEAN MODE)";

          }else{
            $where = "caption Rlike '[[:<:]]". $search_text ."[[:>:]]'";
           
          } 
            
          }

         $videos  = Video::select('id','yt_video_id','yt_video_name','yt_video_url','caption')->where('videos.languages_id',$search_language)->where('videos.status',1)->whereRaw($where)->skip($offset)->take(1)->get();

        if($videos->count()>0){
        $next_video_id  = Video::select('id')->where('videos.languages_id',$search_language)->where('videos.status',1)->whereRaw($where)->skip($offset+1)->take(1)->get();
        }else{
             $next_video_id ="";
        }
        $keyword = $search_text;

        if($videos->count()>0){


              foreach($videos as $single_video){
              $mat = 0;
              $k=0;
              $video_id =  $single_video->id;
              $vi_cap = $single_video->caption;
              $cap_arr = explode("|||",$vi_cap);
              $videos_caption=array();
              foreach($cap_arr as &$cap){
                  if((preg_match("/\b$keyword\b/i",  $cap)) && ($mat==0)){
                    $cap_arr2 = explode("@@@",$cap);
                    $video_time = $cap_arr2[0];
                    $start_vid_caption = $cap_arr2[2];
                    
                    $videos_caption[$k]['time_sec'] = $cap_arr2[0];
                    $videos_caption[$k]['duration'] = $cap_arr2[1];
                    $videos_caption[$k]['caption_text'] = $cap_arr2[2];
                    $mat++;
                  }else{
                    $cap_arr2 = explode("@@@",$cap);
                    $videos_caption[$k]['time_sec'] = $cap_arr2[0];
                    $videos_caption[$k]['duration'] = $cap_arr2[1];
                    $videos_caption[$k]['caption_text'] = $cap_arr2[2];
                  }
                  $k++;
              }
              $video_details['data']['id'] = $single_video->id;
              $video_details['data']['yt_video_id'] = $single_video->yt_video_id;
              $video_details['data']['yt_video_name'] = $single_video->yt_video_name;
              $video_details['data']['yt_video_url'] = $single_video->yt_video_url;
              $video_details['data']['time_sec'] =$video_time;
              $video_details['data']['start_vid_caption'] =$start_vid_caption;
	        }
	     }   
	     if($page == 1){ 
	     	$video_details['prev_page_url'] = null;
	     }else{
	      $pervious_page = $page-1;
	      $video_details['prev_page_url'] = url('api/videos/list?page='.$pervious_page);
	  	}    
	  	 if($next_video_id->count()>0){ 
	  	  $next_page = $page+1;
	  	  $video_details['next_page_url'] = url('api/videos/list?page='.$next_page);
	  	 }else{
			$video_details['next_page_url'] = null;
	  	 }
    
       	 return response()->json(['isError' => 0,'errorCode' => 0,'video_list' => $video_details,'video_subtitle'=>$videos_caption], 200);
        }else{
            return response()->json(['isError' => 1,'errorCode' => 404,'message' => "No Result Found"], 200);

        } 
   		 }else{

   		 	return response()->json(['isError' => 1,'errorCode' => 404,'message' => "The Search field are required"], 200);
   		 }
   		}
    }else{
   			$error = [
				'token' => ['Authentication Error.']
			];
			return $this->sendFailedResponse($error, 401);
   			}
   		}else{
   			return response()->json(['isError' => 1,'errorCode' => 404,'message' => "Api is disable"], 200);
   		}


        
		
	}


	public function getVideosDetail(Request $request){
		$settings = new Settings();
        $api_status =  $settings->getSettings('api-status');
        if($api_status =='1'){
         $token = $request->header('Authorization');
         $api_token =  $settings->getSettings('api-token');
        if($api_token==$token){	

		$video_id = $request->vid_id;
		if($video_id ){

		$video = Video::with('channels')->where('id',$video_id)->first();
		$k=0;

		 $vi_cap = $video->caption;
              $cap_arr = explode("|||",$vi_cap);
              $videos_caption=array();
              foreach($cap_arr as &$cap){
                    $cap_arr2 = explode("@@@",$cap);
                    $videos_caption[$k]['time_sec'] = $cap_arr2[0];
                    $videos_caption[$k]['duration'] = $cap_arr2[1];
                    $videos_caption[$k]['caption_text'] = $cap_arr2[2];
                  $k++;
              }


		 return response()->json(['isError' => 0,'errorCode' => 0,'video' => $video,'video_subtitle'=>$videos_caption], 200);
		}else{
		 return response()->json(['isError' => 1,'errorCode' => 404,'message' => "The Video id is not found"], 200);
		}
		}else{
   			$error = [
				'token' => ['Authentication Error.']
			];
			return $this->sendFailedResponse($error, 401);
   			}
		}else{
   			return response()->json(['isError' => 1,'errorCode' => 404,'message' => "Api is disable"], 200);
   		}
		
	}

  function get_language(Request $request){
  $settings = new Settings();
  $api_status =  $settings->getSettings('api-status');
  if($api_status =='1'){
   $token = $request->header('Authorization');
   $api_token =  $settings->getSettings('api-token');
  if($api_token==$token){
    $language = Language::orderBy('id', 'Asc')->where('status','1')->get();
       return response()->json(['isError' => 0,'errorCode' => 0,'language' => $language], 200);
    }else{
        $error = [
        'token' => ['Authentication Error.']
      ];
      return $this->sendFailedResponse($error, 401);
        }
    }else{
        return response()->json(['isError' => 1,'errorCode' => 404,'message' => "Api is disable"], 200);
      }

  }


	
}
