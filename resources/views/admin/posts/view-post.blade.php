<x-admin-app-layout>
    @section('title')
    {{ $title }}
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
        <p>{{ $gen_helper::full_date($poster->created_at) }}</p>
    </x-slot>

    <div class="py-4 min-h-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="py-4 text-left text-sm text-gray-500 dark:text-gray-400 sm:text-left sm:ml-0"><a onclick="javascript: history.back(1);" style="color:#f11; cursor:pointer;">Back</a></div>

        @if($poster)
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

        <div>{{ $poster->body }}</div>

        <div class="mt-4 text-right text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0"><a href="{{ url('posts/edit/' . $poster->id) }}" style="color:#f11;">Edit</a></div>

        </div></div>
        @endif
                                                         
        </div>
    </div>
</x-admin-app-layout>
