$(document).ready(function(){

    /*
        * 고객센터 열기
        * 판넬 애니메이션 효과 추가
    */
    $(document).on('click', '.cs-handle-panel', debounce(function(e){
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('flipOutX');
        $('#csCenter').addClass('bounceInUp');
        linkClicks('고객센터', '버튼클릭', '플로팅고객센터 버튼클릭'); // 통계

        setTimeout(function(){
            $('#csCenter').addClass('active');
        }, 500);

        setTimeout(function(){
            $('#csCenter').removeClass('bounceInUp');
        }, 1500);

    },300));

    /*
        * 고객센터 PC 닫기
    */
    $('html').on('click', function(e){
        if(!csMobile()) {
            if(!$(e.target).closest('.cs-area').length) {
                // PC
                $('#csCenter').addClass('fadeOutDown');
                setTimeout(function(){
                    $('.cs-handle-panel').removeClass('flipOutX');
                    $('#csCenter').removeClass('active fadeOutDown');
                }, 1300);
            }
        }
    });

    var csDocument = '\
        <div class="cs-area">\
            <div class="scroll-top-area active">\
                <div class="scroll-top">\
                    <span class="btn-scroll-top">TOP</span>\
                </div>\
            </div>\
            <div id="cs_handel_panel" class="cs-handle-panel text-hidden animated">\
                <div class="cs-handler">\
                    <span class="cs-helper">무엇이든 물어보세요.</span>\
                </div>\
            </div>\
            <div class="modal animated" id="csCenter">\
                <iframe id="cs_dom" src="'+base_url+'home/support/center" frameborder="0"></iframe>\
            </div>\
        </div>';

    // $('body').append(csDocument);
});

// 부모창에서 아이프레임의 '닫기'요청을 받아 실행
if (window.addEventListener) {
    window.addEventListener("message", onMessage, false);

} else if (window.attachEvent) {
    window.attachEvent("onmessage", onMessage, false);
}

function onMessage(e) {
    // 경로가 올바른지 체크
    if (location.origin !== e.origin) {
        return;
    }

    var data = e.data;
    if (typeof(window[data.func]) == "function") {
        window[data.func].call(null, data.message);
    }
};

function closeIframe(message) {
    $('.modal#csCenter').removeClass('active');
    hideFloatingMenu();

    if(csMobile()) {
        $('.cs-handler').hide();
    } else {
        $('.cs-handler').fadeIn();
    }
}

/*
    * 플로팅 고객센터는 실제 디바이스가 아니라
    * 화면 프레임으로 조절
*/
function csMobile() {
    if(window.innerWidth < 1024){
        $(".cs-handler p").css("display","none");
        return true;
    } else {
        $(".cs-handler p").css("display","block");
        return false;
    }
};

/*
    * PC 스크롤 위로가기
*/
$(document).on('click','.scroll-top-area', function(){
    $("html,body").animate({ scrollTop: 0 }, "slow");
});