<style>
    /* Image cropper style */
    .img-container, .img-preview {
        overflow: hidden;
        text-align: center;
        /*width: 100%;*/
    }

    .img-preview-sm {
        width: 384px;
        height: 128px;
    }
</style>
<script>
    var crop_width = 1920;
    var crop_height = 640;
    var current_modal;
    var imagedata = {};
</script>
@include('_template_web._js._crop_image_single_modal')