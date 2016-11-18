var KzGallery = {};

KzGallery.activateSortable = function() {
    $('.gallery-sortable').sortable({
        placeholder: '<div class="col-md-1"></div>',
        forcePlaceholderSize: true
    }).bind('sortupdate',function(e,ui){
        KzGallery.galleryUpdateSort();
    });
};

KzGallery.galleryAjax = function ($el,callback) {
    $.ajax({
        url: $el.data('url'),
        success: function(data){
            $('#gallery').html(data);
            KzGallery.activateSortable();
            KzGallery.galleryUpdateSort();
            callback();
        }
    });
};

KzGallery.galleryUpdateSort = function() {
    var item_ids = [];
    $('.gallery-item').each(function(){
        item_ids.push($(this).data('id'));
    });
    $('#gallery-sort-value').val(item_ids.join());
};

KzGallery.fileBatchUploadComplete = function() {
    KzGallery.galleryAjax($('#gallery'));
    $(this).fileinput('clear');
};

KzGallery.fileLoaded = function() {
    $(this).fileinput('upload');
};

$(function(){
    $('#gallery').on('click','.gallery-delete-btn',function(e){
        e.preventDefault();
        e.stopPropagation();

        if(confirm('Удалить?'))
            KzGallery.galleryAjax($(this));
    });

    KzGallery.activateSortable();
});
