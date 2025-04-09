
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Asset Management</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('startbootstrap-creative-gh-pages/assets/favicon.ico') }}" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('startbootstrap-creative-gh-pages/css/styles.css') }}" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Asset Management</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">

                        <li class="nav-item"><a class="nav-link " href="#about">Home</a></li>
                        <li class="nav-item"><a class="nav-link " href="#heirs">Heirs</a> </li>
                        <li class="nav-item"><a class="nav-link " href="#portfolio">Heirs Share Rate</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

                            <li class="nav-item dropdown">
                                <a class="nav-link bi-person smoothscroll" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" ></a>

                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">       
                                
                                    <li  class="nav-item">
                                    @if (Route::has('login'))
                                        @auth
                                            @if (auth()->user()->userType === 'admin')
                                                <li class="nav-item"><a href="{{ route('adminD.dashboard')}}" class="nav-link" style="color:black;">Dashboard</a></li>
                    
                                            @elseif (auth()->user()->userType === 'user')
                                                <li class="nav-item"><a href="{{ route('userAsset.home') }}" class="nav-link" style="color:black;">Dashboard</a></li>
                                            @elseif (auth()->user()->userType === 'family')
                                                <li class="nav-item"><a href="{{ route('familyAsset.home') }}" class="nav-link" style="color:black;">Dashboard</a></li>
                                            @endif
        
                                        @else
                                            <li class="nav-item"> <a class="nav-link" href="{{ route('login') }}" style="color:black;">Login</a><li>
                                            @if (Route::has('register'))
                                                <li class="nav-item"> <a  class="nav-link" href="{{ route('register') }}" style="color:black;" >Register</a><li>
                                            @endif
                                        @endauth
                                    @endif
                    </li>
                                
                                
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Asset Management System</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">For Islamic Family Using Geolocation with Email Notifications</p>
                        @if (Route::has('login'))
                            @auth
                                @if (auth()->user()->userType === 'admin')
                                    <a href="{{ route('adminD.dashboard')}}" class="btn btn-primary btn-xl" >Get Started!</a></li>
        
                                @elseif (auth()->user()->userType === 'user')
                                    <a href="{{ route('userAsset.home') }}" class="btn btn-primary btn-xl" >Get Started!</a></li>
                                @elseif (auth()->user()->userType === 'family')
                                    <a href="{{ route('familyAsset.home') }}" class="btn btn-primary btn-xl" >Get Started!</a></li>
                                @endif

                            @else
                                <a class="btn btn-primary btn-xl" href="{{ route('login') }}" >Get Started!</a><li>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Defination Of Faraid!</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">The determination of the rights and shares of the heirs to the inheritance of a deceased person is based on Shariah law.</p>
                        <a class="btn btn-light btn-xl" href="#heirs">Find Out More!</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
      
            <section class="page-section" id="heirs">
                <div class="container px-4 px-lg-5">
                    <h2 class="text-center mt-0">Heir Type</h2>
                    <hr class="divider"/>
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2">
                                    <i class="bi-gem fs-1 text-primary" data-bs-toggle="tooltip" title="Fardu according to the term faraid science is the proportion of the share of the inheritance that will be inherited by an heir that has been determined by Hukum Syarak. For example, the wife's share has been set at 1/4 if the deceased has no children, and has been set at 1/8 if the deceased leaves children."></i>
                                </div>
                                <h3 class="h4 mb-2">Waris Fardu</h3>
                                <p class="text-muted mb-0">6 parts of fardhu inheritance, namely ½, 1/3, 2/3, ¼, 1/6 and 1/8</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2">
                                    <i class="bi-laptop fs-1 text-primary" data-bs-toggle="tooltip" title="The heirs who did not get the share according to the prescribed fardu. The share rate of asobah heirs is either taking all the shares in the inheritance or taking the balance after being given the share of the fardu heirs or not getting a direct share because it has been spent by the fardu heirs."></i>
                                </div>
                                <h3 class="h4 mb-2">Waris Asobah</h3>
                                <p class="text-muted mb-0">Asobah is divided into three types namely Asobah Bi al-Nafsi,Asobah Bi al-Ghairi,Asobah Ma al-Ghairi.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2">
                                    <i class="bi-globe fs-1 text-primary" data-bs-toggle="tooltip" title="Heirs who have a family relationship with the deceased other than fardu heirs and asobah heirs. The scholars have differed on their position, whether they can inherit the inheritance or not. The first group thinks that they have the right to inherit if the deceased does not leave an heir who can finish the inheritance, or there are no fardu heirs, the remaining property can be transferred to them."></i>
                                </div>
                                <h3 class="h4 mb-2">Dhawi al-Arham</h3>
                                <p class="text-muted mb-0">The residual inheritance must be given to Baitulmal if the deceased does not leave an asobah heir or a fardu heir who cannot spend the inheritance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/fullsize/1.jpg') }}" title="1/2">
                            <img class="img-fluid" src="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/thumbnail/1.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Division</div>
                                <div class="project-name">1/2</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/fullsize/2.jpg') }}" title="1/3">
                            <img class="img-fluid" src="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/thumbnail/2.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Division</div>
                                <div class="project-name">1/3</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/fullsize/3.jpg') }}" title="1/4">
                            <img class="img-fluid" src="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/thumbnail/3.jpg') }}"alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Division</div>
                                <div class="project-name">1/4</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/fullsize/4.jpg') }}" title="2/3">
                            <img class="img-fluid" src="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/thumbnail/4.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Division</div>
                                <div class="project-name">2/3</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/fullsize/5.jpg') }}" title="1/6">
                            <img class="img-fluid" src="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/thumbnail/5.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Division</div>
                                <div class="project-name">1/6</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/fullsize/6.jpg') }}" title="1/8">
                            <img class="img-fluid" src="{{asset('startbootstrap-creative-gh-pages/assets/img/portfolio/thumbnail/6.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption p-3">
                                <div class="project-category text-white-50">Division</div>
                                <div class="project-name">1/8</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
       
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Let's Get In Touch!</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Ready to start your next project with us? Send us a messages and we will get back to you as soon as possible!</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Full name</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Phone number</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-4 text-center mb-5 mb-lg-0">
                        <i class="bi-phone fs-2 mb-3 text-muted"></i>
                        <div>+60 123456789</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2024 - Asset Management</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('startbootstrap-creative-gh-pages/js/scripts.js') }}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
    </body>
</html>

