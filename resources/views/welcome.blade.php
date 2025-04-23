<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Well Being - Chat</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style>
        body::before {
            display: block;
            content: '';
            height: 110px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 fixed-top">
        <div class="container">
            <a href="#" class="navbar-brand"><img src="{{ asset('img/logo.png') }}" alt="Well Being - Chat" width=300px></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"><span class="navbar-toggler-icon"></span></button>
            
            <div class="collapse navbar-collapse" id="navmenu">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About&nbsp;Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Services</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarProfessionals" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Professionals
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarProfessionals">
                            <li class="dropdown-item">
                                <a href="#" class="nav-link">Psychologists</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="#" class="nav-link">Psychiatrists</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="#" class="nav-link">Counselors</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="#" class="nav-link">Coaches</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#instructors" class="nav-link">Testimonial</a>
                    </li>
                    <li class="nav-item">
                        <a href="#instructors" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="#instructors" class="nav-link">Contact&nbsp;Us</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register as Professional') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Showcase -->
    <section class="showcase bg-light text-light p-10 p-lg-0 pt-lg-5 text-sm-start" style="background-image: url({{ asset('img/showcase3.jpg') }});">
        <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div class="m-5 pt-5">
                    <h3>Chat online with</h3>
                    <h1 class="my-4">Psychologists,<br>Psychiatrists,<br>Counselors and <br>Coaches</h1>
                    <button class="btn btn-success btn-lg my-5">Live Chat</button>
                </div>
                
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section class="p-5" style="background-color: lightgray">
        <div class="container">
            <div class="row g-4">
                <div class="col-md py-5">
                    <img src="{{ asset('img/about_specialist.jpg') }}" class="img-fluid rounded" alt="">  
                </div>
                <div class="col-md p-5">
                    <h1>About Us</h1>
                    <p>It's hard to go through life alone. Share your stories now woth any of our specialists. Accepting that you need help is the first step of being a better you. Healing relationship, understanding your emotions, and having a better and positive outlook in life are just a few benefits.</p>
                    <p>We can help you go through life's struggles and guide you to reach your goal. Online therapy might just be the best option to bring you wellness despite your busy lifestyle.</p>    
                    <button class="btn btn-success btn-lg my-5">Live Chat</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructors -->
    <section id="instructors" class="p-5 bg-light">
        <div class="container">
            <h2 class="text-center text-dark">Top online Psychologists & Psychiatrists available</h2>
            {{-- <p class="lead text-center text-dark mb-5">Our instructors all have 5+ years working experience in there field.</p> --}}
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/men/11.jpg" class="rounded-circle mb-3" alt="">
                            <h3 class="card-title mb-3">John Doe</h3>
                            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem dolorem nemo soluta eaque vitae molestiae.</p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/women/11.jpg" class="rounded-circle mb-3" alt="">
                            <h3 class="card-title mb-3">Jane Doe</h3>
                            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem dolorem nemo soluta eaque vitae molestiae.</p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/men/12.jpg" class="rounded-circle mb-3" alt="">
                            <h3 class="card-title mb-3">Juan Dela Cruz</h3>
                            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem dolorem nemo soluta eaque vitae molestiae.</p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/women/12.jpg" class="rounded-circle mb-3" alt="">
                            <h3 class="card-title mb-3">Juana Dela Cruz</h3>
                            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem dolorem nemo soluta eaque vitae molestiae.</p>
                            <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Boxes -->
    <section class="p-5 bg-success" id="learn">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md">
                    <div class="card bg-dark text-light">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi-laptop"></i>
                            </div>
                            <h3 class="card-title mb-3">Our Top Psychologist</h3>
                            {{-- <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati ratione officiis doloremque dolores excepturi accusantium!</p> --}}
                            <a href="" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-secondary text-light">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi-person-square"></i>
                            </div>
                            <h3 class="card-title mb-3">Trauma Therapy</h3>
                            {{-- <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati ratione officiis doloremque dolores excepturi accusantium!</p> --}}
                            <a href="" class="btn btn-dark">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="col-md">
                        <div class="card bg-dark text-light">
                            <div class="card-body text-center">
                                <div class="h1 mb-3">
                                    <i class="bi-people"></i>
                                </div>
                                <h3 class="card-title mb-3">Depression Therapy</h3>
                                {{-- <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati ratione officiis doloremque dolores excepturi accusantium!</p> --}}
                                <a href="" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="col-md">
                        <div class="card bg-secondary text-light">
                            <div class="card-body text-center">
                                <div class="h1 mb-3">
                                    <i class="bi-people"></i>
                                </div>
                                <h3 class="card-title mb-3">Anxiety Therapy</h3>
                                {{-- <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati ratione officiis doloremque dolores excepturi accusantium!</p> --}}
                                <a href="" class="btn btn-dark">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

   

    <!-- Learn Section -->
    {{-- <section class="p-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md">
                    <img src="{{ asset('img/fundamentals1.svg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-md p-5">
                    <h2>Learn the Fundamentals</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus laboriosam cum explicabo, consequatur perspiciatis corrupti!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione accusantium minus maiores necessitatibus eveniet dolor, repudiandae aliquam totam molestiae placeat quod explicabo culpa. Corrupti perferendis qui cumque commodi quo illo!</p>
                    <a href="#" class="btn btn-light mt-3"><i class="bi bi-chevron-right"></i>Read More</a>
                </div>
            </div>
        </div>
    </section>
    <section class="p-5 bg-dark text-light">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md p-5">
                    <h2>Level up your know how</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus laboriosam cum explicabo, consequatur perspiciatis corrupti!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione accusantium minus maiores necessitatibus eveniet dolor, repudiandae aliquam totam molestiae placeat quod explicabo culpa. Corrupti perferendis qui cumque commodi quo illo!</p>
                    <a href="#" class="btn btn-light mt-3"><i class="bi bi-chevron-right"></i>Read More</a>
                </div>
                <div class="col-md">
                    <img src="{{ asset('img/react1.svg') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Question Accordion -->
    <section class="p-5" id="question">
        <div class="container">
            <h2 class="text-center mb-4">Frequently Asked Questions</h2>
            <div class="accordion accordion-flush" id="questions">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questions-one">
                        Where are you located?
                    </button>
                    </h2>
                    <div id="questions-one" class="accordion-collapse collapse" aria-labelledby="questions-one" data-bs-parent="#questions">
                    <div class="accordion-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque blanditiis deserunt sint, amet facere aut soluta recusandae repellendus adipisci aspernatur! Cumque quas omnis odit, sequi debitis quo. Sapiente dicta natus, obcaecati earum laborum repellat maiores accusantium dolores saepe adipisci quod molestiae sed doloribus quisquam officia sequi excepturi minima? Ea, quam.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questions-two">
                        How much does it cost to attend?
                    </button>
                    </h2>
                    <div id="questions-two" class="accordion-collapse collapse" aria-labelledby="questions-two" data-bs-parent="#questions">
                    <div class="accordion-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque blanditiis deserunt sint, amet facere aut soluta recusandae repellendus adipisci aspernatur! Cumque quas omnis odit, sequi debitis quo. Sapiente dicta natus, obcaecati earum laborum repellat maiores accusantium dolores saepe adipisci quod molestiae sed doloribus quisquam officia sequi excepturi minima? Ea, quam.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questions-three">
                        What do I need to know?
                    </button>
                    </h2>
                    <div id="questions-three" class="accordion-collapse collapse" aria-labelledby="questions-three" data-bs-parent="#questions">
                    <div class="accordion-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque blanditiis deserunt sint, amet facere aut soluta recusandae repellendus adipisci aspernatur! Cumque quas omnis odit, sequi debitis quo. Sapiente dicta natus, obcaecati earum laborum repellat maiores accusantium dolores saepe adipisci quod molestiae sed doloribus quisquam officia sequi excepturi minima? Ea, quam.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questions-four">
                        How do I signup?
                    </button>
                    </h2>
                    <div id="questions-four" class="accordion-collapse collapse" aria-labelledby="questions-four" data-bs-parent="#questions">
                    <div class="accordion-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque blanditiis deserunt sint, amet facere aut soluta recusandae repellendus adipisci aspernatur! Cumque quas omnis odit, sequi debitis quo. Sapiente dicta natus, obcaecati earum laborum repellat maiores accusantium dolores saepe adipisci quod molestiae sed doloribus quisquam officia sequi excepturi minima? Ea, quam.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questions-five">
                        Do you help me find a job?
                    </button>
                    </h2>
                    <div id="questions-five" class="accordion-collapse collapse" aria-labelledby="questions-five" data-bs-parent="#questions">
                    <div class="accordion-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque blanditiis deserunt sint, amet facere aut soluta recusandae repellendus adipisci aspernatur! Cumque quas omnis odit, sequi debitis quo. Sapiente dicta natus, obcaecati earum laborum repellat maiores accusantium dolores saepe adipisci quod molestiae sed doloribus quisquam officia sequi excepturi minima? Ea, quam.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Group Chat -->
    <section class="bg-success text-light p-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-8">
                    <h3 class="mb-3 mb-md-0">Group Therapy</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, adipisci deserunt numquam sed, nemo magnam dolores eaque, libero voluptas perspiciatis quos officiis labore dolorum? Sapiente excepturi perferendis dolor veritatis architecto.</p>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-transparent border-light text-light btn-lg my-5">Read More</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Map -->
    <section class="p-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md">
                    <h2 class="text-center mb-4">Contact Info</h2>
                    <ul class="list-group list-group-flush lead">
                        <li class="list-group-item">
                            <span class="fw-bold">Main Location:</span>Banawe Q.C.
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Phone:</span>+63 917 123 4567
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Email:</span>test@test.com
                        </li>
                    </ul>
                </div>
                <div class="col-md">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="p-5 bg-dark text-white text-center position-relative">
        <p class="lead">Copyright &copy; 2023 WellBeing-Chat</p>
    </footer>
</body>
</html>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoieGlhbHVjYXJkIiwiYSI6ImNsY3p3ZXZsbjIyN3Qzb3Bsc2Y5ODBjeGUifQ.CEqrqTw4ZBgOfwyJ2eCfMw';
    var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center:[121.00530443423713,14.62775152280426],
      zoom: 18
    });
  </script>