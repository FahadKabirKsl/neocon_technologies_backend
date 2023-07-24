    @extends('layouts.dashboard.master')
    @push('css')
    @endpush
    @includeIf('layouts.dashboard.partials.css')
    @section('title', 'Create Case-Study')
    @section('content')
        @component('components.breadcrumb')
            @slot('bredcrumb_title')
                Home
            @endslot
            <li class="breadcrumb-item">Case-Study</li>
            <li class="breadcrumb-item">Create</li>
        @endcomponent
        <div class="container w-50">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('caseStudy.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col">
                                        <x-input-label class="form-label" for="tags" :value="__('Tags')" />
                                        <input class="form-control" id="tags" name="tags"
                                            placeholder="Enter tags here..." value="{{ old('tags') }}" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <x-input-label class="form-label" for="image" :value="__('Image')" />
                                        <x-text-input class="form-control" id="image" type="file" name="image" />
                                    </div>
                                    <div class="col-lg-6">
                                        <x-input-label class="form-label" for="name" :value="__('Name')" />
                                        <x-text-input class="form-control" id="name" type="text"
                                            placeholder="Enter your name here..." name="name" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <x-input-label class="form-label" for="title" :value="__('Title')" />
                                        <x-text-input class="form-control" id="title" type="text"
                                            placeholder="Enter your title here..." name="title" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-input-label class="form-label" for="subHeader" :value="__('Sub Header')" />
                                        <x-text-input class="form-control" placeholder="Enter your Sub Header here..."
                                            id="subHeader" type="text" name="subHeader" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <x-input-label class="form-label" for="description" :value="__('Description')" />
                                        <textarea class="form-control" id="description" placeholder="Enter your description here..." name="description"></textarea>
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
            // Initialize Tagify on the input field with ID "tags"
            var input = document.getElementById('tags');
            new Tagify(input);
        </script>
    @endpush
