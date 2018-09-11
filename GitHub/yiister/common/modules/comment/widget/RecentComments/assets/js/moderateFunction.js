var activateModerateFunction = function()
{
    /**
    * 
    * @param {int} id
    * @returns {undefined}
    */
    var turnOffModerateMode = function(id)
    {
        $("#"+id).fadeIn("fast", function(){});
        $("#h5_" + id).fadeIn("fast", function(){});
        $("#date_" + id).fadeIn("fast", function(){});
        $("#username_" + id).fadeIn("fast", function(){});
        $("#modTextarea_" + id).fadeOut( "slow", function(){});
        $(".moderateOptions").fadeIn( "fast", function(){});
    };
    
    $("span.moderateToggle").click(function(event) {
        id = event.target.id;

        // Ha szerkesztés közben megegyezik az aktuális érték az originallal, nincs mentés gomb.
        var originalValue = $("#h5_" + id).html();

        // Alapból ne lehessen elküldeni a megváltozatlan kommentet
        var canSave = false;
        $("#save_" + id).css('opacity', '0.3');

        // Szöveg elrejtése és/vagy belehelyezése a mod. szövegdobozba.
        $("#"+id).fadeOut("fast", function(){});
        $("#h5_" + id).fadeOut("fast", function(){});
        $("#date_" + id).fadeOut("fast", function(){});
        $("#username_" + id).fadeOut("fast", function(){});
        $(".moderateOptions").fadeOut( "fast", function(){});
        $("#modTextarea_" + id).fadeIn( "fast", function(){});
        $("#dropdown_" + id).fadeIn( "fast", function(){});
        $("#textarea_" + id).val(originalValue);

        // Keyupos Send button disable UI funkció
        $("#textarea_" + id).keyup(function() {
           if ($("#textarea_" + id).val().length === 0 || $("#textarea_" + id).val() === originalValue) {
               canSave = false;
               $("#save_" + id).css('opacity', '0.3');
           } else {
               canSave = true;
               $("#save_" + id).css('opacity', '1.0');
           }
        });

        // Moderálás mentése
        $("#save_" + id).click(function(event)
        {
            if (canSave) {
                // Új komment szöveg beírása
                $("#h5_" + id).html($("#textarea_" + id).val());

                // AJAX Request küldése
                $.ajax({
                    url: moderateCommentUrl,
                    type: 'post',
                    data: {
                        commentId : id,
                        commentText : $("#h5_" + id).html(),
                        _csrf : csrfToken
                    },
                    success: function (data) {
                       turnOffModerateMode(id);

                       // Ha ide jut a kód, akkor történt módosítás, szóval:
                       $("#modTag_" + id).html("--Szerkesztve-");
                    }
                });
            }
        });

        // Moderálás mellőzése mégse gombra kattintva
         $("#cancel_" + id).click(function(event) {
            turnOffModerateMode(id);
        });
    });
};