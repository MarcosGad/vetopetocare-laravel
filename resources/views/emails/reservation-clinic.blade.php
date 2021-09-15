@component('mail::message')
# رسالة تأكيد حجز
<p>
<strong>اسم العميل</strong> {{ $userName }}
</p>
<p>
<strong>رقم تليفون العميل</strong> {{ $userPhone }}
</p>
<p>
<strong>ملاحظات العميل عن الحجز</strong> {{ $data['mass'] }}
</p>
@endcomponent
