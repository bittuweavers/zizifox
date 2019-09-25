<section class="banner_cover_sec">
  <div class="container-fluid">
    <h2>How to pronounce</h2>
    <div class="logo_sec">
       <?php $headerLogo = \App\Models\Settings::getSettings('header-logo');?>
                         <a href="{{url('/')}}"><img src="{{$headerLogo}}" alt="Logo"></a>
    </div>
     {{ Form::open(['id'=>'search_form','method' => 'GET','route' => ['influencers.search.video',$slug]] ) }}
    <div class="search_sec">
      <div class="search">
        @if(isset($_GET['search']))
        @php $seacrh = $_GET['search'];  @endphp
        @else 
        @php  $seacrh = "";  @endphp
        @endif    

         <input name="search" type="search" placeholder="Enter a word" value="{{$seacrh}}" autocomplete="off" maxlength="240" class="s-input js-search-field " required>
        
        <div class="option_box">
          <select data-placeholder="Choose a Language..." id="lan-select" name="language">
                              <option value="us">US</option>
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