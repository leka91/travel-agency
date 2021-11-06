@extends('auth.admin-index')

@section('title', 'Tours')

@section('content')

<div class="clearfix">
    <h2 class="pull-left">Tours</h2>

    <a href="{{ route('admin.newTourForm') }}" class="btn btn-primary pull-right mt">
        Add new Tour
    </a>

    @if ($removedToursCount)
    <a href="{{ route('admin.getAllRemovedTours') }}" class="btn btn-default pull-right mt mr">
        Removed Tours &nbsp;
        <span class="badge">
            {{ $removedToursCount }}
        </span>
    </a>
    @endif
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

@if ($tours->count())
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
                <th>Tags</th>
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
                <td class="badge-size">
                    @foreach ($tour->requirements as $requirement)
                    <span class="badge">
                        {{ $requirement->name }}
                    </span>
                    @endforeach
                </td>
                <td class="badge-size">
                    @foreach ($tour->tags as $tag)
                    <span class="badge primary-badge">
                        {{ $tag->name }}
                    </span>
                    @endforeach
                </td>
                <td class="text-right">
                    <a href="{{ route('admin.editTourForm', $tour->id) }}" class="btn btn-primary btn-sm">
                        Edit
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeModal" data-tourid="{{ $tour->id }}">
                        Remove
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tours->appends(request()->except('page'))->links() }}
</div>
@endif

@component('auth.components.modals.remove')
@endcomponent

@endsection