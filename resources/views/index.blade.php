<x-front-header :title="$title" />

<style>
.search-tb{
    width:100%;
}
.search-tb tbody tr td{
    padding:0px;
    border:1px solid #ddd;
}
.search-tb tbody tr td input, .search-tb tbody tr td button{
    width:100%;
    padding:10px;
}
.search-tb tbody tr td button{
    background:#009;
    color:#fff;
}
.search-tb tbody tr td.search-btn-td{
    width:70px;
}
</style>

    <div class="max-w-7xl mx-auto scale-100 p-6 bg-white rounded-lg">
        
    <form method="post" action="{{ url('search') }}">
    @csrf
    <table class="search-tb"><tbody><tr>
    <td><input type="text" name="search" placeholder="Enter title or body content" value="{{ session('home-search') }}"></td>
    <td class="search-btn-td"><x-primary-button class="ms-3"> {{ __('Search') }} </x-primary-button></td>
    </tr></tbody></table>
    </form>

    </div>

    <div class="max-w-7xl mx-auto p-6 lg:p-8">

        @if($all_posts->count() > 0)

        <div class="mt-2 min-h-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

            @foreach($all_posts as $post)
            <x-blog-grid :post="$post" />
            @endforeach
                
            </div>

            @if($all_posts->hasPages())
            <div class="max-w-7xl mx-auto p-6 lg:p-8 bg-white mt-6 pagination"> {{ $all_posts->links() }} </div>
            @endif
        </div>

        @else
        
        <div class="max-w-7xl mx-auto scale-100 p-6 bg-white rounded-lg">No posts available</div>

        @endif

        <x-front-footer />
    </div>
</div>
</body>
</html>
