$(document).ready(function() {

    if ($('.wp-box').length > 0) {
        waypointContent();
    }
    
});

function waypointContent() {
    var i = 0;

    $('.wp-box').waypoint(function(direction) {
        if(direction === 'down' && !$(this.element).hasClass('animated-fast')) {
            
            i++;
            $(this.element).addClass('animating');

            setTimeout(function(){
                $('body .wp-box.animating').each(function(k){
                    var el = $(this);
                    setTimeout(function(){
                        var effect = el.data('animate-effect');
                        switch(effect) {
                            case 'fadeInUp':
                                // console.log('fadeInUp');
                                el.addClass('fadeInUp animated-fast');
                                break;
                        }
                        el.removeClass('animating');
                    }, k * 200);
                });
            }, 100);
        }
    }, {offset: '85%'});
} 

