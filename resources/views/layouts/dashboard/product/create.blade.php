@extends('layouts.dashboard.master')
@push('css')
@endpush
@includeIf('layouts.dashboard.partials.css')
@section('title', 'Create Product')
@section('content')
    @component('components.breadcrumb')
        @slot('bredcrumb_title')
            Home
        @endslot
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item">Create</li>
    @endcomponent
    <div class="container w-50">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('product.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="d-flex row mb-4">
                                <div class="col-sm-6">
                                    <x-input-label class="form-label" for="name" :value="__('Name')" />
                                    <x-text-input class="form-control" id="name" type="text"
                                        placeholder="Enter your name here..." name="name" />
                                </div>
                                <div class="col-sm-6">
                                    <x-input-label class="form-label" for="title" :value="__('Title')" />
                                    <x-text-input class="form-control" id="title" type="text"
                                        placeholder="Enter your title here..." name="title" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <x-input-label class="form-label" for="single_image" :value="__('Single Image')" />
                                    <x-text-input class="form-control" id="single_image" type="file"
                                        name="single_image" />
                                </div>
                                <div class="col-sm-6">
                                    <x-input-label class="form-label" for="image" :value="__('Multiple Product Images')" />
                                    <x-text-input class="form-control" id="image" type="file" multiple
                                        name="image[]" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <x-input-label class="form-label" for="description" :value="__('Description')" />
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <x-primary-button href="#" class="btn btn-neocon rounded">Create
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        //FroalaEditor
        var editor = new FroalaEditor('#description', {
            pluginsEnable: ['insertUnorderedList', 'fullscreen', 'bold', 'italic', 'underline', 'strikeThrough',
                'subscript', 'superscript', 'fontFamily', 'fontSize', 'color', 'align', 'outdent', 'indent',
                'quote', 'insertLink',
                'insertImage', 'insertTable', 'insertHR', 'undo', 'redo'
            ],
            height: '100px',
        });
    </script>
@endpush
