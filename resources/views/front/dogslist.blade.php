           <style>
               .pagination{
                  float: left;
                  width: 100%;
                  margin: 0;
               }
           </style>
           <div class="row adoption">
			@isset($dogs)
			{{$dogs->links()}}
                @foreach($dogs as $dog)
				<div class="col-xs-6 col-sm-4 col-md-3">
			    	@foreach(json_decode($dog->filename) as $file)
					   @if ($loop->first)
					   <a href="{{route('single',$dog->id)}}" title="">
					    <img src="{{asset('assets/' . $file)}}" alt="{{$dog->n_strain}}" />  
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