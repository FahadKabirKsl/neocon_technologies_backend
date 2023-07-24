    @extends('layouts.dashboard.master')
    @push('css')
    @endpush
    @includeIf('layouts.dashboard.partials.css')
    @section('title', 'Create Employee')
    @section('content')
        @component('components.breadcrumb')
            @slot('bredcrumb_title')
                Home
            @endslot
            <li class="breadcrumb-item">Employee</li>
            <li class="breadcrumb-item">Create</li>
        @endcomponent
        <div class="container w-50">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('employee.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="d-flex row mb-4">
                                    <div class="col">
                                        <x-input-label class="form-label" for="type" :value="__('Type')" />
                                        <select class="form-control" id="type" name="type" required>
                                            <option class="select-placeholder" value="" disabled selected>Select
                                                Type</option>
                                            <option value="director">Board of Directors</option>
                                            <option value="team">Management Team</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <x-input-label class="form-label" for="designation" :value="__('Designation')" />
                                        <x-text-input class="form-control" id="designation" type="text"
                                            placeholder="Enter your designation here..." name="designation" />
                                    </div>
                                </div>
                                <div class="d-flex row mb-4">
                                    <div class="col">
                                        <x-input-label class="form-label" for="name" :value="__('Name')" />
                                        <x-text-input class="form-control" id="name" type="text"
                                            placeholder="Enter your name here..." name="name" />
                                    </div>
                                    <div class="col">
                                        <x-input-label class="form-label" for="image" :value="__('Image')" />
                                        <x-text-input class="form-control" id="image" type="file" name="image" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <x-input-label class="form-label" for="about" :value="__('About')" />
                                        <textarea class="form-control" id="about" placeholder="Enter your about here..." name="about" required=""></textarea>
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
            var editor = new FroalaEditor('#about', {
                pluginsEnable: ['insertUnorderedList', 'fullscreen', 'bold', 'italic', 'underline', 'strikeThrough',
                    'subscript', 'superscript', 'fontFamily', 'fontSize', 'color', 'align', 'outdent', 'indent',
                    'quote', 'insertLink',
                    'insertImage', 'insertTable', 'insertHR', 'undo', 'redo'
                ],
                height: '100px',
            });
        </script>
    @endpush
