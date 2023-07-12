@extends('layouts.dashboard.master')
@push('css')
@endpush
@includeIf('layouts.dashboard.partials.css')
@section('title', 'Update Employee')

@section('content')
    @component('components.breadcrumb')
        @slot('bredcrumb_title')
            Home
        @endslot
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item">Employee</li>
        <li class="breadcrumb-item">Update</li>
    @endcomponent
    <div class="container w-50">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Update Employee</h5>
                        <form action="{{ route('employee.update', ['id' => $employee->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row mb-4">
                                <div class="col">
                                    <x-input-label class="form-label" for="type" :value="__('Type')" />
                                    <select class="form-control btn btn-orange" id="type" name="type" required>
                                        <option class="select-placeholder" value="" disabled>Select Type
                                        </option>
                                        <option value="director" {{ $employee->type === 'director' ? 'selected' : '' }}>
                                            Director
                                        </option>
                                        <option value="management_team"
                                            {{ $employee->type === 'management_team' ? 'selected' : '' }}>
                                            Management Team</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex row mb-4">
                                <div class="col">
                                    <x-input-label class="form-label" for="name" :value="__('Name')" />
                                    <span class="text-danger">(*)</span>
                                    <x-text-input class="form-control" id="name" type="text"
                                        value="{{ $employee->name }}" name="name" />
                                </div>
                                <div class="col">
                                    <x-input-label class="form-label" for="designation" :value="__('Designation')" />
                                    <span class="text-danger">(*)</span>
                                    <x-text-input class="form-control" id="designation" type="text"
                                        value="{{ $employee->designation }}" name="designation" />
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <x-input-label class="form-label" for="image" :value="__('Image')" />
                                    <x-text-input class="form-control" id="image" type="file" name="image" />
                                    @if ($employee->image)
                                        <img class="mt-4 shadow bg-body rounded"
                                            src="{{ asset('storage/' . $employee->image) }}" alt="Employee Image"
                                            width="30%">
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <x-input-label class="form-label" for="heading" :value="__('Heading')" />
                                    <span class="text-danger">(*)</span>
                                    <textarea class="form-control" id="heading" name="heading">{{ $employee->heading }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <x-input-label class="form-label" for="message" :value="__('Message')" />
                                    <span class="text-danger">(*)</span>
                                    <textarea class="form-control" id="message" name="message">{{ $employee->message }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <x-input-label class="form-label" for="about" :value="__('About')" />
                                    <span class="text-danger">(*)</span>
                                    <textarea class="form-control" id="about" name="about">{!! $employee->about !!}</textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
