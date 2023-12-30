@extends('layouts.layout')

@section('container')
    <div class="container pt-4">
        <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal" id="add-cat">Add
            Category</button>
        <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal" id="edit-cat">edit
            Category</button>


        <div class="container mt-4">
            <table class="table" id="categories">
                {{-- <caption>List Categories</caption> --}}
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form id="ajaxForm">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modal-label"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                                <p id="name-error" class="text-danger error-messages"></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category Type</label>
                                <select class="form-select" aria-label="Default select example" name="type"
                                    id="type">
                                    <option selected>Choose</option>
                                    <option value="One">One</option>
                                    <option value="Two">Two</option>
                                    <option value="Three">Three</option>
                                </select>
                                <p id="type-error" class="text-danger error-messages"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn-label">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script>
        $(document).ready(function() {

            $('#categories').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/categories",
                    columns: [{
                        data: 'id'
                    }, {
                        data: 'name'
                    }, {
                        data: 'type'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }, ],

                }),

                $('#add-cat').click(function() {

                    $('#exampleModal').on('shown.bs.modal', function() {
                        $('#name').focus();
                    })

                    $('#modal-label').html('Create Category');
                    $('#btn-label').html('Save');


                    var form = $('#ajaxForm')[0];


                    $('#btn-label').click(function(e) {

                        e.preventDefault();

                        var formData = new FormData(form);

                        $('.error-messages').html('');

                        $.ajax({
                            url: '/categories/store',
                            method: 'POST',
                            processData: false,
                            contentType: false,
                            data: formData,

                            success: function(response) {
                                if (response) {
                                    swal("Success", response.message, "success");
                                    $(function() {
                                        $('#exampleModal').modal('toggle');
                                    });
                                }
                            },
                            error: function(error) {
                                if (error) {
                                    $('#name-error').html(error.responseJSON.errors.name);
                                    $('#type-error').html(error.responseJSON.errors.type);
                                }
                            },
                        });

                    });

                });
            $('#edit-cat').click(function() {
                $('#modal-label').html('Create PPPP');
                $('#btn-label').html('Save');
            });
        });
    </script>
@endsection
