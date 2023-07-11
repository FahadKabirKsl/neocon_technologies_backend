    @extends('layouts.dashboard.master')
    @push('css')
    @endpush
    @includeIf('layouts.dashboard.partials.css')
    @section('title', 'Create Service')
    @section('content')
        @component('components.breadcrumb')
            @slot('bredcrumb_title')
                Home
            @endslot
            <li class="breadcrumb-item">Service</li>
            <li class="breadcrumb-item">Create</li>
        @endcomponent
        <div class="container w-50">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('service.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col">
                                        <x-input-label class="form-label" for="title" :value="__('Title')" />
                                        <span class="text-danger">(*)</span>
                                        <x-text-input class="form-control" id="title" type="text"
                                            placeholder="Enter your title here..." required="" name="title" />
                                    </div>
                                </div>
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
                                        <span class="text-danger">(*)</span>
                                        <x-text-input class="form-control" id="image" type="file" required=""
                                            name="image" />
                                    </div>
                                    <div class="col-lg-6">
                                        <x-input-label class="form-label" for="name" :value="__('Name')" />
                                        <span class="text-danger">(*)</span>
                                        <x-text-input class="form-control" id="name" type="text"
                                            placeholder="Enter your name here..." required="" name="name" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <x-input-label class="form-label" for="description" :value="__('Description')" />
                                        <span class="text-danger">(*)</span>
                                        <textarea class="form-control" id="description" placeholder="Enter your description here..." name="description"
                                            required=""></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <x-primary-button href="#" class="btn btn-primary">Save</x-primary-button>
                                        <x-secondary-button href="#" class="btn btn-secondary">Cancel
                                        </x-secondary-button>
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
