@if(session('send'))
    <div class="p-4 flex bg-blue-strong/10 border border-blue-strong text-blue-strong rounded-lg">
        {{ session('send') }}
    </div>
@endif
