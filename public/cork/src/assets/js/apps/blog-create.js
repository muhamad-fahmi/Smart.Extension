/**
 * ===================================
 *    Blog Description Editor
 * ===================================
*/

$("#summernote").summernote({
    placeholder: "Hello stand alone ui",
    tabsize: 2,
    height: 350,
    toolbar: [
        ["style", ["style"]],
        ["font", ["bold", "underline", "clear"]],
        ["color", ["color"]],
        ["para", ["ul", "ol", "paragraph"]],
        ["table", ["table"]],
        ["insert", ["link", "picture", "video"]],
    ],
});


/**
 * ====================
 *      File Pond
 * ====================
*/

// We want to preview images, so we register
// the Image Preview plugin, We also register
// exif orientation (to correct mobile image
// orientation) and size validation, to prevent
// large files from being added
FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginImageExifOrientation,
    FilePondPluginFileValidateSize,
    // FilePondPluginImageEdit
);

// Select the file input and use
// create() to turn it into a pond
var ecommerce = FilePond.create(document.querySelector('.file-upload-multiple'));




