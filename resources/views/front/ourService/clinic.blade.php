@extends('layouts.front')
@section('title','العيادات')
@section('content')
<style>
.adoption div a, .adoption div a img {
    width: 355px;
}    


</style>
	<body class="homepage">
		<!-- Adoption -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>العيادات</span></h3>
				</div>
			</div>
			<div class="row adoption">
			@isset($clinics)
                @foreach($clinics as $clinic)
				<div class="col-md-4">
			    	@foreach(json_decode($clinic->filename) as $file)
					   @if ($loop->first)
					   <a href="{{route('singleGuide',[$clinic->id, '2'])}}" title="">
					    <img src="{{asset('assets/' . $file)}}" alt="{{$clinic->name}}" />  
					   </a>
					   @endif                         
					@endforeach
					<div class="title">
						<h5>
							<span data-hover="{{$clinic->name}}">{{$clinic->name}}</span>
						</h5>
					</div>
				</div>
				@endforeach
				{{$clinics->links()}}
             @endisset
			 @if(!count($clinics))
			 <div class="alert alert-danger no-info" role="alert">
                 لا توجد بيانات حاليا !
             </div>
			 @endif
			</div>
		</div>
		<!-- Adoption end -->
@endsection