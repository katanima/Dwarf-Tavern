$(document).ready(function () {

    /* refresh chat every second */
    var intervalId = window.setInterval(refreshMessages, 1000);

    refreshMessages();

    function refreshMessages() {

        //alert($("#sendMessage").data("id"));

        $.post("generateMessages.php",
            {
                id: $("#sendMessage").data("id"),
                chatType: $("#sendMessage").data("type")
            },
            function (data) {

                $("#messages").empty();
                $("#messages").append(data);


                /* join room */
                $(".join").on("click", function () {

                    $roomId = $(this).data("roomid");

                    $.post("joinRoom.php",
                        { roomId: $roomId },
                        function (data) {

                            if (data === "banned") {

                                alert("Posiadasz bana w tym pokoju.");

                            } else if (data === "full") {

                                alert("Pokój jest pełny.");

                            } else if (data === "password") {



                            } else {

                                $url = "./room.php?roomId=" + $roomId;
                                location.replace($url);
                            }

                        });
                });


            });
    }


    /* send message */
    $("#sendMessage").on("click", function () {

        const akapit = $(this);

        $.post("sendMessage.php",
            {
                content: $("#messageContent").val(),
                id: akapit.data("id"),
                chatType: akapit.data("type")
            },
            function (data) {

                if (data === "success") {

                    $("#messageContent").empty();

                    refreshMessages();

                } else {

                    alert(data);
                }
            });
    });


    /* refresh room list */
    refreshList();

    $(".refresh").on("click", function () {

        refreshList();
    });

    function refreshList() {

        $.post("generateRooms.php",
            {
                roomName: $("#roomName").val(),
                hideFull: $("#hideFull").is(':checked'),
                considerInterests: $("#considerInterests").is(':checked')
            },
            function (data) {

                $("#listOfRooms").empty();
                $("#listOfRooms").append(data);
            });
    }


    /* popup create room form */
    $(".createRoom").slideUp(0);
    var createFormOpen = false;

    $("#createRoom").on("click", function () {

        if (createFormOpen == false) {

            $(".createRoom").slideDown();
            createFormOpen = true;

        } else {

            $(".createRoom").slideUp();
            createFormOpen = false;
        }
    });


    /* popup filter */
    $(".filter").slideUp(0);
    var filterOpen = false;

    $("#filter").on("click", function () {

        if (filterOpen == false) {

            $(".filter").slideDown();
            filterOpen = true;

        } else {

            $(".filter").slideUp();
            filterOpen = false;
        }
    });





    /* display room edit form */
    $editMode = false;
    $("#editButton").on("click", function () {

        if ($editMode == false) {

            $("#editForm").css("display", "block");
            $("#roomInformations").css(" display", "none");
            $("#editButton").text("Cofnij edytowanie");
            $editMode = true;

        } else {

            $("#roomInformations").css("display", "block");
            $("#editForm").css("display", "none");
            $("#editButton").text("Edytuj pokój");
            $editMode = false;
        }
    });

    /* edit room */
    $("#editRoom").on("click", function () {

        const akapit = $(this);

        $.post("updateRoom.php",
            { roomId: akapit.data("room"), ownerNickname: akapit.data("owner"), roomName: $("#roomName").val(), roomDescription: $("#roomDescription").val(), roomGame: $("#roomGame").val(), roomLimit: $("#roomLimit").val(), roomStrictLimit: $("#roomStrictLimit").val() },
            function (data) {

                $("#roomInformations").css("display", "block");
                $("#editForm").css("display", "none");
                $("#editButton").text("Edytuj pokój");
                $editMode = false;

                $("#roomInformations").empty();
                $("#roomInformations").append(data);
            });
    });


    /* leave room */
    $(".leaveRoom").on("click", function () {
        alert("xd");

        const akapit = $(this);

        $.post("leaveRoom.php",
            { roomId: akapit.data("room") },
            function (data) {

                alert(data);

                refreshList();
            });
    });


    /* leave room */
    $("#leaveRoom").on("click", function () {

        const akapit = $(this);

        $.post("leaveRoom.php",
            { roomId: akapit.data("room") },
            function (data) {

                refreshList();

            });
    });


    $("#submit").on("click", function () {

        $.post("searchUsers.php",
            {
                nick: $("#nick").val(),
                interestId: $("#interest").val()
            },
            function (data) {

                $("#userList").empty();

                var tableTop = "<table>";
                var tableBottom = "<table>";
                $("#userList").append(tableTop, data, tableBottom);
            });
    });
});


