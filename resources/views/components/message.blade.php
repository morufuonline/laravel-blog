@if(session()->has('not_success'))
<div class="not-success" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">{{session('not_success')}}</div>
@endif

@if(session()->has('success'))
<div class="success" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">{{session('success')}}</div>
@endif