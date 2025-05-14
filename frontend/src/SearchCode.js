$(document).ready(function() {
    $('#searchCodeButton').click(function (event) {
        const code = $('#code').val();

        $('#resultSearch').remove();
        $('#loadingSearch').remove();

        $('#modalBodySearch').append($('<div id="loadingSearch">Поиск...</div>'))

        if (code) {
            $.ajax({
                url: "http://localhost:8000/backend/router/api.php?code=" + code,
                method: "GET",
                dataType: 'json',
                success: function (response) {
                    const res = JSON.parse(response);
                    $('#loadingSearch').remove();

                    $('#modalBodySearch').append($('<div id="resultSearch" class="pt-2"></div>'));
                    $('#resultSearch').append(res);

                    if (!res.includes('Data not found for code')) {
                        $('#viewCodeDataLink').attr('style', 'display: block !important;');
                    }
                }
            });
        }
    })
})