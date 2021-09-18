@extends('auth.admin-index')

@section('title', 'Removed Tours')

@section('content')

<div class="clearfix">
    <h2 class="pull-left">Removed Tours</h2>
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
                <th>@sortablelink('deleted_at', 'Deleted at')</th>
                <th>Category</th>
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
                <td>{{ $tour->deleted_at->format('d M Y') }}</td>
                <td>{{ $tour->category->name }}</td>
                <td class="text-right">
                    <form action="{{ route('admin.restoreTour', $tour->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-warning btn-sm">
                            Restore
                        </button>
                    </form>

                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-tourid="{{ $tour->id }}">
                        Delete permanently
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