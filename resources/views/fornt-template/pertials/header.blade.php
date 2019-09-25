<header class="main-header">
  <div class="container-fluid">
    <div class="logo-sec">
      <?php $headerLogo = \App\Models\Settings::getSettings('header-logo');?>
                         <a href="{{url('/')}}"><img src="{{$headerLogo}}" alt="Logo"></a>
    </div>
  </div>
</header>