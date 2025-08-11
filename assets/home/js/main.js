jQuery(document).ready(function() {

    /*
        * 메인 슬라이더 조회
    */
    getMainCarousel();
    /*
        * 메인 제품 리스트 (최신 등록 3개)
    */
    // mainPd.getList();
    /*
        * 메인 용역 리스트 (최신 등록 3개)
    */
    mainSc.getList();

    $(document).ajaxStop(function(){
        // 모든 AJAX 통신이 끝난 후 fullpage 로드
        setFullPage();
    });


    $(window).on('resize', debounce(function(e){
        wrap_width = window.innerWidth;
        /*
            * 메인슬라이드 이미지 교체
        */
        var slide = $('.section-fp-main .fp-slidesContainer .slide');
        for(i=0; i<slide.length; i++){

            if(wrap_width <1024){
                var url = slide.eq(i).find('.slide-m').text();
            }
            else{
                var url = slide.eq(i).find('.slide-pc').text();
            }
                slide.eq(i).find('.section-fp-main-img').css('background-image','url("'+url+'")'); 
        }

        // calcSlick();
    },200));


    /*
        * 메인 3 주요제품 클릭시 세션 쿼리
    */
    $('.m3-list ul li a').click(function(){
        var m_url_data = {
            call: $(this).data('urlCall'),
            index : $(this).data('index'),
            depth:$(this).data('depth'),
            parent: $(this).data('parentIndex'),
        }
        sessionStorage.setItem("url_data", JSON.stringify(m_url_data));
    });

    
});

/*
    * 메인슬라이더 조회
*/
function getMainCarousel(){
    loading(true);
    $.ajax({
        type: 'GET',
        url: base_url+'api/contents/mainSlide/list',
        success: function(resData) {
            // console.log('success >>>>');
            // console.log(resData);
            if(resData.status === true && resData.result.message =="NO DATA"){
                loading(false);
                $(".section-fp-main").remove();
            }
            else if(resData.status === true && resData.message == "Get List Success"){
                setMainCarousel(resData.result.data);
            }
        },
        error: function(resData) {
            // console.log('error >>>');
            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }
    });
};

/*
    * 메인슬라이더 출력
*/
function setMainCarousel(res){
    loading(false);
    var list ={};
    if(res != undefined){// 슬라이더 이미지 존재

        for(var i=0; i<res.length; i++){
            list[i] = '<div id="main_carousel_'+res[i].idx+'" class="slide slide-img">\
                            <div class="section-fp-main-img" style="background-image:url(\'\');"></div>\
                            <div class="main-carousel-up">\
                                <p style="color:'+res[i].text_color+'">'+res[i].title_header+'</p>\
                                <p style="color:'+res[i].text_color+'">'+res[i].title+'</p>\
                                <p style="color:'+res[i].text_color+'">'+res[i].text1+'</p>\
                                <span id="main_carousel_pc_'+res[i].idx+'" class="text-hidden slide-url slide-pc">'+base_url+res[i].path+'/'+res[i].pc_img+'</span>\
                                <span id="main_carousel_m_'+res[i].idx+'" class="text-hidden slide-url slide-m">'+base_url+res[i].path+'/'+res[i].mobile_img+'</span>\
                            </div>\
                        </div>';

            // 메인 제품|용역 링크 주석
            // <ul>\
            //     <li><a href="'+base_url+'home/product?menu_code=product&menu_up_code=" title="주요 제품보기"><span>주요</span><span>제품보기</span></a></li>\
            //     <li><a href="'+base_url+'home/service?menu_code=service&menu_up_code=" title="용역 사례보기"><span>용역</span><span>사례보기</span></a></li>\
            // </ul>\

            $("#fullpage .section-fp-main").append(list[i]);


            if($('.wrap').width()>767)
                $("#main_carousel_"+res[i].idx).find('.section-fp-main-img').css("background-image",'url("'+$("#main_carousel_pc_"+res[i].idx).text()+'")');
            else
                $("#main_carousel_"+res[i].idx).find('.section-fp-main-img').css("background-image",'url("'+$("#main_carousel_m_"+res[i].idx).text()+'")');

            // 링크 생성
            if(res[i].link_url !=""){
                $("#main_carousel_"+res[i].idx).css("cursor","pointer");
                if(res[i].link_target =="_SELF"){ // 현재창
                    $("#main_carousel_"+res[i].idx).attr("onclick" ,"location.href='"+res[i].link_url+"'");
                }
                else{ // 새창
                    $("#main_carousel_"+res[i].idx).attr("onclick" ,"window.open('"+res[i].link_url+"')");
                }
            }
        }
        
    }
};

/*
    * 메인 슬라이드 자동 재생
*/
function autoPlay(){
    var slideTime = setInterval(function(){
        $.fn.fullpage.moveSlideRight();
        cFlag = $('.section-fp-main.active').find('.fp-slide.active').index();
        cFObj = $('.section-fp-main.active').find('.fp-slide.active');
    }, 12000);
};

/*
    * 메인 페이지 활성화
*/
function setFullPage(){
    $("#fullpage").fullpage({
        anchors: ['main', 'company', 'product', 'productList', 'serviceList', 'partner', 'footer'],
        licenseKey: '53F8826C-FE764A08-BE0DC3A2-78CDA43A',
        autoScrolling: false, // 스크롤 여부

        //접근성 
        keyboardScrolling: true,
        animateAnchor: true,
        recordHistory: true,
        fitToSection: false, // 컨텐츠 자동 맞춤
        scrollBar: true,
        scrollHorizontally: true, // 수평

        verticalCentered: false, // 컨텐츠 수직 여부
        slidesNavigation: true, // dot 네비게이터 사용여부
        controlArrows: true, // 화살표
        scrollingSpeed: 1000,
        lazyLoading: false,

        // dragAndMove: false, // 마우스 드래그, 터치 드래그
        normalScrollElements: '.menu-box', // 메인페이지 메뉴 스크롤 허용
        controlArrows: true,
        css3: true,
        easing: 'easeInOutCubic',
        easingcss3: 'ease',
    });

    // $('#list_product ul').slick({
    //     infinite: true, // 무한 재생
    //     adaptiveHeight: true, // 슬라이더 높이를 현재 슬라이드에 맞춤
    //     slidesToShow: 1, // 슬라이더 보여줄 갯수
    //     slidesToScroll: 1, // 한 번에 스크롤 할 슬라이드 수
    //     arrows: false, // 다음,  이전 화살표 사용
    //     autoplay: true, // 자동재생
    //     autoplaySpeed : 12000, // 자동재생 시간
    //     dots: true, // 현재 슬라이드 표시점
    //     swipe: true, // 터치 스와이프
    //     swipeToSlide: true, // slidesToScroll에 관계없이 스 와이프하여 슬라이드
    //     touchMove: true, // 터치로 슬라이드 이동 가능
    //     centerMode: true, // 가운데보기
    //     centerPadding: '20%', // 중앙모드일때 옆 패딩

    //     // 반응형 응답 포인트
    //     // responsive: [{
    //     //     breakpoint: 1024, // 태블릿
    //     //     settings: {
    //     //         slidesToShow: 2, // 슬라이더 보여줄 갯수
    //     //         slidesToScroll: 2, // 한 번에 스크롤 할 슬라이드 수
    //     //     }
    //     // }, {
    //     //     breakpoint: 768, // 모바일
    //     //     settings: {
    //     //         slidesToShow: 1, // 슬라이더 보여줄 갯수
    //     //         slidesToScroll: 1, // 한 번에 스크롤 할 슬라이드 수
    //     //     }
    //     // }]
    // });

    $('#list_service ul').slick({
        infinite: true, // 무한 재생
        adaptiveHeight: true, // 슬라이더 높이를 현재 슬라이드에 맞춤
        slidesToShow: 1, // 슬라이더 보여줄 갯수
        slidesToScroll: 1, // 한 번에 스크롤 할 슬라이드 수
        arrows: false, // 다음,  이전 화살표 사용
        autoplay: true, // 자동재생
        autoplaySpeed : 12000, // 자동재생 시간
        dots: true, // 현재 슬라이드 표시점
        // swipe: true, // 터치 스와이프
        // swipeToSlide: true, // slidesToScroll에 관계없이 스 와이프하여 슬라이드
        // touchMove: true, // 터치로 슬라이드 이동 가능
        centerMode: true, // 가운데보기
        centerPadding: '30%', // 중앙모드일때 옆 패딩

        // 반응형 응답 포인트
        responsive: [
        {
            breakpoint: 1400, // 태블릿
            settings: {
                centerPadding: '25%', // 중앙모드일때 옆 패딩
            }
        },
        {
            breakpoint: 1200, // 태블릿
            settings: {
                centerPadding: '20%', // 중앙모드일때 옆 패딩
            }
        },
        {
            breakpoint: 1024, // 태블릿
            settings: {
                centerPadding: '15%', // 중앙모드일때 옆 패딩
            }
        }, 
        {
            breakpoint: 500, // 모바일
            settings: {
                centerPadding: '10%', // 중앙모드일때 옆 패딩
            }
        }]
    });

    $('#list_partner ul').slick({
        infinite: true, // 무한 재생
        adaptiveHeight: true, // 슬라이더 높이를 현재 슬라이드에 맞춤
        slidesToShow: 5, // 슬라이더 보여줄 갯수
        slidesToScroll: 5, // 한 번에 스크롤 할 슬라이드 수
        arrows: true, // 다음,  이전 화살표 사용
        autoplay: true, // 자동재생
        autoplaySpeed : 12000, // 자동재생 시간
        dots: false, // 현재 슬라이드 표시점
        // swipe: true, // 터치 스와이프
        // swipeToSlide: true, // slidesToScroll에 관계없이 스 와이프하여 슬라이드
        // touchMove: true, // 터치로 슬라이드 이동 가능

        // 반응형 응답 포인트
        responsive: [{
            breakpoint: 1024, // 태블릿
            settings: {
                slidesToShow: 2, // 슬라이더 보여줄 갯수
                slidesToScroll: 2, // 한 번에 스크롤 할 슬라이드 수
            }
        }, {
            breakpoint: 768, // 모바일
            settings: {
                slidesToShow: 1, // 슬라이더 보여줄 갯수
                slidesToScroll: 1, // 한 번에 스크롤 할 슬라이드 수
                centerMode: true, // 가운데보기
                centerPadding: '10%', // 중앙모드일때 옆 패딩
            }
        }]
    });

    // calcSlick();
};

/*
    * 제품 / 용역 리스트 반응형 셋팅
*/
// function calcSlick(){
//     var w = Math.floor($('.ms-item .m-img-area').width());
//     var calcW = Math.floor(w/19);
//     var h = calcW*11;

//     $('#list_service').find('.slick-list').css({'height':h+'px'});
//     $('#list_service .ms-item .m-img').css({'padding-bottom':h+'px'});
// };


/*
    * 메인 제품 리스트
*/
var mainPd = {
    getList:function(){

        $.ajax({
            type: 'GET',
            url: base_url+'api/products/product/mainPageList',
            success: function(resData){
                console.log('success >>>>');
                if(resData.status === true && resData.result.message =="NO DATA"){
                    $('.section-main4').remove();
                }
                else if(resData.status === true){
                    mainPd.setList(resData.result.data);
                }
            },
            error: function(resData){
                // console.log('error >>>');
                alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            }
        });
    },
    setList:function(res){
        for(var i=0; i<res.length; i++){
            var item = '<li class="ms-item">\
                                    <div class="m-img-area">\
                                        <div class="m-img" style="background-image:url('+base_url+res[i].path+'/'+res[i].thumb_img+');" aria-label="'+res[i].title+'"></div>\
                                    </div>\
                                    <div class="ms-desc">\
                                        <p>'+res[i].title+'</p>\
                                    </div>\
                                </li>';
            $('#list_product ul').append(item);
        }
    },
};

/*
    * 메인 용역 리스트
*/
var mainSc = {
    getList:function(){

        $.ajax({
            type: 'GET',
            url: base_url+'api/services/service/mainPageList',
            success: function(resData){
                // console.log('success >>>>');
                if(resData.status === true && resData.result.message =="NO DATA"){
                    $('.section-main5').remove();
                }
                else if(resData.status === true){
                    mainSc.setList(resData.result.data);
                }
            },
            error: function(resData){
                // console.log('error >>>');
                alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            }
        });
    },
    setList:function(res){
        for(var i=0; i<res.length; i++){
            var item = '<li class="ms-item">\
                            <a href="'+base_url+'home/service/detail?idx='+res[i].idx+'&menu_code=service&menu_up_code=">\
                                <div class="m-img-area">\
                                    <div class="m-img" style="background-image:url('+base_url+res[i].path+'/'+res[i].thumb_img+');" aria-label="'+res[i].title+'"></div>\
                                    <div class="ms-desc">\
                                        <p>'+res[i].title+'</p>\
                                    </div>\
                                </div>\
                            </a>\
                        </li>';
            $('#list_service ul').append(item);
        }
    },
};