@extends('auth.admin-index')

@section('title', 'Categories')

@section('content')

<div class="clearfix">
    <h2 class="pull-left">Categories</h2>

    <a href="{{ route('admin.newCategoryForm') }}" class="btn btn-primary pull-right mt">
        Add new Category
    </a>
</div>

<div class="page-header"></div>

<div class="table-responsive">

    @if ($categories->isNotEmpty())
    <p>
        {{ $categories->firstItem() }} -
        {{ $categories->lastItem() }} of
        {{ $categories->total() }}
    </p>    
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created at</th>
                <th class="text-right"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->created_at->format('d M Y') }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.editCategoryForm', $category) }}" class="btn btn-primary btn-sm">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->appends(request()->except('page'))->links() }}
</div>

@endsection