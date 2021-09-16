@extends('auth.admin-index')

@section('title', 'Tours')

@section('content')

<div class="clearfix">
    <h2 class="pull-left">Tours</h2>

    <a href="{{ route('admin.newTourForm') }}" class="btn btn-primary pull-right mt">
        Add new Tour
    </a>
</div>

<div class="page-header"></div>

@component('auth.components.status.success')
@endcomponent

@component('auth.components.status.error')
@endcomponent

@error('tour_id')
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>Warning!</strong> {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@enderror

<div class="table-responsive">

    @if ($tours->isNotEmpty())
    <p>
        {{ $tours->firstItem() }} -
        {{ $tours->lastItem() }} of
        {{ $tours->total() }}
    </p>    
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>@sortablelink('id', 'ID')</th>
                <th>@sortablelink('title', 'Title')</th>
                <th>@sortablelink('subtitle', 'Subtitle')</th>
                <th>@sortablelink('price', 'Price')</th>
                <th>@sortablelink('created_at', 'Created at')</th>
                <th>Category</th>
                <th>Requirements</th>
                <th class="text-right"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tours as $tour)
            <tr>
                <td>{{ $tour->id }}</td>
                <td>{{ $tour->title }}</td>
                <td>{{ $tour->subtitle }}</td>
                <td>{{ $tour->price ? $tour->price . ' €' : '' }}</td>
                <td>{{ $tour->created_at->format('d M Y') }}</td>
                <td>{{ $tour->category->name }}</td>
                <td>
                    @foreach ($tour->requirements as $requirement)
                    <span class="badge">
                        {{ $requirement->name }}
                    </span>
                    @endforeach
                </td>
                <td class="text-right">
                    <a href="{{ route('admin.editTourForm', $tour->id) }}" class="btn btn-primary btn-sm">
                        Edit
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-tourid="{{ $tour->id }}">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tours->appends(request()->except('page'))->links() }}
</div>

@component('auth.components.modals.delete')
@endcomponent

@endsection