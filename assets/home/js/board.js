jQuery(document).ready(function(){

    /*
        * 순서
        * 1. 공지사항
        * 2. 자주묻는 질문(FAQ)
        * 3. 대여지점
        * 4. 이벤트
    */
    /*
        * 게시판 공통 검색(ENTER)
        * 공지사항
        * 자주묻는 질문(FAQ)
        * 지점관리
        * 이벤트
    */
    $(".b-search").on('keyup', debounce(function(event){
        var search_word = $(this).val();
        var tg_id = $(this).attr("id");

        if(event.keyCode == 13){ // Enter
            $(".sub-more-btn").removeClass('active'); // 더보기 버튼 활성화
            switch (tg_id) {
                case "search-noti":{ // 공지사항
                    $("#tbody-noti").empty();
                    getNotiList(1, 6, search_word);
                    g_offset.noti_offset =1;
                    break;
                };
                case "search-faq":{ // 자주묻는 질문(FAQ)
                    $(".faq-box").empty();
                    var category = $(".faq-category-list").find('.active').data('category');
                    getFaqList(1, 6, search_word, category);
                    g_offset.faq_offset =1;
                    break;
                };
                case "search-branch":{ // 지점 리스트
                    $("#branch_list_group").empty();
                    getBranchList(1, 6, search_word);
                    g_offset.branch_offset = 1;
                    break;
                };
                case "search-event":{ // 이벤트 리스트
                    $(".sc-event-list").empty();
                    getEventList(1, 6, search_word);
                    g_offset.event_offset = 1;
                    break;
                };
            }
        }
        else{ // 검색어 수정
            $(".sub-more-btn").addClass('active'); // 더보기 버튼 숨김
            switch (tg_id) {
                case "search-noti":{ // 공지사항
                    g_offset.noti_offset = 1;
                    break;
                };
                case "search-faq":{ // 자주묻는 질문(FAQ)
                    g_offset.faq_offset = 1;
                    break;
                };
                case "search-branch":{ // 지점 관리 검색
                    g_offset.branch_offset = 1;
                    break;
                };
                case "search-event":{ // 이벤트 검색
                    g_offset.event_offset = 1;
                    break;
                };
            }
        }
    },200));

    /*
        * 게시판 공통 검색(Click)
        * 검색 아이콘 클릭
        * 검색어가 없을 경우는 전체 출력
        * 공지사항
        * 자주묻는 질문(FAQ)
        * 지점관리
        * 이벤트
    */
    $(".ico-b-search").click(debounce(function(event){
        var search_word = $(this).siblings('.b-search').val();
        var tg_id = $(this).attr("id");

        $(".sub-more-btn").removeClass('active'); // 더보기 버튼 활성화

        switch (tg_id) {
            case "btn-noti-search":{ // 공지사항
                $("#tbody-noti").empty();
                getNotiList(1, 6, search_word);
                g_offset.noti_offset =1;
                break;
            };
            case "btn-faq-search":{  // 자주묻는 질문(FAQ) 검색
                $(".faq-box").empty();
                var category = $(".faq-category-list").find('.active').data('category');
                getFaqList(1, 6, search_word, category);
                g_offset.faq_offset =1;
                break;
            };
            case "btn-branch-search":{ // 지점 관리 검색
                $("#branch_list_group").empty();
                getBranchList(1, 6, search_word);
                g_offset.branch_offset =1;
                break;
            };
            case "btn-event-search":{ // 이벤트 검색
                $(".sc-event-list").empty();
                getEventList(1, 6, search_word);
                g_offset.event_offset =1;
                break;
            };
            default:
                break;
        }
    },200));

    /* 
        * 공지사항 상세보기
        *
    */
    if($("#noti_read").length){
        var noti_idx = sliceUrlIdx();
        getViewNoti(noti_idx);
    }

    $("#noti_prev").click(function(){
        var noti_idx = $(this).data('notiIdx');
        sessionStorage.setItem("noti_idx", JSON.stringify(noti_idx));
    });

    $("#noti_next").click(function(){
        var noti_idx = $(this).data('notiIdx');
        sessionStorage.setItem("noti_idx", JSON.stringify(noti_idx));
    });

    /*
        * 자주묻는 질문(FAQ)
        * 카테고리 정렬
    */
    $(".faq-category-list .faq-category-item").on('click', debounce(function(event){
        $(".faq-box").empty();
        $("#more_faqList").removeClass('active'); // 버튼 활성화
        
        var category = $(this).data('category');
        $(".faq-category-list .faq-category-item").removeClass('active');
        $(this).addClass('active'); // 현재 카테고리 폰트 강조
        getFaqList(1, 6, $("#search-faq").val(), category);
        g_offset.faq_offset=1;
    },200));

    /*
        * 게시판 공통 더보기
        * 공지사항
        * 자주묻는 질문(FAQ)
        * 대여지점
        * 이벤트
    */
    $(".sub-more-btn").on('click', debounce(function(event){
        var tg_id = $(this).attr('id');
        switch (tg_id) {
            case "more_notiList":{ // 공지사항
                getNotiList(g_offset.noti_offset, 6, $("#search-noti").val());
                break;
            };
            case "more_faqList":{ // 자주묻는 질문(FAQ)
                var category = $(".faq-category-list").find('.active').data('category');
                getFaqList(g_offset.faq_offset, 6, $("#search-faq").val(), category);
                break;
            };
            case "more_branchList":{ // 대여지점
                getBranchList(g_offset.branch_offset, 6, $("#search-branch").val());
                break;
            };
            case "more_eventList":{ // 이벤트
                getEventList(g_offset.event_offset, 6, $("#search-event").val());
                break;
            };
            default:
                break;
        }
    },200));

    /*
        * 공지사항 리스트 출력
        * @offset
        * @limit
        * @search_word 
    */
    if($("#tbody-noti").length){
        getNotiList(1, 6, '');
    }

    /*
        * 자주묻는 질문(FAQ) 리스트 출력
        * @offset
        * @limit
        * @search_word
    */
    if($(".faq-area").length){
        getFaqList(1, 6, '', '');
    }

    /*
        * 대여지점 리스트
        * 지점 리스트 출력
        * @offset
        * @limit
        * @search_word
    */
    if($('#branch_list_group').length){
        getBranchList(1, 6, '');
    }

    /*
        * 이벤트 리스트
        * @offset
        * @limit
        * @search_word
    */
    if($('#section_event').length){
        getEventList(1, 6, '');
    }

    /*
        * 이벤트 상세보기
    */
    if($("#event_read").length){
        var event_idx = sliceUrlIdx();
        getViewEvent(event_idx);
    }
});

/*
    * 공지사항 상세보기 클릭
    * 공지 id값 => 세션스토리지 저장
*/
$(document).on('click','.noti_view', function(){
    var noti_idx = $(this).data('notiIdx');
    sessionStorage.setItem("noti_idx", JSON.stringify(noti_idx));
});

/*
    * 공지사항 상세보기
*/
function getViewNoti(idx){
    loading(true);
    $.ajax({
        type: 'GET',
        url: base_url+'api/board/notice/detail?idx='+idx+'',
        success: function(resData) {
            // console.log('success >>>>');
            doneViewNoti(resData);
        },
        error: function(resData) {
            // console.log('error >>>');
            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }
    });
}

function doneViewNoti(resData){
    loading(false);
    var res = resData.result.data[0];
    var res_link = resData.result;

    $("#noti_title").text(res.title);
    $("#noti_cnt").text(res.view_cnt);
    $(".b-read-content #editorContents").append(res.contents);
    $("#noti_date").text(res.reg_date.slice(0,10));

    if(res_link.prev_data == "NO DATA"){
        $("#noti_prev").text('이전 글이 없습니다.');
        $("#noti_prev").css("cursor","auto");
    }
    else{
        $("#noti_prev").text(res_link.prev_data[0].title);
        $("#noti_prev").attr('href',base_url+'home/support/notice?idx='+res_link.prev_data[0].idx+'&menu_code='+mCode+'&menu_up_code='+mUpCode+'');
        $("#noti_prev").data("notiIdx",res_link.prev_data[0].idx);
    }

    if(res_link.next_data == "NO DATA"){
        $("#noti_next").text('다음 글이 없습니다.');
        $("#noti_next").css("cursor","auto");
    }
    else{
        $("#noti_next").text(res_link.next_data[0].title);
        $("#noti_next").attr('href',base_url+'home/support/notice?idx='+res_link.next_data[0].idx+'&menu_code='+mCode+'&menu_up_code='+mUpCode+'');
        $("#noti_next").data("notiIdx",res_link.next_data[0].idx);
    }
}

/*
    * 자주묻는 질문(FAQ) : show-hide
*/
$(document).on('click','.faq-q',function(){
    var tg_q = $(this);
    var tg_a = $(this).siblings('.faq-a');
    var tg_acc = $(this).find('.ico-accordian');

    $(".ico-accordian").css({"transform":"rotate(0deg)"});
    $(".faq-a").slideUp();

    if(tg_a.is(':visible')){
         tg_a.slideUp();
    }
    else{
        tg_a.slideDown();
        tg_acc.css({"transform":"rotate(180deg)"});
    }
});


/*
    * 지점안내 상세보기(딤 팝업)
    * 팝업 open && 텍스트 출력
*/ 
$(document).on('click','.sub-store-item', debounce(function(event){
    var tg_data = $(this).data('branchName');
    var tg_id = $(this).attr('id');
    var modal = $(".branch-modal");
    var bList = JSON.parse(sessionStorage.getItem('branchList'));
    modal.attr("id",tg_id);

    var map_addr;

    for(var prop in bList){
        if(bList[prop].idx == tg_data){
            $("#store_branch_name").text(bList[prop].branch_name);
            $("#store_addr").text(bList[prop].addr + bList[prop].addr2);
            $("#store_office_tel").text(bList[prop].office_tel);
            $("#store_business_hours").text(bList[prop].business_hours);
            $("#store_additional_comment").text(bList[prop].additional_comment);
            $("#store_map_comment").text(bList[prop].map_comment);
            showModal("#"+tg_id);
            $('.store-modal').css('display','block');
            $('.store-modal .modal-box').css('display','block');
            map_addr = bList[prop].addr;
            map_name = bList[prop].branch_name;
            map_tel = bList[prop].office_tel;
        }
    }

    $(".store-modal-text").each(function(index){
        if($.trim($(".store-modal-text").eq(index).text()) == ''){// 지점 소개 항목 O
            $(".store-modal-text").eq(index).addClass('active');
        }
        else{// 지점 소개 항목 X => 아이콘 숨김
            $(".store-modal-text").eq(index).removeClass('active');
        }
    });

    /*
        * 구글 지도 연동
    */
    markerData = {address:map_addr , name: map_name,  tel:map_tel, index:'0'};
    initialize();
},200));


/*
    * 지점안내 상세보기(딤 팝업)
    * 팝업 close
*/
$(document).on('click','#store_modal_close, #store-dimmed',function(){
    var store_id = $(".modal").attr("id");
    $('.store-modal').css('display','none');
    $('.store-modal .modal-box').css('display','none');
    hideModal("#"+store_id);
});

/*
    * 공지사항 리스트 출력
    * @offset
    * @limit
    * @search_word 
*/
function getNotiList(offset, limit, search_word ){
    loading(true);
    $.ajax({
        type: 'GET',
        url: base_url+'api/board/notice/list?offset='+offset+'&limit='+limit+'&search_word='+search_word+'',
        success: function(resData){
            // console.log('success >>>>');
            if(resData.status === true && resData.result.message =="NO DATA"){
                loading(false);
                $("#more_notiList").addClass('active'); // 버튼 비활성화
                $(".b-table.b-table-typeA").addClass('active');

                if(search_word != '' && offset ==1){ //검색어 O && 새로 검색
                    $("#tbody-noti").empty();
                    var no_list = '<td colspan="4" style="border-right:0;">\
                                    <p class="response-no-result noti-no-result">검색된 결과가 없습니다.</p>\
                                </td>';
                    $("#tbody-noti").append(no_list);
                }
                else if(!$(".b-a-link").length){
                    $("#tbody-noti").empty();
                    var no_list = '<td colspan="4" style="border-right:0;">\
                                    <p class="response-no-result noti-no-result">공지사항이 없습니다.</p>\
                                </td>';
                    $("#tbody-noti").append(no_list);
                }

            }
            else if(resData.status === true){
                doneNotiList(resData, offset ,limit);
            }
        },
        error: function(resData){
            // console.log('error >>>');
            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }
    });
};

/*
    * 공지사항
    * 리스트 추가
*/
function doneNotiList(resData, offset, limit){
    loading(false);
    var list ={};
    var res = resData.result.data;

    if(res != undefined){// 공지사항 리스트 존재
        $(".response-no-result").remove();
        var n = (resData.result.total_count)-((offset-1)*res.length);
        if(res.length < limit){
            n = res.length;
        }

        for(var i=0; i<res.length; i++){
            list[i] ='<tr id="noti_item_'+res[i].idx+'" class="noti-item">\
                        <td class="td-number">'+n--+'</td>\
                        <td><a href="'+base_url+'home/support/notice?idx='+res[i].idx+'&menu_code='+mCode+'&menu_up_code='+mUpCode+'" class="b-a-link noti_view ellipsis-line-one" data-noti-idx="'+res[i].idx+'">'+res[i].title+'</a></td>\
                        <td>'+res[i].view_cnt+'</td>\
                        <td>'+res[i].reg_date.slice(0,10)+'</td>\
                     </tr>';

            $("#tbody-noti").append(list[i]);
        }

        /*
            * 더보기 전체 갯수로 제어
        */
        if(res.length<limit){ // 리스트 < 리미트 => 다음 데이터 없음
            $("#more_notiList").addClass('active');// 버튼 비활성화
            $(".b-table.b-table-typeA").addClass('active');
            g_offset.noti_offset = 1;
        }
        else if(res.length == limit){ // 리스트 == 리미트 => 다음 데이터 존재 가능 확인
            var cnt = $('.noti-item').length;
            if(resData.result.total_count == cnt){ // 더보기 X
                $("#more_notiList").addClass('active');// 버튼 비활성화
                $(".b-table.b-table-typeA").addClass('active');
                g_offset.noti_offset = 1;
            }
            else{ // 더보기 O
                $("#more_notiList").removeClass('active');// 버튼 활성화
                $(".b-table.b-table-typeA").removeClass('active');
                g_offset.noti_offset++;
            }
        }
    }
    else{ // 공지 리스트 X (검색어 + 더보기 결과 없을떄)
        $("#more_notiList").addClass('active');// 버튼 비활성화
        $(".b-table.b-table-typeA").addClass('active');
        g_offset.noti_offset = 1;
    }

    // 카테고리가 없을경우
    if($('.section-category').length == 0){
        $('.section-cs-search').addClass('board');
    }
};

/*
    * 자주묻는 질문(FAQ)
    * 리스트 조회
    * @offset
    * @limit
    * @search_word
*/
function getFaqList(offset, limit, search_word, category){
    loading(true);
    $.ajax({
        type: 'GET',
        url: base_url+'api/board/faq/list?offset='+offset+'&limit='+limit+'&category='+category+'&search_word='+search_word+'',
        success: function(resData){
            if(resData.status === true && resData.result.message =="NO DATA"){
                loading(false);
                $("#more_faqList").addClass('active'); // 버튼 비활성화
                $(".faq-area").addClass('active');

                if(search_word != '' && offset ==1){ //검색어 O && 새로 검색
                    $(".faq-box").empty();
                    var no_list = '<div class="faq-item">\
                                    <p class="response-no-result faq-no-result">검색된 결과가 없습니다.</p>\
                                </div>';
                    $(".faq-box").append(no_list);
                }
                else if(!$(".faq-a").length){
                    $(".faq-box").empty();
                    var no_list = '<div class="faq-item">\
                                    <p class="response-no-result faq-no-result">자주묻는 질문이 없습니다.</p>\
                                </div>';
                    $(".faq-box").append(no_list);
                }
            }
            else if(resData.status === true){
                doneFaq(resData, limit);
            }
        },
        error: function(resData){
            // console.log('error >>>');
            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }
    });
};

/*
    * 자주묻는 질문(FAQ)
    * 리스트 추가
*/
function doneFaq(resData, limit){
    loading(false);
    var list ={};
    var res = resData.result.data;

    if(res != undefined){// FAQ 리스트 존재
        $(".response-no-result").remove();
        for(var i=0; i<res.length; i++){
            list[i] ='<div class="faq-item">\
                        <div class="faq-q">\
                            <p><span class="ico-faq-q"></span>'+res[i].title+'<span class="ico-accordian"></span></p>\
                        </div>\
                        <div class="faq-a">\
                            <span class="ico-faq-a"></span>\
                            <div id="editorContents">\
                                <p>'+res[i].contents+'</p>\
                            </div>\
                        </div>\
                    </div>';
            $(".faq-box").append(list[i]);
        }


        /*
            * 더보기 전체 갯수로 제어
        */
        if(res.length<limit){ // 리스트 < 리미트 => 다음 데이터 없음
            $("#more_faqList").addClass('active');// 버튼 비활성화
            $(".faq-area").addClass('active');
            g_offset.faq_offset = 1;
        }
        else if(res.length == limit){ // 리스트 == 리미트 => 다음 데이터 존재 가능 확인
            var cnt = $('.faq-item').length;
            if(resData.result.total_count == cnt){ // 더보기 X
                $("#more_faqList").addClass('active');// 버튼 비활성화
                $(".faq-area").addClass('active');
                g_offset.faq_offset = 1;
            }
            else{ // 더보기 O
                $("#more_faqList").removeClass('active');// 버튼 활성화
                $(".faq-area").removeClass('active');
                g_offset.faq_offset++;
            }
        }

    }
    else{ // FAQ 리스트 X (검색어 + 더보기 결과 없을떄)
        $("#more_faqList").addClass('active');// 버튼 비활성화
        $(".faq-area").addClass('active');
        g_offset.faq_offset = 1;
    }

    // 카테고리가 없을경우
    if($('.section-category').length == 0){
        $('.section-cs-search').addClass('board');
    }
}

/*
    * 대여지점 리스트
    * 리스트 조회
    * @offset
    * @limit
    * @search_word
*/
function getBranchList(offset, limit, search_word){

    loading(true);
    $.ajax({
        type: 'GET',
        url: base_url+'api/branch/list?offset='+offset+'&limit='+limit+'&search_word='+search_word+'',
        success: function(resData) {
            // console.log('success >>>>');
            // console.log(resData);
            if(resData.status === true && resData.result.message =="NO DATA"){
                loading(false);
                $("#more_branchList").addClass('active'); // 버튼 비활성화

                if(search_word != '' && offset ==1 || !$(".sub-store-item").length ){ //검색어 O && 새로 검색
                    $('#branch_list_group').empty();
                    var no_list = '<div class="list-none-t">등록된 지점이 존재하지않습니다.<span></span></div>';
                    $('#branch_list_group').append(no_list);
                }
            }
            else if(resData.status === true){
                doneBranchList(resData, limit);
            }
        },
        error: function(resData) {
             // console.log(resData);
            alert("불러올 대여지점 데이터가 없거나 네트워크에 문제가 발생했습니다. ");
        }
    });
}
 var branchList = {};
sessionStorage.setItem("branchList", JSON.stringify(branchList));
/*
    * 대여지점 리스트
    * 대여 지점 출력
*/
function doneBranchList(resData, limit){
    loading(false);
    var list ={};
    var branchList = {};
    // console.log(resData);
    var res = resData.result.data;
    if(res != undefined){// 지점 리스트 O
        $(".response-no-result").remove();
        for(var i=0; i<res.length; i++){
            list[i] = '<div class="list-item-t sub-store-item wp-box scale-up" id="branch_'+res[i].idx+'" data-animate-effect="fadeInUp">\
                            <a href="javascript:return false;">\
                                <div class="list-item-t-img-area">\
                                    <div class="list-item-t-img scale-img" style="background-image:url(\''+base_url+res[i].path+'/'+res[i].thumb_img+'\');" aria-label="'+res[i].title+'"></div>\
                                </div>\
                                <div class="list-item-t-text">\
                                    <div class="list-item-t-title">\
                                        <h4 class="ellipsis-line-one">'+res[i].branch_name+'</h4>\
                                    </div>\
                                    <div class="list-item-t-desc">\
                                        <span class="ellipsis-line-two">'+res[i].addr+res[i].addr2+'('+res[i].addr_code+')'+'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>';

            $('#branch_list_group').append(list[i]);

            /*
                * 지점리스트 데이터 셋팅
            */
            $('#branch_'+res[i].idx).data('branch-name', res[i].idx);
        }

        $("#more_branchList").removeClass('active');// 버튼 활성화
        waypointContent();
        for(var i=0; i<res.length; i++){
            var bIndex = Object.keys(JSON.parse(sessionStorage.getItem('branchList'))).length;
            var branchList = JSON.parse(sessionStorage.getItem('branchList'));
            branchList[bIndex] = res[i];
            sessionStorage.setItem("branchList", JSON.stringify(branchList));
        }

        /*
            * 더보기 전체 갯수로 제어
        */
        if(res.length<limit){ // 리스트 < 리미트 => 다음 데이터 없음
            $("#more_branchList").addClass('active');// 버튼 비활성화
            g_offset.branch_offset = 1;
        }
        else if(res.length == limit){ // 리스트 == 리미트 => 다음 데이터 존재 가능 확인
            var cnt = $('.sub-store-item').length;
            if(resData.result.total_count == cnt){ // 더보기 X
                $("#more_branchList").addClass('active');// 버튼 비활성화
                g_offset.branch_offset = 1;
            }
            else{ // 더보기 O
                $("#more_branchList").removeClass('active');// 버튼 활성화
                g_offset.branch_offset++;
            }
        }
    }
    else{ // 지점 리스트 X (검색어 + 더보기 결과 없을 떄)
        $("#more_branchList").addClass('active');// 버튼 비활성화
        g_offset.branch_offset = 1;
    }

    $('#section_branch').removeClass('section-list-A section-list-B section-list-C');

    // 카테고리가 없을경우
    if($('.section-category').length == 0){
        $('.section-cs-search').addClass('board');
    }
};


/*
    * 이벤트 리스트
*/
function getEventList(offset, limit, search_word) {
    loading(true);

    $.ajax({
        type: 'GET',
        url: base_url+'api/board/event/list?offset='+offset+'&limit='+limit+'&search_word='+search_word+'',
        success: function(resData){
            // console.log('success >>>>');
            // console.log(resData);
            if(resData.status === true && resData.result.message =="NO DATA"){
                loading(false);
                $("#more_eventList").addClass('active'); // 버튼 비활성화
                if(search_word != '' && offset ==1){ //검색어 O && 새로 검색
                    $(".sc-event-list").empty();
                    var no_data = '<div class="ev-none">검색된 이벤트가 존재하지않습니다.<span></span></div>';
                    $(".sc-event-list").append(no_data);
                }
                else if(!$(".ev-item").length){
                    $(".sc-event-list").empty();
                    var no_list = '<div class="ev-none">진행중인 이벤트가 없습니다.<span></span></div>';
                    $(".sc-event-list").append(no_list);
                }

            }
            else if(resData.status === true){
                loading(false);
                doneEventList(resData.result.data, limit, resData.result.total_count);
            }
        },
        error: function(resData){
            // console.log('error >>>');
            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }
    });
};

function doneEventList(res, limit, total_count) {
    // console.log(res);
    var today = new Date();
    var isYear = today.getFullYear();
    var isMonth = today.getMonth()+1;
    var isDate = today.getDate();
    var today_str = new Date("\'"+isMonth+"/"+isDate+"/"+isYear+"\'"); // 오늘 날짜
    var list ={};

    if(res != undefined){// POST 리스트 존재
        for(var i=0; i<res.length; i++){
            list[i] ='<div id="ev_box_'+res[i].idx+'" class="ev-box wp-box scale-up" data-animate-effect="fadeInUp">\
                            <a href="'+base_url+'home/support/event?idx='+res[i].idx+'&menu_code='+mCode+'&menu_up_code='+mUpCode+'">\
                                <div class="ev-date">\
                                    <span>'+res[i].reg_date.slice(5,7)+'.'+res[i].reg_date.slice(8,10)+'</span>\
                                    <span>'+res[i].reg_date.slice(0,4)+'</span>\
                                </div>\
                                <div class="ev-text">\
                                    <div class="ev-title">\
                                        <h4 class="ellipsis-line-one">'+res[i].title+'</h4>\
                                    </div>\
                                    <div class="ev-desc">\
                                        <span class="ellipsis-line-two">'+res[i].sub_title+'</span>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>';

            $('#section_event .sc-event-list').append(list[i]);
        }

        waypointContent();

        /*
            * 더보기 전체 갯수로 제어
        */
        if(res.length<limit){ // 리스트 < 리미트 => 다음 데이터 없음
            $("#more_eventList").addClass('active');// 버튼 비활성화
            $('#section_event').addClass('active');
            g_offset.event_offset = 1;
        }
        else if(res.length == limit){ // 리스트 == 리미트 => 다음 데이터 존재 가능 확인
            var cnt = $('.ev-box').length;

            if(total_count == cnt){ // 더보기 X
                $("#more_eventList").addClass('active');// 버튼 비활성화
                $('#section_event').addClass('active');
                g_offset.event_offset = 1;
            }
            else{ // 더보기 O
                $("#more_eventList").removeClass('active');// 버튼 활성화
                $('#section_event').removeClass('active');
                g_offset.event_offset++;
            }
        }
    }
};

/*
    * 이벤트 상세보기
*/
function getViewEvent(idx){
    loading(true);
    $.ajax({
        type: 'GET',
        url: base_url+'api/board/event/detail?idx='+idx+'',
        success: function(resData) {
            // console.log('success >>>>');
            // console.log(resData);
            if(resData.status === true && resData.message =="success"){
                loading(false);
                doneViewEvent(resData);
            }
            else{
                loading(false);
                alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.")
            }
        },
        error: function(resData) {
            // console.log('error >>>');
            loading(false);
            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }
    });
}

function doneViewEvent(resData){
    loading(false);
    var res = resData.result.data[0];
    var res_link = resData.result;

    $("#noti_title").text(res.title);
    $("#noti_cnt").text(res.view_cnt);
    $(".b-read-content #editorContents").append(res.contents);
    $("#noti_date").text(res.reg_date.slice(0,10));

    if(res_link.prev_data == "NO DATA"){
        $("#noti_prev").text('이전 글이 없습니다.');
        $("#noti_prev").css("cursor","auto");
    }
    else{
        $("#noti_prev").text(res_link.prev_data[0].title);
        $("#noti_prev").attr('href',base_url+'home/support/event?idx='+res_link.prev_data[0].idx+'&menu_code='+mCode+'&menu_up_code='+mUpCode+'');
        $("#noti_prev").data("notiIdx",res_link.prev_data[0].idx);
    }

    if(res_link.next_data == "NO DATA"){
        $("#noti_next").text('다음 글이 없습니다.');
        $("#noti_next").css("cursor","auto");
    }
    else{
        $("#noti_next").text(res_link.next_data[0].title);
        $("#noti_next").attr('href',base_url+'home/support/event?idx='+res_link.next_data[0].idx+'&menu_code='+mCode+'&menu_up_code='+mUpCode+'');
        $("#noti_next").data("notiIdx",res_link.next_data[0].idx);
    }
}
