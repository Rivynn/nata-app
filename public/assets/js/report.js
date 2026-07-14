$(function () {

    $('#participantReportTable').DataTable({

        responsive: true,

        autoWidth: false,

        pageLength: 25,

        order: [[7, 'desc']],

        language: {

            search: "Cari :",

            lengthMenu: "Tampilkan _MENU_ data",

            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",

            zeroRecords: "Data tidak ditemukan.",

            paginate: {

                first: "Awal",

                last: "Akhir",

                next: "›",

                previous: "‹"

            }

        }

    });

});