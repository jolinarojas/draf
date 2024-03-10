@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="page-content">
            <!-- Button trigger modal -->
            <button type="button" id="add-member-btn" class="btn btn-primary">Add a Member</button>
            <hr>
            <!-- Modal -->
            <div class="modal fade" id="add-member-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add a new Member</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('family-members.store') }}" method="POST" id="add-member-form">
                                @csrf
                                <input type="hidden" name="household_id" value="{{ $household_id }}">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control" id="age" name="age" placeholder="Enter age">
                                </div>
                                <div class="form-group">
                                    <label for="sex">Sex</label>
                                    <input type="text" class="form-control" id="sex" name="sex" placeholder="Enter sex">
                                </div>
                                <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Enter occupation">
                                </div>
                                <div class="form-group">
                                    <label for="POF">POF</label>
                                    <input type="text" class="form-control" id="POF" name="POF" placeholder="Enter POF">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" name="status" placeholder="Enter status">
                                </div>
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder="Enter remarks"></textarea>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="ajax-crud-datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>Occupation</th>
                                    <th>POF</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($family_members as $member)
                                    <tr>
                                        <td>{{ $member->id }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->age }}</td>
                                        <td>{{ $member->sex }}</td>
                                        <td>{{ $member->occupation }}</td>
                                        <td>{{ $member->POF }}</td>
                                        <td>{{ $member->status }}</td>
                                        <td>{{ $member->remarks }}</td>
                                        <td>{{ $member->created_at }}</td>
                                        <td>{{ $member->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-member" data-id="{{ $member->id }}" data-household-id="{{ $member->household_id }}">
                                                <i class="bx bx-pencil"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm delete-member" data-id="{{ $member->id }}" data-household-id="{{ $member->household_id }}">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#add-member-btn').on('click', function () {
                $('#add-member-modal').modal('show');
            });

            $(document).on('click', '.edit-member', function () {
                var memberId = $(this).data('id');
                var householdId = $(this).data('household-id');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('family-members')}}/" + memberId,
                    success: function (data) {
                        $('#name').val(data.name);
                        $('#age').val(data.age);
                        $('#sex').val(data.sex);
                        $('#occupation').val(data.occupation);
                        $('#POF').val(data.POF);
                        $('#status').val(data.status);
                        $('#remarks').val(data.remarks);
                        $('#add-member-form').attr('action', "{{ url('family-members')}}/" + memberId + "?household_id=" + householdId);
                        $('#add-member-modal').modal('show');
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            $(document).on('click', '.delete-member', function (e) {
                e.preventDefault();
                var that = $(this);
                var memberId = $(this).data('id');
                var householdId = $(this).data('household-id');
                if (confirm("Are you sure you want to delete this member?")) {
                    $.ajax({
                        type: 'DELETE',
                        url: "{{ url('family-members')}}/" + memberId,
                        data: { household_id: householdId },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            $(that).parent().parent().remove();
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }
            });

            $('#add-member-form').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = $(this).attr('action');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
