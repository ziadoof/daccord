
$(document).ready(function () {
    var favoriteAdd = document.getElementsByClassName('js-favorite-add');
    for (var favorite of favoriteAdd) {
        favorite.addEventListener('click', function (e) {
            $(this.querySelector('span')).toggleClass('active');
            e.preventDefault();
            let object = this.getAttribute('data-object');
            let type = this.getAttribute('data-type');
            let isFavorite = this.getAttribute('data-favorite');
            let data = {object, type};
            let url = '';
            if (isFavorite === 'true') {
                url = Routing.generate('favorite_remove');
                $(this).attr('data-favorite', 'false');
            } else {
                url = Routing.generate('favorite_add');
                $(this).attr('data-favorite', 'true');
            }

            $.ajax({
                method: "post",
                dataType: "json",
                url: url,
                data: data,
            }).done(function (response) {
            })


        })
    }

});

/* when a user clicks, toggle the 'is-animating' class */
$(".favme").on('click touchstart', function () {
    $(this).toggleClass('is_animating');
});

/*when the animation is over, remove the class*/
$(".favme").on('animationend', function () {
    $(this).toggleClass('is_animating');
});
