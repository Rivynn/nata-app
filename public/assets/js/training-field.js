$(function () {

    function updatePreview() {

        const name = $('#name').val() || 'Jenis Pelatihan';

        const description = $('#description').val() || 'Deskripsi bidang pelatihan.';

        const icon = $('#icon').val();

        const color = $('#color').val();

        $('#previewName').text(name);

        $('#previewDescription').text(description);

        $('#previewIcon')
            .attr('class', icon + ' text-' + color);

        $('#previewBadge')
            .attr('class', 'badge badge-' + color + ' px-3 py-2')
            .text(color.charAt(0).toUpperCase() + color.slice(1));

    }

    $('#name').on('keyup', updatePreview);

    $('#description').on('keyup', updatePreview);

    $('#icon').on('change', updatePreview);

    $('#color').on('change', updatePreview);

    // Preview awal ketika halaman dibuka
    updatePreview();

});