@extends('layouts.front')
@section('title','الصيلايات')
@section('content')
	<body class="homepage">
		<!-- Adoption -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>الصيدليات</span></h3>
				</div>
			</div>
			<div class="row adoption">
			@isset($pharmacys)
                @foreach($pharmacys as $pharmacy)
				<div class="col-md-4">
			    	@foreach(json_decode($pharmacy->filename) as $file)
					   @if ($loop->first)
					   <a href="{{route('singleGuide',[$pharmacy->id, '3'])}}" title="">
					    <img src="{{asset('assets/' . $file)}}" alt="{{$pharmacy->name}}" />  
					   </a>
					   @endif                         
					@endforeach
					<div class="title">
						<h5>
							<span data-hover="{{$pharmacy->name}}">{{$pharmacy->name}}</span>
						</h5>
					</div>
				</div>
				@endforeach
				{{$pharmacys->links()}}
             @endisset
		   	 @if(!count($pharmacys)) 
			 <div class="alert alert-danger no-info" role="alert">
                 لا توجد بيانات حاليا !
             </div>
			 @endif
			</div>
		</div>
		<!-- Adoption end -->
@endsection