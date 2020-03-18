jQuery(document).ready(function( $ ) {

    "use strict";
    var pHeaderAdd = $( '#page-header-img-upload' ),
        pHeaderRemove = $( '#page-header-img-remove' ),
        pHeaderImg = $( '#page-header-img' ),
        pHeaderData = $( '#page-header-img-data' ),
        pHeaderDesc = $( '#page-header-img-desc' ),
        cHeaderAdd = $( '#category-header-img-upload' ),
        cHeaderRemove = $( '#category-header-img-remove' ),
        cHeaderImg = $( '#category-header-img' ),
        cHeaderData = $( '#category-header-img-data' ),
        cHeaderDesc = $( '#category-header-img-desc' );

    HeaderImg( pHeaderAdd, pHeaderRemove, pHeaderImg, pHeaderData, pHeaderDesc );
    HeaderImg( cHeaderAdd, cHeaderRemove, cHeaderImg, cHeaderData, cHeaderDesc );

    function HeaderImg( HeaderImgAdd, HeaderImgRemove, HeaderImg, HeaderImgData, HeaderImgDesc ) {
        var pageHeaderUploader = wp.media({
            title: 'Header Image',
            button: {
                text: 'Set header image'
            },
            multiple: false
        });

        HeaderImgAdd.click( function() {
            if ( pageHeaderUploader ) {
                pageHeaderUploader.open();
            }
        } );

        HeaderImg.click( function() {
            if ( pageHeaderUploader ) {
                pageHeaderUploader.open();
            }
        } );

        pageHeaderUploader.on( 'select', function() {
            var attachment = pageHeaderUploader.state().get('selection').first().toJSON();
            HeaderImg.attr( 'src', attachment.url );
            HeaderImgData.attr( 'value', attachment.url );
            toggleVisibility( 'ADD' );
        } );

        HeaderImgRemove.click( function() {
            HeaderImg.removeAttr( 'src' );
            HeaderImgData.removeAttr( 'value' );
            toggleVisibility( 'REMOVE' );
        } );

        var toggleVisibility = function( action ) {
            if ( 'ADD' === action ) {
                HeaderImgAdd.css('display', 'none');
                HeaderImgDesc.css('display', 'block');
                HeaderImgRemove.css('display', 'inline-block');
                HeaderImg.css('display', 'block');
            }

            if ( 'REMOVE' === action ) {
                HeaderImgAdd.css('display', 'inline-block');
                HeaderImgRemove.css('display', 'none');
                HeaderImgDesc.css('display', 'none');
                HeaderImg.css('display', 'none');
            }
        };

        if ( HeaderImg.attr('src') ) {
        toggleVisibility( 'ADD' );
        } else {
        toggleVisibility( 'REMOVE' );
        }
    }
}); // end dom ready