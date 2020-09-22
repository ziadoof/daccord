//view image upload for edit profile and car
import * as imageConversion from 'image-conversion';

function viewProfileImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            //imgId,formId,previewId,targetResult,postName
            let imgId = 'fos_user_profile_form_profileImage';
            let formId = 'fos_user_profile_edit';
            let previewId = 'previewProfileImge';
            let targetResult = e.target.result;
            let postName = 'newProfileImage';
            let buttonId = 'js-profile-edite';
            document.getElementById(buttonId).disabled = true;
            photoProcess(imgId,formId,previewId,targetResult,postName,buttonId,300,300);

        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewProfileImage = viewProfileImage;

function viewCarImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            //imgId,formId,previewId,targetResult,postName
            let imgId = 'driver_carImage';
            let formId = 'driver_user_edit';
            let previewId = 'previewCarImge';
            let targetResult = e.target.result;
            let postName = 'driverImage';
            let buttonId = 'js-driver-edite';
            document.getElementById(buttonId).disabled = true;
            photoProcess(imgId,formId,previewId,targetResult,postName,buttonId,300,300);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewCarImage = viewCarImage;

function viewHostingImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //imgId,formId,previewId,targetResult,postName
            let imgId = 'hosting_image';
            let formId = 'hosting_user_edit';
            let previewId = 'previewHostingImge';
            let targetResult = e.target.result;
            let postName = 'hostingImage';
            let buttonId = 'js-hosting-edite';
            document.getElementById(buttonId).disabled = true;
            photoProcess(imgId,formId,previewId,targetResult,postName,buttonId,800,600);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewHostingImage = viewHostingImage;

function viewMeetupImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //imgId,formId,previewId,targetResult,postName
            let imgId = 'meetup_image';
            let formId = 'meetup-form-new';
            let previewId = 'previewMeetupImge';
            let targetResult = e.target.result;
            let postName = 'meetupImage';
            let buttonId = 'js-newmeetup';
            document.getElementById(buttonId).disabled = true;
            photoProcess(imgId,formId,previewId,targetResult,postName,buttonId,1200,960);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewMeetupImage = viewMeetupImage;

function viewCarpoolImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //imgId,formId,previewId,targetResult,postName
            let imgId = 'carpool_carImage';
            let formId = 'carpool_user_edit';
            let previewId = 'previewCarpoolImge';
            let targetResult = e.target.result;
            let postName = 'carpoolImage';
            let buttonId = 'js-carpool-edite';
            document.getElementById(buttonId).disabled = true;
            photoProcess(imgId,formId,previewId,targetResult,postName,buttonId,1200,960);

        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewCarpoolImage = viewCarpoolImage;

function viewOfferImageOne(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //imgId,formId,previewId,targetResult,postName
            let imgId = 'offer_imageOne';
            let formId = 'Offer';
            let previewId = 'previewOfferImgeOne';
            let targetResult = e.target.result;
            let postName = 'adImageOne';
            let buttonId = 'js-new-ad';
            document.getElementById(buttonId).disabled = true;
            photoProcess(imgId,formId,previewId,targetResult,postName,buttonId,1200,960);

        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewOfferImageOne = viewOfferImageOne;

function viewOfferImageTow(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //imgId,formId,previewId,targetResult,postName
            let imgId = 'offer_imageTow';
            let formId = 'Offer';
            let previewId = 'previewOfferImgeTow';
            let targetResult = e.target.result;
            let postName = 'adImageTow';
            let buttonId = 'js-new-ad';
            document.getElementById(buttonId).disabled = true;
            photoProcess(imgId,formId,previewId,targetResult,postName,buttonId,1200,960);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewOfferImageTow = viewOfferImageTow;

function viewOfferImageThree(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //imgId,formId,previewId,targetResult,postName
            let imgId = 'offer_imageThree';
            let formId = 'Offer';
            let previewId = 'previewOfferImgeThree';
            let targetResult = e.target.result;
            let postName = 'adImageThree';
            let buttonId = 'js-new-ad';
            document.getElementById(buttonId).disabled = true;
            photoProcess(imgId,formId,previewId,targetResult,postName,buttonId,1200,960);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
window.viewOfferImageThree = viewOfferImageThree;



function photoProcess(imgId,formId,previewId,targetResult,postName,buttonId,max_width,max_height ){
    let img = document.getElementById(imgId).files[0];
    imageConversion.compressAccurately(img, 250).then(res=>{
        //The res in the promise is a compressed Blob type (which can be treated as a File type) file;

        var blobURL = window.URL.createObjectURL(res);
        var image = new Image();
        image.src = blobURL;
        var form = document.getElementById(formId);
        image.onload = function() {
            // have to wait till it's loaded
            var resized = resizeMe(image); // send it to canvas

            let oldInput = document.getElementById('photo_'+postName);
            if (oldInput !== null){
                oldInput.value = resized;
                form.appendChild(oldInput);
            }
            else{
                var newinput = document.createElement("input");
                newinput.type = 'hidden';
                newinput.id = 'photo_'+postName;
                newinput.name = postName+'[]';
                newinput.value = resized; // put result from canvas into new hidden input
                form.appendChild(newinput);
            }

            $('#'+previewId).attr('src',targetResult);
            document.getElementById(imgId).value = "";
            document.getElementById(buttonId).disabled = false;

        }

        function resizeMe(img) {

            var canvas = document.createElement('canvas');
            var width = img.width;
            var height = img.height;

            // calculate the width and height, constraining the proportions
            if (width > height) {
                if (width > max_width) {
                    //height *= max_width / width;
                    height = Math.round(height *= max_width / width);
                    width = max_width;
                }
            } else {
                if (height > max_height) {
                    //width *= max_height / height;
                    width = Math.round(width *= max_height / height);
                    height = max_height;
                }
            }

            // resize the canvas and draw the image data into it
            canvas.width = width;
            canvas.height = height;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, width, height);

            return canvas.toDataURL("image/jpeg",0.9); // get the data from canvas as 70% JPG (can be also PNG, etc.)
        }
    })

}