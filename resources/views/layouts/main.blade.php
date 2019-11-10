<!doctype html>
<html lang="en">
    <head>
        <title> @yield('title') </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Global site tag (gtag.js) - Google Ads: 946383617 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-946383617"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'AW-946383617');
        </script>

        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({
                  google_ad_client: "ca-pub-4947569401603583",
                  enable_page_level_ads: true
             });
        </script>
    </head>

    <body>
        <div class="container">

            @if(request()->get('logo') != 1)
                <div class="logo d-none d-sm-block">
                    <a href="/"><img class="img-fluid" src="{{ asset('joblookupbasket.png') }}"></a>
                </div>
            @endif

            @include('navbar')

            @include('messages')

            @yield('content')
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://adview.online/js/pub/tracking.js?publisher=1145&channel=&source=feed"></script>

    </body>
</html>