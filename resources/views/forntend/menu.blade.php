   <div class="header_sec">
    <nav class="navbar navbar-expand-md">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa fa-bars" aria-hidden="true"></i>
      </button>

      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
      <ul class="navbar-nav">

       @if(Request::is('privacy-policy'))
          <?php $privacymenuClass = 'active'; ?>
        @else
          <?php $privacymenuClass = ''; ?>
        @endif 
         @if(Request::is('developer'))
          <?php $developermenuClass = 'active'; ?>
        @else
          <?php $developermenuClass = ''; ?>
        @endif 
         @if(Request::is('about-us'))
          <?php $aboutmenuClass = 'active'; ?>
        @else
          <?php $aboutmenuClass = ''; ?>
        @endif 
        @if($privacymenuClass=="" && $developermenuClass =="" &&  $aboutmenuClass == "")
            <?php $homemenuClass = 'active'; ?>
        @else
          <?php $homemenuClass = ''; ?>
        @endif 
        <li class="nav-item {{$homemenuClass}}">
           <?php $headerLogo = \App\Models\Settings::getSettings('header-logo');?>
           <a href="{{url('/')}}"><img src="{{$headerLogo}}" alt="Logo"></a>
        </li>
        <li class="nav-item {{$privacymenuClass}}">
        <a class="nav-link" href="{{url('/privacy-policy')}}">PRIVACY POLICY</a>
        </li>
        <li class="nav-item {{$developermenuClass}}">
        <a class="nav-link" href="{{url('/developer')}}">DEVELOPER</a>
        </li>
        <li class="nav-item {{$aboutmenuClass}}">
        <a class="nav-link" href="{{url('/about-us')}}">About Us</a>
        </li>
      </ul>
      </div>
    </nav>
    </div>
