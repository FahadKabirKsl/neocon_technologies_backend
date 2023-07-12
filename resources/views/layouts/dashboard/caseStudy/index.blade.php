@extends('layouts.dashboard.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatable-extension.css') }}">
@endpush
@includeIf('layouts.dashboard.partials.css')
@section('title', 'List of Case-Study')
@section('content')
    @component('components.breadcrumb')
        @slot('bredcrumb_title')
            Home
        @endslot
        <li class="breadcrumb-item">Case-Study</li>caseStudy
        <li class="breadcrumb-item">List of Case-Studies</li>
    @endcomponent
    <div class="container">
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
                            <table class="table display" id="basic-1" style="font-size:12px">
                                <thead>
                                    <tr>
                                        <th>Tags</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($caseStudies as $paper)
                                        <tr>
                                            <td>
                                                @if ($paper->tags)
                                                    @php
                                                        $cases = json_decode($paper->tags);
                                                    @endphp
                                                    @if ($cases)
                                                        @foreach ($cases as $case)
                                                            <button type="button" style="font-size:12px"
                                                                class="btn btn-orange my-1">{{ $case->value }}</button>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/' . $paper->image) }}" alt="Case-Study Image"
                                                    width="90">
                                            </td>
                                            <td>{{ $paper->name }}</td>
                                            <td>{{ $paper->title }}</td>
                                            <td>
                                                <div class="collapse-content" id="collapseContent{{ $paper->id }}">
                                                    {!! $paper->description !!}
                                                </div>
                                                <div class="collapse-link pt-2"
                                                    onclick="toggleCollapse({{ $paper->id }})">
                                                    <span id="collapseLinkText{{ $paper->id }}">See More</span>
                                                </div>
                                            </td>
                                            <td>{{ $paper->link }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div>
                                                        <a href="{{ route('caseStudy.edit', ['id' => $paper->id]) }}"
                                                            class="btn btn-outline-primary">Edit</a>
                                                    </div>
                                                    <div style="margin-left:5px">
                                                        <form
                                                            action="{{ route('caseStudy.destroy', ['id' => $paper->id]) }}"
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
                            {{-- {{ $caseStudies->links() }} --}}
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
