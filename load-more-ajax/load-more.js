jQuery( document ).ready( function(){
    var page = 2;
    jQuery( function($) {
      jQuery( 'body' ).on( 'click', '.loadmore', function() {
        var data = {
          'action': 'load_posts_by_ajax',
          'page': page,
          'security': blog.security
        };
        jQuery.post( blog.ajaxurl, data, function( response ) {
          if( $.trim(response) != '' ) {
            jQuery( '.blog-posts' ).append( response );
            page++;
          } else {
            jQuery( '.loadmore' ).hide();
            jQuery( ".no-more-post" ).html( "No More Post Available" );
          }
        });
      });
    });
  });
