// Call the DataTables plugin
$(function () {

    const defaultOptions = {

        responsive: true,

        autoWidth: false,

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        ordering: true,

        searching: true,

        info: true,

        paging: true,

        language: {

            search: "",

            searchPlaceholder: "Cari data...",

            lengthMenu: "Tampilkan _MENU_ data",

            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",

            infoEmpty: "Belum ada data",

            zeroRecords: "Data tidak ditemukan",

            emptyTable: "Belum ada data",

            paginate: {

                first: "<<",

                previous: "<",

                next: ">",

                last: ">>"

            }

        }

    };

    $('#verificationTable').DataTable(defaultOptions);

    $('#participantsTable').DataTable(defaultOptions);
    $('#participantTable').DataTable(defaultOptions);
    $('#usersTable').DataTable(defaultOptions);
    $('#employeesTable').DataTable(defaultOptions);
    $('#trainingFieldsTable').DataTable(defaultOptions);
    //$('#trainingTable').DataTable(defaultOptions);

    // $('#verificationTable').DataTable(defaultOptions);
    //
    // $('#registrationTable').DataTable(defaultOptions);
    //
    // $('#certificateTable').DataTable(defaultOptions);
    //
    // $('#trainingTable').DataTable(defaultOptions);
    //
    // $('#fieldTable').DataTable(defaultOptions);
    //
    // $('#userTable').DataTable(defaultOptions);

});
