@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="background-image-cover" style="background-image:url('{{ asset('img/background/background-1.webp') }}')">
    <nav class="navbar navbar-dark fixed-top navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <img src="{{ asset('img/logo/fairwin-horizontal-white.webp') }}" alt="8Fairwin8 Trading Corporation">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto font-weight-300 font-size-100 justify-content-center">
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link link-color-1 px-md-3 px-xl-4 aileron-bold font-weight-600 active" aria-current="page" href="http://thebluhotel.test">HOME</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link aileron-bold link-color-1 px-md-3 px-xl-4 " aria-current="page" href="http://thebluhotel.test/rooms">PRODUCTS</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item mb-2 mb-lg-0">--}}
{{--                        <a class="nav-link aileron-bold link-color-1 px-md-3 px-xl-4 " href="http://thebluhotel.test/contact">CONTACT</a>--}}
{{--                    </li>--}}
                    <li class="nav-item ms-md-3 ms-xl-4">
                        <a class="btn aileron-bold font-weight-500 px-4 py-2 mb-4 mb-lg-0 btn-custom-1" href="https://booking.bluhotelalbay.com/booking/book-rooms-thebluhotel" target="_blank" rel="noreferrer">REGISTER NOW</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row align-items-center py-5 min-vh-100">
            <div class="col-md-11 col-lg-9 col-xl-8 pt-4 mt-5 mb-5">
                <p class="code-pro-bold-lc font-size-320 font-size-sm-400 font-size-md-420 font-size-lg-450 font-size-xl-480 font-size-xxl-560 text-center text-md-start text-white line-height-100 mb-4">Let nature <span class="code-pro-bold-lc text-color-1">heal</span> <br>and <span class="code-pro-bold-lc text-color-1">protect</span> you from within.</p>
                <h1 class="aileron-regular font-size-120 font-size-sm-130 font-size-md-130 font-size-lg-130 font-size-xl-140 font-size-xxl-160 text-center text-md-start text-white line-height-140 mb-5">8Fairwin8 Trading Corporation is a leading provider of wellness solutions designed to help individuals achieve optimal health and well-being.</h1>

                <div class="text-center text-md-start mb-2">
                    <a href="http://thebluhotel.test/contact" class="btn btn-custom-1 font-size-110 aileron-bold px-4 px-sm-5 py-3">EXPERIENCE WELLNESS TODAY</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white w-100 py-5">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5 col-xxl-4 mb-5 mb-lg-0">
                <div class="row justify-content-center">
                    <div class="col-10 col-sm-8 col-md-6 col-lg-12">
                        <img src="{{ asset('img/logo/fairwin-logo.png') }}" class="w-100" />
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="ps-lg-4 ps-xl-5">
                    <p class="code-pro-bold-lc line-height-120 text-color-2 text-center text-lg-start font-size-170 font-size-sm-140 font-size-md-180 font-size-lg-140 font-size-xl-190 mb-3">Welcome to 8Fairwin8 Trading Corporation</p>
                    <p class="code-pro-lc text-center text-lg-start font-size-100 font-size-md-110 font-size-lg-90 font-size-xl-110 mb-3">We're a company dedicated to promoting health and wellness through our range of premium-quality products. Here, we believe that good health is the foundation for a happy and fulfilling life, and we are committed to empowering individuals to take control of their well-being and achieve their health goals.</p>
                    <p class="code-pro-lc text-center text-lg-start font-size-100 font-size-md-110 font-size-lg-90 font-size-xl-110 mb-3">Our products are carefully crafted using only the highest quality natural ingredients, sourced from around the world. From our innovative supplements and nutritional products to our indulgent beauty and personal care lines, our products are designed to support the body's natural systems and promote overall wellness.</p>
                    <p class="code-pro-lc text-center text-lg-start font-size-100 font-size-md-110 font-size-lg-90 font-size-xl-110 mb-0">But we are more than just a health and wellness company. At Fairwin, we are a community of like-minded individuals who share a passion for healthy living and a commitment to helping others. Our network of independent distributors is dedicated to sharing our products and our mission with others, and to helping individuals achieve financial independence through our proven business opportunity.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="background-image-cover w-100 py-5" style="background-image:url('{{ asset('img/background/background-5.png') }}')">
    <div class="container py-5">
        <div class="row justify-content-center align-items-stretch pt-5">
            <div class="col-md-6 mb-5 pb-5 pb-md-0 mb-md-0">
                <div class="card h-100" style="border-radius:30px">
                    <div class="card-body px-md-4 py-4">
                        <div class="d-flex justify-content-center align-items-center vision-mission-icon mb-4">
                            <div class="d-flex justify-content-center align-items-center bg-color-1" style="width:90px; height:90px; border-radius:50%; border:4px solid #104d22">
                                <div class="text-center text-color-2">
                                    <i class="fa-solid fa-leaf font-size-240"></i>
                                </div>
                            </div>
                        </div>

                        <div class="px-lg-4 px-xl-5">
                            <p class="aileron-bold text-center line-height-120 font-size-170 font-size-sm-180 font-size-md-190 font-size-lg-210 font-size-xl-200 mb-3">VISION</p>
                            <p class="code-pro-lc text-center font-size-100 font-size-sm-120 font-size-md-110 font-size-lg-120 mb-3 mb-xl-4">A strong and innovative Global enterprise, guided by the ethics of FAIRNESS and WIN-WIN principle, sharing hope and transforming lives for God’s glory.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100" style="border-radius:30px">
                    <div class="card-body px-md-4 py-4">
                        <div class="d-flex justify-content-center align-items-center vision-mission-icon mb-4">
                            <div class="d-flex justify-content-center align-items-center bg-color-2" style="width:90px; height:90px; border-radius:50%; border:4px solid #e3b504">
                                <div class="text-center text-color-1">
                                    <i class="fa-solid fa-leaf font-size-240"></i>
                                </div>
                            </div>
                        </div>

                        <div class="px-lg-4 px-xl-5">
                            <p class="aileron-bold text-center line-height-120 font-size-170 font-size-sm-180 font-size-md-190 font-size-lg-210 font-size-xl-200 mb-3">MISSION</p>
                            <p class="code-pro-lc text-center font-size-100 font-size-sm-120 font-size-md-110 font-size-lg-120 mb-3 mb-xl-4">To develop FAIR-WINNER Leaders and provide quality products, services and opportunities; uplifting Health, Wealth and a Joyful life, while ministering to the needs of others showing God’s love to everyone.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white w-100 py-5">
    <div class="container py-5">
        <p class="text-color-1 neuemontreal-bold line-height-110 font-size-200 font-size-sm-230 font-size-md-250 font-size-lg-300 font-size-xl-320 font-size-xxl-320 text-center mb-5 pb-2 pb-md-4">OUR CORPORATE<br>SOCIAL RESPONSIBILITY</p>

        <div class="row align-items-stretched mx-0">
            <div class="col-md-6 px-0 ideas-line-right">
                <div data-aos="fade-down" data-aos-delay="100" class="aos-init aos-animate">
                    <div class="card bg-color-2 border-0 mb-4 mb-md-5">
                        <div class="card-body px-4 ps-sm-5 ps-md-4 pe-md-5 px-xl-5 py-4 py-lg-5 position-relative">
                            <div class="text-color-1 font-size-230 font-size-sm-260 font-size-md-200 font-size-lg-250 font-size-xl-250 font-size-xxl-270 line-height-100 text-center position-absolute idea-number-right">01</div>

                            <div class="d-flex justify-content-start justify-content-md-end">
                                <div class="ps-5 ps-md-0 pe-md-3 ps-lg-0 pe-lg-4 px-xl-4 px-xxl-5 text-start text-md-end line-height-130 font-size-110 font-size-sm-130 font-size-md-100 font-size-lg-140 font-size-lg-140 font-size-xl-160">
                                    <p class="code-pro-bold-lc font-size-110 text-color-1 mb-2 mb-lg-3">Fair & Winning System</p>
                                    <p class="aileron-regular text-white mb-0">Fairwin system is designed to give fortune to everyone who is passionate about making a difference in their life. It gives bonuses, ranking incentives, profit shares and a lot of rebates to all fairwin members, resellers and network builders.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-down" data-aos-delay="200" class="aos-init aos-animate">
                    <div class="card bg-color-2 border-0 mb-4 mb-md-5 d-block d-md-none">
                        <div class="card-body px-4 ps-sm-5 ps-md-5 pe-md-4 pe-lg-0 px-xl-5 py-4 py-lg-5 position-relative">
                            <div class="text-color-1 font-size-230 font-size-sm-260 font-size-md-200 font-size-lg-250 font-size-xl-250 font-size-xxl-270 line-height-100 text-center position-absolute idea-number-left">02</div>

                            <div class="d-flex justify-content-start">
                                <div class="ps-5 ps-md-3 pe-0 ps-lg-4 px-xl-4 px-xxl-5 text-start line-height-130 font-size-110 font-size-sm-130 font-size-md-100 font-size-lg-140 font-size-xl-160">
                                    <p class="code-pro-bold-lc font-size-110 text-color-1 mb-3">Give Hope</p>
                                    <p class="aileron-regular text-white mb-0">Changes happen every day, and we see unfair treatment  of the society. The world is ruled by highly educated people and seems to have no opportunity for the common people. In fairwin, it doesn't matter what social status are you in. Fairwin is for everyone who wants to change their life and experience the life in the top.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-down" data-aos-delay="300" class="aos-init aos-animate">
                    <div class="card bg-color-2 border-0 mb-4 mb-md-5">
                        <div class="card-body px-4 ps-sm-5 ps-md-4 pe-md-5 px-xl-5 py-4 py-lg-5 position-relative">
                            <div class="text-color-1 font-size-230 font-size-sm-260 font-size-md-200 font-size-lg-250 font-size-xl-250 font-size-xxl-270 line-height-100 text-center position-absolute idea-number-right">03</div>

                            <div class="d-flex justify-content-start justify-content-md-end">
                                <div class="ps-5 ps-md-0 pe-md-3 ps-lg-0 pe-lg-4 px-xl-4 px-xxl-5 text-start text-md-end line-height-130 font-size-110 font-size-sm-130 font-size-md-100 font-size-lg-140 font-size-lg-140 font-size-xl-160">
                                    <p class="code-pro-bold-lc font-size-110 text-color-1 mb-3">Unique Ideas</p>
                                    <p class="aileron-regular text-white mb-0">Fairwin is a system generated ideas that helps every distributor to make their business manageable. You can work from home and send products without living your house or purchase products and encode new distributors using your phone and internet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-down" data-aos-delay="400" class="aos-init">
                    <div class="card bg-color-2 border-0 mb-0 d-block d-md-none">
                        <div class="card-body px-4 ps-sm-5 ps-md-5 pe-md-4 pe-lg-0 px-xl-5 py-4 py-lg-5 position-relative">
                            <div class="text-color-1 font-size-230 font-size-sm-260 font-size-md-200 font-size-lg-250 font-size-xl-250 font-size-xxl-270 line-height-100 text-center position-absolute idea-number-left">04</div>

                            <div class="d-flex justify-content-start">
                                <div class="ps-5 ps-md-3 pe-0 ps-lg-4 px-xl-4 px-xxl-5 text-start line-height-130 font-size-110 font-size-sm-130 font-size-md-100 font-size-lg-140 font-size-xl-160">
                                    <p class="code-pro-bold-lc font-size-110 text-color-1 mb-3">Energy</p>
                                    <p class="aileron-regular text-white mb-0">You may feel the energy and the passion of the leaders and the member of the board and accurate programs that assist the needs of the members. It will serve as a charging station when you can be motivated, trained and equipped of all the learnings and knowledge that you need to run your own business.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 px-0 ideas-line-left d-none d-md-block" style="border-left:3px solid #e3b504">
                <div data-aos="fade-down" data-aos-delay="200" class="aos-init aos-animate">
                    <div class="card bg-color-2 border-0 mb-4 mb-md-5 ideas-top-right-card">
                        <div class="card-body px-4 ps-sm-5 ps-md-5 pe-md-4 px-xl-5 py-4 py-lg-5 position-relative">
                            <div class="text-color-1 font-size-230 font-size-sm-260 font-size-md-200 font-size-lg-250 font-size-xl-250 font-size-xxl-270 line-height-100 text-center position-absolute idea-number-left">02</div>

                            <div class="d-flex justify-content-start">
                                <div class="ps-5 ps-md-3 pe-0 ps-lg-4 px-xl-4 px-xxl-5 text-start line-height-130 font-size-110 font-size-sm-130 font-size-md-100 font-size-lg-140 font-size-xl-160">
                                    <p class="code-pro-bold-lc font-size-110 text-color-1 mb-3">Give Hope</p>
                                    <p class="aileron-regular text-white mb-0">Changes happen every day, and we see unfair treatment  of the society. The world is ruled by highly educated people and seems to have no opportunity for the common people. In fairwin, it doesn't matter what social status are you in. Fairwin is for everyone who wants to change their life and experience the life in the top.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-down" data-aos-delay="400" class="aos-init">
                    <div class="card bg-color-2 border-0 mb-0">
                        <div class="card-body px-4 ps-sm-5 ps-md-5 pe-md-4 px-xl-5 py-4 py-lg-5 position-relative">
                            <div class="text-color-1 font-size-230 font-size-sm-260 font-size-md-200 font-size-lg-250 font-size-xl-250 font-size-xxl-270 line-height-100 text-center position-absolute idea-number-left">04</div>

                            <div class="d-flex justify-content-start">
                                <div class="ps-5 ps-md-3 pe-0 ps-lg-4 px-xl-4 px-xxl-5 text-start line-height-130 font-size-110 font-size-sm-130 font-size-md-100 font-size-lg-140 font-size-xl-160">
                                    <p class="code-pro-bold-lc font-size-110 text-color-1 mb-3">Energy</p>
                                    <p class="aileron-regular text-white mb-0">You may feel the energy and the passion of the leaders and the member of the board and accurate programs that assist the needs of the members. It will serve as a charging station when you can be motivated, trained and equipped of all the learnings and knowledge that you need to run your own business.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="background-image-cover w-100 py-5" style="background-image:url('{{ asset('img/awards/background.webp') }}')">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 col-lg-5 col-xl-4 mb-5 mb-md-0">
                <div class="row justify-content-center">
                    <div class="col-10 col-sm-8 col-md-12">
                        <img src="{{ asset('img/awards/award.webp') }}" class="w-100" style="border:2px solid #e3b504; border-radius:20px" alt="2023 People's Choice Excellence Awardee | 8Fairwin8 Trading Corporation" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="ps-md-3 ps-lg-5">
                    <p class="text-white code-pro-bold-lc line-height-110 font-size-200 font-size-sm-230 font-size-md-180 font-size-lg-240 font-size-xl-260 font-size-xxl-280 text-center text-md-start mb-4">2023 People's Choice Excellence Awardee</p>
                    <p class="text-white code-pro-lc text-center text-md-start font-size-110 font-size-sm-120 font-size-md-90 font-size-lg-110 font-size-xl-110 font-size-xxl-130 mb-3">8Fairwin8 Trading Corporation is proud to be selected as the OUTSTANDING BEAUTY / HEALTH & WELLNESS BUSINESS OPPORTUNITY COMPANY in the 41st People's Choice Excellence Awards held on MARCH 5, 2023 (SUNDAY), 6:00 PM at SOFITEL HOTEL & RESORTS, PHILIPPINE PLAZA MANILA.</p>
                    <p class="text-white code-pro-lc text-center text-md-start font-size-110 font-size-sm-120 font-size-md-90 font-size-lg-110 font-size-xl-110 font-size-xxl-130 mb-0">We would like to extend our sincere gratitude to all of our supporters for helping us achieve this great honor.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="background-image-cover w-100 py-5" style="background-image:url('{{ asset('img/background/background-2.png') }}')">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-xxl-9">
                <div class="card position-relative">
                    <div class="position-absolute mistrully font-size-300 font-size-md-350" style="top:-20px; right:50px">Grateful Notes</div>

                    <div class="card-body px-4 px-sm-5 py-5">
                        <div class="font-size-120">
                            <p class="code-pro-lc mt-4 mt-sm-0">Thank you Fairwin,</p>
                            <p class="code-pro-lc">Malaki ang naitulong ng mga products lalo na noong nakaranas kami ng pagtama ng COVID-19 sa aming family. Malaking tulong ang inhalation and steam kasama ang rub sa tuwing kami ay mahihirapang huminga.</p>
                            <p class="code-pro-lc mb-0">Sa kabuuan, lubos kong pinuri ang mga produkto dahil sa mga benepisyong aking nakamit. Mas pinabuti nito ang aking kalusugan at nagbigay sa akin ng panibagong lakas sa araw-araw. Nagpapasalamat ako sa mga produktong ito at sa kumpanya na nagbigay ng oportunidad upang matuklasan ko ito.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="overflow-hidden">
    <div class="w-100 products-carousel">
        <div class="item">
            <img src="{{ asset('img/products/product-1.webp') }}" class="w-100" alt="8Fairwin8 Trading Corporation" />
        </div>
        <div class="item">
            <img src="{{ asset('img/products/product-2.webp') }}" class="w-100" alt="8Fairwin8 Trading Corporation" />
        </div>
        <div class="item">
            <img src="{{ asset('img/products/product-3.webp') }}" class="w-100" alt="8Fairwin8 Trading Corporation" />
        </div>
        <div class="item">
            <img src="{{ asset('img/products/product-4.webp') }}" class="w-100" alt="8Fairwin8 Trading Corporation" />
        </div>
        <div class="item">
            <img src="{{ asset('img/products/product-5.webp') }}" class="w-100" alt="8Fairwin8 Trading Corporation" />
        </div>
        <div class="item">
            <img src="{{ asset('img/products/product-6.webp') }}" class="w-100" alt="8Fairwin8 Trading Corporation" />
        </div>
        <div class="item">
            <img src="{{ asset('img/products/product-7.webp') }}" class="w-100" alt="8Fairwin8 Trading Corporation" />
        </div>
        <div class="item">
            <img src="{{ asset('img/products/product-8.webp') }}" class="w-100" alt="8Fairwin8 Trading Corporation" />
        </div>
    </div>
</div>

<div class="background-image-cover py-5" style="background-image:url('{{ asset('img/background/background-4.png') }}')">
    <div class="container py-5">
        <p class="text-color-2 line-height-110 font-size-200 font-size-sm-230 font-size-md-250 font-size-lg-300 font-size-xl-320 font-size-xxl-320 text-center mb-5 pb-2 pb-md-4">HEAR IT FROM OUR CUSTOMERS</p>

        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5 px-3 px-lg-4 mb-4 mb-sm-5">
                <div class="video-container mb-4">
                    <iframe width="560" height="340" src="https://www.youtube.com/embed/E3eJ9Np5XIk" title="Testimonial of fairwin products by Ma&#39;am Precy" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>

                <p class="text-center text-color-2 font-size-130 font-size-sm-150 font-size-md-120 font-size-lg-150 font-size-xl-160 font-size-xxl-170 mb-0">Ms. Precy</p>
            </div>

            <div class="col-md-6 col-xl-5 px-3 px-lg-4 mb-4 mb-sm-5">
                <div class="video-container mb-4">
                    <iframe width="560" height="340" src="https://www.youtube.com/embed/qKelTFwZHa4" title="Fairwin Product testimonial of ma&#39;am Reina Sarsona" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>

                <p class="text-center text-color-2 font-size-130 font-size-sm-150 font-size-md-120 font-size-lg-150 font-size-xl-160 font-size-xxl-170 mb-0">Ms. Reina Sarsona</p>
            </div>

            <div class="col-md-6 col-xl-5 px-3 px-lg-4 mb-4 mb-sm-5">
                <div class="video-container mb-4">
                    <iframe width="560" height="340" src="https://www.youtube.com/embed/jN1i9TuRaqU" title="Fullwonder Coffee Testimonial" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>

                <p class="text-center text-color-2 font-size-130 font-size-sm-150 font-size-md-120 font-size-lg-150 font-size-xl-160 font-size-xxl-170 mb-0">Ms. Loremel Andulan</p>
                <p class="aileron-regular text-center text-color-2 font-size-sm-120 font-size-md-90 font-size-lg-110">Brgy. Sta Lucia, Dolores, Quezon</p>
            </div>

            <div class="col-md-6 col-xl-5 px-3 px-lg-4 mb-4 mb-sm-5">
                <div class="video-container mb-4">
                    <iframe width="560" height="340" src="https://www.youtube.com/embed/vmS3QSii5ZU" title="Kapeng masarap na, masarap pa sa pakiramdam" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>

                <p class="text-center text-color-2 font-size-130 font-size-sm-150 font-size-md-120 font-size-lg-150 font-size-xl-160 font-size-xxl-170 mb-0">Ms. Grayda Nino</p>
                <p class="aileron-regular text-center text-color-2 font-size-sm-120 font-size-md-90 font-size-lg-110">Brgy. Conception, San Pablo City, Laguna</p>
            </div>

            <div class="col-md-6 col-xl-5 px-3 px-lg-4">
                <div class="video-container mb-4">
                    <iframe width="560" height="340" src="https://www.youtube.com/embed/bUwAc5eTxhk" title="Fullwonder Coffee testimonial nakatulong makabuo?" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>

                <p class="text-center text-color-2 font-size-130 font-size-sm-150 font-size-md-120 font-size-lg-150 font-size-xl-160 font-size-xxl-170 mb-0">Ms. Rosalie Solano</p>
                <p class="aileron-regular text-center text-color-2 font-size-sm-120 font-size-md-90 font-size-lg-110">Brgy. Mojon Liliw, Laguna</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white pt-0 pt-md-5 pb-5">
    <div class="container pt-0 pt-md-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 col-xxl-8">
                <p class="text-center text-color-1 code-pro-bold-lc line-height-100 font-size-240 font-size-sm-260 font-size-md-300 font-size-lg-350 mb-3">Now for the questions</p>
                <p class="text-center text-color-2 aileron-bold line-height-130 font-size-130 font-size-sm-130 font-size-md-140 font-size-lg-150 font-size-xl-160 font-size-xxl-170 mb-5 pb-4">LET'S GET YOU THE ANSWERS</p>

                <div class="accordion" id="accordion-faq">
                    <div class="accordion-item" style="border:3px solid #000000; border-bottom:0">
                        <h2 class="accordion-header" id="heading-1">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">What kind of products do you offer?</span>
                            </button>
                        </h2>
                        <div id="collapse-1" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body font-size-110 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">We offer a range of health and wellness products including supplements, vitamins, personal care items, and skincare products, all made with natural and high-quality ingredients.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border:3px solid #000000; border-bottom:0">
                        <h2 class="accordion-header" id="heading-2">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">What are the benefits of your products?</span>
                            </button>
                        </h2>
                        <div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body code-pro-lc font-size-110 line-height-140 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">Our products are designed to support overall health and wellness, boost energy levels, promote healthy digestion, and improve skin and hair health, among other benefits.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border:3px solid #000000; border-bottom:0">
                        <h2 class="accordion-header" id="heading-3">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">How are your products different from those available in the market?</span>
                            </button>
                        </h2>
                        <div id="collapse-3" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body code-pro-lc font-size-110 line-height-140 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">Our products are formulated with natural ingredients and are free from harmful chemicals that are often found in other products. We also prioritize quality and effectiveness, and our products are backed by research and customer testimonials.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border:3px solid #000000; border-bottom:0">
                        <h2 class="accordion-header" id="heading-4">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">Are your products safe and free from harmful chemicals?</span>
                            </button>
                        </h2>
                        <div id="collapse-4" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body code-pro-lc font-size-110 line-height-140 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">Yes, our products are made with natural and safe ingredients, and are free from harmful chemicals such as parabens, sulfates, and phthalates.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border:3px solid #000000; border-bottom:0">
                        <h2 class="accordion-header" id="heading-5">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">How can I become a distributor for your company?</span>
                            </button>
                        </h2>
                        <div id="collapse-5" class="accordion-collapse collapse" aria-labelledby="heading-5" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body code-pro-lc font-size-110 line-height-140 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">You can visit our website and fill out the registration form to become a part of our team. Our team will then contact you and guide you through the process.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border:3px solid #000000; border-bottom:0">
                        <h2 class="accordion-header" id="heading-6">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-6" aria-expanded="false" aria-controls="collapse-6">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">What kind of training and support do you provide to your distributors?</span>
                            </button>
                        </h2>
                        <div id="collapse-6" class="accordion-collapse collapse" aria-labelledby="heading-6" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body code-pro-lc font-size-110 line-height-140 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">We provide extensive training and support to our distributors, including online resources, webinars, and one-on-one coaching. We also offer ongoing support to help our distributors grow their sales organizations and achieve their goals.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border:3px solid #000000; border-bottom:0">
                        <h2 class="accordion-header" id="heading-7">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-7" aria-expanded="false" aria-controls="collapse-7">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">How much can I earn as a distributor for your company?</span>
                            </button>
                        </h2>
                        <div id="collapse-7" class="accordion-collapse collapse" aria-labelledby="heading-7" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body code-pro-lc font-size-110 line-height-140 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">The earnings potential for our distributors is unlimited and depends on their dedication and effort. We offer a generous compensation plan that rewards distributors for their sales and the sales of their team members.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border:3px solid #000000; border-bottom:0">
                        <h2 class="accordion-header" id="heading-8">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-8" aria-expanded="false" aria-controls="collapse-8">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">Is there any investment required to become a distributor?</span>
                            </button>
                        </h2>
                        <div id="collapse-8" class="accordion-collapse collapse" aria-labelledby="heading-8" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body code-pro-lc font-size-110 line-height-140 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">Yes, there is a small investment required to become a distributor, which covers the cost of the starter kit and training materials. However, the investment is relatively low compared to other business opportunities.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border:3px solid #000000; border-bottom:0">
                        <h2 class="accordion-header" id="heading-9">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-9" aria-expanded="false" aria-controls="collapse-9">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">How long does it take to see results from using your products?</span>
                            </button>
                        </h2>
                        <div id="collapse-9" class="accordion-collapse collapse" aria-labelledby="heading-9" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body code-pro-lc font-size-110 line-height-140 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">The results from using our products vary depending on the individual and the product being used. However, many of our customers have reported seeing positive results within a few weeks of using our products.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border:3px solid #000000; border-bottom:0">
                        <h2 class="accordion-header" id="heading-10">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-10" aria-expanded="false" aria-controls="collapse-10">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">Can your products be used in combination with other medications?</span>
                            </button>
                        </h2>
                        <div id="collapse-10" class="accordion-collapse collapse" aria-labelledby="heading-10" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body code-pro-lc font-size-110 line-height-140 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">It is always recommended to consult with a healthcare professional before using our products in combination with other medications.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" style="border:3px solid #000000">
                        <h2 class="accordion-header" id="heading-11">
                            <button class="accordion-button collapsed px-4 px-md-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-11" aria-expanded="false" aria-controls="collapse-11">
                                <span class="aileron-regular font-size-120 font-size-md-130 font-size-lg-150 font-size-xl-160 pe-3">Do you have any customer support service in case of any queries or issues with the product?</span>
                            </button>
                        </h2>
                        <div id="collapse-11" class="accordion-collapse collapse" aria-labelledby="heading-11" data-bs-parent="#accordion-faq" style="border-top:3px solid #000000">
                            <div class="accordion-body code-pro-lc font-size-110 line-height-140 px-4 px-md-5 py-4">
                                <p class="code-pro-lc line-height-140 mb-0">Yes, we have a dedicated customer support team that is available to answer any queries or address any issues related to our products.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-color-2 py-5">
    <div class="container py-5">
        <p class="text-color-1 line-height-110 font-size-200 font-size-sm-230 font-size-md-250 font-size-lg-300 font-size-xl-320 font-size-xxl-320 text-center mb-5 pb-2 pb-md-4">CHECK OUT OUR WAYS TO EARN</p>

        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-10">
                <video class="w-100" controls>
                    <source src="{{ asset('videos/complan.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>

<div class="bg-color-1 w-100">
    <div class="d-flex align-items-center flex-fill py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-xl-11 col-xxl-10">
                    <p class="neuemontreal-bold text-center line-height-100 font-size-180 font-size-sm-300 font-size-md-350 font-size-lg-380 font-size-xl-420 font-size-xxl-450 mb-5 pb-lg-2 letter">Join us and discover the transformative power of health and wellness.</p>
                    <p class="aileron-regular text-center line-height-140 font-size-140 font-size-sm-140 font-size-md-150 font-size-lg-160 font-size-xl-170 font-size-xxl-170 px-4 px-sm-0 mb-5 pb-3">Together, we can create a world where everyone has the opportunity to live their best, healthiest life.</p>

                    <div class="text-center">
                        <button class="btn btn-custom-2 font-size-xl-120 py-3 px-5">
                            <span class="aileron-bold px-4 px-sm-5">REGISTER NOW</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-color-2 pt-5 pb-0 pb-lg-5 overflow-hidden" id="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-4 order-0 px-sm-5 px-md-0 mb-5 mb-md-0">
                <div class="px-4 px-sm-5 pe-md-5 pe-lg-4">
                    <img src="{{ asset('img/logo/fairwin-white-2.webp') }}" class="w-100" alt="8Fairwin8 Trading Corporation">
                </div>
            </div>

            <div class="col-12 col-lg-4 order-2 order-lg-1 pt-4 pt-lg-0 mt-4 mb-5 my-lg-0">
                <p class="code-pro-bold-lc text-color-1 text-center text-lg-start font-size-sm-140 font-size-md-100 font-size-lg-90 font-size-xl-110 font-size-xxl-130 font-weight-700 mb-2">WHERE TO FIND US</p>
                <p class="code-pro-lc text-white text-center text-lg-start font-size-sm-140 font-size-md-100 font-size-lg-90 font-size-xl-110 font-size-xxl-130 line-height-110 mb-3">V-A #35 Makokak Street Corner A. Mabini Street, San Pablo City, Laguna, Philippines</p>

                <p class="code-pro-bold-lc text-color-1 text-center text-lg-start font-size-sm-140 font-size-md-100 font-size-lg-90 font-size-xl-110 font-size-xxl-130 font-weight-700 mb-2">CONTACT US</p>
                <a href="tel:+639176701822" target="_blank" class="d-flex justify-content-center justify-content-lg-start align-items-center link-color-1 text-decoration-none mb-2">
                    <div>
                        <i class="fa-solid fa-circle-phone text-color-1 font-size-160"></i>
                    </div>
                    <div class="ps-3 ps-sm-4 ps-lg-3 ps-xl-4">
                        <p class="code-pro-lc font-size-sm-140 font-size-md-100 font-size-lg-90 font-size-xl-110 font-size-xxl-130 line-height-110 mb-0">(+63) 917 670 1822</p>
                    </div>
                </a>
                <a href="mailto:8fairwintradingcorp8@gmail.com" target="_blank" class="d-flex justify-content-center justify-content-lg-start align-items-center link-color-1 text-decoration-none mb-3">
                    <div>
                        <i class="fa-solid fa-circle-envelope text-color-1 font-size-160"></i>
                    </div>
                    <div class="ps-3 ps-sm-4 ps-lg-3 ps-xl-4">
                        <p class="code-pro-lc font-size-sm-140 font-size-md-100 font-size-lg-90 font-size-xl-110 font-size-xxl-130 line-height-110 mb-0">8fairwintradingcorp8@gmail.com</p>
                    </div>
                </a>

                <p class="code-pro-bold-lc text-color-1 text-center text-lg-start font-size-sm-140 font-size-md-100 font-size-lg-90 font-size-xl-110 font-size-xxl-130 font-weight-700 mb-2">CONNECT WITH US</p>
                <a href="https://facebook.com/8fairwin8family" target="_blank" class="d-flex justify-content-center justify-content-lg-start align-items-center link-color-1 text-decoration-none mb-2">
                    <div>
                        <i class="fa-brands fa-facebook text-color-1 font-size-160"></i>
                    </div>
                    <div class="ps-3 ps-sm-4 ps-lg-3 ps-xl-4">
                        <p class="code-pro-lc font-size-sm-140 font-size-md-100 font-size-lg-90 font-size-xl-110 font-size-xxl-130 line-height-110 mb-0">facebook.com/8fairwin8family</p>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-4 order-1 order-lg-2">
                <div class="pt-5 pb-3 px-lg-4" id="map" style="position: relative; overflow: hidden;"><div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);"><div class="gm-err-container"><div class="gm-err-content"><div class="gm-err-icon"><img src="https://maps.gstatic.com/mapfiles/api-3/images/icon_error.png" alt="" draggable="false" style="user-select: none;"></div><div class="gm-err-title">Oops! Something went wrong.</div><div class="gm-err-message">This page didn't load Google Maps correctly. See the JavaScript console for technical details.</div></div></div></div></div>
            </div>
        </div>
    </div>
</div>
@endsection
