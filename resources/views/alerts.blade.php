<!--SUCCESS-->
@if(Session::has('success'))
<div id="alert-3" class="flex items-center p-4 text-green-800 rounded-lg bg-green-50" role="alert">
    <i class="fa-solid fa-check"></i>
    <div class="ml-3 text-sm font-medium">
        {{Session::get('success')}}
    </div>
</div>
@endif
<!--DANGER-->
@if(Session::has('fail'))
<div id="alert-2" class="flex items-center p-4 text-red-800 rounded-lg bg-red-50" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i>
    <div class="ml-3 text-sm font-medium">
        {{Session::get('fail')}}
    </div>
</div>
@endif