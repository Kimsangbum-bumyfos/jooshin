jQuery(document).ready(function() {

    /*
        * 페이징 및 동기식 변경
        * 리스트 페이지
    */
    if($('#list_service').length){
        /* [GET] */
        sOffset != '' ? sc.config.offset = sOffset : '';
        sCategory != '' ? sc.config.category = sCategory : '';
        sc.getList(sc.config.offset, sc.config.limit, sc.config.category);
        paging.creat(sc.config.offset, sc.config.total_count, sc.config.limit);
    }

    /*
        * 카테고리 클릭
    */
    $('#sc_category > li').click(function(){
        var category = $(this).data('category');
        window.location.href = list_base_url+'&category='+category+'&offset=1';
    });

    /*
        * 상세페이지
    */
    if($('#detail_service').length){
        sc.getView(getUrlIdx());
        calcSlick();
    }

    $(window).on('resize', debounce(function(e){

        if(wrap_width<1024){
            // 상세 페이지 슬릭 비율에 맞게 높이 조절
            calcSlick();
        }

        // resize paging
        if($('#paging').length){
            $('#paging').empty();
            paging.creat(sc.config.offset, sc.config.total_count, sc.config.limit);
        }

    },0));

});


/*
    * 제품 / 용역 상세 반응형 셋팅
*/
function calcSlick(){
    var w = Math.floor($('#detail_service .img-area').width());
    var calcW = Math.floor(w/256);
    var h = calcW*165;
    $('#detail_service .img-area .sc-img').css({'height':h+'px'});
};


var sc = {
    config:{
        offset: 1,
        limit: 8,
        category:'',
        list_id:'list_service',
        total_count: 0,
    },
    /*
        * 리스트 호출
        * @offset, @limit, @category
    */
    getList:function(offset, limit, category){
        var category = encodeURIComponent(category); // IE encode
        $.ajax({
            type: 'GET',
            async: false,
            url: base_url+'api/services/service/list?offset='+offset+'&limit='+limit+'&category='+category+' ',
            success: function(resData){
                sc.config.total_count = 0;
                if(resData.status === true && resData.result.message =="NO DATA"){
                    // 더보기 X && 리스트가 없을 경우
                    if($('#list_service').find('.service-item').length == 0){
                        sc.clearList();         // 리스트 초기화
                        sc.noList();            // 데이터 없음 출력
                        $('#paging').remove();
                    }
                }
                else if(resData.status === true && resData.message =="Get List Success"){
                    sc.config.total_count = resData.result.total_count;
                    sc.setList(resData.result.data, resData.result.total_count, offset, category);
                }
            },
            error: function(resData){
                // console.log('error >>>');
                alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            }
        });
    },
    setList:function(res, total_count, offset, category){
        for(var prop in res){
            var item ='<div class="service-item wp-box scale-up" data-animate-effect="fadeInUp">\
                        <div class="service-inner">\
                        <a href="'+base_url+'home/service/detail?idx='+res[prop].idx+'&menu_code='+mCode+'&menu_up_code='+mUpCode+'&category='+category+'&offset='+offset+'" class="service-img-area" >\
                            <div class="service-img scale-img" style="background-image:url('+base_url+res[prop].path+'/'+res[prop].thumb_img+');" aria-label="'+res[prop].title+'"></div>\
                        </a>\
                        <div class="service-desc">\
                            <h3 class="ellipsis-line-two">'+res[prop].title+'</h3>\
                        </div>\
                    </div>';

            $('#'+sc.config.list_id).append(item);
        }

        
        waypointContent();
    },
    noList:function(){
        var item ='<div class="service-no-list">등록된 용역이 없습니다.</div>';
        $('#'+sc.config.list_id).append(item);
    },
    clearList:function(){
        $('#'+sc.config.list_id).empty();
    },
    getView:function(idx){
        $.ajax({
            type: 'GET',
            url: base_url+'api/services/service/detail?idx='+idx+' ',
            success: function(resData){
                // console.log('success >>>>');
                if(resData.status === true && resData.result.message =="NO DATA"){
                    alert("잘못된 접근입니다.");
                    window.location.href=base_url;
                    return;
                }
                else if(resData.status === true && resData.message =="success"){
                    sc.setView(resData.result.data[0]);
                }
            },
            error: function(resData){
                // console.log('error >>>');
                alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            }
        });


    },
    setView:function(res){
        var container = $('#detail_service');
        // slider
        var item = '<li class="sc-img" style="background-image:url('+base_url+res.path+'/'+res.thumb_img+');" aria-label="'+res.title+'"></li>';
        container.find('.img-area').append(item);

        if(res.img_list != ""){
            var imgList = res.img_list.split(',');

            for(var prop in imgList){
                var item = '<li class="sc-img" style="background-image:url('+base_url+res.path+'/'+imgList[prop]+');" aria-label="'+res.title+'"></li>';
                container.find('.img-area').append(item);
            }

            $('.img-area').slick({
                infinite: true, // 무한 재생
                adaptiveHeight: true, // 슬라이더 높이를 현재 슬라이드에 맞춤
                slidesToShow: 1, // 슬라이더 보여줄 갯수
                slidesToScroll: 1, // 한 번에 스크롤 할 슬라이드 수
                arrows: false, // 다음,  이전 화살표 사용
                autoplay: true, // 자동재생
                autoplaySpeed : 12000, // 자동재생 시간
                dots: true, // 현재 슬라이드 표시점
                swipe: true, // 터치 스와이프
                swipeToSlide: true, // slidesToScroll에 관계없이 스 와이프하여 슬라이드
                touchMove: true, // 터치로 슬라이드 이동 가능
            });
        }
        else{
            container.find('.img-area li').addClass('one');
        }

        container.find('.view-detail .title h2').text(res.title);
        // container.find('.info').append('<li><span>발주처 : <i>'+res.buyer+'</i></span></li><li><span>기간 : <i>'+res.s_date.slice(2,4)+'.'+res.s_date.slice(5,7)+'.'+res.s_date.slice(8,10)+'~'+res.e_date.slice(2,4)+'.'+res.e_date.slice(5,7)+'.'+res.e_date.slice(8,10)+'</i></span></li>');
        container.find('#editorContents').html(res.contents);
    },
}




/*
    * 동기식 페이징
*/
var paging = {
    config:{
        paging_cnt_max : 10,
        paging_cnt_max_mobile : 5,
        device: '',
        pageNo: '',
        last_page: '',
    },
    device: function(){
        if(window.innerWidth >=767)
            return 'pc';
        else
            return 'mobile';
    },
    creat: function (pageNo, total_count, paging_limit) {
        paging.config.device = paging.device();
        pageNo = parseInt(pageNo);
        var quotient = parseInt(total_count / paging_limit);                            // 몫
        var remainder = total_count % paging_limit;                                     // 나머지
        if(remainder != 0 )                                                             // 나머지가 있을 경우 마지막 페이지 추가
            var last_page = parseInt(quotient + 1);
        else                                                                            // 나머지 없음
            var last_page = quotient;


        var url = base_url+'home/service?menu_code='+mCode+'&menu_up_code='+mUpCode+'';
        var query_string = '&category='+sc.config.category+'';
        var prev = '';                                                                  // 이전으로
        if (pageNo != 1 && last_page != 1)                                              // 현재 != 첫페이지 && 마지막페이지 != 첫페이지
            prev = '<a href="'+url+query_string+'&offset='+parseInt(pageNo-1)+'" class="prev"></a>';
        else
            prev = '<a class="prev disabled"></a>';

        var next = '';                                                                  // 다음으로
        if (pageNo != last_page)                                                        // 현재 != 마지막페이지 &&  != 전체 페이지
            next = '<a href="'+url+query_string+'&offset='+parseInt(pageNo+1)+'" class="next"></a>';
        else
            next = '<a class="next disabled"></a>';

        var list = '<span>';

        if(paging.config.device == 'pc'){
            if(last_page > 10)
                var max = 10;
            else
                var max = last_page;

            var paging_cnt_max = max;
            var paging_cnt_half = 5;
            var paging_cnt_left = 10;
            var paging_calc_right = pageNo+paging_cnt_half;
        }
        else{
            if(last_page > 5)
                var max = 5;
            else
                var max = last_page;

            var paging_cnt_max = max;
            var paging_cnt_half = 3;
            var paging_cnt_left = 5;
            var paging_calc_right = pageNo+paging_cnt_half-1;
        }

        if(pageNo > paging_cnt_half && last_page > paging_cnt_max) {
            if(parseInt(pageNo)+parseInt(paging_cnt_half) <= last_page){
                for(var i = parseInt(pageNo-paging_cnt_half+1); i <= pageNo; i ++){ 
                    var current_page = i == pageNo ? 'current' : '';
                    list += '<a href="'+url+query_string+'&offset='+i+'" class="' + current_page + '">' + i + '</a>';
                }
                for(var j = pageNo+1; j <= paging_calc_right; j++ ) {
                    var current_page = j == pageNo ? 'current' : '';
                    list += '<a href="'+url+query_string+'&offset='+j+'" class="' + current_page + '" >' + j + '</a>';
                }
            }
            else{
                var right_page = last_page - pageNo;
                var left_page = paging_cnt_left - right_page;

                for(var i = parseInt(pageNo-left_page+1); i < pageNo; i ++){
                    var current_page = i == pageNo ? 'current' : '';
                    list += '<a href="'+url+query_string+'&offset='+i+'" class="' + current_page + '" >' + i + '</a>';
                }

                for(var j = pageNo; j <= pageNo+right_page; j++ ) {
                    var current_page = j == pageNo ? 'current' : '';
                    list += '<a href="'+url+query_string+'&offset='+j+'" class="' + current_page + '" >' + j + '</a>';
                }

            }
        }
        else{
            var start = 1;
            for (start; start <= max; start++) {
                var current_page = start == pageNo ? 'current' : '';
                list += '<a href="'+url+query_string+'&offset='+start+'" class="' + current_page + '" >' + start + '</a>';
            }
        }
        list += '</span>';
        $('#paging').append(prev + list + next);

        // 현제 페이지 선택 막기
        $('#paging').find('a.current').removeAttr("href");
    },
};