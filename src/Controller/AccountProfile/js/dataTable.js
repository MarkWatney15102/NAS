$(document).ready(function () {
    let table = $('#user_permissions_table');
    let userId = table.data('userid');
    let ajaxUrl = "/api/AccountProfilePermission/load/" + userId;
    table.DataTable( {
        ajax: ajaxUrl
    } );
});