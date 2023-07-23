@extends('layouts.dashboard.master')
@push('css')
@endpush
@includeIf('layouts.dashboard.partials.css')
@section('title', 'Update Product')

@section('content')
    @component('components.breadcrumb')
        @slot('bredcrumb_title')
            Home
        @endslot
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item">Update</li>
    @endcomponent
    <div class="container w-50">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Update Product</h5>
                        <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="d-flex row my-4">
                                <div class="col-sm-4">
                                    <x-input-label class="form-label" for="name" :value="__('Name')" />
                                    <x-text-input class="form-control" id="name" type="text"
                                        value="{{ $product->name }}" name="name" />
                                </div>
                                <div class="col-sm-4">
                                    <x-input-label class="form-label" for="title" :value="__('Title')" />
                                    <x-text-input class="form-control" id="title" type="text"
                                        value="{{ $product->title }}" name="title" />
                                </div>
                                {{-- single_image-start --}}
                                <div class="col-sm-4">
                                    <div class="col-sm-12">
                                        <x-input-label class="form-label" for="single_image" :value="__('Single Image')" />
                                        <x-text-input class="form-control" id="single_image" type="file"
                                            name="single_image" />
                                        @if ($product->single_image)
                                            <img class="mt-4 shadow bg-body rounded"
                                                src="{{ asset('storage/' . $product->single_image) }}"
                                                alt="Product Single Image" width="40%">
                                        @endif
                                    </div>
                                </div>
                                {{-- single_image-end --}}
                            </div>
                            {{-- multi_image-start --}}
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <div class="my-4">
                                        <x-input-label class="form-label" for="image" :value="__('Add/Update Multiple Images')" />
                                        <x-text-input class="form-control" id="image" type="file" name="image[]"
                                            multiple />
                                    </div>

                                    <div id="image-container">
                                        <x-input-label class="form-label" for="image" :value="__('Previous Multiple Images')" />
                                        @if (is_array($product->image) && count($product->image) > 0)
                                            @foreach ($product->image as $index => $imagePath)
                                                @if ($index % 3 === 0)
                                                    <div class="row">
                                                @endif
                                                <div class="col-sm-4">
                                                    <div class="image-item mb-2" style="position: relative;">
                                                        <img class="mt-2 shadow bg-body rounded"
                                                            src="{{ asset('storage/' . $imagePath) }}" alt="Product Image"
                                                            width="100%">
                                                        <button class="btn btn-orange remove-image"
                                                            onclick="removeImage({{ $index }})">X</button>
                                                        <input type="hidden" name="image[]" value="{{ $imagePath }}">
                                                    </div>
                                                </div>
                                                @if (($index + 1) % 3 === 0 || $index === count($product->image) - 1)
                                    </div>
                                    @endif
                                    @endforeach
                                @elseif (!is_array($product->image) && !empty($product->image))
                                    <div class="image-item me-1" style="position: relative;">
                                        <img class="mt-4 shadow bg-body rounded"
                                            src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                            width="100%">
                                        <button class="btn btn-orange remove-image" onclick="removeImage(0)">X</button>
                                        <!-- For single image, set index to 0 -->
                                        <input type="hidden" name="image[]" value="{{ $product->image }}">
                                    </div>
                                    @endif
                                </div>
                            </div>
                    </div>
                    {{-- multi_image-end --}}
                    <div class="row mb-4">
                        <div class="col">
                            <x-input-label class="form-label" for="description" :value="__('Description')" />
                            <textarea class="form-control" id="description" name="description">{!! $product->description !!}</textarea>
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
        var editor = new FroalaEditor('#description', {
            pluginsEnable: ['insertUnorderedList', 'fullscreen', 'bold', 'italic', 'underline', 'strikeThrough',
                'subscript', 'superscript', 'fontFamily', 'fontSize', 'color', 'align', 'outdent', 'indent',
                'quote', 'insertLink',
                'insertImage', 'insertTable', 'insertHR', 'undo', 'redo'
            ],
            height: '100px',
        });
        //removeIamge
        function removeImage(index) {
            let container = document.getElementById('image-container');
            let images = container.getElementsByClassName('image-item');
            let imageInput = document.getElementsByName('image[]')[index];

            // If the image exists in the database (not a new image), add its index to the remove_images input
            if (imageInput && imageInput.value !== '') {
                let removeInput = document.createElement('input');
                removeInput.setAttribute('type', 'hidden');
                removeInput.setAttribute('name', 'remove_images[]');
                removeInput.value = index;
                container.appendChild(removeInput);
            }
            // Remove the image item from the container
            images[index].remove();
        }
    </script>
@endpush
