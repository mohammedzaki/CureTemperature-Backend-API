<script id="devices-details-template" type="text/x-handlebars-template">
    <table class="table dataTable no-footer devices-details-table" id="devices-@{{id}}">
        <thead>
            <tr>
                <th>Name</th>
                <th>Serial Number</th>
                <th>Device Category Name</th>
            </tr>
        </thead>
    </table>
</script>
<script type="text/javascript">
     let devicesDetailsTemplate = Handlebars.compile($('#devices-details-template').html());
// Add event listener for opening and closing details
     var table = $('#dataTableBuilder').DataTable();
    console.log(table);
    $('#dataTableBuilder tbody').on('click', 'td .devices-details-control', function () {
      let tr = $(this).closest('tr');
      let row = table.row(tr);
      let devicesDetailsTableId = 'devices-' + row.data().id;

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
      } else {
        // Open this row
        row.child(devicesDetailsTemplate(row.data())).show();
        initDevicesDetailsTable(devicesDetailsTableId, row.data());
        tr.addClass('shown');
        tr.next().find('td').addClass('no-padding bg-gray row-detials');
      }
    });

    function initDevicesDetailsTable(tableId, data) {
      $('#' + tableId).DataTable({
        processing: true,
        serverSide: true,
        ajax: data.devices_details_url,
        columns: [
          //{ data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'serial_number', name: 'serial_number' },
          { data: 'deviceCategoryName', name: 'deviceCategoryName' }
        ],
        dom: 'Bfrtip',
        buttons: [ 'export' ]
      })
    }
</script>
