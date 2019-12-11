
    function markAsVisited(e) {
        const link = e.target;

        const notifiable_id = link.parentNode.parentNode.getAttribute('notifiable');
        const notification_id = link.parentNode.parentNode.getAttribute('notification');

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

    const links = document.getElementsByClassName('list__item--link');
    for(const link of links){
        link.addEventListener('click', function (e)
        {
            markAsVisited(e)
        });
    }


