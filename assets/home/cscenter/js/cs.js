$(document).ready(function(){
    // iframe 고객센터 js

    /*
        * 공통 가이드텍스트
    */
    $('.guidetext').each(function(){
        var guideText = $(this).attr('placeholder');
        var tg = $(this);

        tg.focus(function(){
            tg.attr('placeholder','');
        })
        .blur(function(){
            tg.attr('placeholder', guideText);
        });
    });

    /*
        * 부모프레임 디바이스 체크 후 css 로드
    */
    var isParentMobile = $(window.parent.document.body).hasClass('mobile');

    if(window.parent && window.parent.document){
        if (isParentMobile) {
            LazyLoad.css('../../assets/home/cscenter/css/cs-mobile.css', function (msg) {
            }, '[mobile CSS Load]');
        } else {
            LazyLoad.css('../../assets/home/cscenter/css/cs-pc.css', function (msg) {
            }, '[PC CSS Load]');
        }

    }else{
        // console.log('[noParentDocument]');
    }

    /*
        * 플로팅 고객센터 탭 전환(FAQ/실시간문의/1:1문의)
        * IE 이슈 수정 => a태그 사용X
    */
    $(document).on('click', '.cs-tab li', function(){

        linkClicks('고객센터', '실시간문의클릭', '실시간문의 탭 클릭'); // 통계

        $(".cs-tab li").removeClass("active");
        $(this).addClass("active");

        var tab = $(this).find('span').attr("class");
        var panel = $('.cs-body').find('tab-panel');

        if($(this).find('span').hasClass('formTab'))
            linkClicks('고객센터', '1:1문의클릭', '1:1문의하기탭클릭'); // 통계

        $('.tab-panel').removeClass('active');

        for(var i=0; i<$('.tab-panel').length; i++){
            if($('.tab-panel').eq(i).attr('id') === tab){
                $('.tab-panel').eq(i).addClass('active');
            }
        }
    });
   
    /*
        * CS_Tab1_ 아이프레임 리로드 (시도하기)
    */
    $(document).on('click', '.empty-panel .btn', function(e){
        e.preventDefault();
        window.location.reload();
    });

    /*
        * 플로팅 고객센터 close(닫기)
    */
    $(document).on('click', '.cs-header .btn-close', function (){

        $('#csCenter', parent.document).parent().parent().css({'position': 'relative'});
        $('#csCenter',parent.document).addClass('fadeOutDown');
        setTimeout(function(){
            $("#csCenter", parent.document).parent().find('.cs-handle-panel').removeClass('flipOutX');
            $("#csCenter", parent.document).removeClass('active fadeOutDown');
        }, 1300);

        if(inner_width<1024){ // 모바일
            $('#float_dim', parent.document).trigger('click');
        }
    });

    /* 
        * 화면 리사이즈시 횡스크롤 체크
    */
    $(window).on('resize', debounce(function(e){
        isSortScrolled();
    },200));

    /*
        * 플로팅 고객센터(FAQ)
        * 카테고리 [<][>] 버튼 넓이 계산 및 이동
    */
    isSortScrolled();
    $(".sort-btn-group a").click(function(){
        if($(this).hasClass('btn-prev')){ // 이전
            $('.sort-list').removeClass('end');
            $('.sort-btn-group a').removeClass('disabled');
            $(this).addClass('disabled');
        }
        else{ // 다음
            $('.sort-list').addClass('end');
            $('.sort-btn-group a').removeClass('disabled');
            $(this).addClass('disabled');
        }
    });

    /*
        * 플로팅 고객센터(FAQ)
        * 리스트 조회, 카테고리 정렬
        * @offset: 시작페이지
        * @limit : 갯수
        * @search_word : 검색어 (nullable)
        * @category : 카테고리 (nullable)
    */
    getCsFaq(1,4,'','');

    /*
        * 플로팅 고객센터(FAQ)
        * 검색어 입력
        * 검색어가 없을 경우는 전체 출력
        * @검색어
    */
    $("#cs-search-faq").on('keyup', debounce(function(event){
        var search_word = $(this).val();

        if(event.keyCode == 13){ // Enter
            $("#more_getCsFaq").removeClass('active'); // 더보기 버튼 활성화
            $(".qna-group").empty();
            getCsFaq(1,4, search_word, '');
            g_cs.faq_offset = 1;
        }
        else{
            $("#more_getCsFaq").addClass('active'); // 더보기 버튼 활성화
            g_cs.faq_offset = 1;
        }
    },200));

    /*
        * 플로팅 고객센터(FAQ)
        * 검색어 입력 후 검색버튼 클릭
        * 검색어가 없을 경우는 전체 출력
        * @검색어
    */
    $("#btn-cs-search").on('click', debounce(function(event){
        var search_word = $("#cs-search-faq").val();
        $("#more_getCsFaq").removeClass('active'); // 더보기 버튼 활성화

        $(".qna-group").empty();
        var category = $(".sort-group").find('.sort-list').find('.active').data('category');
        getCsFaq(1, 4, search_word, category);
        g_cs.faq_offset = 1;
    },200));

    /*
        * 플로팅 고객센터(FAQ)
        * 카테고리 정렬
        * @카테고리
    */
    $(".sort-list a").on('click', debounce(function(event){
        $(".qna-group").empty();
        $("#more_getCsFaq").removeClass('active'); // 더보기 버튼 활성화
        var category = $(this).data('category');
        $(".sort-list a").removeClass('active');
        $(this).addClass('active'); // 현재 카테고리 폰트 강조
        getCsFaq(1, 4, $("#cs-search-faq").val() ,category);
        g_cs.faq_offset = 1;
    },200));

    /*
        * 플로팅 고객센터(FAQ)
        * 더보기 클릭
    */
    $("#more_getCsFaq").on('click', debounce(function(event){
        var category = $(".sort-group").find('.sort-list').find('.active').data('category');
        getCsFaq(g_cs.faq_offset, 4, $("#cs-search-faq").val(), category);
    },200));

    /*
        * 플로팅 고객센터(1:1 문의)
        * 필드 유효성 검사
    */
    $("#formTab .form-confirm").on('click', debounce(function(event){

        if($("#cs_title").val() === undefined || $("#cs_title").val()==''){
            alert("제목은 필수 항목입니다.");
        }
        else if($("#cs_name").val() === undefined || $("#cs_name").val()==''){
            alert("이름은 필수 항목입니다.");
        }
        else if($("#cs_phone").val() === undefined || $("#cs_phone").val()==''){
            alert("연락처는 필수 항목입니다.");
        }
        else if(!cnf_phone($("#cs_phone").val())){
            alert("유효하지 않은 휴대전화입니다.");
        }
        else if($("#cs_email").val() === undefined || $("#cs_email").val()==''){
            alert("이메일은 필수 항목입니다.");
        }
        else if(!cnf_e_mail($("#cs_email").val())){
            alert("유효하지 않은 이메일입니다.");
        }
        else if($("#cs_contents").val() === undefined || $("#cs_contents").val()==''){
            alert("문의사항은 필수 항목입니다.");
        }
        else if(!$('#formTab .cs-form input[type="checkbox"]').is(':checked')){
            alert("개인정보취급동의 체크해 주세요");
        }
        else {
            // alert("데모 버전에서는 제공하지 않는 기능입니다.");
            pushCustomer();
        }
    },200));

    /*
        * 플로팅 고객센터(1:1 문의) 결과 확인 버튼 제어
    */
    $(document).on('click', '.result-panel button', function (e){
        e.preventDefault();
        $('.result-panel').fadeOut();

        $('.result-panel .icon').removeClass('fail').removeClass('success');

        $('.result-info').empty();
        $('.result-panel').css('display','none');
    });
});

/*
    전역 변수
    1. FAQ 리스트 오프셋
*/
var g_cs = {
    faq_offset:1,
};

/*
    * 플로팅 고객센터(FAQ)
    * 리스트 조회, 카테고리 정렬
    * @offset
    * @limit
    * @search_word : 검색어 (nullable)
    * @category : 카테고리 (nullable)
*/
function getCsFaq(offset, limit, search_word, category){
    var category = encodeURIComponent(category);
    loading(true);
    $.ajax({
        type: 'GET',
        url: base_url+'api/board/faq/list?offset='+offset+'&limit='+limit+'&category='+category+'&search_word='+search_word+'',
        success: function(resData) {
            // console.log('success >>>>');
            if(resData.status === true && resData.result.message =="NO DATA"){
                loading(false);
                $("#more_getCsFaq").addClass('active'); // 버튼 비활성화

                if(search_word != '' && offset ==1){ //검색어 O && 새로 검색
                    $(".qna-group").empty();
                    var no_list = '<div class="cs-category-item">\
                                    <p class="cs-faq-no-result">검색된 결과가 없습니다.</p>\
                                </div>';
                    $(".qna-group").append(no_list);
                }
                else if(!$(".qna-content").length){ // 내용이 없는 경우
                    $(".qna-group").empty();
                    var no_list = '<div class="cs-category-item">\
                                        <p class="cs-faq-no-result">자주묻는 질문이 없습니다.</p>\
                                </div>';
                    $(".qna-group").append(no_list);
                }
            }
            else if(resData.status === true){
                doneCsFaq(resData, limit);
            }
        },
        error: function(resData) {
            // console.log('error >>>');
            alert("불러올 데이터가 없거나 네트워크에 에러가 발생하였습니다.");
        }
    });
}

/*
    * 플로팅 고객센터(FAQ)
    * 리스트 추가
*/
function doneCsFaq(resData, limit){
    loading(false);
    var res = resData.result.data;
    var list={};

    if(res != undefined){// FAQ 리스트 존재
        // $(".response-no-result").remove();
        for(var i=0; i<res.length; i++){
            list[i] ='<div class="cs-category-item cs-faq-item">\
                        <div class="qna-title">\
                            <h3><span class="ico-qmark"></span>'+res[i].title+'</h3>\
                        </div>\
                        <div class="qna-content">\
                            <span class="ico-amark"></span>\
                            <p>'+res[i].contents+'</p>\
                        </div>\
                    </div>';
            $('.qna-group').append(list[i]);
        }

        /*
            * 더보기 전체 갯수로 제어
        */
        if(res.length<limit){ // 리스트 < 리미트 => 다음 데이터 없음
            $("#more_getCsFaq").addClass('active');// 버튼 비활성화
            g_cs.faq_offset = 1;
        }
        else if(res.length == limit){ // 리스트 == 리미트 => 다음 데이터 존재 가능 확인
            var cnt = $('.cs-faq-item').length;
            if(resData.result.total_count == cnt){ // 더보기 X
                $("#more_getCsFaq").addClass('active');// 버튼 비활성화
                g_cs.faq_offset = 1;
            }
            else{ // 더보기 O
                $("#more_getCsFaq").removeClass('active');// 버튼 활성화
                g_cs.faq_offset++;
            }
        }
    }
    else{ // FAQ 리스트 X (검색어 + 더보기 결과 없을떄)
        $("#more_getCsFaq").addClass('active');// 버튼 비활성화
        g_cs.faq_offset = 1;
    }
}

/*
    * 플로팅 고객센터(FAQ)
    * 상세보기 : show-hide
*/
$(document).on('click','.qna-title',function(){
    var qnaItem = $(this).closest('.cs-category-item');

    if (qnaItem.hasClass('active')) {
        qnaItem.find('.qna-content').slideUp();
        qnaItem.removeClass('active');
    }
    else{
        $('.qna-group .cs-category-item .qna-content').slideUp(0);
        $('.qna-group .cs-category-item').removeClass('active');
        qnaItem.find('.qna-content').slideDown();
        qnaItem.addClass('active');
    }
});

/*
    * 플로팅 고객센터(1:1 문의)
    * @제목, 이름, 연락처, 이메일, 문의내용
*/
function pushCustomer(){
    loading(true);
    $.ajax({
        type: 'POST',
        url: base_url+'api/customer/inquire/insert',
        data:{
            ci_t: $("#token").val(),
            title: $("#cs_title").val(),
            contents: $("#cs_contents").val(),
            name: $("#cs_name").val(),
            email:$("#cs_email").val(),
            phone:$("#cs_phone").val(),
        },
        success: function(resData) {
            // console.log('success >>>>');
            loading(false);
            donePushCustomer(resData);
        },
        error: function(resData) {
            // console.log('error >>>');
            loading(false);
            alert("전송할 데이터가 없거나 네트워크에 오류가 발생하였습니다.");
        }
    });
};

/*
    * 플로팅 고객센터(1:1 문의 결과 출력)
*/
function donePushCustomer(res){
    loading(false);
    var res = res;
    if(res.status === true){
        linkClicks('고객센터', '1:1문의전송', '1:1문의하기전송완료'); // 통계
        $('#formTab .result-panel .icon').addClass('success');

        var content = '\
                    <span class="highlight-blue">문의가 정상적으로 등록되었습니다.</span>\
                    <br>빠른 시간 내 답변드리도록 하겠습니다.\
                ';

        $('.result-info').html(content);
        $('.result-panel').css('display','block');

        // 폼 비우기
        $('#formTab .cs-form input, #formTab .cs-form textarea').val('');
        $('#formTab .cs-form input[type="checkbox"]').prop('checked',false);      
    }
    else{
        $('#formTab .result-panel .icon').addClass('fail');
        var content = '\
                    <span class="highlight-blue">문의가 등록되지 않았습니다.</span>\
                    <br>다시 한번 시도해 주세요.\
                ';
        $('.result-info').html(content);
        $('.result-panel').css('display','block');
    }
}

/*
    * 플로팅 고객센터 횡스크롤 확인
*/
function isSortScrolled() {
    var cropWidth = $('.sort-crop').css('width');
    var contentWidth = $('.sort-list').css('width');
    cropWidth = Math.round(cropWidth.substring(0,cropWidth.length-2));
    contentWidth = Math.floor(contentWidth.substring(0,contentWidth.length-2));
    if(cropWidth < contentWidth){
        if (!$('.sort-list').hasClass('end')) {
            $('.sort-btn-group a.btn-prev').addClass('disabled');
            $('.sort-btn-group a.btn-next').removeClass('disabled');
        } else {
            $('.sort-btn-group a.btn-prev').removeClass('disabled');
            $('.sort-btn-group a.btn-next').addClass('disabled');
        }
        return true;
    }else{
        $('.sort-list').removeClass('end');
        $('.sort-btn-group a.btn-prev').addClass('disabled');
        return false;
    }
}

/*
    * 고객센터 1:1문의 개인정보취급 (사파리)
*/
$(document).on('click', '#btn_cs_detail', function(){
    $('#cs_detail').addClass('active').css({'display':'block','z-index':'9000'});
    $('.cscenter .cs-body .tab-panel.active').css({'display':'none'});
});

$(document).on('click', '#btn_cs_detail_close', function(){
    $('#cs_detail').removeClass('active').css({'display':'none','z-index':'8000'});
    $('.cscenter .cs-body .tab-panel.active').attr("style", ""); // 인라인 삭제
});

var inner_width = $('#csCenter', parent.document).parent().parent().parent().width();

// 리사이즈 돌려서 글씨 띄우기
$(window).on('resize', debounce(function(e){
    inner_width = $('#csCenter', parent.document).parent().parent().parent().width();
    $(".cscenter").css("display","block");
},200));