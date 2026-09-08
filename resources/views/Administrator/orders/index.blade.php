@extends('layouts.admin')
@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>@lang('admin.routes.Orders')</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>@lang('admin.success')</strong>
            </div>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th>@lang('admin.date')</th>
                    <th>@lang('admin.user')</th>
                    <th>@lang('admin.phone')</th>
                    <th>@lang('admin.product')</th>
                    <th>@lang('admin.qty')</th>
                    <th>@lang('admin.status')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->tour_title ?: '-' }}</td>
                        <td>{{ $item->persons }}</td>
                        <td>
                            <div class="iradio">
                                <input type="checkbox"
                                       data-id="{{ $item->id }}"
                                       data-table="{{ $main_table }}"
                                       data-column="status"
                                       {{ $item->status ? 'checked' : '' }}
                                       class="js-switch change"
                                />
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm pull-right delete"
                                    data-id="{{ $item->id }}"
                                    data-table="{{ $main_table }}"
                                    data-check-childs-here="{{ json_encode([]) }}"
                            >
                                <i class="fa fa-trash"></i>
                            </button>
                            <a class="btn btn-primary btn-sm pull-right" href="{{ route('ViewOrders', $item->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="alert alert-warning text-center">
                                @lang('admin.no_found')
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
