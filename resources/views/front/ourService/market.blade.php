@extends('layouts.front')
@section('title','المحال التجارية')
@section('content')
	<body class="homepage">
		<!-- Adoption -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>المحلات التجارية</span></h3>
				</div>
			</div>
			<div class="row adoption">
			@isset($markets)
                @foreach($markets as $market)
				<div class="col-md-4">
			    	@foreach(json_decode($market->filename) as $file)
					   @if ($loop->first)
					   <a href="{{route('singleGuide',[$market->id, '4'])}}" title="">
					    <img src="{{asset('assets/' . $file)}}" alt="{{$market->name}}" />  
					   </a>
					   @endif                         
					@endforeach
					<div class="title">
						<h5>
							<span data-hover="{{$market->name}}">{{$market->name}}</span>
						</h5>
					</div>
				</div>
				@endforeach
				{{$markets->links()}}
             @endisset
			 @if(!count($markets)) 
			 <div class="alert alert-danger no-info" role="alert">
                 لا توجد بيانات حاليا !
             </div>
			 @endif
			</div>
		</div>
		<!-- Adoption end -->
@endsection