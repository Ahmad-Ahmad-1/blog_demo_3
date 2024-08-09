{{-- @extends('layouts.test') --}}

{{-- @section('content') --}}

    {{-- <main>
        <aside>
            <div>
                I'm in aside
            </div>
        </aside>

        <section>
            <div>
                @foreach ($items as $item)
                    <div class="alert alert-success">{{ $item }}</div>
                @endforeach
            </div>
        </section> --}}

        @auth
        <div class="alert alert-suc">You are logged in</div>
        @else
        <div class="alert alert-danger">You are not logged in!</div>
        @endauth

    {{-- </main> --}}

{{-- @endsection --}}
