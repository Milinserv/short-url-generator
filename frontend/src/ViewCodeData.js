$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const data = urlParams.get('code');
    const mainBlock = document.getElementById('main');

    if (data) {
        loadCodeData(data);
        mainBlock.style.display = 'none';
    }
    function loadCodeData(code) {
        // Загружаем содержимое viewCodeData.html через AJAX
        $('#content').load('viewCodeData.html', { code: code });
    }

    $('#viewCodeDataLink').click(function (event) {
        const code = $('#code').val();

        if (code) {
            window.location.href = '/?code=' + code;
        }
    })
})