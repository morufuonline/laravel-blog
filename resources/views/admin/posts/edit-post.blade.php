<x-admin-app-layout>
    @section('title')
    {{ $title }}
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-4 min-h-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="py-4 text-left text-sm text-gray-500 dark:text-gray-400 sm:text-left sm:ml-0"><a onclick="javascript: history.back(1);" style="color:#f11;cursor:pointer;">Back</a></div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

        <form action="{{ url('posts/update/' . $post->id) }}" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  

        @csrf
        @method('PUT')
        
        <fieldset class="border-radius"><legend class="required">All fields are required</legend>

        <label for="title" class="pt-4">Title<span class="required">*</span></label>
        <div class="py-2">
        <input type="text" name="title" id="title" class="form-control sm:rounded-lg" placeholder="Enter Title" required value="{{ $gen_helper::check_inputted('title', $post->title) }}">
        </div>
        @error('title')
        <p class="required">{{$message}}</p>
        @enderror

        <label for="body" class="pt-4">Body<span class="required">*</span></label>
        <div class="py-2">
        <textarea type="text" rows="7" name="body" id="body" class="form-control sm:rounded-lg" placeholder="Enter details" required>{{ $gen_helper::check_inputted('body', $post->body) }}</textarea>
        </div>
        @error('body')
        <p class="required">{{$message}}</p>
        @enderror

        <div class="py-4 text-right sm:text-right">
        <x-primary-button class="ms-3">
                {{ __('Update') }}
            </x-primary-button>
        </div>

        </fieldset>

        </form>

        </div></div>
                                                         
        </div>
    </div>
</x-admin-app-layout>
