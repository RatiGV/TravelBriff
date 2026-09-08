@extends('layouts.admin')
@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>@lang('admin.order_details')</h2>
            <a class="btn btn-default btn-sm pull-right" href="{{ route('Orders') }}">
                <i class="fa fa-arrow-left"></i> @lang('admin.cancel')
            </a>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 25%;">@lang('admin.date')</th>
                    <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                </tr>
                <tr>
                    <th>@lang('admin.first_name')</th>
                    <td>{{ $item->first_name }}</td>
                </tr>
                <tr>
                    <th>@lang('admin.last_name')</th>
                    <td>{{ $item->last_name }}</td>
                </tr>
                <tr>
                    <th>@lang('admin.email')</th>
                    <td>{{ $item->email }}</td>
                </tr>
                <tr>
                    <th>@lang('admin.phone')</th>
                    <td>{{ $item->phone }}</td>
                </tr>
                <tr>
                    <th>@lang('admin.persons')</th>
                    <td>{{ $item->persons }}</td>
                </tr>
                <tr>
                    <th>@lang('admin.arrival_date')</th>
                    <td>{{ $item->arrival_date ? $item->arrival_date->format('d.m.Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>@lang('admin.return_date')</th>
                    <td>{{ $item->return_date ? $item->return_date->format('d.m.Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>@lang('admin.pickup_location')</th>
                    <td>{{ $item->pickup_location ?: '-' }}</td>
                </tr>
                <tr>
                    <th>@lang('admin.return_location')</th>
                    <td>{{ $item->return_location ?: '-' }}</td>
                </tr>
                <tr>
                    <th>@lang('admin.product')</th>
                    <td>
                        @if($item->tour)
                            <a href="{{ route('ClientTourInner', $item->product_id) }}" target="_blank">
                                {{ $item->tour_title ?: ('#' . $item->product_id) }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>@lang('admin.status')</th>
                    <td>{{ $item->status ? __('admin.active') : __('admin.not_active') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
