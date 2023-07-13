@extends('layouts.master')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                </div>
            </div>
            <div class="content-body"><!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">My Orders</h4>
                            </div>
                            <div class="table-responsive">
                                @if($orders->isEmpty())
                                    <div class="d-flex justify-content-center">
                                        <h4>Oops, you have not any order yet.</h4>
                                    </div>
                                @else
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <span class="font-weight-bold">{{ $order->created_at }}</span>
                                        </td>
                                        <td>{{ $order->price }} USD</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->discount }}% (On per item)</td>
                                        <td><span class="badge badge-pill badge-light-primary mr-1">Paid</span></td>
                                        <td><a class="text-primary font-weight-bold" href="{{ route('coming-soon') }}">Details</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
