@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> نسخة احتياطية </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> نسخة احتياطية
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
                                    <h4 class="card-title"> </h4>
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
                              
                                       <form  method="POST" action="{{ route('admin.backup.getbackup') }}">
                                        @csrf  
                                        
                                         <button type="submit" name="backup"   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">أخذ نسخة احتياطية لقاعدة البيانات كاملا على السيرفر</button>
                                        </form>
                                        
                                        
                                        <form method="post" class="example" id="export_form"
                                        action="{{ route('admin.backup.getbackupTwo') }}">
                                        @csrf 
                                         <h3>حدد الجدول واخذ نسخة احتياطية له على جهازك</h3>
                                         
                                         <button type="button" id="selectAll" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"> <span class="sub"></span> تحديد الكل</button>
                                         
                                        <?php
                                        foreach($result as $table)
                                        {
                                        ?>
                                         <div class="checkbox"">
                                          <label><input type="checkbox" class="checkbox_table" name="table[]" value="<?php echo $table["Tables_in_vetopetocare"]; ?>" /> <?php echo $table["Tables_in_vetopetocare"]; ?></label>
                                         </div>
                                        <?php
                                        }
                                        ?>
                                         <div class="form-group">
                                          <input type="submit" name="submit" id="submit" class="btn btn-info" value="أخذ النسخة" />
                                         </div>
                                        </form>
                                                                          
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
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
 $('#submit').click(function(){
  var count = 0;
  $('.checkbox_table').each(function(){
   if($(this).is(':checked'))
   {
    count = count + 1;
   }
  });
  if(count > 0)
  {
   $('#export_form').submit();
  }
  else
  {
   alert("من فضلك حدد الجدول اولا");
   return false;
  }
 });
 
 
  $('body').on('click', '#selectAll', function () {
    if ($(this).hasClass('allChecked')) {
        $('input[type="checkbox"]', '.example').prop('checked', false);
    } else {
        $('input[type="checkbox"]', '.example').prop('checked', true);
    }
    $(this).toggleClass('allChecked');
  })


});
</script>
@endsection
