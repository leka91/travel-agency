@extends('auth.admin-index')

@section('title', 'Tags')

@section('content')

<div class="clearfix">
    <h2 class="pull-left">Tags</h2>

    <a href="{{ route('admin.newTagForm') }}" class="btn btn-primary pull-right mt">
        Add new Tag
    </a>
</div>

<div class="page-header"></div>

@if ($tags->count())
<div class="table-responsive">
    @if ($tags->isNotEmpty())
    <p>
        {{ $tags->firstItem() }} -
        {{ $tags->lastItem() }} of
        {{ $tags->total() }}
    </p>    
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>@sortablelink('id', 'ID')</th>
                <th>@sortablelink('name', 'Name')</th>
                <th>@sortablelink('created_at', 'Created at')</th>
                <th class="text-right"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->created_at->format('d M Y') }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.editTagForm', $tag->id) }}" class="btn btn-primary btn-sm">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tags->appends(request()->except('page'))->links() }}
</div>
@endif

@endsection