<!doctype html>
<html lang="en">
<head>
 <!------------Include header here------------------>
    @include('fornt-template.pertials.head')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-138940807-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-138940807-3');
    </script>

    <!-- Google Adsense -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-9358295083964619",
    enable_page_level_ads: true
  });
</script>

</head>
<body>

	
  @yield('content')	

 @include('fornt-template.pertials.footer')
</body>
 <!------------Include Script here------------------>	
 @include('fornt-template.pertials.script')

</html>
