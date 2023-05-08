$(function () {
    $("#table_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/user-list",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

});
