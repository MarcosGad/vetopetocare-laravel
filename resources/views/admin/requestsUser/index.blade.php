@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> طلبات المستخدمين </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> طلبات المستخدمين
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
                                    <h4 class="card-title">جميع طلبات المستخدمين</h4>
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
                                                <th>البريد الألكترونى</th>
                                                <th>تحويل الى</th>
                                                <th>عنوان العيادة</th>
                                                <th>سعر الكشف</th>
                                                <th>نبدة عنك</th>
                                                <th>رخصة مزاولة المهنة</th>
                                                <th>صورة كرنية النقابة</th>
                                                <th>صورة تحقيق الشخصية</th>
                                                <th>رخصة الصيدلية</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @isset($requestsUsers)
                                                @foreach($requestsUsers as $requestsUser)
                                                    <tr>
                                                    <td>{{$requestsUser->email}}</td>
                                                    <td>
                                                      @if($requestsUser->type == 2) عيادة @endif
                                                      @if($requestsUser->type == 3) صيدلية @endif
                                                      @if($requestsUser->type == 4) محل تجارى @endif
                                                      @if($requestsUser->type == 5) شركة @endif
                                                      @if($requestsUser->type == 6) مدرسة @endif
                                                    </td>
                                                    <td>{{$requestsUser->address}}</td>
                                                    <td>{{$requestsUser->disclosure_price}}</td>
                                                    <td>{{$requestsUser->about_you}}</td>
                                                    <td>@if($requestsUser->type == 2) <img style="width: 150px; height: 100px;" src="{{$requestsUser->license}}"> @else لايوجد @endif</td>
                                                    <td>@if($requestsUser->type == 2) <img style="width: 150px; height: 100px;" src="{{$requestsUser->image_of_the_guild_capricorn}}"> @else لايوجد @endif</td>
                                                    <td>@if($requestsUser->type == 2) <img style="width: 150px; height: 100px;" src="{{$requestsUser->Personal_identification_photo}}"> @else لايوجد @endif</td>
                                                    <td>@if($requestsUser->type == 3) <img style="width: 150px; height: 100px;" src="{{$requestsUser->pharmacy_license}}"> @else لايوجد @endif </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">

                                                                 <a href="{{route('admin.requestsUser.acc',[$requestsUser->user_id,$requestsUser->type,$requestsUser->id])}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">قبول التحويل</a>

                                                                   <button 
                                                                   type="button" 
                                                                   id="{{$requestsUser->id}}" 
                                                                   data-userId="{{$requestsUser->user_id}}" 
                                                                   data-typeUser="@if($requestsUser->type == 2)  تحويل حسابك ألى عيادة @endif
                                                                    @if($requestsUser->type == 3)  تحويل حسابك ألى صيدلية @endif
                                                                    @if($requestsUser->type == 4)  تحويل حسابك ألى محل تجارى @endif
                                                                    @if($requestsUser->type == 5)  تحويل حسابك ألى شركة @endif
                                                                    @if($requestsUser->type == 6)  تحويل حسابك ألى مدرسة @endif" 
                                                                    data-created="{{$requestsUser->created_at}}" 
                                                                    class="refusal btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">رفض التحويل مع السبب</button>

                                                                   <a href="{{route('admin.requestsUser.delete',$requestsUser -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>


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
            <form id="my-form" method="POST">
            @csrf
                <input type="hidden" name="with_id" id="with_id" required>
                <input type="hidden" name="user_id" id="user_id" required>
                <input type="hidden" name="one" id="typeUser" required>
                <input type="hidden" name="two" id="created" required>

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
    

$(document).on('click', '.refusal', function(e){
    $('#formModal').modal('show');
    var with_id = $(this).attr('id');
    var user_id = $(this).attr("data-userId");
    var typeUser = $(this).attr("data-typeUser");
    var created = $(this).attr("data-created");
    $('#with_id').val(with_id);
    $('#user_id').val(user_id);
    $('#typeUser').val(typeUser);
    $('#created').val(created);
});

$(".btn-submit").click(function(e){
    e.preventDefault();
    var form_data = new FormData(document.getElementById("my-form"));

    if($('#details').val() == ''){
        alert("يجب كتابة سبب الرفض")
    }else{
        $.ajax({
        url:"{{ route('refusal.insertRefusalThree') }}",
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
