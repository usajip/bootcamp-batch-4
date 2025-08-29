@if(session('success'))
    <div class="mb-4 text-green-700 bg-green-100 border border-green-400 px-4 py-2 rounded">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-4 text-red-700 bg-red-100 border border-red-400 px-4 py-2 rounded">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif