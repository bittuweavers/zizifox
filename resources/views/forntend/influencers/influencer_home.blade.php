@extends('fornt-template.app')

@section('content')


<!-- Start View Section -->
<!-- Start Banner Section -->
<section class="banner_cover" <?php if($banner){ ?> style="background: url('{{$banner->banner_url}}');background-repeat: no-repeat;background-size: cover;background-position: top center;" <?php } ?>>
  <div class="container">
  @include('forntend.menu')
	<div class="heading_wrap">
		<div class="influ_det">
		  <h1>{{$influencer->title}}</h1>
		  @if($influencer->logo) 
		  <div class="influ_log">
			<img src="{{$influencer->logo}}">
		  </div>
		  @endif
		</div> 
	</div>	
    <h2>How to pronounce</h2>
          {{ Form::open(['id'=>'search_form','method' => 'GET','route' => ['influencers.search.video',$influencer->slug]] ) }}
    <div class="search_sec"> 
      <div class="search">
         <input name="search" type="search" placeholder="Enter a word" value="" autocomplete="off" maxlength="100" class="s-input js-search-field " required>
       <?php /* <div class="option_box">
         <select data-placeholder="Choose a Language..." id="lan-select" name="language">
              @if($language->count()>0)
                @foreach($language as $key=>$val)
                  @php if($val->lang_code=='en'){
                        $lang='us';
                        }else{
                        $lang=$val->lang_code;
                        } 
                  @endphp 
                  <option value="{{$lang}}">{{$val->lang_name}}</option>
                @endforeach 
                @else
                  <option value="us">US</option>      
                @endif 
          </select>
        </div> */ ?>
      </div>
      <div class="button_sec">
        <button type="submit" class="btn_submit">Search</button>
      </div>
      @if($search_count>5)
           {!! NoCaptcha::renderJs() !!}
           {!! NoCaptcha::display() !!}
             <div class="error_captcha"></div> 
       @endif
    </div>
    {{ Form::close() }}   
    <div class="content_sec">
    
    </div>
  </div>
</section>
<!-- End Banner Section -->
<section class="mid-content-sec">
  <div class="container">
    <div class="row">
    <div class="col-lg-6">
      <div class="mid-cont-lft"> 
        <h1>{{$influencer->title}}</h1>
       {!! $influencer->description !!}
         <div class="more-info">
           @if($influencer->site_url) 
           <a href="{{$influencer->site_url}}"><span>M</span>ORE INFO +</a>
           @endif
         </div>
      </div>
    </div>
    <div class="col-lg-6">
       @if($influencer->description_image) 
      <div class="mid-cont-img">
        <img src="{{$influencer->description_image}}">
      </div>
      @endif
    </div>  
    </div>
  </div>
</section>

<!-- Start banner Add Section  -->
<section class="add_sec">
  <div class="container">
    <div class="img_sec">
      <?php $homepagerightads = \App\Models\Settings::getSettings('home-page-bottom-ads');?>
          {!! $homepagerightads !!}
    </div>
  </div>
</section>
<!-- End banner Add Section  -->



         

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

@stop 





