@props(['comment'])

    <div class="scale-100 p-6 py-2 my-2 bg-white rounded-lg">

        <p>{{$comment->body}}</p>
        <hr>
        <p style="font-size:12px;">{{$comment->name}} - {{ $gen_helper::special_date($comment->created_at) }}</p>
        
    </div>
