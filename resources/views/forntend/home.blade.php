@extends('fornt-template.app')

@section('content')

<!-- Start View Section -->
<!-- Start Banner Section -->
<section class="banner_cover" <?php if($banner){ ?> style="background: url('{{$banner->banner_url}}');background-repeat: no-repeat;background-size: cover;background-position: top center;" <?php } ?>>
  <div class="container">
    @include('forntend.menu')
    <h2>How to pronounce</h2>
    {{ Form::open(['id'=>'search_form','method' => 'GET','route' => ['home.search.video']] ) }}
    <div class="search_sec"> 
      <div class="search">
         <input name="search" type="search" placeholder="Enter a word" value="" autocomplete="off" maxlength="100" class="s-input js-search-field " required>
        <div class="option_box">
         <select data-placeholder="Choose a Language..." id="lan-select" name="language">
                @foreach($language as $key=>$val)
                  <option value="{{$val->id}}">{{$val->lang_name}}</option>
                @endforeach 
          </select>
        </div>
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
     <?php $home_page_content = \App\Models\Settings::getSettings('home-page-content');?>
                       {!! $home_page_content !!}
    </div>
  </div>
</section>
<!-- End Banner Section -->

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

  @if($search_count>5)
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




