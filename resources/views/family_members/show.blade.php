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
                            <form action="{{ route('family-members.store') }}" method="post" id="add-member-form">
                                @csrf
                                <input type="hidden" name="household_id" value="{{ $household_id }}">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control"  name="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control"  name="age" placeholder="Enter age">
                                </div>
                                <div class="form-group">
                                    <label for="sex">Sex</label>
                                    <input type="text" class="form-control" name="sex" placeholder="Enter sex">
                                </div>
                                <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control"  name="occupation" placeholder="Enter occupation">
                                </div>
                                <div class="form-group">
                                    <label for="POF">POF</label>
                                    <input type="text" class="form-control" name="POF" placeholder="Enter POF">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control"  name="status" placeholder="Enter status">
                                </div>
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea class="form-control"  name="remarks" rows="3" placeholder="Enter remarks"></textarea>
                                </div>
                                <hr>
                                <button id="submit-btn" type="submit" class="btn btn-primary">Submit</button>
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
                                @foreach ($family_members as $index => $member)
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
                                            <button class="btn btn-warning btn-sm edit-member" data-index="{{$index}}" data-id="{{ $member->id }}" data-household-id="{{ $member->household_id }}">
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

            var family_members = {!! $family_members !!};
            var member_id = null;

            
            
            $('#add-member-btn').on('click', function () {
                $('#add-member-form').attr('action', "{{ route('family-members.store') }}").attr('method', 'post');
                $('h5.modal-title').text('Add a New Member');
                $('#submit-btn').html('Submit');
                $('#add-member-modal').modal('show');
            });

            $(document).on('click', '.edit-member', function (e) {
                e.preventDefault();
                var index = $(this).data('index');

                member_id = family_members[index].id;

                $('#name').val(family_members[index].name);
                $('#age').val(family_members[index].age);
                $('#sex').val(family_members[index].sex);
                $('#occupation').val(family_members[index].occupation);
                $('#POF').val(family_members[index].POF);
                $('#status').val(family_members[index].status);
                $('#remarks').val(family_members[index].remarks);
                /*$('h5.modal-title').text('Edit a Member');
                $('#submit-btn').html('Update');*/
                
                $('#update-member-form').attr('action', "/family-members/"+member_id);

                var memberId = $(this).data('id');
                var householdId = $(this).data('household-id');
                $('#update-member-modal').modal('show');
                

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

            /*$('#add-member-form').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
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
            });*/
        });
    </script>
@endsection
