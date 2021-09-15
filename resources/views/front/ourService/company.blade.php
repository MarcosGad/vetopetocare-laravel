@extends('layouts.front')
@section('title','الشركات')
@section('content')
	<body class="homepage">
		<!-- Adoption -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>الشركات</span></h3>
				</div>
			</div>
			<div class="row adoption">
			@isset($companys)
                @foreach($companys as $company)
				<div class="col-md-4">
			    	@foreach(json_decode($company->filename) as $file)
					   @if ($loop->first)
					   <a href="{{route('singleGuide',[$company->id, '5'])}}" title="">
					    <img src="{{asset('assets/' . $file)}}" alt="{{$company->name}}" />  
					   </a>
					   @endif                         
					@endforeach
					<div class="title">
						<h5>
							<span data-hover="{{$company->name}}">{{$company->name}}</span>
						</h5>
					</div>
				</div>
				@endforeach
				{{$companys->links()}}
             @endisset
             @if(!count($companys))
			 <div class="alert alert-danger no-info" role="alert">
                 لا توجد بيانات حاليا !
             </div>
			 @endif
				
			</div>
		</div>
		<!-- Adoption end -->
@endsection