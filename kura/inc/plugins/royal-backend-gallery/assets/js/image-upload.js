jQuery(document).ready(function( $ ) {
    "use strict";

/*
***************************************************************
* #Image Upload
***************************************************************
*/

// Media Upload button
$('#rf_block_bg_cover_upload').click(function( event ){

    // Prevents default behaviour
    event.preventDefault();

    // frame popup options
    var mediaFrame = wp.media({
        library: {
            type: 'image'
        }
    });

    // grab value of selected mp3 and place thats url in input
    mediaFrame.on('select', function() {
        var mediaAttachment = mediaFrame.state().get('selection').first().toJSON();
        $('#rf_block_bg_cover').val( mediaAttachment.url );
    });

    // open popup
    mediaFrame.open();
});


/*
***************************************************************
* #Gallery  
***************************************************************
*/

// define variables
var galleryImgSrcs = $("#rf_gallery_imgs_src"),
    galleryImgIds  = $("#rf_gallery_img_ids"),
    galleryWrap    = $('.gallery-wrap #sortable');

// Media Upload button
$(document).on( 'click', '#rf_gallery_imgs_upload', function( event ) {

    var imageSrcArray = [],
        imageIdArray = [];

    // assign Image Urls & IDs to array 
    if ( galleryImgSrcs.val() !== '' ) {
        imageSrcArray = galleryImgSrcs.val().split(',');
    }

    if ( galleryImgIds.val() !== '' ) {
        imageIdArray = galleryImgIds.val().split(',');
    }

    // prevent default behaviour
    event.preventDefault();

    // popup options
    var mediaFrame = wp.media({
        multiple: true, // set to false if you want only one image
        library: {
            type: 'image'
        }
    });

    // when popup is closed
    mediaFrame.on('select', function() {
        
        // get image object
        var mediaAttachments = mediaFrame.state().get('selection');

        // loop to place all image url's in one array
        mediaAttachments.each(function( image ) {
            imageSrcArray.push( image.attributes.url );
            imageIdArray.push( image.attributes.id );
        });

        // Adds all image URL's comma seperated to a text input
        galleryImgSrcs.val( imageSrcArray );

        // Adds all image URL's comma seperated to a text input
        galleryImgIds.val( imageIdArray );

        // remove images first then append
        galleryWrap.find('.gallery-image').remove();

        // loop to display images
        $.each(imageSrcArray, function(index) {
            galleryWrap.append('\
                <li class="gallery-image ui-state-default" data-id="'+ imageIdArray[index] +'">\
                    <span class="remove">x</span>\
                    <img src="'+ imageSrcArray[index] +'" alt="" />\
                    <a href="post.php?post='+ imageIdArray[index] +'&action=edit#attachment_caption" target="_blank" class="editlink">Edit</a>\
                </li>\
            ');
        });

    }); // end popup close


    // open popup Frame
    mediaFrame.open();

}); // end click function

// check if input value is not empty
if ( galleryImgSrcs.val() !== '' ) {

    // define variables on load
    var imageSrcsOnLoad = galleryImgSrcs.val().split(','),
        imageIdsOnLoad  = galleryImgIds.val().split(',');

    // on load - loop to display images
    $.each( imageSrcsOnLoad, function(index) {
        galleryWrap.append('\
            <li class="gallery-image ui-state-default" data-id="'+ imageIdsOnLoad[index] +'">\
                <span class="remove">x</span>\
                <img src="'+ imageSrcsOnLoad[index] +'" alt="" />\
                <a href="post.php?post='+ imageIdsOnLoad[index] +'&action=edit#attachment_caption" target="_blank" class="editlink">Edit</a>\
            </li>\
        ');
    });
}


// function to remove elements from array
function royalRemoveItem( array, item ){
    for ( var i in array ) {
        if ( array[i] == item ) {
            array.splice( i, 1 );
            break;
        }
    }
}

// delete images from gallery
$(document).on( 'click', '.remove', function() {

    // redefine on click
    imageSrcsOnLoad = galleryImgSrcs.val().split(',');
    imageIdsOnLoad  = galleryImgIds.val().split(',');

    // remove elements from array
    royalRemoveItem( imageSrcsOnLoad, $(this).parent().find('img').attr('src') );
    royalRemoveItem( imageIdsOnLoad, $(this).parent().data('id') );

    // remove images
    $(this).parent().remove();

    // update value of input
    galleryImgSrcs.val(imageSrcsOnLoad);
    galleryImgIds.val(imageIdsOnLoad);

});

// add dragNdrop functionality
$( "#sortable" ).sortable({
  placeholder: "ui-state-highlight",
  stop: function(evt, ui) {
    setTimeout( function() {
        
        var dragID = '',
            dragSRC = '';

        $('#sortable li').each(function(){
            dragID += ',' + $(this).attr('data-id');
            dragSRC += ',' + $(this).find('img').attr('src');
        });

        dragID = dragID.replace(',', '');
        dragSRC = dragSRC.replace(',', '');

        galleryImgIds.val(dragID);
        galleryImgSrcs.val(dragSRC);

    }, 500 );
}
});

$( "#sortable" ).disableSelection();


}); // end ready