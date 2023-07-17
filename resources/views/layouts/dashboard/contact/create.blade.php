@extends('layouts.dashboard.master')
@push('css')
@endpush
@includeIf('layouts.dashboard.partials.css')
@section('title', 'Contact With Us')
@section('content')
    @component('components.breadcrumb')
        @slot('bredcrumb_title')
            Home
        @endslot
        <li class="breadcrumb-item">Contact With Us</li>
        <li class="breadcrumb-item">Create</li>
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('contact.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <x-input-label class="form-label" for="name" :value="__('Name')" />
                                    <span class="text-danger">(*)</span>
                                    <x-text-input class="form-control" id="name" type="text"
                                        placeholder="Enter your name here..." required="" name="name" />
                                </div>
                                <div class="col-lg-6">
                                    <x-input-label class="form-label" for="email" :value="__('Email')" />
                                    <span class="text-danger">(*)</span>
                                    <x-text-input class="form-control" id="email" type="email"
                                        placeholder="Enter email is here..." required="" name="email" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <x-input-label class="form-label" for="phoneNumber" :value="__('Phone Number')" />
                                    <span class="text-danger">(*)</span>
                                    <x-text-input class="form-control" id="phoneNumber" type="tel"
                                        placeholder="Enter phone number name..." required="" name="phoneNumber" />
                                </div>
                                <div class="col-lg-6">
                                    <x-input-label class="form-label" for="inquiry" :value="__('Inquiry')" />
                                    <span class="text-danger">(*)</span>
                                    <select class="form-control btn btn-orange" id="inquiry" name="inquiry" required>
                                        <option class="select-placeholder btn btn-orange" value="" disabled selected>
                                            Select Inquiry
                                        </option>
                                        <option value="innovations">Neocon Innovations Limited</option>
                                        <option value="technologies">Neocon Technologies Limited</option>
                                        <option value="gateway">Neocon Gateway Limited</option>
                                        <option value="ksl">Kabir Securities Limited</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <x-input-label class="form-label" for="reason" :value="__('Describe Your Inquiry')" />
                                    <span class="text-danger">(*)</span>
                                    <textarea class="form-control" id="reason" required="" placeholder="Enter your inquiry..." name="reason"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
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
        var editor = new FroalaEditor('#reason', {
            pluginsEnable: ['insertUnorderedList', 'fullscreen', 'bold', 'italic', 'underline', 'strikeThrough',
                'subscript', 'superscript', 'fontFamily', 'fontSize', 'color', 'align', 'outdent', 'indent',
                'quote', 'insertLink',
                'insertImage', 'insertTable', 'insertHR', 'undo', 'redo'
            ],
            height: '100px',
        });
    </script>
@endpush
