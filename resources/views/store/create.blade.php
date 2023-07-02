@extends('layouts.master')
@section('content')
    <shop-create
        :store-index-route="'{{ route('stores.index') }}'"
    >
    </shop-create>
@endsection
