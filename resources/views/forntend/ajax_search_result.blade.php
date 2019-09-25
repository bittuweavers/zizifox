            @php   $keyword = $search_text;    
             @endphp
             @if($videos)
             @if($videos->count()>0)

              @foreach($videos as $single_video)
              @php  
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

       
              $youtube_video_id =  $single_video->yt_video_id;

              $video_view_count = (new App\Models\VideoViews)->getcountvideoview($video_id);

              if($video_view_count>0){}
              else{
               $save_view = (new App\Models\VideoViews)->saveviewvideo($video_id);
                }
             
               @endphp
              <div class="video_sec">
                 <div id="player"></div>

                        @php
                        $str = htmlspecialchars_decode($start_vid_caption, ENT_QUOTES); 
                          $output1 = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $str);  @endphp 
              </div>
              <div class="content_sec">
                 <h2 id="caption_txt">{!! preg_replace("/\b$keyword\b/i", "<b class='highliht_text'>$0</b>", $output1); !!}</h2>
              </div>
               @if(count($videos_caption)>0)
               <ul style="display:none;" class="caption_text">
                    @foreach($videos_caption as &$caption)
                  

                     @php
                          $time = (float)$caption["time_sec"];
                          $duration = (float)$caption["duration"];
                          $str1 = htmlspecialchars_decode($caption['caption_text'], ENT_QUOTES); 
                          $output = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $str1); @endphp 
           
                    <li id='cap_{{$time*100}}' data-start="{{round($time * 2) / 2}}" data-duration="{{$duration}}" data-end="{{$time+ $duration}}">{!! $output !!}</li>
                      
                  
                    @endforeach
                  </ul> 
                  @endif
                
                  <div class="button_sec d-flex justify-content-center">
                      @php
                          ($page == 1) ? $pervious_page =1 : $pervious_page = $page-1;
                         
                         @endphp
                      <span class="{{ ($page == 1) ? ' disabled' : 'pagination' }}" >
                      <a data-page="{{$pervious_page}}" data-search="{{$_GET['search']}}" class="previous_btn"><i class="fa fa-step-backward" aria-hidden="true"></i></a>
                      </span>
                      <div>
                        <a href="javascript:void(0)" id="play-btn-video" onclick="play_stop()" class="play-btn-video pause_btn"><i id="play-btn" class="fa fa-pause" aria-hidden="true"></i></a>
                      </div>
                      <span <?php if($next_video_id->count()>0){  $next_page = $page+1  ?>  class="pagination"  <?php }else{  $next_page = $page?> class="disabled" <?php } ?> >
                      <a data-page="{{$next_page}}" data-search="{{$_GET['search']}}" <?php if($next_video_id->count()>0){  ?> data-id="{{$next_video_id[0]}}" <?php } ?> class="next_icon"><i class="fa fa-step-forward" aria-hidden="true"></i></a>
                      </span> 
                  </div>
              @endforeach    
              @else
               <div class="not_found">No Result Found</div>    
              @endif  

  @if($videos->count()>0)

 <script>
      var i_count=0;
      var player ="";
      var done = false;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '417',
          width: '100%',
          videoId: '<?php echo  $youtube_video_id;  ?>',
          playerVars: { 'autoplay': 1, 'controls': 2,'iv_load_policy':3,'playsinline':1,'rel':0,'showinfo':0,'start':'<?php  echo floor($video_time); ?>' },
           events: {
                'onReady': initialize,
                'onStateChange': onPlayerStateChange
            }
         
        });
      
      }
      var time_update_interval;

 function initialize() {

   // time_update_interval =  setInterval(updateTimerDisplay, 1000);
  
    }

  
    function updateTimerDisplay(){
      console.log(player.getCurrentTime());
       console.log(Math.round(player.getCurrentTime()*2)/2);
      if(i_count==0 && player.getCurrentTime()==0){

      }else{

      var youtube_time =Math.round(player.getCurrentTime()*2)/2;
      
        var $this = $('ul li[data-start="'+youtube_time+'"]');
          if($this.text()){
            var str = $this.text();
            var keyword = "{{$keyword}}";

            var re = new RegExp('\\b('+ keyword + ')\\b', 'gi');
            var b = str.replace(re, '<b class="highliht_text">$1</b>');
          //  var b = str.replace(new RegExp('(' + keyword + ')', 'gi'), '<b class="highliht_text">$1</b>');
  
            $('#caption_txt').html(b);

          }else{
          //  console.log(2);
          }
           i_count =i_count+1;
        }
       
    }


        function onPlayerStateChange(event) {

          if (event.data == YT.PlayerState.PLAYING && !done) {
          time_update_interval = setInterval(updateTimerDisplay, 500);
          done = true;
        }

        switch (event.data) {
            case YT.PlayerState.PLAYING:
                $('#play-btn').removeClass('fa fa-play');
                $('#play-btn').addClass('fa fa-pause');
                
                break;
            case YT.PlayerState.PAUSED:
                $('#play-btn').removeClass('fa fa-pause');
                $('#play-btn').addClass('fa fa-play');
                 
                break;
            default:
                return;

        }
    }

function play_stop(){
     if($('#play-btn').hasClass('fa-play')){
            player.playVideo();

     }
        if ($('#play-btn').hasClass('fa-pause')){
            player.pauseVideo();
        }
}
    </script>
   
   @endif   
    @endif             