@extends('layouts.front')
@section('title','الحيوانات')
@section('content')
<style>
.btn-hover-active{
	background-color: #6bc37d !important;
    border-color: #6bc37d !important;
}
#country_list{
    position: absolute;
    width: 100%;
    left: 28px;
    margin-top: -12px;
    z-index: 55555;
}
</style>
	<body class="homepage">
		<div class="container">
				<div class="col-md-12 centered">
					<h3><span>اعثر على رفيقك المثالي</span></h3>
				</div>
				
		<div class="container search" style="margin-top: 50px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="text" name="country" id="country" placeholder="ابحث عن السلالة" class="form-control">
                    </div>
                    <div id="country_list"></div>                    
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>

			<p id="filterBtnAll" class="btn btn-primary btn-hover-active">الكل</p>
			@foreach($dogs as $index => $dog)
			<p id="{{$index}}" class="filter-btn btn btn-primary">{{$dog->purpose}}</p>
			@endforeach
			
			
			<div class="wrapper-btn-add">
			  <a href="{{ route('add') }}">
              <button class="circle">
                <img id="addSign" src="https://ssl.gstatic.com/bt/C3341AA7A1A076756462EE2E5CD71C11/2x/btw_ic_speeddial_white_24dp_2x.png" alt="" />
              </button>
              </a>
            </div>
                   
			<div id="dogList"></div>

			</div>
		</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$('.btn').click(function(){
       $('.btn-hover-active').removeClass('btn-hover-active');
       $(this).addClass('btn-hover-active');
    });
    
    $(document).on('click', '.homepage .pagination a', function(event){
       event.preventDefault(); 
       var page = $(this).attr('href').split('page=')[1];
       showAllDogs(page);
    })
    
    $(document).on('click', '.filter .pagination a', function(event){
       event.preventDefault(); 
       var page = $(this).attr('href').split('page=')[1];
       showFilterDogs(page);
    });

	showAllDogs();
	function showAllDogs(page){
		$('#dogList').html('<img style="margin: auto;display: block;" src="{{asset('assets/images/logo.png')}}">'); 
        $.ajax({
            url:"/allDogs?page="+page,
            success: function(data){
                $('#dogList').html(data); 
            },
        });
    }

	$('#filterBtnAll').click(function(){
	    $(".filter").addClass("homepage");
	    $(".homepage").removeClass("filter");
		showAllDogs();
	});
    
	$('.filter-btn').click(function(){
	    $(".homepage").addClass("filter");
	    $(".filter").removeClass("homepage");
		$('#dogList').html('<img style="margin: auto;display: block;" src="{{asset('assets/images/logo.png')}}">');
	   var ty =  $(this).text();
	   $.ajax({
        url: '/filterDogs/'+ty,
        success: function(data){
			$('#dogList').html(data); 
        },
        });
    });
    
    function showFilterDogs(page){
	   $('#dogList').html('<img style="margin: auto;display: block;" src="{{asset('assets/images/logo.png')}}">');
	   var ty = $('.btn-hover-active').text();
	   console.log(ty);
	   $.ajax({
        url:"/filterDogs/"+ty+"?page="+page,
        success: function(data){
		  $('#dogList').html(data); 
        },
       });
    }
    
    $('#country').on('keyup',function() {
        var query = $(this).val(); 
        $.ajax({
            url:"{{ route('search') }}",
            type:"GET",
            data:{'country':query},
                success:function (data) {
                   $('#country_list').html(data);
                }
            })
    });
    
   $(".search").hover(
           function()
           { 
            var query = $('#country').val(); 
            if(query == ''){
                var query = 'null';
            }
            $.ajax({
            url:"{{ route('search') }}",
            type:"GET",
            data:{'country':query},
                success:function (data) {
                   $('#country_list').html(data);
                }
            })
           },
           function() 
           { 
              $('#country_list').html("");
           }
    );

    

    // $(document).on('click', 'li', function(){
    //     var value = $(this).text();
    //     $('#country').val(value);
    //     $('#country_list').html("");
    // });               
                

});
  
</script>
@endsection