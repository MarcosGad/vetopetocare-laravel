@extends('layouts.front')
@section('title','الصفحة الرئيسية')
@section('content')
	<body class="homepage">
		<!-- Slider -->
		@isset($slides)
		<div id="home_carousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
			@foreach($slides as $index => $slide)
				<li data-target="#home_carousel" data-slide-to="{{$index}}" @if($index == 0) class="active" @endif></li>
			@endforeach
			</ol>
			
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
		     	@foreach($slides as $index => $slide)
				<div class="item @if($index == 0) active @endif">
					<img src="{{$slide->filename}}" alt="" />
					<div class="carousel-caption">
						<h2>{{$slide->headr}}</h2>
					    <p>{{$slide->paragraph}}</p>
						@if(!empty($slide->button_name))
					    <form method="get" action="{{$slide->button_url}}">
					    	<button type="submit" class="btn btn-lg btn-default">{{$slide->button_name}}</button>
					    </form>
						@endif
					</div>
				</div>
				@endforeach
			</div>
			
			<!-- Controls -->
			<a class="left carousel-control" href="#home_carousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#home_carousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
		@endisset
		<!-- Slider end -->
		
		<div class="row-boxs">
            <div class="col-boxs">
                	    <a href="{{ route('clinic') }}">
                <i class="fas fa-clinic-medical boxs-i"></i>
                <h3 style="margin-top: 6px;">العيادات</h3>
                 </a>
            </div>
            <div class="col-boxs">
                	    <a href="{{ route('pharmacy') }}">
                <i class="fas fa-mortar-pestle boxs-i"></i>
                <h3 style="margin-top: 6px;">الصيدليات</h3>
                 </a>
            </div>
            <div class="col-boxs">
                	    <a href="{{ route('market') }}">
                <i class="fas fa-shopping-cart boxs-i"></i>
                <h3 style="margin-top: 6px;">المحلات التجارية</h3>
                 </a>
            </div>
            <div class="col-boxs">
                	    <a href="{{ route('company') }}">
                <i class="fas fa-building boxs-i"></i>
                <h3 style="margin-top: 6px;">الشركات</h3>
                 </a>
            </div>
            <div class="col-boxs">
                	    <a href="{{ route('school') }}">
                <i class="fas fa-school boxs-i"></i>
                <h3 style="margin-top: 6px;">المدارس</h3>
                 </a>
            </div>
        </div>

		<!-- Services -->
		<div class="container">
			<div class="row">
			
				
				<div class="col-md-4 col3">
					<a  title="تربية الكلاب" class="roundal" id="adoption"></a>
					<h3>تربية الكلاب</h3>
					<p>يمكن تربية الكلاب من خلال توفير اللوازم الأساسية الضرورية، بما في ذلك طوق الرقبة الذي يحدد هوية الكلب، وأوعية الطعام والماء، وألعاب للمضغ، كما يجب توفير مكان مخصص للنوم.</p>
					
				</div>
				<div class="col-md-4 col3">
					<a href="" title="كلب يمشي" class="roundal" id="walking"></a>
					<h3>كلب يمشي</h3>
					<p>إنّ اقتناء كلب في المنزل قد يُشجّع صاحبه على مُمارسة الرّياضة والحركة، إذ إنّه من المعروف بأنّ الكلاب تُحبّ الجري وهذا مُفيد جيّد للصحّة. كما أنّ الكلب رفيق جيّد في مُمارسة الرّياضة سواء كانت الجري أم ركوب الدرّاجات.</p>
					
				</div>
			
				<div class="col-md-4 col3">
					<a href="" title="اللعب الكلاب" class="roundal" id="play"></a>
					<h3>اللعب الكلاب</h3>
					<p>الكلاب حيوانات جميلة تُجيد تسلية صاحبها، فهي تُضفي جواً من المرح والمُتعة التي تعود بالسّعادة على الشّخص من خلال تدريبه على حركات مُعيّنة واللّعب معاً.</p>
					
				</div>
			</div>
	
		</div>
		<!-- Services end -->

		<!-- Testimonials -->
		<div class="testimonials" data-stellar-background-ratio="0.6">
			<div class="container">
				<div class="row">
					<div class="col-md-12 centered">
						<!-- Slider -->
						<div id="home_testimonial" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
							<ol class="carousel-indicators">
						    	@foreach($testimonials as $index => $testimonial)
								<li data-target="#home_testimonial" data-slide-to="{{$index}}" @if($index == 0) class="active" @endif></li>
								@endforeach
							</ol>
							
							<!-- Wrapper for slides -->
							<div class="carousel-inner">
						    	@foreach($testimonials as $index => $testimonial)
								<div class="item @if($index == 0) active @endif">
									<p>{{$testimonial->paragraph}}</p>
								</div>
								@endforeach
							</div>
						</div>
						<!-- Slider end -->

					</div>
				</div>
			</div>
		</div>
		<!-- Testimonials end -->
		<!-- Adoption -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>اعثر على رفيقك المثالي</span></h3>
				</div>
			</div>
			<div class="row adoption">
			@isset($dogs)
                @foreach($dogs as $dog)
				<div class="col-xs-6 col-sm-4 col-md-3">
			    	@foreach(json_decode($dog->filename) as $file)
					   @if ($loop->first)
					   <a href="{{route('single',$dog->id)}}" title="">
					    <img src="{{asset('assets/' . $file)}}" alt="{{$dog->strain}}" />  
					   </a>
					   @endif                         
					@endforeach
					<div class="title">
						<h5>
						@if($dog->purpose == 'مستلزمات')
						<span data-hover="{{$dog->address}}">{{$dog->address}}</span>
						@else
						<span data-hover="{{$dog->strain}}">{{$dog->strain}}</span>
						@endif  
						</h5>
					</div>
				</div>
				@endforeach
             @endisset
			</div>
		</div>
		<!-- Adoption end -->
@endsection