{{-- @extends('template')
@section('title', 'Halaman Page 1')
@section('content')
@push('styles')
<style>
    h1{color: green;}
    </style>
@endpush
<div class="containter">
    <h1>Ini Page 1</h1>
</div>
@endsection --}}

<x-templateABC>
    <div class="containter">
        <h1>Ini Page 1</h1>
    </div>
    @push('styles')
    <style>
        h1{color: green;}
    </style>
    @endpush
</x-templateABC>