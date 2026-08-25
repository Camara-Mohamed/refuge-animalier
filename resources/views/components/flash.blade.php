@props(['key' => 'success'])

@if (session($key))
    <div class="mb-4 p-4 bg-blue-turquoise/10 border border-blue-turquoise text-blue-strong rounded-lg font-sans text-sm">
        {{ session($key) }}
    </div>
@endif
