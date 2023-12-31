@extends('main')
@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Admins </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a class="btn btn-round btn-primary btn-sm" href="manage_admin.php" title="Add">
                            Add admin
                        </a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="">
                    @if(count($admins) > 0)

                        @if($message)
                            <div class="alert alert-{{ $message['type'] }}">
                                {{ $message['message'] }}
                            </div>
                        @endif
                        <table id="example" class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th>#</th>
                                <th>Username</th>
                                <th class=" no-link last"><span class="nobr">Action</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $key => $admin)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td class="center">
                                        <a class="btn btn-info btn-sm" href="manage_admin.php?id={{ $admin->id }}" title="Edit">Edit</a>
                                        <a class="btn btn-danger btn-sm" href="admins.php?delete={{ $admin->id }}" title="Delete" onclick="return confirm('Are you sure?')">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            No admins found
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="js/datatables/js/jquery.dataTables.js"></script>
<script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
<script>
    $(document).ready(function () {
        $('input.tableflat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });

    var asInitVals = new Array();
    $(document).ready(function () {
        var oTable = $('#example').dataTable({
            "oLanguage": {
                "sSearch": "Search all columns:"
            },
            "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                } //disables sorting for column one
            ],
            'iDisplayLength': 50,
            "sPaginationType": "full_numbers"
        });
        $("tfoot input").keyup(function () {
            /* Filter on the column based on the index of this element's parent <th> */
            oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
        });
        $("tfoot input").each(function (i) {
            asInitVals[i] = this.value;
        });
        $("tfoot input").focus(function () {
            if (this.className == "search_init") {
                this.className = "";
                this.value = "";
            }
        });
        $("tfoot input").blur(function (i) {
            if (this.value == "") {
                this.className = "search_init";
                this.value = asInitVals[$("tfoot input").index(this)];
            }
        });
    });
</script>
@endsection
