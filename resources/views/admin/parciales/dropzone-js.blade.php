<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
<script>
Dropzone.options.formDropzoneFotos = {
  paramName: "foto", // input
  maxFilesize: 2, // MB
  acceptedFiles: "image/*",
  init: function() {
    this.on("success", function() { 
        // cuando subió todo, refrezcar
        if(this.getUploadingFiles().length==0) {
            setTimeout(function(){ window.location.reload(); }, 1000);
        }
    });
  }
};
</script>