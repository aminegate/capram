<?php include 'db.php'; ?>

<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CAPRAM</title>
    <meta name="author" content="Capram">
    <meta name="description" content="Capram">
    <meta name="keywords" content="Capram">
    <meta name="robots" content="INDEX,FOLLOW">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="favicon.png" type="image/x-icon" rel="shortcut icon">
    <meta name="theme-color" content="#ffffff">
    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!--==============================
	    All CSS File 
	============================== -->
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="assets/css/app.min.css"> -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!-- map CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- KEEPING YOUR EXACT CSS -->
    <!-- UPDATED DARK THEME CSS -->
    <style>
        :root {
            --primary-orange: #F7943D !important;
            --bg-color: #0a0a0a !important;
            --card-bg: #161616 !important;
            --text-main: #eeeeee !important;
            --text-muted: #aaaaaa !important;
            --border-color: #2a2a2a !important;
            --pure-white: #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color) !important;
            color: var(--text-main) !important;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Layout Fixes */
        aside.sidebar,
        main.main-content {
            padding-bottom: 110px !important;
            padding-top: 130px !important;
        }

        .page-wrapper {
            max-width: 1200px !important;
            margin: 0 auto !important;
            display: flex !important;
            gap: 40px !important;
        }
        
        .main-content {
    flex: 3 !important;
}
        
        .sidebar {
    flex: 1 !important;
    min-width: 300px !important;
}

        /* Blog Post Cards */
        .blog-post {
            background: var(--card-bg) !important;
            margin-bottom: 30px !important;
            border-radius: 12px !important;
            border: 1px solid var(--border-color) !important;
            overflow: hidden !important;
            transition: transform 0.3s ease;
        }

        .blog-post:hover {
            transform: translateY(-5px);
        }

        .post-img {
            width: 100% !important;
            height: 350px !important;
            object-fit: cover !important;
            border-bottom: 1px solid var(--border-color);
        }

        .post-body {
            padding: 30px !important;
        }

        .post-meta {
            color: var(--text-muted) !important;
            margin-bottom: 15px !important;
            font-size: 14px !important;
        }

        .post-meta i {
            color: var(--primary-orange) !important;
            margin-right: 5px !important;
        }

        .post-title,
        .post-title a {
            font-size: 26px !important;
            margin-bottom: 15px !important;
            color: var(--pure-white) !important;
            text-decoration: none !important;
        }

        .post-excerpt {
            color: var(--text-muted) !important;
        }

        .btn-read-more {
            background: var(--primary-orange) !important;
            color: white !important;
            padding: 12px 25px !important;
            border-radius: 6px !important;
            display: inline-block !important;
            text-decoration: none !important;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-read-more:hover {
            background: #e67e22 !important;
            color: white !important;
        }

        /* Sidebar Widgets */
        .widget:not(.footer-widget) {
            background: var(--card-bg) !important;
            padding: 25px !important;
            margin-bottom: 30px !important;
            border-radius: 12px !important;
            border: 1px solid var(--border-color) !important;
        }

        .widget-title {
            border-left: 4px solid var(--primary-orange) !important;
            padding-left: 15px !important;
            margin-bottom: 20px !important;
            font-size: 19px !important;
            font-weight: bold !important;
            color: var(--pure-white) !important;
        }

        /* Search Input Fix */
        .widget input[type="text"] {
            background: #222 !important;
            border: 1px solid var(--border-color) !important;
            color: white !important;
            border-radius: 4px 0 0 4px !important;
        }

        /* Recent Posts Widget */
        ul.recent-posts-widget {
            padding: 0;
            list-style: none;
        }

        .recent-posts-widget li {
            border-bottom: 1px solid var(--border-color) !important;
            padding-bottom: 15px !important;
            margin-bottom: 15px !important;
        }

        .recent-posts-widget a {
            color: var(--text-main) !important;
            text-decoration: none !important;
            font-weight: 500 !important;
        }

        .recent-posts-widget a:hover {
            color: var(--primary-orange) !important;
        }

        /* Prayer Widget Dark Mode */
        /* --- UPDATED PRAYER TIME CSS --- */

        /* 1. Remove dots and reset list */
        #prayer-list-ul {
            padding: 0 !important;
            margin: 0 !important;
            list-style: none !important;
            /* This removes the dots */
        }

        /* 2. Fix the rows: Name on left, Time on right */
        #prayer-list-ul li {
            display: flex !important;
            justify-content: space-between !important;
            /* This pushes time to the right */
            align-items: center !important;
            padding: 12px 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            font-size: 15px !important;
            color: #bbbbbb !important;
            list-style-type: none !important;
            /* Double check for dots */
        }

        /* Remove border from last item */
        #prayer-list-ul li:last-child {
            border-bottom: none !important;
        }

        /* 3. Make names white and bold */
        #prayer-list-ul li strong {
            color: #ffffff !important;
            font-weight: 600 !important;
        }

        /* 4. Highlight the current upcoming prayer */
        #prayer-list-ul li.active-prayer {
            color: var(--primary-orange) !important;
        }

        #prayer-list-ul li.active-prayer strong {
            color: var(--primary-orange) !important;
        }

        /* 5. Fix the Orange Header Box */
        .next-prayer-highlight {
            background: var(--primary-orange) !important;
            color: white !important;
            padding: 20px !important;
            border-radius: 8px !important;
            text-align: center !important;
            margin-bottom: 20px !important;
        }

        .next-prayer-highlight h4 {
            font-size: 32px !important;
            margin: 5px 0 !important;
            font-weight: 800 !important;
            color: white !important;
            text-transform: uppercase;
        }

        .time-display {
            font-size: 24px !important;
            font-weight: 300 !important;
            opacity: 0.9;
        }

        /* 6. Fix "Ville :" label color */
        .prayer-controls label {
            color: #888888 !important;
            font-size: 12px !important;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* --- DARK DROPDOWN FIX --- */

        .city-dropdown {
            width: 100% !important;
            background-color: #1a1a1a !important;
            /* Dark background */
            color: #ffffff !important;
            /* White text */
            border: 1px solid #333333 !important;
            /* Subtle border */
            padding: 10px 20px !important;
            border-radius: 30px !important;
            /* Rounded pill shape */
            appearance: none !important;
            /* Removes default browser styling */
            -webkit-appearance: none !important;
            cursor: pointer !important;
            font-size: 14px !important;
            margin-bottom: 20px !important;
            outline: none !important;

            /* Adds a small custom arrow icon */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'%3E%3C/path%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 15px center !important;
        }

        /* Styles the dropdown options (the list that pops out) */
        .city-dropdown option {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
        }

        /* Fix for Hover/Focus */
        .city-dropdown:focus {
            border-color: var(--primary-orange) !important;
        }

    </style>

</head>



<body class="blog-body">
    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->
    <!--********************************
   		Code Start From Here 
	******************************** -->
    <!-- <div class="cursor-follower"></div> -->

    <!-- slider drag cursor -->
    <!-- <div class="slider-drag-cursor"> DRAG </div> -->

   
    
       <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="index.html"><img src="assets/img/logo_2.png" alt="Capram"></a>
            </div>
            <div class="th-mobile-menu">
                <ul>
                    <li>
                        <a href="index.html" data-i18n="data-1">Accueil</a>
                    </li>
                    <li>
                        <a href="about.html" data-i18n="data-2">À propos</a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="categories.html" data-i18n="data-3">Catégories</a>
                        <ul class="sub-menu">
                            <li>
                                <div><img src="assets/img/icon/clutch.png" alt=""></div><a href="ca-embrayage.html" data-i18n="data-4">Embrayage</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/motor.svg" alt=""></div><a href="ca-motor.html" data-i18n="data-5">Moteur</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/filter.png" alt=""></div><a href="ca-filtration.html" data-i18n="data-6">Filtration</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/suspension.svg" alt=""></div><a href="ca-suspension.html" data-i18n="data-7">Suspension</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/brakes.svg" alt=""></div><a href="ca-freinage.html" data-i18n="data-8">Freinage</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/cooling.png" alt=""></div><a href="ca-refroidissment.html" data-i18n="data-9">Refroidissement</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/battery.png" alt=""></div><a href="ca-electrical.html" data-i18n="data-10">Système Électrique</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/roues.svg" alt=""></div><a href="ca-wheels.html" data-i18n="data-11">Entraînement des roues</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/lubricant.png" alt=""></div><a href="ca-lubricant.html" data-i18n="data-12">Lubrifiant</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/carrosserie.png" alt=""></div><a href="ca-carrosserie.html" data-i18n="data-13">Carrosserie</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/perfum.png" alt=""></div><a href="ca-accessory.html" data-i18n="data-14">Accessoires</a>
                            </li>
                            <li>
                                <div><img src="assets/img/icon/other.png" alt=""></div><a href="ca-autres.html" data-i18n="data-15">Autres</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="javascript:void(0);" data-i18n="data-16">Services</a>
                        <ul class="sub-menu">
                            <li><a href="nos-service-3.html" data-i18n="data-17">Espace Digital</a></li>
                            <li><a href="nos-service-2.html" data-i18n="data-18">Logistique</a></li>
                            <li><a href="nos-service-1.html" data-i18n="data-19">Impact National</a></li>
                            <li><a href="javascript:void(0);" data-i18n="data-20">E-Catalogue</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="partner.html" data-i18n="data-21">Partenaires</a>
                    </li>
                    <li>
                        <a href="blog.php" data-i18n="data-22">Actualité</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-i18n="data-23" class="goToContact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
	Header Area
   ==============================-->

    <header class="th-header header-default">

        <div class="header-top">
            <div class="row justify-content-center justify-content-lg-between  align-items-center gy-2">
                <div class="col-auto custom-info-group">
                    <!-- The clickable button (Visible only at 1483px and down) -->
                    <button class="info-toggle-btn" id="infoToggleBtn">
                        <i class="fa-solid fa-circle-info"></i> <span data-i18n="data-24">Infos Pratiques</span>
                    </button>
                    <button class="info-toggle-btn">
                        <div class="header-button">
                            <a class="th-btn style6 th-btn-responsive" href="https://b2bcapram.ma/">
                                <span class="icon-stack">
                                    <i class="fa-solid fa-store"></i>
                                    <div class="niche-badge"> <i class="fa-solid fa-cog"></i></div>
                                </span> <span data-i18n="data-25">B2B Capram</span>
                            </a>
                        </div>
                    </button>

                    <!-- The Information Container -->
                    <div class="header-links-container" id="headerLinksPopup">
                        <ul class="header-links-list">
                            <li><i class="fa-regular fa-clock"></i><span data-i18n="data-26">Horaires: Lundi – Vendredi : 9:00 AM – 18:30 PM</span> <span class="colorSlash">/</span> <span data-i18n="data-2000">Samedi : 9:00 AM – 13:00 PM</span></li>
                            <li><i class="fal fa-envelope"></i><a href="mailto:contact@capram.ma">contact@capram.ma</a></li>
                            <li><i class="fal fa-location-dot"></i>35 Rue Bachir Ibrahimi, Casablanca 20250</li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="top-right">
                        <div class="social-links">
                            <div class="lang-switcher-header">
                                <!-- French Option -->
                                <div class="lang-pill active" data-lang="fr">
                                    <div class="flag-circle">
                                        <img src="assets/img/france.png" alt="FR">
                                    </div>
                                    <span class="lang-code">FR</span>
                                </div>

                                <!-- English Option -->
                                <div class="lang-pill" data-lang="en">
                                    <div class="flag-circle">
                                        <img src="assets/img/united-states.png" alt="EN">
                                    </div>
                                    <span class="lang-code">EN</span>
                                </div>
                            </div>
                            <a href="https://web.facebook.com/profile.php?id=61561691562602"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/company/centre-africain-de-pi%C3%A8ces-de-rechange-pour-l%E2%80%99automobile-au-maroc"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://www.instagram.com/capram.auto/"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <!-- Main Menu Area -->
            <div class="menu-area">
                <div class="container-fulid">
                    <div class="row align-items-center justify-content-between">

                        <div class="col-auto">
                            <div class="header-logo">
                                <a href="index.html">
                                    <img src="assets/img/logo.png" alt="Capram" />
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    <li class="">
                                        <a href="index.html" data-i18n="data-28">Accueil</a>
                                    </li>
                                    <li><a href="about.html" data-i18n="data-29">À propos</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="categories.html" data-i18n="data-30">Catégories</a>
                                        <ul class="sub-menu">

                                            <li>
                                                <div><img src="assets/img/icon/clutch.png" alt=""></div><a href="ca-embrayage.html" data-i18n="data-31">Embrayage</a>
                                            </li>
                                            <li>
                                                <div><img src="assets/img/icon/motor.svg" alt=""></div><a href="ca-motor.html" data-i18n="data-32">Moteur</a>
                                            </li>
                                            <li>
                                                <div><img src="assets/img/icon/filter.png" alt=""></div><a href="ca-filtration.html" data-i18n="data-33">Filtration</a>
                                            </li>
                                            <li>
                                                <div><img src="assets/img/icon/suspension.svg" alt=""></div><a href="ca-suspension.html" data-i18n="data-34">Suspension</a>
                                            </li>

                                            <li>
                                                <div><img src="assets/img/icon/brakes.svg" alt=""></div><a href="ca-freinage.html" data-i18n="data-35">Freinage</a>
                                            </li>
                                            <li>
                                                <div><img src="assets/img/icon/cooling.png" alt=""></div><a href="ca-refroidissment.html" data-i18n="data-36">Refroidissement</a>
                                            </li>
                                            <li>
                                                <div><img src="assets/img/icon/battery.png" alt=""></div><a href="ca-electrical.html" data-i18n="data-37">Système Électrique</a>
                                            </li>
                                            <li>
                                                <div><img src="assets/img/icon/roues.svg" alt=""></div><a href="ca-wheels.html" data-i18n="data-38">Entraînement des roues</a>
                                            </li>

                                            <li>
                                                <div><img src="assets/img/icon/lubricant.png" alt=""></div><a href="ca-lubricant.html" data-i18n="data-39">Lubrifiant</a>
                                            </li>
                                            <li>
                                                <div><img src="assets/img/icon/carrosserie.png" alt=""></div><a href="ca-carrosserie.html" data-i18n="data-40">Carrosserie</a>
                                            </li>
                                            <li>
                                                <div><img src="assets/img/icon/perfum.png" alt=""></div><a href="ca-accessory.html" data-i18n="data-41">Accessoires</a>
                                            </li>
                                            <li>
                                                <div><img src="assets/img/icon/other.png" alt=""></div><a href="ca-autres.html" data-i18n="data-42">Autres</a>
                                            </li>

                                        </ul>

                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);" data-i18n="data-43">Services</a>
                                        <ul class="sub-menu">
                                            <li><a href="nos-service-3.html" data-i18n="data-44">Espace Digital</a></li>
                                            <li><a href="nos-service-2.html" data-i18n="data-45">Logistique</a></li>
                                            <li><a href="nos-service-1.html" data-i18n="data-46">Impact National</a></li>
                                            <li><a href="javascript:void(0);" data-i18n="data-47">E-Catalogue</a></li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="partner.html" data-i18n="data-48">Partenaires</a>
                                    </li>
                                    <li class="">
                                        <a href="blog.php" data-i18n="data-49">Actualité</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" data-i18n="data-50" class="goToContact">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="header-button d-flex d-lg-none">
                                <button type="button" class="th-menu-toggle icon-btn"><i class="far fa-bars"></i></button>
                            </div>
                        </div>
                        <div class="col-auto hideIn d-lg-block d-none">
                            <div class="header-button">
                                <a class="th-btn style6" href="https://b2bcapram.ma/">
                                    <span class="icon-stack">
                                        <i class="fa-solid fa-store"></i>
                                        <div class="niche-badge"> <i class="fa-solid fa-cog"></i></div>
                                    </span><span data-i18n="data-51">B2B Capram</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    
    
    <!--==============================
Hero Area
==============================-->
    <div class="th-hero-wrapper hero-1 bg-mask" id="hero">
        <div class="swiper th-slider" id="heroSlider8" data-slider-options='{"effect":"fade", "autoHeight": "false"}'>
            <div class="swiper-wrapper">
                <div class="swiper-slide" data-bg-src="assets/img/hero/hero_bg_1_1.jpg">
                    <div class="hero-inner">
                        <div class="container-fluid">
                            <div class="hero-style1">
                                <span class="sub-title style5" data-ani="slideinup" data-ani-delay="0.2s" data-i18n="data-52"> Pièces de rechanges</span>
                                <h1 class="hero-title text-white">
                                    <span class="title1" data-ani="slideinup" data-ani-delay="0.4s" data-i18n="data-53">CAPRAM</span>
                                </h1>
                                <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.6s" data-i18n="data-54">Meilleure Offre pièces de rechanges au Maroc.</p>
                                <div class="btn-group" data-ani="slideinup" data-ani-delay="0.7s">
                                    <a href="about.html" class="th-btn">
                                        <span data-i18n="data-55">Découvrir</span>
                                        <span class="after-bg"></span>
                                    </a>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-bg-src="assets/img/hero/hero_bg_1_2.jpg">
                    <div class="hero-inner">
                        <div class="container-fluid">
                            <div class="hero-style1">
                                <span class="sub-title style5" data-ani="slideinup" data-ani-delay="0.2s" data-i18n="data-57"> Carrosserie</span>
                                <h1 class="hero-title text-white">
                                    <span class="title1" data-ani="slideinup" data-ani-delay="0.4s" data-i18n="data-58">CAPCARROSSERIE</span>
                                </h1>
                                <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.6s" data-i18n="data-59">Bon rapport qualité prix en carrosserie Européenne & Asiatique</p>
                                <div class="btn-group" data-ani="slideinup" data-ani-delay="0.7s">
                                    <a href="about.html" class="th-btn">
                                        <span data-i18n="data-60">Découvrir</span>
                                        <span class="after-bg"></span>
                                    </a>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-bg-src="assets/img/hero/hero_bg_1_3.jpg">
                    <div class="hero-inner">
                        <div class="container-fluid">
                            <div class="hero-style1">
                                <span class="sub-title style5" data-ani="slideinup" data-ani-delay="0.2s" data-i18n="data-62"> Lubrifiants, additifs & liquides</span>
                                <h1 class="hero-title text-white">
                                    <span class="title1" data-ani="slideinup" data-ani-delay="0.4s" data-i18n="data-63">CAPSERVICE</span>
                                </h1>
                                <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.6s" data-i18n="data-64">Solution Complète: Lubrifiants, additifs & liquides pour automobile & industrie.</p>
                                <div class="btn-group" data-ani="slideinup" data-ani-delay="0.7s">
                                    <a href="about.html" class="th-btn">
                                        <span data-i18n="data-65">Découvrir</span>
                                        <span class="after-bg"></span>
                                    </a>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="icon-box">
                <button data-slider-prev="#heroSlider8" class="slider-arrow style2 default">
                    <img src="assets/img/icon/left-arrow.svg" alt="">
                </button>
                <button data-slider-next="#heroSlider8" class="slider-arrow style2 default">
                    <img src="assets/img/icon/right-arrow.svg" alt="">
                </button>
            </div>
        </div>
        <div class="scroll-down">
            <a href="#about-sec" class="scroll-wrap">
                <span data-i18n="data-67">Descendre</span> <span><img src="assets/img/icon/down-arrow.svg" alt=""></span>
            </a>
        </div>
    </div>
    
       <!--======== / Hero Section ========-->
    <!--==============================
Feature Area  
==============================-->


    <div class="page-wrapper">
        <!-- === MAIN CONTENT (THIS IS WHAT I MODIFIED FOR SECURITY) === -->
        <main class="main-content">
            <?php
                    // 1. SECURE SEARCH LOGIC (Prepared Statements)
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $search_term = "%" . $_GET['search'] . "%";
                        // Prevent SQL Injection using prepare()
                        $stmt = $conn->prepare("SELECT * FROM blog_posts WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC");
                        $stmt->bind_param("ss", $search_term, $search_term);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        echo '<h3 style="margin-bottom:20px;">Résultats pour : "'.htmlspecialchars($_GET['search']).'"</h3>';
                    } else {
                        // Default: Show all posts
                        $sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
                        $result = $conn->query($sql);
                    }
                    // 2. CHECK & DISPLAY POSTS
                    if ($result->num_rows > 0) {
                        // Translation Arrays
                        $english_months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        $french_months = ['Janv', 'Févr', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'];

                        while($row = $result->fetch_assoc()) {
                            // Date formatting
                            $dateObj = date_create($row['created_at']);
                            $dateString = date_format($dateObj, "d M, Y");
                            $dateFrench = str_replace($english_months, $french_months, $dateString);
                            
                            // Clean excerpt
                           $excerpt = strip_tags($row['content']);
                    ?>
            <!-- BLOG POST ITEM -->
            <article class="blog-post">
                <?php if($row['image_url']): ?>
                <a href="javascript:void(0);">
                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="post-img">
                </a>
                <?php endif; ?>
                <div class="post-body">
                    <div class="post-meta">
                        <span><i class="far fa-calendar-alt"></i> <?php echo $dateFrench; ?></span>
                        <span><i class="far fa-user"></i> <?php echo htmlspecialchars($row['author']); ?></span>
                    </div>
                    <h2 class="post-title">
                        <a href="javascript:void(0);"><?php echo htmlspecialchars($row['title']); ?></a>
                    </h2>
                    <p class="post-excerpt"><?php echo $excerpt; ?></p>
                </div>
            </article>
            <?php 
                        } // End while
                    } else {
                        echo "<p>Aucun article trouvé.</p>";
                    }
                    ?>
        </main>
        <!-- === SIDEBAR (Keeping your exact widgets) === -->
        <aside class="sidebar">
            <!-- Search Widget -->
            <div class="widget">
                <h3 class="widget-title">Recherche</h3>
                <form action="blog.php" method="GET" style="display:flex;">
                    <input type="text" name="search" placeholder="Rechercher..." style="width:100%; padding:10px; border:1px solid #ddd;">
                    <button type="submit" style="background:#F7943D; color:white; border:none; padding:0 15px;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <!-- Recent Posts Widget -->
            <div class="widget">
                <h3 class="widget-title">Articles récents</h3>
                <ul class="recent-posts-widget">
                    <?php
                            // Fetch latest 5 posts (Simple & fast)
                            $recent_sql = "SELECT id, title, created_at FROM blog_posts ORDER BY created_at DESC LIMIT 5";
                            $recent_result = $conn->query($recent_sql);

                            if ($recent_result->num_rows > 0) {
                                while($recent = $recent_result->fetch_assoc()) {
                                    $dateObj = date_create($recent['created_at']);
                                    $formattedDate = date_format($dateObj, "d/m/Y");
                            ?>
                    <li>
                        <a href="single.php?id=<?php echo $recent['id']; ?>">
                            <?php echo htmlspecialchars($recent['title']); ?>
                        </a>
                        <span class="widget-date">
                            <i class="far fa-clock"></i> <?php echo $formattedDate; ?>
                        </span>
                    </li>
                    <?php 
                                }
                            } else {
                                echo "<li>Aucun article récent.</li>";
                            }
                            ?>
                </ul>
            </div>
            <!-- Prayer Times Widget (Your specific logic) -->
            <div class="widget">
                <h3 class="widget-title">Horaires de Prière</h3>
                <div class="prayer-controls">
                    <label for="city-select" style="display:block; margin-bottom:5px; color:#555; font-size:13px;">Ville :</label>
                    <select id="city-select" class="city-dropdown">
                        <option value="Casablanca" selected>Casablanca</option>
                        <option value="Rabat">Rabat</option>
                        <option value="Marrakech">Marrakech</option>
                        <option value="Agadir">Agadir</option>
                        <option value="Tangier">Tanger</option>
                        <option value="Fes">Fès</option>
                        <option value="Meknes">Meknès</option>
                        <option value="Oujda">Oujda</option>
                        <option value="Laayoune">Laâyoune</option>
                    </select>
                </div>
                <div id="next-prayer-box" class="next-prayer-highlight">
                    <span class="next-label">Prochaine Prière :</span>
                    <h4 id="next-name">Chargement...</h4>
                    <div id="next-time" class="time-display">--:--</div>
                    <small id="time-remaining">Bientôt</small>
                </div>
                <ul class="prayer-list" id="prayer-list-ul"></ul>
            </div>
        </aside>
    </div>
    <!--==============================
	Footer Area
==============================-->
    <footer class="footer-wrapper footer-default">
        <div class="widget-area">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-xl-4" data-cue="slideInUp">
                        <div class="widget footer-widget">
                            <div class="th-widget-about">
                                <div class="about-logo">
                                    <a href="index.html"><img src="assets/img/logo.png" alt="Capram"></a>
                                </div>
                                <p class="about-text" data-i18n="data-142">Chez CAPRAM, nous nous engageons à offrir une qualité et une précision inégalées dans chaque aspect de nos activités. Dès votre premier contact avec nous et tout au long de notre accompagnement par nos experts, nous mettons tout en œuvre pour garantir des solutions fiables et un service à la hauteur de vos attentes.</p>
                                <div class="th-social">
                                    <a href="https://web.facebook.com/profile.php?id=61561691562602"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.linkedin.com/company/centre-africain-de-pi%C3%A8ces-de-rechange-pour-l%E2%80%99automobile-au-maroc"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://www.instagram.com/capram.auto/"><i class="fa-brands fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-auto" data-cue="slideInUp">
                        <div class="widget widget_nav_menu footer-widget">
                            <h3 class="widget_title">
                                <span data-i18n="data-143">Liens Utiles</span>
                            </h3>

                            <div class="menu-all-pages-container">
                                <ul class="menu">

                                    <li>
                                        <a href="index.html">
                                            <i class="fa-solid fa-angle-right"></i>
                                            <span data-i18n="data-144">Accueil</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="about.html">
                                            <i class="fa-solid fa-angle-right"></i>
                                            <span data-i18n="data-145">À propos</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="categories.html">
                                            <i class="fa-solid fa-angle-right"></i>
                                            <span data-i18n="data-146">Nos Catégories</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0);">
                                            <i class="fa-solid fa-angle-right"></i>
                                            <span data-i18n="data-147">Actualité</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-auto" data-cue="slideInUp">
                        <div class="widget widget_nav_menu footer-widget">
                            <h3 class="widget_title">
                                <span data-i18n="data-148">Nos Services</span>
                            </h3>

                            <div class="menu-all-pages-container">
                                <ul class="menu">

                                    <li>
                                        <a href="nos-service-3.html">
                                            <i class="fa-solid fa-angle-right"></i>
                                            <span data-i18n="data-149">Espace Digital</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="nos-service-2.html">
                                            <i class="fa-solid fa-angle-right"></i>
                                            <span data-i18n="data-150">Logistique</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="nos-service-1.html">
                                            <i class="fa-solid fa-angle-right"></i>
                                            <span data-i18n="data-151">Impact National</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0);">
                                            <i class="fa-solid fa-angle-right"></i>
                                            <span data-i18n="data-152">E-Catalogue</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3" data-cue="slideInUp">
                        <div class="widget footer-widget">
                            <h3 class="widget_title" data-i18n="data-153">Publications Instagram</h3>
                            <div class="sidebar-gallery">
                                <div class="gallery-thumb">
                                    <img src="assets/img/widget/gallery_1_1.jpg" alt="Gallery Image">
                                    <a target="_blank" href="https://www.instagram.com/capram.auto/" class="gallery-btn"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="gallery-thumb">
                                    <img src="assets/img/widget/gallery_1_2.jpg" alt="Gallery Image">
                                    <a target="_blank" href="https://www.instagram.com/capram.auto/" class="gallery-btn"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="gallery-thumb">
                                    <img src="assets/img/widget/gallery_1_3.jpg" alt="Gallery Image">
                                    <a target="_blank" href="https://www.instagram.com/capram.auto/" class="gallery-btn"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="gallery-thumb">
                                    <img src="assets/img/widget/gallery_1_4.jpg" alt="Gallery Image">
                                    <a target="_blank" href="https://www.instagram.com/capram.auto/" class="gallery-btn"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="gallery-thumb">
                                    <img src="assets/img/widget/gallery_1_5.jpg" alt="Gallery Image">
                                    <a target="_blank" href="https://www.instagram.com/capram.auto/" class="gallery-btn"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="gallery-thumb">
                                    <img src="assets/img/widget/gallery_1_6.jpg" alt="Gallery Image">
                                    <a target="_blank" href="https://www.instagram.com/capram.auto/" class="gallery-btn"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="certifWrapper">
            <div class="certifContainer">

                <img src="assets/img/salamatouna%202.png" alt="">
                <img src="assets/img/imanor_2.png" alt="">
            </div>

        </div>
        <div class="copyright-wrap">
            <div class="container">
                <div class="row justify-content-center gy-3 align-items-center">
                    <div class="col-lg-6" data-cue="slideInUp">
                        <p class="copyright-text">
                            <span data-i18n="data-154">Copyright</span>
                            <i class="fal fa-copyright"></i> 2026 <a href="index.html">Capram</a>, <span data-i18n="data-157">Tous droits réservés.</span>
                        </p>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center" data-cue="slideInUp">
                        <div class="footer-links">
                            <ul>
                                <li><a href="javascript:void(0);" data-i18n="data-158">Politique SMQ</a></li>
                       
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--********************************
			Code End  Here 
******************************** -->
    <!-- Scroll To Top -->
    <div style="" class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>
    <!--==============================
    All Js File
============================== -->
    <!-- Jquery -->
    <script src="assets/js/vendor/jquery-3.7.1.min.js"></script>
    <!-- <script src="assets/js/vendor/jquery-3.7.1.min.js"></script> -->
    <!-- map Js -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // 1. Initialize map
        var map = L.map('map').setView([33.58609299340052, -7.602708825402712], 18);

        // 2. Use World_Street_Map for high detail in Casablanca
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // Add your marker
        var marker = L.marker([33.58609299340052, -7.602708825402712]).addTo(map);
        marker.bindPopup("<b>CAPRAM</b>").openPopup();

    </script>
    <!-- <script src="assets/js/app.min.js"></script> -->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Magnific Popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- Range Slider -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- Isotope Filter -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- Cue Js -->
    <script src="assets/js/scrollCue.min.js"></script>
    <!-- Gsap -->
    <script src="assets/js/gsap.min.js"></script>
    <!-- Scroll Trigger -->
    <script src="assets/js/ScrollTrigger.min.js"></script>
    <!-- Split Text -->
    <script src="assets/js/SplitText.min.js"></script>
    <!-- Lenis Js -->
    <script src="assets/js/lenis.min.js"></script>
    <!-- Main Js File -->
    <script src="assets/js/main.js"></script>
     <script src="lang/translations.js"></script>

    <script>
        // Use 'jQuery' keyword to avoid conflict with other libraries ($)
        (function($) {
            $(document).ready(function() {
                console.log("Prayer Script Initialized");

                function getPrayerTimes(city) {
                    // Updated to use Method 3 (World League) which is more stable for Morocco
                    var apiURL = "https://api.aladhan.com/v1/timingsByCity?city=" + encodeURIComponent(city) + "&country=Morocco&method=3";

                    $("#next-name").text("Chargement...");

                    $.ajax({
                        url: apiURL,
                        method: "GET",
                        dataType: "json",
                        success: function(response) {
                            if (response && response.data) {
                                var t = response.data.timings;
                                var prayers = [{
                                        name: "Fajr",
                                        time: t.Fajr
                                    },
                                    {
                                        name: "Chourouq",
                                        time: t.Sunrise
                                    },
                                    {
                                        name: "Dohr",
                                        time: t.Dhuhr
                                    },
                                    {
                                        name: "Asr",
                                        time: t.Asr
                                    },
                                    {
                                        name: "Maghrib",
                                        time: t.Maghrib
                                    },
                                    {
                                        name: "Icha",
                                        time: t.Isha
                                    }
                                ];
                                updateUI(prayers);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("API Error:", error);
                            $("#next-name").text("Indisponible");
                            $("#time-remaining").text("Erreur de connexion");
                        }
                    });
                }

                function updateUI(prayers) {
                    var listHtml = "";
                    var nextFound = false;
                    var now = new Date();
                    var currentStr = ("0" + now.getHours()).slice(-2) + ":" + ("0" + now.getMinutes()).slice(-2);

                    $("#prayer-list-ul").empty();

                    $.each(prayers, function(i, p) {
                        var time = p.time.split(' ')[0].substring(0, 5);
                        var isNext = false;

                        if (!nextFound && time > currentStr) {
                            $("#next-name").text(p.name);
                            $("#next-time").text(time);
                            $("#time-remaining").text("Aujourd'hui");
                            nextFound = true;
                            isNext = true;
                        }

                        var activeClass = isNext ? 'class="active-prayer"' : '';
                        listHtml += '<li ' + activeClass + '><strong>' + p.name + '</strong> <span>' + time + '</span></li>';
                    });

                    $("#prayer-list-ul").html(listHtml);

                    // Fallback if all prayers today have passed
                    if (!nextFound) {
                        $("#next-name").text("Fajr");
                        $("#next-time").text(prayers[0].time.substring(0, 5));
                        $("#time-remaining").text("Demain");
                        $("#prayer-list-ul li:first").addClass("active-prayer");
                    }
                }

                // Initialize with Casablanca
                getPrayerTimes("Casablanca");

                // Listen for changes
                $("#city-select").on("change", function() {
                    getPrayerTimes($(this).val());
                });
            });
        })(jQuery);

    </script>
    

        
    </body>

</html>
