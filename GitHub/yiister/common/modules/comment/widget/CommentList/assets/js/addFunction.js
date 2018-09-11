var activateAddFunction = function (commentAdded)
{
    // Billentyűnyomásos kilensvalidáció
    $("#writeComment textarea").keyup(function()
    {
       if ($("#writeComment textarea").val().length === 0) {
           $('#submitComment').prop('disabled', true);
       } else {
           $('#submitComment').prop('disabled', false);
       }
    });
    
    // Form feladása (csak egy textarea, nem is form igazából)
    $("#submitComment").click(function(event) {
        event.preventDefault();
        $.ajax
        ({
            url: addCommentUrl,
            type: 'post',
            data:
            {
                postId: postId,
                commentText: $("#writeComment textarea").val(),
                _csrf : csrfToken,
            },
            success: function (data)
            {
                // Gomb deaktiválása és szöveg törlése
                $("#writeComment textarea").val("");
                $("#writeComment button").prop("disabled", true);
                
                $("div#commentListWidget").children().first().prepend(data.freshComment);
                
                // Néhány esetleges korrekció
                $("#noComment").hide();
                
                // Listenerek újrainicializálása
                activateModerateFunction();
                activateDeleteFunction();
            }
        });
    });
};
   