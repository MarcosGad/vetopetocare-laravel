@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الدلائل </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> الدلائل
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
                                    <h4 class="card-title">جميع الدلائل</h4>
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
                                                <th>الأسم</th>
                                                <th>الصور</th>
                                                <th>العنوان</th>
                                                <th>رقم التليفون</th>
                                                <th>رقم التليفون الارضى</th>
                                                <th>سعر الكشف المنزل</th>
                                                <th>سعر الكشف العادي</th>
                                                <th>اسم الدكتور</th>
                                                <th>سعر خدمة التوصيل</th>
                                                <th>الوصف</th>
                                                <th>البريد الالكترونى</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @isset($guides)
                                                @foreach($guides as $guide)
                                                    <tr>
                                                    <td>@if($guide->name) {{$guide->name}} @else لا يوجد @endif</td>
                                                    <td>
                                                    @foreach(json_decode($guide->filename) as $file)
                                                        <img style="width: 150px; height: 100px;" src="{{asset('assets/' . $file)}}">
                                                    @endforeach
                                                    </td>
                                                    <td>@if($guide->address) {{$guide->address}} @else لا يوجد @endif</td>
                                                    <td>@if($guide->phone) {{$guide->phone}} @else لا يوجد @endif</td>
                                                    <td>@if($guide->landline_phone) {{$guide->landline_phone}} @else لا يوجد @endif</td>
                                                    <td>@if($guide->home_detection_rate) {{$guide->home_detection_rate}} @else لا يوجد @endif</td>
                                                    <td>@if($guide->regular_check_up_price) {{$guide->regular_check_up_price}} @else لا يوجد @endif</td>
                                                    <td>@if($guide->doctor_name) {{$guide->doctor_name}} @else لا يوجد @endif</td>
                                                    <td>@if($guide->price_of_the_delivery_service) {{$guide->price_of_the_delivery_service}} @else لا يوجد @endif</td>
                                                    <td>@if($guide->offers_services) {{$guide->offers_services}} @else لا يوجد @endif</td>
                                                    <td>
                                                    @if($guide->user_id == 0) مسؤال الموقع @endif
                                                    @foreach($users as $user)
                                                        @if($user->id == $guide->user_id)
                                                          @if($user->email) {{$user->email}} @else لا يوجد @endif
                                                        @endif
                                                    @endforeach
                                                    </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">

                                                                <a href="{{route('admin.guides.delete',$guide -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

                                                                   <button type="button" id="{{$guide->id}}" data-userId="{{$guide->user_id}}" data-guideName="{{$guide->name}}" data-address="{{$guide->address}}" class="refusal btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">الحذف مع السبب</button>

                                                                <a href="{{route('admin.guides.status',$guide -> id)}}"
                                                                   class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                    @if($guide->active == 0)
                                                                        تفعيل
                                                                        @else
                                                                        الغاء تفعيل
                                                                    @endif
                                                                </a>
                                                                <!-- <button type="button" id="{{$guide->id}}" class="showGuides btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">عرض</button> -->
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
            <label class="control-label col-md-4" >الأسم</label>
            <input readonly name="name" id="name" class="form-control"/>
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
                <input type="hidden" name="one" id="guideName" required>
                <input type="hidden" name="two" id="address" required>

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
    
 $(document).on('click', '.showGuides', function(){
    var id = $(this).attr('id');
    $.ajax({
    url:"guides/fetch/"+id+"/edit",
    dataType:"json",
    success:function(html){
        $('#name').val(html.data.name);
        $('.modal-title').text("");
        $('#formModal').modal('show');
    }
    })
 });


$(document).on('click', '.refusal', function(e){
    $('#formModalTwo').modal('show');
    var with_id = $(this).attr('id');
    var user_id = $(this).attr("data-userId");
    var name = $(this).attr("data-guideName");
    var address = $(this).attr("data-address");
    $('#with_id').val(with_id);
    $('#user_id').val(user_id);
    $('#guideName').val(name);
    $('#address').val(address);
});

$(".btn-submit").click(function(e){
    e.preventDefault();
    var form_data = new FormData(document.getElementById("my-form"));

    if($('#details').val() == ''){
        alert("يجب كتابة سبب الرفض")
    }else{
        $.ajax({
        url:"{{ route('refusal.insertRefusalTwo') }}",
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
