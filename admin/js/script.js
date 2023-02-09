$(document).ready(function() {
    $('#summernote').summernote({
        height: 200,
        focus: true
    });


});

$(document).ready(function() {
 $('#selectAll').click(function(e) {
    if(this.checked) {
        $('.selectItem').each(function() {
            this.checked = true;
        });
    }else {
        $('.selectItem').each(function() {
            this.checked = false;
        });  
    }
 });
});

