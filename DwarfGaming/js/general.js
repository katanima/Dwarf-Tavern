$(document).ready(function(){

    $("#searchButton1").on("click", function() {

        const akapit = $(this);

        $.post("searchRooms.php", { name: $("#searchByName").val(), full: $("#searchForEmpty").val() }, function(data) {

            if(data === "sukces") {
                
                akapit.attr("src", (akapit.attr("src") == "../icons/likeButtonLiked.png") ? "../icons/likeButtonUnliked.png" : "../icons/likeButtonLiked.png");
            }
        });
    })
});