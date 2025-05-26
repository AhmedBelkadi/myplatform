@extends("layouts.master_layout")


@section("links")
    <link rel="icon" href="{{ asset('assets/img/avatars/wwww.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset("assets4")}}/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{asset("assets4")}}/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{asset("assets4")}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset("assets4")}}/plugins/aos/aos.css">
    <link rel="stylesheet" href="{{asset("assets4")}}/plugins/slick/slick.css">
    <link rel="stylesheet" href="{{asset("assets4")}}/plugins/slick/slick-theme.css">
    <link rel="stylesheet" href="{{asset("assets4")}}/style.css">
@endsection

@section("main")

    <div class="main-wrapper">
        <header class="header-eight min-header">
            <div class="header-fixed header-fixed-wrap">
                <nav class="navbar navbar-expand-lg header-nav header-nav-eight">
                    <div class="navbar-header">
                        <a id="mobile_btn" href="javascript:void(0);">
          <span class="bar-icon bar-icon-eight">
            <span></span>
            <span></span>
            <span></span>
          </span>
                        </a>
                        <a href="{{route("home")}}" class="navbar-brand navbar-brand-eight logo">
                            <img src="{{ asset('assets/img/avatars/wwww.jpg') }}" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper main-menu-wrapper-eight">
                        <div class="menu-header menu-header-eight">
                            <a href="{{route("home")}}" class="menu-logo">
                                <img src="{{ asset('assets/img/avatars/wwww.jpg') }}" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <ul class="main-nav main-nav-eight">
                            <li class="active">
                                <a href="{{route("home")}}">Accueil</a>
                            </li>
                            <li class="has-submenu">
                                <a href="">Services<i class="fas fa-chevron-circle-down"></i></a>
                                <ul class="submenu">
                                    <li><a href="#features">Support Technique</a></li>
                                    <li><a href="#features">Assistance Compte</a></li>
                                    <li><a href="#features">Questions Générales</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#contact">Contactez nous</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht header-navbar-rht-eight">
                        <li class="nav-item">
                            <a class="btn btn-register" href="{{route("login")}}">
                                <i class="fas fa-lock"></i>CONNEXION
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <section class="section section-search-eight">
            <div class="container">
                <div class="banner-wrapper-eight m-auto text-center">
                    <div id="accueil" class="banner-header aos" data-aos="fade-up">
                        <h1>Plateforme de Support et Gestion des Tickets<span><br>Service d'Assistance en Ligne<br></span>
                            2024</h1>
                        <p>Bienvenue sur notre plateforme de gestion des tickets. Nous sommes là pour vous aider à résoudre 
                           tous vos problèmes techniques et répondre à vos questions.
                        </p>
                    </div>

                    <div class="row aos" data-aos="fade-up">
                        <div class="statistics-list-eight">
                            <div class="statistics-content-eight">
                                <h3>Notre système de tickets vous permet de suivre vos demandes et d'obtenir une assistance rapide et efficace</h3>
                            </div>
                        </div>
                    </div>

                    <div class="features-section mt-5" id="features">
                        <div class="row justify-content-center">
                            <div class="col-md-4 mb-4">
                                <div class="feature-card text-center p-4 bg-white rounded shadow-sm">
                                    <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                                    <h4>Support Technique</h4>
                                    <p>Assistance pour tous vos problèmes techniques</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="feature-card text-center p-4 bg-white rounded shadow-sm">
                                    <i class="fas fa-user-cog fa-3x text-primary mb-3"></i>
                                    <h4>Gestion de Compte</h4>
                                    <p>Aide pour la gestion de votre compte</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="feature-card text-center p-4 bg-white rounded shadow-sm">
                                    <i class="fas fa-comments fa-3x text-primary mb-3"></i>
                                    <h4>Questions Générales</h4>
                                    <p>Réponses à toutes vos questions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer footer-eight">

            <div class="footer-top aos" data-aos="fade-up">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget footer-about">
                                <div class="footer-logo">
                                    <img style="box-shadow: 20px 16px 5px 0px #042552;"
                                         src="{{ asset('assets/img/avatars/wwww.jpg') }}" alt="logo">
                                </div>
                                <div class="footer-about-content">
                                    <p>Système de Gestion des Tickets</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">Accès Rapide</h2>
                                <ul>
                                    <li><a href="{{route("login")}}">Connexion</a></li>
                                    <li><a href="#features">Nos Services</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">Liens utiles</h2>
                                <ul>
                                    <li><a href="{{route("home")}}">Accueil</a></li>
                                    <li><a href="#contact">Contact</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div id="contact" class="footer-widget footer-contact">
                                <h2 class="footer-title">Contact</h2>
                                <div class="footer-contact-info">
                                    <div class="footer-address">
                                        <p>123 Rue Example<br>Ville, Pays</p>
                                    </div>
                                    <p>+212 500 000 000</p>
                                    <p class="mb-0">support@example.com</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container-fluid">
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="copyright-text">
                                    <p class="mb-0">&copy; 2024 Support System. <span style="color: #FF9800;">Créé par </span></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="social-icon text-md-end">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </footer>

    </div>

@endsection

@section("scripts")
    <!-- jQuery -->
    <script src="{{asset("assets4")}}/js/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="{{asset("assets4")}}/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JS -->
    <script src="{{asset("assets4")}}/plugins/select2/js/select2.min.js"></script>
    <!-- Slick Slider JS -->
    <script src="{{asset("assets4")}}/plugins/slick/slick.js"></script>
    <!-- Aos JS -->
    <script src="{{asset("assets4")}}/plugins/aos/aos.js"></script>
    <!-- Custom JS -->
    <script src="{{asset("assets4")}}/script.js"></script>
@endsection
