@php
    $colors = [
        'success' => 'info',
        'error' => 'danger',
        'warning' => 'warning',
        'info' => 'primary'
    ];
@endphp

<div class="alert alert-{{ $colors[$type] ?? 'info' }} alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
