<x-front-header :title="$title" />

            <div class="max-w-7xl mx-auto p-6 lg:p-8">

                @if($post)

                <div class="mt-2">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">

                    <x-message />

    <div class="scale-100 p-6 bg-white rounded-lg">

        <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
        </div>

        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{$post->title}}</h2>

        <p>{{$post->name}} - {{ $gen_helper::special_date($post->created_at) }}</p>

        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
        {{$post->body}}
        </p>
        
    </div>

    @if($comments->count() > 0)
    <div class="scale-100 p-6 bg-white rounded-lg">
        <h3 style="font-weight:900;">Comments ({{ $comments->count() }})</h3>
    </div>
    @foreach($comments as $comment)
    <x-comment-grid :comment="$comment" />
    @endforeach
    @endif

    @auth
    <div class="scale-100 p-6 my-4 bg-white rounded-lg">
    <form action="{{ url('comment/' . $post->id ) }}" method="post" runat="server" autocomplete="off">  

        @csrf

        <fieldset class="border-radius"><legend>Comment below</legend>

        <div class="py-2">
        <textarea type="text" rows="7" name="body" id="body" class="form-control  rounded-lg sm:rounded-lg" placeholder="Enter comment" required style="border:1px solid #bbb; padding:10px;">{{ old('body') }}</textarea>
        </div>
        @error('body')
        <p class="required">{{$message}}</p>
        @enderror

        <div class="py-4 text-right sm:text-right">
        <x-primary-button class="ms-3">
                {{ __('Send') }}
            </x-primary-button>
        </div>

        </fieldset>

        </form>
        </div>
        @endauth

                        
                    </div>

                </div>

                @endif

                <x-front-footer />
            </div>
        </div>
    </body>
</html>
