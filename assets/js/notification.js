(function() {
        // ajax request to mark a notification as seen
        function markAsSeen(e) {
            var xhttp = new XMLHttpRequest();
            var element = e.target;
            xhttp.onreadystatechange = function () {
                // on success
                if (xhttp.readyState === 4 && xhttp.status === 200) {
                    // mark notification as seen
                    element.parentNode.classList+= ' seen';
                    // remove button
                    element.remove();
                    // decrease notification count
                    var notificationCounter = document.getElementById('notificationCount');
                    var notificationNumber = parseInt(notificationCounter.innerHTML);
                    notificationNumber--;
                    var unseen_large_Counter = document.getElementById('unseen-large-number');
                    var unseen_large_Number = parseInt(unseen_large_Counter.innerHTML);
                    unseen_large_Number--;
                    notificationCounter.innerHTML = notificationNumber.toString();
                    unseen_large_Counter.innerHTML = unseen_large_Number.toString();
                    if (notificationNumber === 0){
                        notificationCounter.parentNode.parentNode.classList = '';
                    }
                }
            };
            xhttp.open("POST", element.toString(), true);
            xhttp.send();
        }

        function markAllAsSeen(e) {
            var xhttp = new XMLHttpRequest();
            var element = e.target;
            xhttp.onreadystatechange = function () {
                // on success
                if (xhttp.readyState === 4 && xhttp.status === 200) {
                    // add "seen" class for all notifications
                    var notifications = document.getElementsByClassName('list__item');
                    for (var notification of notifications){
                        notification.children[0].classList += ' seen';
                    }
                    // remove action buttons
                    var paras = document.getElementsByClassName('ajax-notification');
                    while(paras[0]) {
                        paras[0].parentNode.removeChild(paras[0]);
                    }
                    // set notification count to 0
                    var notificationCount = document.getElementById('notificationCount');
                    notificationCount.innerHTML = '0';
                    var unseen_large_number = document.getElementById('unseen-large-number');
                    unseen_large_number.innerHTML = '0';
                    var active = document.getElementsByClassName('active-notification');
                    active.classList='';
                }
            };
            xhttp.open("POST", element.toString(), true);
            xhttp.send();
        }

        // mark as seen button handler
        var btns = document.getElementsByClassName('ajax-notification');
        for(var btn of btns){
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                markAsSeen(e);
            });
        }
        // mark all as seen button handler
        if(document.getElementById('notification-MarkAllAsSeen')!==null){
            document.getElementById('notification-MarkAllAsSeen').addEventListener('click',function (e) {
                e.preventDefault();
                markAllAsSeen(e);
            });
        }
    })();

