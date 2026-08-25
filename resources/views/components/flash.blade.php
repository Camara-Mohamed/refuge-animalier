@if (session('success'))
    <div class="mb-4 p-4 bg-blue-turquoise/10 border border-blue-turquoise text-blue-strong rounded-lg font-sans text-sm">
        {{ session('success') }}
    </div>
@endif
