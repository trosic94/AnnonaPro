<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ setting('site.title') }} {{ (isset($metaTitle))? ' - '.$metaTitle : '' }}</title>
        <meta name="description" content="{{ setting('site.description') }} {{ (isset($metaDescription))? ' - '.$metaDescription : '' }}"/>
        <meta name="keywords" content="{{ setting('site.keywords') }} {{ (isset($metaKeywords))? ', '.$metaKeywords : '' }}"/>
        
        
        <link rel="stylesheet" type="text/css" href="{{ URL::to('/css/app.css') }}">
        <link rel="icon" href="{{ URL::asset('/favicon.ico') }}" type="image/x-icon">
        
        
        <script type="text/javascript" src="{{ URL::to('/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/mdb.min.js') }}"></script>
        
        
        <script type="text/javascript" src="{{ URL::asset('/js/shp.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('/js/functions.js') }}"></script>
        
        
        <script type="text/javascript" src="{{ URL::asset('/js/ekko-lightbox.js') }}"></script>

<style type="text/css">
    body, html {
        padding: 0;
        margin: 0;
        width: 100%;
        height: 100%;
    }
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,800');

@media (min-width: 500px) {
  .col-sm-6 {
    width: 50%;
  }
}
html, body {
  height: 100%;
  min-height: 18em;
}

.frontend-side {
  background-image: url("/images/dev/annonapro_salon.png");
}

.uiux-side {
  background-image: url("/images/dev/online_prodavnica.png");
}

.split-panel:hover .uiux-side {
  opacity: 0.3;
}

.split-panel:hover .text-content {
  opacity: 1;
}
.split-pane {
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  height: 50vh;
  min-height: 9em;
  font-size: 2em;
  color: white;
  font-family: 'Open Sans', sans-serif;
  font-weight:300;
}
@media(min-width: 500px) {
  .split-pane {
    padding-top: 2em;
    height: 50vh;
  }
}
.split-pane > div {
  position: relative;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  text-align: center;
}
.split-pane > div .text-content {
  line-height: 1.6em;
  margin-bottom: 0em;
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
}
.split-pane > div .text-content .big {
  font-size: 2em;
}
.split-pane > div img {
  height: 1.3em;
}
@media (max-width: 500px) {
  .split-pane > div img {
    display:none;
  }
}
.split-pane button, .split-pane a.button {
  font-family: 'Open Sans', sans-serif;
	font-weight:800;
  background: none;
  border: 1px solid white;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  width: 15em;
  padding: 0.7em;
  font-size: 0.5em;
  -moz-transition: all 0.2s ease-out;
  -o-transition: all 0.2s ease-out;
  -webkit-transition: all 0.2s ease-out;
  transition: all 0.2s ease-out;
  text-decoration: none;
  color: white;
  display: inline-block;
	cursor: pointer;
}
.split-pane button:hover, .split-pane a.button:hover {
  text-decoration: none;
  background-color: white;
  border-color: white;
	cursor: pointer;
}
.uiux-side.split-pane button:hover, .split-pane a.button:hover {
  color: violet;
}
.frontend-side.split-pane button:hover, .split-pane a.button:hover {
  color: blue;
}

#split-pane-or {
  font-size: 2em;
  color: white;
  font-family: 'Open Sans', sans-serif;
  text-align: center;
  width: 100%;
  position: absolute;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
@media (max-width: 925px) {
  #split-pane-or {
    top:15%;
  }
}
#split-pane-or > div img {
  height: 100%;
}
@media (max-width: 500px) {
  #split-pane-or {
    position: absolute;
    top: 50px;
  }
  #split-pane-or > div img {
    height:2em;
  }
}
@media(min-width: 500px) {
  #split-pane-or {
    font-size: 3em;
  }
}
.big {
  font-size: 2em;
}

#slogan {
  position: absolute;
  width: 100%;
  z-index: 100;
  text-align: center;
  vertical-align: baseline;
  top: 0.5em;
  color: white;
  font-family: 'Open Sans', sans-serif;
  font-size: 1.4em;
}
@media(min-width: 500px) {
  #slogan {
    top: 5%;
    font-size: 1.8em;
  }
}
#slogan img {
  height: 0.7em;
}
.bold {
	text-transform:uppercase;
}
.big {
	font-weight:800;
}
    /* body {
        background-image: url('images/dev/dev.jpg');
        background-position: center center;
        background-size: cover;
    } */
</style>
    </head>
    <body>
        <div class='split-pane col-xs-12 col-sm-12 uiux-side'>
            <div>
              {{-- <img src='/images/dev/online_prodavnica.png'> --}}
              <div class='text-content'>
                {{-- <div class="bold">You want</div> --}}
                <h2 style='font-weight:500;letter-spacing: 3.6px;'>ONLINE PRODAVNICA</h2>
              </div>
              <button>
                ULAZ
              </button>
            </div>
          </div>
          <div class='split-pane col-xs-12 col-sm-12 frontend-side'>
            <div>
              {{-- <img src='/images/dev/annonapro_salon.png'> --}}
              <div class='text-content'>
                {{-- <div class="bold">You want</div>
                <div class='big'>FRONT-END?</div> --}}
                <h2 style='font-weight:500;letter-spacing: 3.6px;'>ANNONAPRO SALON</h2>
              </div>
              <a class='button'>
                ULAZ
              </a>
            </div>
          </div>
          <div id='split-pane-or'>
            <div>
              <a href="/" title="{{ setting('site.title') }}"><img src="/images/dev/logo.svg" alt="{{ setting('site.title') }}"></a>
            </div>
          </div>
    </body>
</html>
