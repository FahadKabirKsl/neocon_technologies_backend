@extends('layouts.dashboard.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatable-extension.css') }}">
@endpush
@includeIf('layouts.dashboard.partials.css')
@section('title', 'List of Review')
@section('content')
    @component('components.breadcrumb')
        @slot('bredcrumb_title')
            Home
        @endslot
        <li class="breadcrumb-item">Review</li>
        <li class="breadcrumb-item">List of Review</li>
    @endcomponent
    <div class="container w-75">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div>
                                @if (session()->has('create'))
                                    <div class="alert alert-success">
                                        {{ session('create') }}
                                    </div>
                                @endif
                                @if (session()->has('update'))
                                    <div class="alert alert-success">
                                        {{ session('update') }}
                                    </div>
                                @endif
                                @if (session()->has('delete'))
                                    <div class="alert alert-danger">
                                        {{ session('delete') }}
                                    </div>
                                @endif
                            </div>
                            <table class="table text-center display" id="basic-1">
                                <thead style="font-size:12px;text-align:center">
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Signature</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size:12px;text-align:center">
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ $review->name }}</td>
                                            <td>{{ $review->type }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image"
                                                    width="70">
                                            </td>
                                            <td>{{ $review->rating }}</td>
                                            <td>
                                                <div class="collapse-content" id="collapseContent{{ $review->id }}">
                                                    {!! $review->comment !!}
                                                </div>
                                                <div class="collapse-link pt-2"
                                                    onclick="toggleCollapse({{ $review->id }})">
                                                    <span id="collapseLinkText{{ $review->id }}">See More</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <div>
                                                        <a href="{{ route('review.edit', ['id' => $review->id]) }}"
                                                            class="btn btn-outline-primary">Edit</a>
                                                    </div>
                                                    <div style="margin-left:5px">
                                                        <form action="{{ route('review.destroy', ['id' => $review->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div>
                                {{ $review->links() }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function toggleCollapse(id) {
            const contentDiv = document.getElementById(`collapseContent${id}`);
            const linkTextSpan = document.getElementById(`collapseLinkText${id}`);

            if (contentDiv.style.maxHeight) {
                // Collapse the content
                contentDiv.style.maxHeight = null;
                linkTextSpan.textContent = "See More";
            } else {
                // Expand the content
                contentDiv.style.maxHeight = contentDiv.scrollHeight + "px";
                linkTextSpan.textContent = "See Less";
            }
        }
    </script>
@endpush
