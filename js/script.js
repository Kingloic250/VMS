

$(document).ready(function() {

    // Live search using AJAX

    $('#live_search').keyup(function () {
        let search = $(this).val();
        if (search != '') {
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {search: search},
                success: function (data) {
                    $('#search_result').html(data);
                    $('#search_result').css('display','block');
                    $('#search_result p').click(function () {
                        let value = $(this).html();
                        $('#live_search').val(value);
                        $('#search_result').css('display','none');
                    });
                }
            });
        }
        else{
            $('#search_result').css('display','none');
        }
    });

    $('#search').keyup(function () {
        let searching = $(this).val();
        if (searching != '') {
            $.ajax({
                url: 'searching.php',
                method: 'POST',
                data: {search: searching},
                success: function (data) {
                    $('#result').html(data);
                    $('#result').css('display','block');
                    $('#result p').click(function () {
                        let value = $(this).html();
                        $('#search').val(value);
                        $('#result').css('display','none');
                    });
                }
            });
        }
        else{
            $('#result').css('display','none');
        }
    });
    
});