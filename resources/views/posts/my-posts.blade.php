<x-app-layout title="My Posts">

    <x-flash-messages type="success" class="w-75" />

    <x-search :action="route('posts.search')" placeholder="Search Posts" />

    <table class="table w-75 m-auto mt-3 w-fit p-2">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at }}</td>

                    <td>
                        <a href="{{ route('posts.show', [$post->id, 'home']) }}" class="btn btn-primary fw-bold">Read
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="text-danger">
                            No Posts!
                        </div>
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

    {{ $posts->links() }}

</x-app-layout>
