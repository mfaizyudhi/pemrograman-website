<x-layouts.app : title="'Posts" :description="'List of all posts'">
    <x-slot name="header">
        <h1 class="text-2xl font-bold">Posts</h1>
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
    </div>

    @if ($posts->isEmpty())
    <p>No posts available.</p>
    @else
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            {{ $posts->links() }}
            @endif