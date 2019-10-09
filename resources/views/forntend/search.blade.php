@extends('fornt-template.app')

@section('content')

<!-- Start Banner Section -->
<section class="banner_cover_sec" <?php if($banner){ ?> style="background: url('{{$banner->banner_url}}');background-repeat: no-repeat;background-size: cover;background-position: center center;" <?php } ?> >
  <div class="container-fluid">
    <div class="logo_sec">
       <?php $headerLogo = \App\Models\Settings::getSettings('header-logo');?>
                         <a href="{{url('/')}}"><img src="{{$headerLogo}}" alt="Logo"></a>
    </div>
     {{ Form::open(['id'=>'search_form','method' => 'GET','route' => ['home.search.video']] ) }}
    <div class="search_sec">
      <div class="search">
        @if(isset($_GET['search']))
        @php $seacrh = $_GET['search'];  @endphp
        @else 
        @php  $seacrh = "";  @endphp
        @endif 

         @if(isset($_GET['language']))
        @php $lan = $_GET['language'];  @endphp
        @else 
        @php  $lan = "1";  @endphp
        @endif     

         <input name="search" type="search" placeholder="Enter a word" value="{{$seacrh}}" autocomplete="off" maxlength="100" class="s-input js-search-field " required>
        
        <div class="option_box">
          <select data-placeholder="Choose a Language..." id="lan-select" name="language">
                 
                @foreach($language as $key=>$val)
                  <option value="{{$val->id}}" <?php if($lan==$val->id){ echo "selected"; } ?>>{{$val->lang_name}}</option>
                @endforeach 
          </select>
        </div>
      </div>
      <div class="button_sec">
        <button type="submit" class="btn_submit">Search</button>
      </div>
      @if($search_count>49)
                            {!! NoCaptcha::renderJs() !!}
                             {!! NoCaptcha::display() !!}
                             <div class="error_captcha"></div> 
                         @endif
    </div>
      {{ Form::close() }}   
  </div>
</section>
<!-- End Banner Section -->

<!-- Start View Section -->
<section class="view_sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 left_sec left_first_sec">
        <div class="img_sec">
          <?php $searchpageleftads = \App\Models\Settings::getSettings('search-page-left-ads');?>
                  {!! $searchpageleftads !!}
        </div>
      </div>
      <div class="col-md-8 left_sec">
        <h3>How to Pronounce {{$_GET['search']}} in English(<span id="page">{{$page}}</span> out {{$video_count}} )</h3>
         <div class="ajax_load" ><img src="{{url('forntend/images/loading.gif')}}"></div>
          <div class="ajx-result">
                  @include('forntend.ajax_search_result')
           </div>
      </div>
      <div class="col-md-2 right_sec">
        <div class="img_sec">
          <?php $searchpagerightads = \App\Models\Settings::getSettings('search-page-right-ads');?>
                  {!! $searchpagerightads !!}
        </div>
      </div>
    </div>
  <div>
</section>
<!-- End View Section -->
 
 @if($search_count>49)
   <script type="text/javascript">
     
     $('form').on('submit', function(e) {
  if(grecaptcha.getResponse() == "") {
    $('.error_captcha').html('Captcha is required');
   // e.preventDefault();
   // alert("You can't proceed!");
    return false;
  } else {
  //  alert("Thank you");
  }
});
   </script>
  

 @endif
<script type="text/javascript">
   $(document).ready(function()
    {
        $(document).on('click', '.pagination',function(event)
        {
              event.preventDefault();
             
             var page = $(this).find('a:first').data('page');
             var search = $(this).find('a:first').data('search');
             var id = $(this).find('a:first').data('id');
            getData(page,search,id);
        });

        $(document).ajaxStart(function(){
          $(".ajax_load").css("display", "block");
          $('a').attr('disabled',true);
        });
        $(document).ajaxComplete(function(){
          $(".ajax_load").css("display", "none");
           $('a').attr('disabled',false);
        });

  
    });
  
    function getData(page,search,id){

        var lang  = '<?php echo $lan; ?>';
        jQuery.ajax(
        {
            url: "{{ url('/ajax-pagination') }}",
              type: "get",
             data: { page: page,search:search,id:id,lang:lang },
            datatype: "html"
        }).done(function(data){
            $(".ajx-result").empty().html(data);
            onYouTubeIframeAPIReady();
            $("#page").text(page);
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }

</script>
 

@stop 