@extends('layouts.master')
@section('content')
    <shop-edit
        :store-index-route="'{{ route('stores.index') }}'"
        store-id="{{ request()->segment(2) }}"
    >
    </shop-edit>
@endsection
