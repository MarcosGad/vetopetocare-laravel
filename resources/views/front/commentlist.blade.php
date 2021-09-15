@foreach($comments as $comment)
	<div >
		<b>{{ $comment->name }}</b>: {{ $comment->comment }}
		<p style="font-size:9px;">{{ date('M d, Y h:i A', strtotime($comment->created_at)) }}</p>
	</div>
@endforeach