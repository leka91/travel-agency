@extends('auth.admin-index')

@section('title', 'Requirements')

@section('content')

<div class="clearfix">
    <h2 class="pull-left">Requirements</h2>

    <a href="{{ route('admin.newRequirementForm') }}" class="btn btn-primary pull-right mt">
        Add new Requirement
    </a>
</div>

<div class="page-header"></div>

<div class="table-responsive">

    @if ($requirements->isNotEmpty())
    <p>
        {{ $requirements->firstItem() }} -
        {{ $requirements->lastItem() }} of
        {{ $requirements->total() }}
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
            @foreach ($requirements as $requirement)
            <tr>
                <td>{{ $requirement->id }}</td>
                <td>{{ $requirement->name }}</td>
                <td>{{ $requirement->created_at->format('d M Y') }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.editRequirementForm', $requirement->id) }}" class="btn btn-primary btn-sm">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $requirements->appends(request()->except('page'))->links() }}
</div>

@endsection