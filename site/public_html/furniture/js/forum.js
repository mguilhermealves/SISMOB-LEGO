$("#like_forum_response").on("click", function() {
    var userId = $(this).data("userid");
    var objectId = $(this).data("objectid");
    var type = "response_like";

    like_response(userId, objectId, type);
});

function like_response(userId, objectId, type) {
    $.ajax({
        method: "POST",
        url: '/like_response',
        data: {
            user_id: userId, 
            object_id: objectId,
            type: type 
        },
        beforeSend: function() {},
        success: function(data) {
           console.log(data);
        }
    });
}