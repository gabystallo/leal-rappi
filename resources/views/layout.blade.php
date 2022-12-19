<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Leal Médica">
    <meta name="keywords" content="Leal Médica">
    <meta name="author" content="Leal Médica">
       
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:site_name" content="Leal Médica" />
    @if($og['title'] ?? null)
        <meta property="og:title" content="{{ $og['title'] }}" />
        <meta property="twitter:title" content="{{ $og['title'] }}" />
    @else
        <meta property="og:title" content="Leal Médica" />
        <meta property="twitter:title" content="Leal Médica" />
    @endif
    @if($og['description'] ?? null)
        <meta property="og:description" content="{{ $og['description'] }}" />
        <meta property="twitter:description" content="{{ $og['description'] }}" />
    @else
        <meta property="og:description" content="Leal Médica" />
        <meta property="twitter:description" content="Leal Médica" />
    @endif
    @if($og['image'] ?? null)
        <meta property="og:image" content="{{ $og['image'] }}" />
    @else
        <meta property="og:image" content="{{ url('logo-fondo.png') }}" />
    @endif

    <meta property="twitter:creator" content="Leal Médica" />


    <link rel="shortcut icon" href="{{ url('logo.png') }}" />


    <title>@yield('titulo', config('app.name', ''))</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ mix('css/front.css') }}" rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="{{ mix('js/front.js') }}"></script>

    <?php /*
    <script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56e64ff5f19e592d" async="async"></script>
    */ ?>
    
    <link rel="stylesheet" href="/js/lib/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen">
    <script type="text/javascript" src="/js/lib/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>

    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <script src='https://www.google.com/recaptcha/api.js'></script>

    <link rel="stylesheet" type="text/css" href="{{ url('js/lib/slick/slick.css') }}">
    <script src="{{ url('js/lib/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56e64ff5f19e592d" async="async"></script>

    @if(config('app.env') == 'production')
        
    @endif

    @yield('script.header')
</head>



<body>
    @include('flasher.flasher')
    <div id="general">

        <!-- menú lateral -->
        <div class="menu-lateral">
            <div class="contenido">
                <div class="logo">
                    <h2></h2>
                    <a href="#cerrar" data-cerrar-menu-lateral>X</a>
                </div>
                <ul>
                    <li><a href="{{ url('/') }}" title="Plan médico Soy Rappi">PLAN MÉDICO SOY RAPPI</a></li>
                    <li><a href="{{ url('obtene-tu-monotributo') }}" title="Obtené tu monotributo">OBTENÉ TU MONOTRIBUTO</a></li>
                </ul>
            </div>
        </div>

        <!-- header -->
        <header>
            <div class="contenedor">
                <h1>
                    <a href="{{ url('/') }}" class="leal">Leal Médica</a>
                    <a href="{{ url('/') }}" class="rappi">Rappi</a>
                </h1>
                <div class="info">
                    <div class="telefono">
                        0810 122 6763<a href="tel:08101226763"></a>
                    </div>
                    <div class="redes">
                        <a href="mailto:bsas@lealmedica.com.ar" class="email"></a>
                        <a href="https://www.instagram.com/lealmedica" class="instagram"></a>
                        <a href="https://es-la.facebook.com/lealmedica" class="facebook"></a>
                    </div>
                </div>
            </div>
            <a class="desplegar-menu-responsive" href="#desplegar-menu"  data-abrir-menu-lateral></a>
        </header>

        <section class="banner-encabezado">
            <div class="fondo">
                <p>APROVECHÁ LOS BENEFICIOS EXCLUSIVOS PARA REPARTIDORES RAPPI <strong>SIN COSTOS</strong></p>
            </div>
        </section>
        <?php /*
        <!-- slides -->
        @if(count($slides = App\Models\Slide::front()->get()))
            <section class="slides">
                @foreach($slides as $slide)
                    @continue(!$slide->tiene('imagen'))
                    <div class="slide">
                        <div class="imagen" style="background-image:url({{ $slide->url('imagen') }});"></div>
                        <div class="imagen-vertical" style="background-image:url({{ $slide->getVertical() }});"></div>
                        @if(substr($slide->titulo, 0, 1) != '.')
                            <div class="info">
                                <div class="titulo">{{ $slide->titulo }}</div>
                            </div>
                        @endif
                        @if($slide->link)
                            <a class="cover" href="{{ $slide->link }}" target="_blank"></a>
                        @endif
                    </div>
                @endforeach
            </section>
        @endif
        */ ?>

        <div class="accesos-rapidos">
            <div class="contenedor">
                
                <div class="col">
                    <div class="contenido">
                        <a href="{{ url('/') }}" title="Plan médico Soy Rappi" class="plan-medico {{ ($seccion ?? null) == 'plan-medico' ? 'activo' : '' }}">PLAN MÉDICO SOY RAPPI</a>
                    </div>
                </div>
                <div class="col">
                    <div class="contenido">
                       <a href="{{ url('obtene-tu-monotributo') }}" title="Obtené tu monotributo" class="monotributo {{ ($seccion ?? null) == 'monotributo' ? 'activo' : '' }}">OBTENÉ TU MONOTRIBUTO</a>
                    </div>
                </div>
                
            </div>
        </div>

        @yield('contenido')

        <!-- banner -->
        <section class="banner">
            <div class="contenedor">
                <div class="info">
                    <div class="logo"><a href="https://www.lealmedica.com.ar" target="_blank"></a></div>
                    <div class="redes">
                        <a href="https://www.lealmedica.com.ar" target="_blank">lealmedica.com.ar</a>
                        <a href="mailto:bsas@lealmedica.com.ar" class="email"></a>
                        <a href="https://www.instagram.com/lealmedica" class="instagram"></a>
                        <a href="https://es-la.facebook.com/lealmedica" class="facebook"></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- footer -->
        <footer>
            <div class="contenedor">
                <ul>
                    <li>
                        <h3>MENDOZA</h3>
                        <p>Montevideo 501, esq. Chile, Ciudad<br><a href="tel:08102200097">0810-220-0097</a></p>
                    </li>
                    <li>
                        <h3>SAN JUAN</h3>
                        <p>Entre Ríos 316 Sur, Capital<br><a href="tel:2645827475">264 582-7475</a></p>
                    </li>
                    <li>
                        <h3>BUENOS AIRES</h3>
                        <p>Av. Corrientes 1302 13º Piso, CABA<br><a href="tel:1152635404">11 5263-5404</a> - <a href="tel:08101226763">0810-122-6763</a></p>
                    </li>
                    <li>
                        <h3>SANTA FE</h3>
                        <p>Sarmiento 1825, Rosario, Santa Fe<br><a href="tel:3416984459">341 698-4459</a></p>
                    </li>
                </ul>
                <div class="abajo">
                    <p>
                        Superintendencia de Servicios de Salud - Órgano de Control de Obras Sociales y Entidades de Medicina Prepaga<br>
                        <a href="tel:080022272583">0800-222-SALUD (72583)</a> - R.N.E.M.P. v. 1-1438-3
                    </p>
                </div>
            </div>
        </footer>

    </div>

</body>