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
                                        <x-input-label class="form-label" for="name" :value="__('Name')" />
                                        <span class="text-danger">(*)</span>
                                        <x-text-input class="form-control" id="name" type="text"
                                            placeholder="Enter your name here..." name="name"
                                            value="{{ old('name') }}" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <x-input-label class="form-label" for="description" :value="__('Description')" />
                                        <span class="text-danger">(*)</span>
                                        <textarea class="form-control" id="description" placeholder="Enter your description here..." name="description"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <x-input-label class="form-label" for="subName" :value="__('Sub Name')" />
                                        <span class="text-danger">(*)</span>
                                        <x-text-input class="form-control" id="subName" type="text"
                                            placeholder="Enter your subName here..." name="subName" />
                                    </div>
                                    <div class="col-lg-6">
                                        <x-input-label class="form-label" for="subTitle" :value="__('Sub Title')" />
                                        <span class="text-danger">(*)</span>
                                        <x-text-input class="form-control" id="subTitle" type="text"
                                            placeholder="Enter your subTitle here..." name="subTitle" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <x-input-label class="form-label" for="image" :value="__('Image')" />
                                        <span class="text-danger">(*)</span>
                                        <x-text-input class="form-control" id="image" type="file" name="image" />
                                    </div>
                                    <div class="col-lg-6">
                                        <x-input-label class="form-label" for="subDesc" :value="__('Sub Description')" />
                                        <span class="text-danger">(*)</span>
                                        <textarea class="form-control" id="subDesc" placeholder="Enter your sub description here..." name="subDesc"></textarea>
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
            var input = document.getElementById('name');
            new Tagify(input);
        </script>
    @endpush
