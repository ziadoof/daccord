//view image upload for edit profile and car
function viewProfileImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewProfileImge')
                .attr('src', e.target.result)
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewProfileImage = viewProfileImage;

function viewCarImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewCarImge')
                .attr('src', e.target.result)
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewCarImage = viewCarImage;

function viewHostingImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewHostingImge')
                .attr('src', e.target.result)
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewHostingImage = viewHostingImage;

function viewMeetupImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewMeetupImge')
                .attr('src', e.target.result)
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewMeetupImage = viewMeetupImage;

function viewCarpoolImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewCarpoolImge')
                .attr('src', e.target.result)
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewCarpoolImage = viewCarpoolImage;

function viewOfferImageOne(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewOfferImgeOne')
                .attr('src', e.target.result)
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewOfferImageOne = viewOfferImageOne;

function viewOfferImageTow(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewOfferImgeTow')
                .attr('src', e.target.result)
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewOfferImageTow = viewOfferImageTow;

function viewOfferImageThree(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewOfferImgeThree')
                .attr('src', e.target.result)
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewOfferImageThree = viewOfferImageThree;