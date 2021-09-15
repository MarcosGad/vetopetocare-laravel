@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الحيوانات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> الحيوانات
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع الحيوانات</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal" style="margin-right: 21px;">
                                            <thead>
                                            <tr>
                                                <th>النوع</th>
                                                <th>الهدف</th>
                                                <th>اسم المستلزم / عنوان الحيوان</th>
                                                <th>الوصف</th>
                                                <th>اللون</th>
                                                <th>السلالة</th>
                                                <th>نقاء السلالة</th>
                                                <th>علامة مميزة</th>
                                                <th>العمر</th>
                                                <th>السعر</th>
                                                <th>رقم الرخصة</th>
                                                <th>الجنس</th>
                                                <th>الصور</th>
                                                <th>الملاحضات</th>
                                                <th>البريد الالكترونى</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @isset($dogs)
                                                @foreach($dogs as $dog)
                                                    <tr>
                                                    <td>{{$dog->type}}</td>
                                                    <td>{{$dog->purpose}}</td>
                                                    <td>{{$dog->address}}</td>
                                                    <td>{{$dog->description}}</td>
                                                    <td>{{$dog->color}}</td>
                                                    <td>{{$dog->strain}}</td>
                                                    <td>{{$dog->n_strain}}</td>
                                                    <td>{{$dog->pecial_marque}}</td>
                                                    <td>{{$dog->currency}}</td>
                                                    <td>{{$dog->price}}</td>
                                                    <td>{{$dog->license}}</td>
                                                    <td>{{$dog->sex}}</td>
                                                    <td>
                                                    @foreach(json_decode($dog->filename) as $file)
                                                        <img style="width: 150px; height: 100px;" src="{{asset('assets/' . $file)}}">
                                                    @endforeach
                                                    </td>
                                                    <td>{{$dog->notes}}</td>
                                                    <td>
                                                    @if($dog->user_id == 0) مسؤال الموقع @endif
                                                    @foreach($users as $user)
                                                        @if($user->id == $dog->user_id)
                                                          {{$user->name}}
                                                        @endif
                                                    @endforeach
                                                    </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">

                                                                <a href="{{route('admin.dogs.delete',$dog -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

                                                                   <button type="button" id="{{$dog->id}}" data-userId="{{$dog->user_id}}" data-type="@if($dog->purpose == 'مستلزمات'){{$dog->address}}@else{{$dog->type}}@endif" data-strain="@if($dog->purpose == 'مستلزمات'){{$dog->purpose}}@else{{$dog->strain}}@endif" class="refusal btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">الحذف مع السبب</button>

                                                                <a href="{{route('admin.dogs.status',$dog -> id)}}"
                                                                   class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                    @if($dog->active == 0)
                                                                        تفعيل
                                                                        @else
                                                                        الغاء تفعيل
                                                                    @endif
                                                                </a>
                                                                <button type="button" id="{{$dog->id}}" class="showDog btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">عرض</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>                                        
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>



<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
           <div class="form-group">
            <label class="control-label col-md-4" >النوع</label>
            <input readonly name="type" id="type" class="form-control"/>
           </div>
        </div>
     </div>
    </div>
</div>


<div id="formModalTwo" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <form id="my-form" method="POST">
            @csrf
                <input type="hidden" name="with_id" id="with_id" required>
                <input type="hidden" name="user_id" id="user_id" required>
                <input type="hidden" name="one" id="one" required>
                <input type="hidden" name="two" id="two" required>

                <div class="form-group">
                    <label>سبب الرفض</label>
                    <input type="text" id="details" name="details" class="form-control form-input @error('details') is-invalid @enderror" placeholder="سبب الرفض" required>
                </div>
                @error('details')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-submit">ارسال</button>
                </div>

            </form>
        </div>
     </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    
 $(document).on('click', '.showDog', function(){
    var id = $(this).attr('id');
    $.ajax({
    url:"dogs/fetch/"+id+"/edit",
    dataType:"json",
    success:function(html){
        $('#type').val(html.data.type);
        $('.modal-title').text("");
        $('#formModal').modal('show');
    }
    })
 });


$(document).on('click', '.refusal', function(e){
    $('#formModalTwo').modal('show');
    var dog_id = $(this).attr('id');
    var user_id = $(this).attr("data-userId");
    var type = $(this).attr("data-type");
    var strain = $(this).attr("data-strain");
    $('#with_id').val(dog_id);
    $('#user_id').val(user_id);
    $('#one').val(type);
    $('#two').val(strain);
});

$(".btn-submit").click(function(e){
    e.preventDefault();
    var form_data = new FormData(document.getElementById("my-form"));

    if($('#details').val() == ''){
        alert("يجب كتابة سبب الرفض")
    }else{
        $.ajax({
        url:"{{ route('refusal.insertRefusal') }}",
        method:"POST",
        data:form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType:"json",
        success:function(response){
              if(response.success){
                  $('#formModalTwo').modal('hide');
                  alert(response.message)
                  location.reload();
              }else{
                  alert("Error")
              }
        },
        error:function(error){
              console.log(error)
        }
    });
    }
});
});
</script>
@endsection
