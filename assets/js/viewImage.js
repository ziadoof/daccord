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
window.viewHostingImage = viewCarImage;

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