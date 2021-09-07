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
                <td>
                    @foreach ($tour->requirements as $requirement)
                    <span class="badge">
                        {{ $requirement->name }}
                    </span>
                    @endforeach
                </td>
                <td class="text-right">
                    <a href="#" class="btn btn-primary btn-sm">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tours->appends(request()->except('page'))->links() }}
</div>

@endsection