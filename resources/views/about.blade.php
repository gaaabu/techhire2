<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/about-styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="./asset/logo.png" name="logo" class="logo"> TechHire</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobs.index') }}">Browse Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact Us</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                @if(Auth::user()->isEmployer())
                                    <li><a class="dropdown-item" href="{{ route('jobs.create') }}">Post Job</a></li>
                                @endif
                                @if(Auth::user()->isJobSeeker())
                                    <li><a class="dropdown-item" href="{{ route('applications.index') }}">My Applications</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-register ms-2" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">About Us</h1>
        </div>
    </section>
    <section class="about-description">
        <div class="about-desc-contents">
            <div class="about-text">
                <div class="left-txt">
                    <h1>Empowering Tech Careers, One Match at a Time.</h1>
                </div>
                <div class="right-txt">
                    <p>At TechHire, we bridge the gap between talented individuals and top tech companies. Whether you're a seasoned developer or just starting your journey, 
                        we provide the tools and opportunities to help you grow, connect, and succeed in the ever-evolving tech industry.
                    </p>
                </div>
            </div>
            <div class="btm-image">
                <img src="./asset/abt-img.webp" name="logo" class="logo"> 
            </div>
        </div>
    </section>
    <section class="about-how">
        <div class="about-how-contents">
            <h1>How it works</h1>
            <p>Follow these simple steps to start your journey and land your next tech job.</p>
            <div class="cards-container">
                <div class="about-cards">
                    <h2><i class="bi bi-person"></i></h2>
                    <h4>Create Account</h4>
                    <p>Quickly sign up to get job recommendations and updates tailored for you.</p>
                </div>
                <div class="about-cards">
                    <h2><i class="bi bi-file-earmark-person"></i></h2>
                    <h4>Upload Resume</h4>
                    <p>Upload your resume to let employers find you easily.</p>
                </div>
                <div class="about-cards">
                    <h2><i class="bi bi-briefcase"></i></h2>
                    <h4>Find Jobs</h4>
                    <p>Browse thousands of tech jobs matching your skills and preferences.</p>
                </div>
                <div class="about-cards">
                    <h2><i class="bi bi-check2-circle"></i></h2>
                    <h4>Apply Job</h4>
                    <p>Apply with one click and track your application status easily.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-faq">
        <div class="faq-main-section">
            <h1>Frequently Asked Questions</h1>
            <div class="faq-card">
                <div class="faq-item">
                    <button class="faq-question">Can I upload a CV <span class="arrow">&#9662;</span></button>
                    <div class="faq-answer">Yes, you can easily upload your CV to your profile so employers can find you faster.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">How long will the recuirtment process take? <span class="arrow">&#9662;</span></button>
                    <div class="faq-answer">It depends on each employer's timeline. Some may respond quickly, while others may take longer based on their hiring process.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Do you recuirt graduates, apprentices, and students? <span class="arrow">&#9662;</span></button>
                    <div class="faq-answer">TechHire is open to everyone. It's up to the employer to decide who they want to recruit.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Is it free to create an account? <span class="arrow">&#9662;</span></button>
                    <div class="faq-answer">Yes, signing up and browsing jobs on TechHire is completely free for job seekers.</div>
                </div>
            </div>
    </div>

    
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const faqQuestions = document.querySelectorAll(".faq-question");

            faqQuestions.forEach(question => {
                question.addEventListener("click", function() {
                    const answer = this.nextElementSibling;
                    const arrow = this.querySelector(".arrow");

                    if (answer.style.maxHeight) {
                        answer.style.maxHeight = null;
                        arrow.innerHTML = "&#9662;";
                    } else {
                        answer.style.maxHeight = answer.scrollHeight + "px";
                        arrow.innerHTML = "&#9652;"; 
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    
</body>
</html>