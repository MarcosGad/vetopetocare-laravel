@extends('layouts.front')
@section('title','القائمة المفضلة')
@section('content')
@if (!Auth::guest() && auth()->user()->active == 1)
    		<!-- Adoption -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>القائمة المفضلة</span></h3>
				</div>
			</div>
			<div class="row adoption">
			@isset($dogs)
                @foreach($dogs as $dog)
				<div class="col-xs-6 col-sm-4 col-md-3">
			    	@foreach(json_decode($dog->filename) as $file)
					   @if ($loop->first)
					   <a href="{{route('single',$dog->id)}}" title="">
					    <img src="{{asset('assets/' . $file)}}" alt="{{$dog->type}}" />  
					   </a>
					   @endif                         
					@endforeach
					<div class="title">
						<h5>
							<span data-hover="{{$dog->type}}">{{$dog->type}}</span>
						</h5>
                        <h5 class="trash-wishlist">
                            <a href="{{route('getWishlist.delete',$dog->id)}}" onclick="return confirm('هل انت متاكد')">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </h5>
					</div>
				</div>
                
				@endforeach
             @endisset
			</div>
		</div>
		<!-- Adoption end -->
@else
<h1>Not Active</h1>
@endif
@endsection