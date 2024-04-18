@extends('admin.layouts.master')
@section("title")
Store Owners | Dashboard
@endsection
@section('content')

<div class="content mt-3">
    <div class="d-flex justify-content-between my-2">
        <h3><strong> <i class="icon-circle-right2 mr-2"></i> Store Owners</strong></h3>
        <div>
            <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left" id="clearFilterAndState"> <b><i class=" icon-reload-alt"></i></b> Reset All Filters</button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-striped" id="usersDatatable" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created Date</th>
                            <th class="text-center"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('body').tooltip({selector: '[data-popup="tooltip"]'});
     var datatable = $('#usersDatatable').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        lengthMenu: [ 10, 25, 50, 100, 200, 500 ],
        order: [[ 0, "desc" ]],
        ajax: '{{ route('admin.storeOwnerUsersDatatable') }}',
        columns: [
            {data: 'id', visible: false, searchable: false},
            {data: 'name'},
            {data: 'email'},
            {data: 'phone'},
            {data: 'created_at'},
            {data: 'action', sortable: false, searchable: false},
        ],
        colReorder: true,
        drawCallback: function( settings ) {
            $('select').select2({
               minimumResultsForSearch: Infinity,
               width: 'auto'
            });
        },
        scrollX: true,
        scrollCollapse: true,
        dom: '<"custom-processing-banner"r>flBtip',
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search with anything...',
            lengthMenu: '_MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
            processing: '<i class="icon-spinner10 spinner position-left mr-1"></i>Waiting for server response...'
        },
       buttons: {
               dom: {
                   button: {
                       className: 'btn btn-default'
                   }
               },
               buttons: [
                   {extend: 'csv', filename: 'store-owners-'+ new Date().toISOString().slice(0,10), text: 'Export as CSV'},
               ]
           }
    });

     $('#clearFilterAndState').click(function(event) {
        if (datatable) {
            datatable.state.clear();
            window.location.reload();
        }
     });
</script>
@endsection