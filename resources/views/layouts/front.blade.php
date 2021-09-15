<!DOCTYPE html>
<html dir="rtl">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title','Unknown Page')</title>
	    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/admin/images/ico/favicon.ico')}}">
	<link href="{{asset('assets/front/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/front/css/style.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=El+Messiri:400,500,600,700&amp;subset=arabic,cyrillic" rel="stylesheet">
	<link href="{{asset('assets/front/css/customStyle.css')}}" rel="stylesheet">
	<!-- fontawesome-free-5.14.0 -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/all.min.css')}}">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!--[if IE 8]><link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/ie8.css')}}" /><![endif]-->
	</head>
	<!-- Navigation -->
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="{{ route('home') }}">
						<img src="{{asset('assets/images/logo.png')}}">
					</a></h1>
				</div>	
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="{{ (request()->is('/')) ? 'active' : '' }}">
							<a href="{{ route('home') }}" title="الصفحة الرئيسية"><span data-hover=" الرئيسية">الرئيسية</span></a>
						</li>
						<li class="{{ Request::segment(1) === 'allPets' ? 'active' : null }}">
							<a href="{{ route('allPets') }}" title="معرض فيتو بيتو"><span data-hover="معرض فيتو بيتو"> معرض فيتو بيتو</span></a> 
						</li>
						
						@if (!Auth::guest() && auth()->user()->active == 1)
						<li class="dropdown">
							<a href="" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="أضافة أعلان">أضافة أعلان</span> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="{{ route('add') }}" title="أضافة حيوان">أضافة حيوان</a>
								</li>
								<li>
									<a href="{{ route('accessories') }}" title="أضافة مستلزم">أضافة مستلزم</a>
								</li>
							</ul>
						</li>
						@endif
						<li class="dropdown">
							<a href="" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="خدماتنا">خدماتنا</span> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="{{ route('clinic') }}" title="العيادات">العيادات</a>
								</li>
								<li>
									<a href="{{ route('pharmacy') }}" title="الصيدليات">الصيدليات</a>
								</li>
								<li>
									<a href="{{ route('market') }}" title="المحلات التجارية">المحلات التجارية</a>
								</li>
								<li>
									<a href="{{ route('company') }}" title="الشركات "> الشركات</a>
								</li>
								<li>
									<a href="{{ route('school') }}" title="المدارس "> المدارس</a>
								</li>
							</ul>
						</li>

						@if (!Auth::guest() && auth()->user()->active == 1)
						<li class="{{ Request::segment(1) === 'getWishlist' ? 'active' : null }}">
							<a href="{{ route('getWishlist') }}" title="القائمة المفضلة"><span data-hover=" القائمة المفضلة">القائمة المفضلة </span></a> 
						</li>
						<li class="{{ Request::segment(1) === 'displayed' ? 'active' : null }}">
							<a href="{{ route('displayed') }}" title="حالة الطلبات"><span data-hover=" حالة الطلبات">حالة الطلبات </span></a> 
						</li>
						@if (auth()->user()->type != 1)
						<li class="{{ Request::segment(1) === 'addGuides' ? 'active' : null }}">
							<a href="{{ route('addGuides') }}" title="اضاف دليلك"><span data-hover="اضاف دليلك"> اضاف دليلك</span></a> 
						</li>
						@endif
						@if (auth()->user()->type == 1)
						<li class="{{ Request::segment(1) === 'reqUser' ? 'active' : null }}">
							<a href="{{ route('reqUser') }}" title="انضم الينا"><span data-hover=" انضم الينا">  انضم الينا</span></a> 
						</li>
						@endif
						@endif
						
						<li class="{{ Request::segment(1) === 'about' ? 'active' : null }}">
							<a href="{{ route('about') }}" title="عن الشركة"><span data-hover="عن الشركة "> عن الشركة</span></a> 
						</li>
						<li class="{{ Request::segment(1) === 'contact' ? 'active' : null }}">
							<a href="{{ route('contact') }}" title="اتصل بنا"><span data-hover="اتصل بنا  "> اتصل بنا </span></a> 
						</li>
						<li class="purchase-btn">
                            @if (!Auth::guest())
                            <button type="submit" class="btn btn-default">
                                <a class="" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                تسجيل الخروج
                                </a> 
							</button>
							<button type="submit" class="btn btn-default"><a href="{{ route('profile') }}">بياناتك</a></button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            </form>
                            @else
							<li><button type="submit" class="btn btn-default"><a href="{{ route('sign-up') }}">التسجيل</a></button></li>
							<li><button type="submit" class="btn btn-default"><a href="{{ route('login') }}">تسجيل الدخول</a></button></li>
                            @endif
						</li>
					</ul>
				</div>
			</div>
		</div>
    <!-- Navigation end -->
    
	@yield('content')
	
		<!-- Purchase -->
		<div class="purchase">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-md-9">
						<p><strong>فيتو بيتو كاير</strong> نحن نسعد للرد على اسئلة جميع عملائنا و استفسارتكم<br />
						</p>
					</div>
					<div class="col-sm-4 col-md-3 purchase-button">
						<form method="get" action="{{ route('contact') }}">
							<button type="submit" class="btn btn-default btn-green">اتصل بنا</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Purchase end -->

    <!-- Footer -->
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<h6>عن الشركة</h6>
						<p><strong>هو عالم متكامل لخدمة ومساعدة  مربي الحيوانات, بالتعاون مع كيان طبي ضخم علي أعلي مستوي من الخبره لضمان الامان والسهولة والراحة .</strong></p>
						
					</div>
					<!--<div class="col-md-3 blog">
						<h6>Freshly blogged</h6>
						<p class="title"><a href="#" title="">Eodem modo typi, qui nunc nobis</a></p>
						<p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram.</p>
						<p><a href="#" title="">Read this post&hellip;</a></p>
					</div>-->
					<div class="col-md-4">
						<h6>خدماتنا</h6>
						<ul>
							<li><a href="{{ route('home') }}" title="">الرئيسية</a></li>
							<li><a href="{{ route('allPets') }}" title="">معرض  فيتو بيتو</a></li>
							<li><a href="{{ route('contact') }}" title="">اتصل بنا</a></li>
						</ul>
					</div>
					<div class="col-md-4 contact-info">
						<h6>تواصل معانا</h6>
						
						<p class="social">
							<a href="#" class="facebook"></a> <a href="#" class="pinterest"></a> <a href="#" class="twitter"></a>
						</p>
						<p class="c-details">
							<span>البريد الألكترونى</span> <a href="mailto:info@vetopetocare.com" title="">info@vetopetocare.com</a><br >
							
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 copyright">
						<p>&copy; Copyright 2020. All rights reserved. <a href="https://www.justworkmedia.com/" title="JustWorkMedia">JustWorkMedia</a></p>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer end -->
		
		<!-- Javascript plugins -->
		<script src="https://code.jquery.com/jquery.js"></script>
		@yield('profile')
		<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/front/js/carouFredSel.js')}}"></script>
		<script src="{{asset('assets/front/js/jquery.stellar.min.js')}}"></script>
		<script src="{{asset('assets/front/js/ekkoLightbox.js')}}"></script>
		<script src="{{asset('assets/front/js/custom.js')}}"></script>

		<!-- fontawesome-free-5.14.0 -->
        <script src="{{asset('assets/admin/js/all.min.js')}}" type="text/javascript"></script>
	</body>
</html>