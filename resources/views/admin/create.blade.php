@extends('layouts.layout')

@section('container')
    <div class="container pt-4">
        <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal" id="add-cat">Add
            Category</button>
        <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal" id="edit-cat">edit
            Category</button>

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
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category Type</label>
                                <select class="form-select" aria-label="Default select example" name="type"
                                    id="type">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
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


            // e.preventDefault();


            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('#add-cat').click(function() {

                $('#exampleModal').on('shown.bs.modal', function() {
                    $('#name').focus();
                })

                $('#modal-label').html('Create Category');
                $('#btn-label').html('Save');


                var form = $('#ajaxForm')[0];
                $('#btn-label').click(function() {

                    var formData = new FormData(form);

                    // console.log(name);

                    $.ajax({
                        url: '/categories/store',
                        method: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData,

                        success: function(response) {
                            console.log(response);
                        },
                        failed: function(response) {
                            console.log(response);
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
