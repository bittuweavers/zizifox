<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Channel;
use App\Models\Language;
use App\Models\VideosCaption;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Session;

class VideosController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        set_time_limit(8000000);
    }


      public function index(Request $request)
    {

                $search ="";
                $search_type="";
                  $videos = Video::select('id','yt_video_name','yt_video_id','status','channels_id')->where(function($query) use ($search)  {
                       if(isset($_GET['search'])){
                         $search_type = $_GET['search_type']; 
                          $search = $_GET['search'];
                            if($search){
                               if($search_type=='channel'){   
                               $query->whereHas('channels', function ($query1)  use($search) {
                                  $query1->where('channel_name','LIKE',"%{$search}%");
                              });
                             }else{
                              $query->Where("$search_type", 'LIKE',"%{$search}%");

                             }
                           
                          }
                        }
                     })->orderBy('id', 'desc')->Paginate(40);
                   if(isset($_GET['search'])){
                         $search_type = $_GET['search_type']; 
                          $search = $_GET['search'];
                            if($search){
                      $videos->appends(['search' => $search,'search_type'=>$search_type]);
                    }
                  }

                
                   /* if(isset($_GET['search'])){

                $search_type = $_GET['search_type'];      

                $search = $_GET['search'];
                if($search){
                  $videos = Video::select('id','yt_video_name','yt_video_id','status','channels_id')->whereHas('channels', function ($query)  use($search) {
                      $query->where('channel_name','LIKE',"%{$search}%");
                  })->orderBy('id', 'desc')->simplePaginate(40);

                  /* $videos = Video::select('id','yt_video_name','yt_video_id','status','channels_id')->Where("$search_type", 'LIKE',"%{$search}%")->orderBy('id', 'desc')->simplePaginate(40); */
               /*   $videos->appends(['search' => $search]);
                 
                }else{
                   ->orderBy('id', 'desc')->simplePaginate(40);
                }
              }else{

                 $videos = Video::select('id','yt_video_name','yt_video_id','status','channels_id')->orderBy('id', 'desc')->simplePaginate(40);
              }*/
        
 

       

        return view('admin.videos.index')->with('videos', $videos); 
    //return view('admin.users.index', ['users' => $users->appends(Input::except('page')),'roles'=> $roles,]);
    }

     public function add_video()
    {
       $language = Language::orderBy('id', 'Asc')->get();
     

        return view('admin.videos.create')->with('language', $language);
    }

    public function store(Request $request)
    {  
      ini_set('max_execution_time',8000000);
      $message= array();
    	 $this->validate($request, [
		    'video_id_url'=>'required',
        'channel_name'=>'required',
		   	
			]);
       $lang_code_search =$request->lang;
    
    	$video_url =  $request->video_id_url;
      $str_arr = explode (",", $video_url);  
      if($request->channel_name){
      $video_channel_data = Channel::select('id')->where('channel_name',$request->channel_name)->first();
      //print_r($video_channel_data);die;
     if(is_object($video_channel_data)){
    
         $channel_id = $video_channel_data->id;
       }else{

      $video_channel = new Channel;
      $video_channel->channel_name =$request->channel_name; 
      $video_channel->save();
    $channel_id = $video_channel->id;
      }
    }else{
      $channel_id ="";
    }

     foreach ($str_arr as $url) {
     
		if (filter_var($url, FILTER_VALIDATE_URL)) {
			$youtube_url = $url; 
			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
     
      if(($match) && ($match[1])){
			$youtube_id = $match[1];
      }else{
        $youtube_id = "";
      }


		}else{
			$youtube_id = preg_replace('/\s+/', '', $url);

		$youtube_url = 	'http://www.youtube.com/watch?v='.$youtube_id;
		
		}
    if($youtube_id){
		$videos_data = Video::where('yt_video_id','=',$youtube_id)->count();
 //  print_r($videos_data);die;
		if($videos_data >0){

      $message[]= 'Video Is Already Added';
 

		}else{
    
      $id =0;
      $lg_code=$lang_code_search;
      $create_name ="";

      $video_lang = Curl::to('http://video.google.com/timedtext')->withData(array('type' => 'list','v'=>$youtube_id))->withContentType('text/xml')->returnResponseObject()->get();
        if($video_lang->status=='200'){
        $langxml=simplexml_load_string($video_lang->content);
      foreach ($langxml->track as $row1) {
         $lang_code = $row1->attributes()->lang_code;
        if($lang_code==$lang_code_search){
          $id = $row1->attributes()->id;  
          $lg_code =$lang_code_search;
          $create_name = $row1->attributes()->name;
            } 
          }
        }

     
     // echo $create_name;
      $response_title = Curl::to('http://www.youtube.com/oembed')->withData(array('url' => $youtube_url,'format'=>'json'))->get();

      $res_array = json_decode($response_title, true);

      
  		$response_video = Curl::to('http://video.google.com/timedtext')->withData(array('type' => 'track','v'=>$youtube_id,'id'=>$id,'lang'=>$lg_code,'name'=>"$create_name"))->withContentType('text/xml')->returnResponseObject()->get();

      $status = $response_video->status;
      $response = $response_video->content;
      if($status=='404'){
         $message[]= 'Video Not Found.Please check the Url or Id';
       

      }else{
  		if($response){
          if($res_array){
            $video_title = $res_array['title']; 
          }else{
            $video_title ="";
          }
          $ij=0;
       $captions="";

      $xml=simplexml_load_string($response);
      //print_r($xml);
      foreach ($xml->text as $row) {

        $str1 = htmlspecialchars_decode($row, ENT_QUOTES); 
                          $output = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $str1);
        //$videos_caption[] =array('vid_id'=>$insertedId,'caption_text'=>$output,'time_sec'=> $row->attributes()->start,'duration'=> $row->attributes()->dur);

        if($ij==0){

              }else{
               $captions .= "  ||| ";
              }
               $captions .= $row->attributes()->start;
              $captions .= " @@@ ";
              $captions .= $row->attributes()->dur;
               $captions .= " @@@ ";
              $captions .= $output;
              $ij++;
        
      }

          if($lang_code_search =='en'){
            $lang = 'us';
          }else{
             $lang = $request->lang;
          }
  			   $videos_creat = new Video;
  			   $videos_creat->yt_video_url =$youtube_url; 
  			   $videos_creat->yt_video_id =$youtube_id;
           $videos_creat->yt_video_name =$video_title;
            $videos_creat->language = $lang;
           $videos_creat->channels_id = $channel_id;
           $videos_creat->status ='1';
           $videos_creat->caption =$captions;
  			    $save = $videos_creat->save();
  			  $insertedId = $videos_creat->id;
 		
      
     //DB::update('update videos set caption = ? where id = ?',[$captions,$insertedId]);
  	 //DB::table('videos_captions')->insert($videos_caption);
     $message[]= 'Closed caption text is successfully saved in database';

     

  		}else{
         $message[]= 'Closed caption text is not available for video';
      
  		}
		}

		}

    
    }else{

       $message[]= 'Video Not Found.Please check the Url or Id';
    }
       } 

       return redirect()->route('admin.videos.create')->with('message',$message);
	//	echo $youtube_id;

    }	

public function destroy($id)
    {
    $videos = Video::find($id);
        $delete = Video::destroy($id);
       //  DB::delete('delete videos_captions where vid_id = ?',[$id]);
    
    if($delete){
      
      return redirect()->route('admin.videos')
            ->with('success','Video is delete successfully.');
    }else{
      return redirect()->route('admin.videos')
            ->with('success','Video is not delete please try again !!!.');
    }
    }

    
    public function view($id)
    {  
       
        $videos = Video::findOrFail($id);
       // $videos_caption = VideosCaption::where('vid_id','=',$id)->get();
        return view('admin.videos.show',compact('videos')); 
    }

    public function changeStatus(Request $request){

      $id = $request->id;
      $videos = Video::findOrFail($id);
     $status = $videos->status ;
     if($status=='1'){
      $video_status =0;
      $text = "Enable";
     }else{
      $video_status =1;
      $text = "Disable";
     }

     $videos->status =  $video_status;
      $videos->save();
      echo $text;

    }

    public function insert_chanel(){

  $video = Video::select('channel')->distinct()->get();
  foreach ($video as $value) {
             $video_channel = new Channel;
           $video_channel->channel_name =$value->channel; 
           $video_channel->save();
           $insertedId = $video_channel->id;
            $video = Video::where('channel', $value->channel)
          ->update(['channel' =>  $insertedId]);
  }

}
    
}


