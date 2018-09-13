var activateDeleteFunction = function()
{
    $("span.deleteComment").click(function(event) {
        id = event.target.id;

        // Szöveg elrejtése és/vagy belehelyezése a mod. szövegdobozba.
        $("#commentMain_" + id).fadeOut( "slow", function(){});

         // AJAX Request küldése; a törlés kérése.
        $.ajax({
            url: deleteCommentUrl,
            type: 'post',
            data: {
                    commentId : id,
                    _csrf : csrfToken
                  },
            success: function (data) {
               
            }
        });
    });
};