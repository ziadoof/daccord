function markAsVisited(e) {
    var link = e.target;
    var notifiable_id = link.parentNode.parentNode.getAttribute('notifiable');
    var notification_id =link.parentNode.parentNode.getAttribute('notification');
    if (notification_id !==null && notifiable_id !== null){
        var url = Routing.generate('notification_mark_as_seen',{notifiable:notifiable_id,notification:notification_id});
        $.ajax({
            url: url,
            async: true,
            type: "POST",
            success: function (response) {
            }
        });
    }
}
var links = document.getElementsByClassName('list__item--link');
for(var link of links){
    link.addEventListener('click', function (e)
    {
        markAsVisited(e)
    });
}
