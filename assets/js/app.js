$(document).ready(function () {
    $('#searchTitle').keyup(function () {
        let search = $(this).val();

        if (search.length >= 2) {
            $.ajax({
                url: '/~2414241/music-library/api_search.php', 
                type: 'GET',
                data: { term: search },
                success: function (response) {
                    let suggestions = '';
                    response.forEach(song => {
                        suggestions += `<li class="list-group-item">
                            <a href="index.php?title=${song.title}">
                                🎵 ${song.title} – ${song.artist}
                            </a></li>`;
                    });
                    $('#suggestions').html(suggestions).show();
                },
                error: function () {
                    console.log("AJAX request failed!");
                }
            });
        } else {
            $('#suggestions').hide();
        }
    });

    $(document).on('click', '#suggestions li', function () {
        $('#searchTitle').val($(this).text().trim());
        $('#suggestions').hide();
    });
});
