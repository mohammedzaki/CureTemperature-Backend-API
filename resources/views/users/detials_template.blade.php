<script id="users-details-template" type="text/x-handlebars-template">
    <table class="table dataTable no-footer users-details-table" id="users-@{{id}}">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
    </table>
</script>
<script type="text/javascript">
    let usersDetailsTemplate = Handlebars.compile($('#users-details-template').html());
    // Add event listener for opening and closing details
    var table = $('#dataTableBuilder').DataTable();
    console.log(table);
    $('#dataTableBuilder tbody').on('click', 'td .users-details-control', function () {
      let tr = $(this).closest('tr');
      let row = table.row(tr);
      let usersDetailsTableId = 'users-' + row.data().id;

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
      } else {
        // Open this row
        row.child(usersDetailsTemplate(row.data())).show();
        initUsersDetailsTable(usersDetailsTableId, row.data());
        tr.addClass('shown');
        tr.next().find('td').addClass('no-padding bg-gray row-detials');
      }
    });

    function initUsersDetailsTable(tableId, data) {
      $('#' + tableId).DataTable({
        processing: true,
        serverSide: true,
        ajax: data.users_details_url,
        columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' }
        ],
        dom: 'Bfrtip',
        buttons: [ 'export' ]
      })
    }
</script>
