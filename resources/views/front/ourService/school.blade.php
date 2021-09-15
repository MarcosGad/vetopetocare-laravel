@extends('layouts.front')
@section('title','المدارس')
@section('content')
	<body class="homepage">
		<!-- Adoption -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>المدارس</span></h3>
				</div>
			</div>
			<div class="row adoption">
			@isset($schools)
                @foreach($schools as $school)
				<div class="col-md-4">
			    	@foreach(json_decode($school->filename) as $file)
					   @if ($loop->first)
					   <a href="{{route('singleGuide',[$school->id, '6'])}}" title="">
					    <img src="{{asset('assets/' . $file)}}" alt="{{$school->name}}" />  
					   </a>
					   @endif                         
					@endforeach
					<div class="title">
						<h5>
							<span data-hover="{{$school->name}}">{{$school->name}}</span>
						</h5>
					</div>
				</div>
				@endforeach
				{{$schools->links()}}
             @endisset
		   	 @if(!count($schools)) 
			 <div class="alert alert-danger no-info" role="alert">
                 لا توجد بيانات حاليا !
             </div>
			 @endif
			</div>
		</div>
		<!-- Adoption end -->
@endsection