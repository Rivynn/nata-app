$(function(){

    function updatePreview(){

        $('#previewName').text(
            $('#name').val() || 'Nama Pelatihan'
        );

        $('#previewQuota').text(
            $('#quota').val() || 0
        );

        $('#previewDuration').text(
            ($('#duration').val() || 0) + ' Hari'
        );

        $('#previewLocation').text(
            $('#location').val() || 'Lokasi'
        );

        let status = $('#status').val();

        $('#previewStatus')
            .removeClass('badge-success badge-danger')
            .addClass(
                status === 'open'
                    ? 'badge badge-success px-3 py-2'
                    : 'badge badge-danger px-3 py-2'
            )
            .text(
                status === 'open'
                    ? 'Dibuka'
                    : 'Ditutup'
            );

        let option = $('#trainingField option:selected');

        if(option.length){

            let icon = option.data('icon') || 'fas fa-book-open';

            let color = option.data('color') || 'primary';

            $('#previewField').text(
                option.text()
            );

            $('#previewIcon')
                .attr(
                    'class',
                    icon + ' text-' + color
                );

        }

    }

    $('#name').keyup(updatePreview);

    $('#quota').keyup(updatePreview);

    $('#duration').keyup(updatePreview);

    $('#location').keyup(updatePreview);

    $('#status').change(updatePreview);

    $('#trainingField').change(updatePreview);

    updatePreview();

});