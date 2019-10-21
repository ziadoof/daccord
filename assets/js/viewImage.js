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