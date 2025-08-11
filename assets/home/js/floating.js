$(document).ready(function(){
    // draw_floating();// 플로팅메뉴 생성
    
});

/*
    * 모바일 페이지 상단으로가기
*/
$(document).on("click", ".btn-float.top", scrollUp);

function scrollUp(){
    $("html,body").animate({ scrollTop: 0 }, "slow");
};

/*
    * 플로팅 고객센터 open
*/
 $(document).on('click', '.btn-float.cs', function(){
    $('body').css({'position': 'fixed'});
    linkClicks('고객센터', '버튼클릭', '플로팅고객센터 버튼클릭'); // 통계
    $("#csCenter").addClass('active').removeClass('fadeOutDown bounceInUp');
});

/*
    * 플로팅 메뉴 제어
*/
$(document).on('click', '.float-menu .dimmed, .btn-float.more', function(){

    if ($('.float-menu').hasClass('active')){
        hideFloatingMenu();
    }
    else{
        showFloatingMenu();
    }
});

/*
    * 모바일 플로팅 메뉴 생성
*/
function draw_floating(){
    var floatList = {};
    var floatDocument = {};
    var data = {
        call:{
            class : 'call pc-off',
            name : '전화',
            link : 'href="tel:1833-3457"'
        },
        kakao:{
            class: 'kakao',
            name:'카톡플러스',
            link:'href="#"'
            // https://pf.kakao.com/_xlaxfxhj/chat
        },
        toktok:{
            class : 'toktok',
            name : '톡톡',
        },
        cs:{
            class : 'cs',
            name : '고객센터',
        }
    };

    /*
        * 플로팅 메뉴 폼 생성
    */
    var floatDocument = '<div class="float-menu">\
                            <div class="dimmed" id="float_dim"></div>\
                            <div class="float-btn-group">\
                                <a class="btn-float top text-hidden">위로</a>\
                                <span class="float-hidden-group">\
                                </span>\
                                <span class="btn-float more text-hidden">더보기</span>\
                            </div>\
                        </div>';
    $('body').append(floatDocument);

    /*
        * 데이터 삽입
    */
    for(var prop in data){
        var floatItem ='<a '+data[prop].link+' class="btn-float '+data[prop].class+'" aria-label="'+data[prop].name+'"></a>';
        $(".float-menu").find('.float-hidden-group').append(floatItem);
    }

    // $('.btn-float.kakao').attr('target','_blank');

    /************************************************** 데모버전 지원 X
     $('.btn-float.toktok').attr("onclick","javascript:window.open('https://talk.naver.com/WC11HH?ref='+encodeURIComponent(location.href), 'talktalk', 'width=471, height=640');return false");
    ********************************************************************/
    // $('.btn-float.toktok').attr("onclick","javascript:window.open('https://talk.naver.com/WC11HH?ref='+encodeURIComponent(location.href), 'talktalk', 'width=471, height=640');return false");
};

// 모바일
// Floating_ 더보기 메뉴 펼치기 
function showFloatingMenu() {
    $('.float-menu').addClass('active');
    $('.btn-float.top').fadeOut();
    $('.float-hidden-group').addClass('active');
}

// Floating_ 더보기 메뉴 닫기 
function hideFloatingMenu() {
    $('.float-menu').removeClass('active');
    $('.btn-float.top').fadeIn();
    $('.float-hidden-group').removeClass('active');
}


/*
    * 데모버전 지원X
*/ 
$(document).on('click','.btn-float.kakao, .btn-float.toktok', function(){
    alert('데모 버전에서는 제공하지 않는 기능입니다.');
});


/*
    * 네이버 톡톡 통계
*/
$(document).on('click', '.btn-float.toktok', function(){
    linkClicks('고객센터', '톡톡하기클릭', '톡톡하기버튼클릭'); // 통계
});

/*
    * 카톡 플러스 통계
*/
$(document).on('click', '.btn-float.kakao', function(){
    linkClicks('고객센터', '카톡문의클릭', '카톡문의버튼클릭'); // 통계
});