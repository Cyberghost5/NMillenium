@extends('layouts.main')
@section('title')
    {{ __('Onboarding List') }}
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form-horizontal create-form" action="{{ route('onboarding.store') }}" id="onboard-create" enctype="multipart/form-data" method="POST" novalidate>
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">{{ __('Add Onboarding') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form fields for adding new onboarding item -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12 form-group mandatory">
                                            <label for="add_title" class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title"  class="form-control" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12 form-group mandatory">
                                            <label for="add_description" class="form-label">{{ __('Description') }}</label>
                                            <textarea name="description" id="description" class="form-control" cols="7" rows="3" required maxlength="150"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group mandatory">
                                        <label for="image" class="form-label">{{ __('Image') }}</label>
                                        <div class="cs_field_img1">
                                            
                                                <div class="img_input img-fluid"><i class="fas fa-upload "></i> Upload</div>
                                                <input type="file" name="image" class="image" style="display: none" accept=".jpg, .jpeg, .png">
                                            
                                            <div class="image-preview-container">
                                                <img src="{{ asset('assets/images/image_preview.png') }}" alt="" class="img-fluid preview-image" id="image" style="max-width: 100%; height: auto; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 form-group mandatory">
                                        <label for="status" class="form-label">{{ __('Status') }}</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_active" value="1" checked>
                                            <label class="form-check-label" for="status_active">
                                                {{ __('Active') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_inactive" value="0">
                                            <label class="form-check-label" for="status_inactive">
                                                {{ __('Inactive') }}
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary mt-0"
                                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                                    <button type="submit" class="btn btn-primary mt-0">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <p class="card-header-new-style">{{ __('Onboarding List') }}</p>
                                </div>
                                <div class="col-12 col-md-6 d-flex justify-content-end">
                                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                        + {{ __('Add Onboarding') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless" aria-describedby="mydesc" id="table_list"
                                data-toggle="table" data-url="{{ route('onboarding.show', 1) }}" data-click-to-select="true"
                                data-side-pagination="server" data-pagination="true"
                                data-page-list="[5, 10, 20, 50, 100, 200,500,2000]" data-search="true"
                                data-search-align="right" data-toolbar="#toolbar" data-show-columns="true"
                                data-show-refresh="true" data-trim-on-search="false" data-responsive="true"
                                data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3"
                                data-query-params="queryParams" data-table="onboardings" data-use-row-attr-func="true"
                                data-mobile-responsive="true" data-escape="true" data-show-export="true"
                                data-export-options='{"fileName": "onboarding-list","ignoreColumn": ["operate"]}'
                                data-export-types="['pdf','json', 'xml', 'csv', 'txt', 'sql', 'doc', 'excel']">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" data-field="id" data-align="center" data-sortable="true">
                                            {{ __('ID') }}</th>
                                        <th scope="col" data-field="title" data-align="center" data-sortable="true">
                                            {{ __('Title') }}</th>
                                        <th scope="col" data-field="description" data-align="center"
                                            data-escape="false">{{ __('Description') }}</th>
                                        <th scope="col" data-field="image" data-formatter="imageFormatter">
                                            {{ __('Image') }}</th>
                                        {{-- <th scope="col" data-field="image" data-align="center" data-formatter="imageFormatter">{{ __('Image') }}</th> --}}
                                        <th scope="col" data-field="status" data-align="center " data-formatter="newStatusFormatter">{{ __('Status') }}
                                        </th>
                                        <th scope="col" data-field="operate" data-escape="false" data-align="center"
                                            data-sortable="false" data-events="onboardingEvents">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="editModal" class="modal fade modal-lg" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="edit-form" class="form-horizontal edit-form" enctype="multipart/form-data"
                                method="POST" novalidate>
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel1">{{ __('Edit Onboarding') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <input type="hidden" name="edit_id" id="edit_id" class="form-control"
                                            data-parsley-required="true">
                                        <div class="col-md-12 form-group mandatory">
                                            <label for="edit_title"
                                                class="mandatory form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="edit_title" class="form-control"
                                                data-parsley-required="true" maxlength="15">
                                        </div>
                                        <div class="col-md-12 form-group mandatory">
                                            <label for="edit_description"
                                                class="mandatory form-label">{{ __('Description') }}</label>
                                            <textarea name="description" id="edit_description" class="form-control" cols="7" rows="3" maxlength="150"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="edit_image"
                                                class="mandatory form-label">{{ __('Image') }}</label>
                                            <div class="cs_field_img1">
                                                <div class="img_input"><i class="fas fa-upload "></i> Upload</div>
                                                <input type="file" name="image" class="image"
                                                    style="display: none" accept=".jpg, .jpeg, .png, .svg">
                                                <img src="{{ asset('assets/images/image_preview.png') }}" alt=""
                                                    class="img preview-image" id="edit_image">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3 form-group">
                                            <label for="edit_status" class="form-label">{{ __('Status') }}</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="edit_status_active" value="1">
                                                <label class="form-check-label" for="status_active">
                                                    {{ __('Active') }}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="edit_status_inactive" value="0">
                                                <label class="form-check-label" for="status_inactive">
                                                    {{ __('Inactive') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect"
                                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection

    @section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Reset form when modal is closed
            $('#addModal').on('hidden.bs.modal', function () {
                $('#onboard-create')[0].reset();
                // Reset image preview
                $('#image').attr('src', "{{ asset('assets/images/image_preview.png') }}");
            });

            // Image size validation - 2MB max
            // const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2MB in bytes
            /*
            // Add form validation
            $('#onboard-create').on('submit', function(e) {
                const imageInput = $(this).find('input[name="image"]')[0];                
                
                // if (imageInput.files.length > 0) {
                //     const fileSize = imageInput.files[0].size;
                    
                //     if (fileSize > MAX_FILE_SIZE) {
                //         e.preventDefault();
                //         // Swal.fire({
                //         //     icon: 'error',
                //         //     title: 'File Too Large',
                //         //     text: 'The image must not be larger than 2MB.',
                //         //     confirmButtonText: 'OK'
                //         // });
                
                //         return false;
                //     }
                // }
            });
            */
           /*
            // Edit form validation
            $('#edit-form').on('submit', function(e) {
                const imageInput = $(this).find('input[name="image"]')[0];
                
                if (imageInput.files.length > 0) {
                    const fileSize = imageInput.files[0].size;
                    
                    if (fileSize > MAX_FILE_SIZE) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'File Too Large',
                            text: 'The image must not be larger than 2MB.',
                            confirmButtonText: 'OK'
                        });
                        return false;
                    }
                }
            });
            */

            // Image preview functionality for add modal
            $('.img_input').on('click', function() {
                $(this).siblings('.image').click();
            });

            $('.image').on('change', function(e) {
                if (this.files && this.files[0]) {
                    // Check file size
                    // if (this.files[0].size > MAX_FILE_SIZE) {
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: 'File Too Large',
                    //         text: 'The image must not be larger than 2MB. Please choose a smaller image.',
                    //         confirmButtonText: 'OK'
                    //     });
                    //     // Reset file input
                    //     $(this).val('');
                    //     return;
                    // }
                    
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Image preview functionality for edit modal
            $('#editModal .img_input').on('click', function() {
                $(this).siblings('.image').click();
            });

            $('#editModal .image').on('change', function(e) {
                if (this.files && this.files[0]) {
                    // Check file size
                    // if (this.files[0].size > MAX_FILE_SIZE) {
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: 'File Too Large',
                    //         text: 'The image must not be larger than 2MB. Please choose a smaller image.',
                    //         confirmButtonText: 'OK'
                    //     });
                    //     // Reset file input
                    //     $(this).val('');
                    //     return;
                    // }
                    
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#edit_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection