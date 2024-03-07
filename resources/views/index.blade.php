@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="page-content">
            
        
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Disaster Response Action Form</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Household</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" id="table-res">
                            <table id="ajax-crud-datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>fhname</th>
                                        <th>serial_no</th>
                                        <th>address</th>
                                        <th>NOFHH</th>
                                        <th>NOLHH</th>
                                        <th>insurance</th>
                                        <th>TFI</th>
                                        <th>wall_materials</th>
                                        <th>roof_materials</th>
                                        <th>house_and_lot</th>
                                        <th>disaster_prone</th>
                                        <th>date_interviewed</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
 
<!-- bootstrap Household model -->
<!-- bootstrap Household model -->
        <div class="modal fade" id="Household-modal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Household</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="HouseholdForm" name="HouseholdForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="fhname" class="col-sm-2 control-label">Family Head Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="fhname" name="fhname" placeholder="Enter Family Head Name" maxlength="50" required="">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="serial_no" class="col-sm-2 control-label">Serial Number</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="serial_no" name="serial_no" placeholder="Enter Serial Number" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NOFHH" class="col-sm-2 control-label">Number of Family Household</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="NOFHH" name="NOFHH" placeholder="Enter Number of Family Household" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NOLHH" class="col-sm-2 control-label">Number of Living Household</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="NOLHH" name="NOLHH" placeholder="Enter Number of Living Household" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="insurance" class="col-sm-2 control-label">Insurance</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="insurance" name="insurance" placeholder="Enter Insurance" required="">
                                </div>
                            </div>
                           <div class="form-group">
                                <label for="TFI" class="col-sm-2 control-label">TFI</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="TFI" name="TFI" placeholder="Enter TFI" required="" max="99999999999999999999" step="0.01">
                                    <div class="invalid-feedback">
                                        Please provide a valid TFI (maximum 20 digits with up to 2 decimal places).
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="wall_materials" class="col-sm-2 control-label">Wall Materials</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="wall_materials" name="wall_materials">
                                        <option value="Option 1">Option 1</option>
                                        <option value="Option 2">Option 2</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="roof_materials" class="col-sm-2 control-label">Roof Materials</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="roof_materials" name="roof_materials">
                                        <option value="Option 1">Option 1</option>
                                        <option value="Option 2">Option 2</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="house_and_lot" class="col-sm-2 control-label">House and Lot</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="house_and_lot" name="house_and_lot">
                                        <option value="Option 1">Option 1</option>
                                        <option value="Option 2">Option 2</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="disaster_prone" class="col-sm-2 control-label">Disaster Prone</label>
                                 <div class="col-sm-12">
                                    <select class="form-control" id="disaster_prone" name="disaster_prone">
                                        <option value="Tsunami">Tsunami</option>
                                        <option value="Flash Flood">Flash Flood</option>
                                        <option value="EarthQuake">EarthQuake</option>
                                        <option value="Volcanic Eruption">Volcanic Eruption</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_interviewed" class="col-sm-2 control-label">Date Interviewed</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="date_interviewed" name="date_interviewed" required="">
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10"><br/>
                                <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    
<script type="text/javascript">
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#ajax-crud-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('ajax-crud-datatable') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'fhname', name: 'fhname' },
            { data: 'serial_no', name: 'serial_no' },
            { data: 'address', name: 'address' },
            { data: 'NOFHH', name: 'NOFHH' },
            { data: 'NOLHH', name: 'NOLHH' },
            { data: 'insurance', name: 'insurance' },
            { data: 'TFI', name: 'TFI' },
            { data: 'wall_materials', name: 'wall_materials' },
            { data: 'roof_materials', name: 'roof_materials' },
            { data: 'house_and_lot', name: 'house_and_lot' },
            { data: 'disaster_prone', name: 'disaster_prone' },
            { data: 'date_interviewed', name: 'date_interviewed' },
            { data: 'action', name: 'action', orderable: false },
        ],
        order: [[0, 'desc']],
        buttons: [ // Add DataTables buttons configuration
            {
                extend: 'collection',
                text: 'Import',
                buttons: ['copy', 'excel', 'pdf', 'print'],
                className: 'btn btn-primary'
            }
        ]
    });

    table.buttons().container().appendTo('#t .col-md-6:eq(0)');

});

function add() {
    $('#HouseholdForm').trigger("reset");
    $('#Household-modal').modal('show');
    $('#id').val('');
}

function editFunc(id) {
    $.ajax({
        type: "POST",
        url: "{{ url('edit') }}",
        data: { id: id },
        dataType: 'json',
        success: function (res) {
            $('#Household-modal').modal('show');
            $('#id').val(res.id);
            $('#fhname').val(res.fhname);
            $('#serial_no').val(res.serial_no);
            $('#address').val(res.address);
            $('#NOFHH').val(res.NOFHH);
            $('#NOLHH').val(res.NOLHH);
            $('#insurance').val(res.insurance);
            $('#TFI').val(res.TFI);
            $('#wall_materials').val(res.wall_materials);
            $('#roof_materials').val(res.roof_materials);
            $('#house_and_lot').val(res.house_and_lot);
            $('#disaster_prone').val(res.disaster_prone);
            $('#date_interviewed').val(res.date_interviewed);
        }
    });
}

function deleteFunc(id) {
    if (confirm("Delete Record?") == true) {
        var id = id;
        // ajax
        $.ajax({
            type: "POST",
            url: "{{ url('delete') }}",
            data: { id: id },
            dataType: 'json',
            success: function (res) {
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
            }
        });
    }
}

$('#HouseholdForm').submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ url('store')}}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            $("#Household-modal").modal('hide');
            var oTable = $('#ajax-crud-datatable').dataTable();
            oTable.fnDraw(false);
            $("#btn-save").html('Submit');
            $("#btn-save").attr("disabled", false);
        },
        error: function (data) {
            console.log(data);
        }
    });
});
</script>
<!-- end bootstrap model -->
@endsection
