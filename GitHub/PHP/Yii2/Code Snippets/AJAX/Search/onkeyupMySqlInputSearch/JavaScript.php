<?php
//User list filter functionality. Bug: also searched through the html tags inside.
JSRegister::begin([
    'position' => \yii\web\View::POS_READY,
]); ?>
<script>
    $("#searchPostsField").focusin(function()
    {
        $(this).attr('placeholder', '');
    });
    
    $("#searchPostsField").focusout(function()
    {
        $(this).attr('placeholder', 'Search...');
    });
    
    /***********************************
     * SEARCHING
     ***********************************/
    function searchInDb()
    {
        $.ajax({
            url: '<?= $searchActionUrl ?>',
            type: 'post',
            data: {
                searchString: $("#searchPostsField").val(),
                _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
            },
            success: function (data) {
                if (data.empty === "notEmpty") {
                    $("#postsContainer").html("");
                    $("#postsContainer").html(data.posts);
                } else {
                    $("#postsContainer").html("");
                    $("#postsContainer").html("<h4 class=\"noPosts\">Nincs megjelenítendő bejegyzés</h4>");
                }
            }
        });
    }
    
    var timeoutHandle;
    function invocation()
    {
        timeoutHandle = window.setTimeout( 
        function() {
            searchInDb();
        }, 500);
    }
    $("#searchPostsField").on('keyup', function()
    {
        clearTimeout(timeoutHandle);
        if ($("#searchPostsField").val().trim().length !== 0) {
            invocation();
        }
        
        // If the user deleted the search string then reload all posts
        else {
            location.reload();
        }
    });
</script>
<?php JSRegister::end(); ?>