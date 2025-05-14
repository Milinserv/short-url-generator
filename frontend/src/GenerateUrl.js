$(document).ready(function() {
    $('#generateButton').click(function(event) {
        $('#resultGenerate').remove();
        $('#loadingGenerate').remove();

        $('#modalBodyGenerate').append($('<div id="loadingGenerate">Генерация...</div>'))

        $.ajax({
            url: "http://localhost:8000/backend/router/api.php?gen=true",
            method: "GET",
            dataType: 'json',
            success: function (response) {
                const res = JSON.parse(response);
                $('#loadingGenerate').remove();

                $('#modalBodyGenerate').append($('<div id="resultGenerate"></div>'))
                $('#resultGenerate').append(res);
            }
        });
    })
})