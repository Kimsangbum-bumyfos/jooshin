jQuery(document).ready(function() {


    /*
        * 페이징 및 동기식 변경
    */
    /*
        * 제품 리스트 페이지
    */
    if($('#list_product').length){
        /* [GET] */
        pOffset != '' ? pd.config.offset = pOffset : '';
        pSearchWord != '' ? pd.config.search_word = pSearchWord : '';
        pDepth_1 != '' ? pd.config.depth_1 = pDepth_1 : '';
        pDepth_2 != '' ? pd.config.depth_2 = pDepth_2 : '';
        pDepth_3 != '' ? pd.config.depth_3 = pDepth_3 : '';
        if(pSearchFlag != 't'){                                                                             // 검색시에는 셋팅 X
            /* [SIDE MENU] */
            /* step-1 */
            if(pDepth_1 != ""){
                $('#snb_product').find("[data-name='"+pDepth_1+"']").addClass('toggle');                    // depth_1
                $('#snb_product').find("[data-name='"+pDepth_1+"']").find('.snb-depth2').slideDown(300);    // depth_2
            
                /* [exc] step-3  : list_depth_3*/
                var step_1_exc_list = pd.side_list_d3(pDepth_1, pDepth_2);
                if(pDepth_3 == '')
                    var step_1_exc_active = 0;
                else
                    var step_1_exc_active = step_1_exc_list.indexOf(pDepth_3);
                pd.add_side_list_d3(step_1_exc_list, step_1_exc_active, pDepth_1, pDepth_2);

                /* [TOP MENU] */
                if(pDepth_1 != "제작품"){

                    // 2뎁스 셋팅
                    switch (pDepth_1) {
                        case "계측장비":
                        case "비디오게이지":
                        case "시험용치구":
                            pt.setSpan('ALL', '', 2);
                            pt.top_set_d3(pt.top_list_d2(pDepth_1));
                            break;
                        default:
                            pt.top_set_d3(pt.top_list_d3(pDepth_2));  // 계측장비, 비디오, 시험용 제외
                            break;
                    }
                    pt.showDepth(2);
                    showSelect(2); // mobile

                    pt.showDepth(3);
                    showSelect(3); // mobile

                    // [exc] set span
                    if(pDepth_3 != ''){
                        pt.setSpan(pDepth_3, pDepth_3, 3);
                    }
                }
                else{
                    pt.hideDepth(2);
                    pt.hideDepth(3);
                    hideSelect(2);
                    hideSelect(3);
                }
                pt.setSpan(pDepth_1, pDepth_1, 1);
            }

            /* step-2 */
            if(pDepth_2 != ""){
                $('#snb_product').find("[data-name='"+pDepth_1+"']").find('.snb-depth2').find("[data-name='"+pDepth_2+"']").addClass('active');

                /* [TOP MENU] */
                var t_get_depth_2 = pt.top_list_d2(pDepth_1);   // 스트레인게이지, 계측센서
                if(t_get_depth_2 != false){
                    pt.top_set_d2(t_get_depth_2);
                }
                pDepth_2 == "변형률계n무응력계" ? pt.setSpan('변형률계&무응력계', pDepth_2, 2) : pt.setSpan(pDepth_2, pDepth_2, 2);
            }
            /* [MOBILE MENU] */
            sync_select.get_list(1);
            sync_select.get_list(2);
            sync_select.get_list(3);
            if(pDepth_1 == '계측장비' || pDepth_1 == '비디오게이지' || pDepth_1 == '시험용치구')
                sync_select.exc_2();
        }
        else{
            // 검색시 숨김
            pt.setSpan('선택', '', 1);
            hideSelect(1);
            hideSelect(2);
            hideSelect(3);
            $('.product-container').addClass('mobile');
        }
        pd.getList(pd.config.offset, pd.config.limit, pd.config.search_word, pDepth_1, pDepth_2, pDepth_3);
        paging.creat(pd.config.offset, pd.config.total_count, pd.config.limit);
    }
    /*****************************************************************/

    $('#searchProduct').on('keyup', debounce(function(event){
        var search_word = $(this).val();
        if(event.keyCode == 13){ // Enter
            if(search_word == ""){
                alert('검색어를 입력해주세요.');
                return;
            }
            window.location.href = base_url+'home/product?menu_code='+mCode+'&menu_up_code='+mUpCode+'&search_word='+search_word+'&search_flag=t';
        }
    },200));

    $('#ico_searchProduct').on('click', debounce(function(event){
        var search_word = $('#searchProduct').val();
        if(search_word == ""){
            alert('검색어를 입력해주세요.');
            return;
        }
        window.location.href = base_url+'home/product?menu_code='+mCode+'&menu_up_code='+mUpCode+'&search_word='+search_word+'&search_flag=t';
    },200));

    /*
        * 상세페이지
    */
    if($('#detail_product').length){
        pd.getView(getParameterByName('idx'));
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
            paging.creat(pd.config.offset, pd.config.total_count, pd.config.limit);
        }
    },0));
});

/*
    * 제품 / 용역 상세 반응형 셋팅
*/
function calcSlick(){
    var w = Math.floor($('#detail_product .img-area').width());
    var calcW = Math.floor(w/256);
    var h = calcW*165;
    $('#detail_product .img-area .pd-img').css({'height':h+'px'});
};

/*
    * [side menu] 1뎁스 클릭
*/
$(document).on('click', '.snb-depth1 > li', function(){
    var tg = $(this);
    if(tg.hasClass('toggle')){
        if(tg.find('.snb-depth2').length == 0)
            return;
        tg.removeClass('toggle');
        tg.find('.snb-depth2').slideUp(300);

    }
    else{
        $('.snb-depth1 > li').removeClass('toggle');
        $('.snb-depth1 > li').find('.snb-depth2').slideUp(300);
        tg.addClass('toggle');
        tg.find('.snb-depth2').slideDown(300);
    }
});

/* [top menu - trail] */
$(document).on('click', '.trail-item > span', function(){
    var depth = $(this).parent('.trail-item');
    var ul = depth.find('ul');
    var p_id = $(this).parent('').attr('id');

    // style
    if(depth.hasClass('toggle')){ 
        // 닫기
        depth.removeClass('toggle');
        ul.slideUp(350);
    }
    else{
        // 열기
        $('.toggle-item').removeClass('toggle');
        switch (p_id) {
            case "trail_depth1":
                $('#trail_item_depth2').slideUp(350);
                $('#trail_item_depth3').slideUp(350);
                break;
            case "trail_depth2":
                $('#trail_item_depth1').slideUp(350);
                $('#trail_item_depth3').slideUp(350);
                break;
            case "trail_depth3":
                $('#trail_item_depth1').slideUp(350);
                $('#trail_item_depth2').slideUp(350);
                break;
            default:
                // statements_def
                break;
        }

        depth.addClass('toggle');
        ul.slideDown(350);
    }
});

/*
    * [top menu] 1뎁스 클릭
*/
$(document).on('click', '#trail_item_depth1 li', function(){
    var tg_name = $(this).data('name');
    switch (tg_name) {
        case "스트레인게이지":
            pt.movePage(tg_name, tg_name, '');
            break;
        case "계측센서":
            pt.movePage(tg_name, '하중계', '');
            break;
        default:
            pt.movePage(tg_name, '', ''); 
    }
});

/*
    * [top nav] 2뎁스 클릭
*/
$(document).on('click', '#trail_item_depth2 li', function(){
    var tg_name = $(this).data('name');

    if(pDepth_1 == '스트레인게이지' || pDepth_1 == '계측센서')
        pt.movePage(pDepth_1, tg_name, '');

});   

/*
    * [top nav] 3뎁스 클릭
*/
$(document).on('click', '#trail_item_depth3 li', function(){
    var tg_name = $(this).data('name');
    pt.movePage(pDepth_1, pDepth_2, tg_name);
});

/*
    * [mobile select]
*/
$(document).on('change', '#trail_select_depth1', function(){
    var tg_name = $(this).val();
    switch (tg_name) {
        case "스트레인게이지":
            pt.movePage(tg_name, tg_name, '');
            break;
        case "계측센서":
            pt.movePage(tg_name, '하중계', '');
            break;
        default:
            pt.movePage(tg_name, '', ''); 
    }
});

$(document).on('change', '#trail_select_depth2', function(){
    var tg_name = $(this).val();
    if(pDepth_1 == '스트레인게이지' || pDepth_1 == '계측센서')
        pt.movePage(pDepth_1, tg_name, '');
});

$(document).on('change', '#trail_select_depth3', function(){
    var tg_name = $(this).val();
    if(tg_name == 'ALL')
        tg_name = '';
    pt.movePage(pDepth_1, pDepth_2, tg_name);
});

var pd = {
    config:{
        offset: 1,
        limit: 10,
        search_word :'',
        depth_1: '',
        depth_2: '',
        depth_3: '',
        total_count: 0,
    },
    /*
        * 리스트 호출
        * @offset, @limit, @search_word, @depth_1, @depth_2, @depth_3, @target = 뎁스(1/2/3/검색입력)
    */
    getList:function(offset, limit, search_word, depth_1, depth_2, depth_3){
        var depth_1 = encodeURIComponent(depth_1); // IE encode
        var depth_2 = encodeURIComponent(depth_2); // IE encode
        var depth_3 = encodeURIComponent(depth_3); // IE encode
        var search_word = encodeURIComponent(search_word); // IE encode
        $.ajax({
            type: 'GET',
            async: false,
            url: base_url+'api/products/product/list?offset='+offset+'&limit='+limit+'&search_word='+search_word+'&depth_1='+depth_1+'&depth_2='+depth_2+'&depth_3='+depth_3+' ',
            success: function(resData){
                pd.config.total_count = 0;
                if(resData.status === true && resData.result.message =="NO DATA"){
                    // 더보기 X && 리스트가 없을 경우
                    if($('#list_product').find('.list-item').length == 0){
                        pd.clearList();           // 리스트 초기화
                        pd.noList();              // 데이터 없음 출력
                        $('#paging').remove();
                    }
                }
                else if(resData.status === true && resData.message =="Get List Success"){
                    pd.config.total_count = resData.result.total_count;
                    pd.setList(resData.result.data, resData.result.total_count, decodeURIComponent(depth_1), decodeURIComponent(depth_2), decodeURIComponent(depth_3), offset, decodeURIComponent(search_word));
                }
            },
            error: function(resData){
                alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            }
        });
    },
    setList:function(res, total_count, depth_1, depth_2, depth_3, offset, search_word){
        for(var prop in res){
            var item ='<div id="product_item_'+res[prop].idx+'" class="list-item wp-box scale-up" data-animate-effect="fadeInUp" data-depth1="'+res[prop].depth_1+'" data-depth2="'+res[prop].depth_2+'" data-depth3="'+res[prop].depth_3+'">';
                    if(search_word == '')
                        item += '<a href="'+base_url+'home/product/detail?idx='+res[prop].idx+'&menu_code='+mCode+'&menu_up_code='+mUpCode+'&depth_1='+depth_1+'&depth_2='+depth_2+'&depth_3='+depth_3+'&offset='+offset+'&search_word='+search_word+'">';
                    else
                        item += '<a href="'+base_url+'home/product/detail?idx='+res[prop].idx+'&menu_code='+mCode+'&menu_up_code='+mUpCode+'&depth_1='+depth_1+'&depth_2='+depth_2+'&depth_3='+depth_3+'&offset='+offset+'&search_word='+search_word+'&search_flag=t">';
                    item += '<div class="list-item-img-area">\
                                    <div class="list-item-img scale-img" style="background-image:url('+base_url+res[prop].path+'/'+res[prop].thumb_img+');" aria-label="'+res[prop].title+'"></div>\
                                </div>\
                                <div class="list-desc"></div>\
                            </a>\
                        </div>';
            $('#list_product').append(item);

            if(res[prop].depth_1 == "시험용치구"){
                 // 타입
                if(res[prop].type != "" && res[prop].type != null && res[prop].type != 'null')
                    $('#product_item_'+res[prop].idx).find('.list-desc').append('<span class="ellipsis-line-one">타입 : <i>'+res[prop].type+'</i></span>');
                // 모델명(시험방식)
                if(res[prop].model_name != "" && res[prop].model_name != null && res[prop].model_name != 'null')
                    $('#product_item_'+res[prop].idx).find('.list-desc').append('<span class="ellipsis-line-one">시험방식 : <i>'+res[prop].model_name+'</i></span>');
                // 제조사
                if(res[prop].manufacturer != "" && res[prop].manufacturer != null && res[prop].manufacturer != 'null')
                    $('#product_item_'+res[prop].idx).find('.list-desc').append('<span class="ellipsis-line-one">제조사 : <i>'+res[prop].manufacturer+'</i></span>');
            }
            else {
                // 제품명
                if(res[prop].title != "" && res[prop].title != 'null' && res[prop].title != 'null')
                    $('#product_item_'+res[prop].idx).find('.list-desc').append('<span class="ellipsis-line-one">제품명 : <i>'+res[prop].title+'</i></span>');
                // 모델명
                if(res[prop].model_name != "" && res[prop].model_name != null && res[prop].model_name != 'null')
                    $('#product_item_'+res[prop].idx).find('.list-desc').append('<span class="ellipsis-line-one">모델명 : <i>'+res[prop].model_name+'</i></span>');
                // 제조사
                if(res[prop].manufacturer != "" && res[prop].manufacturer != null && res[prop].manufacturer != 'null')
                    $('#product_item_'+res[prop].idx).find('.list-desc').append('<span class="ellipsis-line-one">제조사 : <i>'+res[prop].manufacturer+'</i></span>');
                // 타입
                if(res[prop].type != "" && res[prop].type != null && res[prop].type != 'null')
                    $('#product_item_'+res[prop].idx).find('.list-desc').append('<span class="ellipsis-line-one">타입 : <i>'+res[prop].type+'</i></span>');
                // 측정범위
                if(res[prop].sensor_range != "" && res[prop].sensor_range != null && res[prop].sensor_range != 'null'){
                    $('#product_item_'+res[prop].idx).find('.list-desc').append('<span class="ellipsis-line-one">측정범위 : <i>'+res[prop].sensor_range+'</i></span>');
                }
            }

            if(res[prop].depth_2 == "토압계")
                if(res[prop].sensor_outline != "" && res[prop].sensor_outline != null && res[prop].sensor_outline != 'null')
                    $('#product_item_'+res[prop].idx).find('.list-desc').append('<span class="ellipsis-line-one">외경 : <i>'+res[prop].sensor_outline+'</i></span>');
                
        }

        waypointContent();
    },
    showDepth:function(selector){
        selector.removeClass('hide');
    },
    hideDepth:function(selector){
        selector.addClass('hide');
    },
    clearList:function(){
        $('#list_product').empty();
    },
    noList:function(target){
        var item = '<div class="product-no-list">제품이 존재하지 않습니다.</div>';
        $('#list_product').append(item);
        $('#paging').remove();
    },
    add_side_list_d3:function(list, index_active, depth_1, depth_2){
        if(list == false)
            return;

        $('#list_depth_3').removeClass('hide');
        $('#list_depth_3').empty();

        for(var prop in list){
            var cls = index_active == prop ? 'active' : '';
            if(list[prop] =="ALL")
                var item ='<li class="'+cls+'" data-name="">\
                            <a href="'+list_base_url+'&depth_1='+depth_1+'&depth_2='+depth_2+'">ALL</a>\
                           </li>';
            else
                var item ='<li class="'+cls+'" data-name="'+list[prop]+'">\
                            <a href="'+list_base_url+'&depth_1='+depth_1+'&depth_2='+depth_2+'&depth_3='+list[prop]+'">'+list[prop]+'</a>\
                          </li>';
            $('#list_depth_3').append(item);
        }

    },
    /*
        * [side_list_d3] : 좌측메뉴 뎁스3 셋팅 리스트
    */
    side_list_d3:function(depth_1, depth_2){
        if(depth_1 == "계측장비")
            depth_2 = "계측장비";
        else if(depth_1 == "비디오게이지")
            depth_2 = "비디오게이지";
        else if(depth_1 == "시험용치구")
            depth_2 = "시험용치구";

        var depth_3;
        switch (depth_2) {
            case "계측장비": // 계측장비
                var depth_3 = ['ALL', 'JSH', 'KYOWA', 'DEWESOFT', 'Campbell Scientific', '기타'];
                break;
            case "스트레인게이지":
                var depth_3 = ['ALL', 'MM', 'KYOWA', 'SHOWA', '기타'];
                break;
            case "악세사리":
                var depth_3 = ['ALL','Adhesives', 'Coating Materials', 'Gauge installation Tape', 'Extension Cable', 'Spot welder', 'Strain Gauge Clamp', 'Strain Gauge Installation Tool kit', '기타'];
                break;
            case "하중계":
                var depth_3 = ['ALL', 'Compression', 'Tension/Compression', 'Tension', 'Component', 'Torque', '기타'];
                break;
            case "지진/가속도계":
                var depth_3 = ['ALL','Servo Type', 'Strain Gauge Type', 'ICP Type', 'Mems Type', '기타'];
                break;
            case "변위계":
                var depth_3 = ['ALL','Strain Gauge Type', 'Laser Type', 'Potentio Meter Type', '기타'];
                break;
            case "신율계":
                var depth_3 = ['ALL', 'Axial', 'High Temperature Axial', 'Clip-on Gauge', 'Deflectometers', 'Laser Extensometers', 'Calibrators', '기타'];
                break;
            case "토압계":
                var depth_3 = ['ALL','JSH',  'KYOWA', 'SSK', '기타'];
                break;
            case "변형률계n무응력계":
                var depth_3 = ['ALL', 'JSH',  'GEOKON', 'ROCTEST', '기타'];
                break;
            case "압력계":
                var depth_3 = ['ALL', 'JSH', 'KYOWA', '기타'];
                break;
            case "경사계":
                var depth_3 = ['ALL', 'JSH', '기타'];
                break;
            case "온도계":
                var depth_3 = ['ALL', 'Thermocouple', 'Thermistor', 'PT100', 'iButton', '기타'];
                break;
            case "기타":
                var depth_3 = ['ALL', '균열계', '콤프레소미터', '풍향풍속계', '유량계', '철근계', '간극수압계', '수위계', '지중변위계', '침하계', '부식센서', '자동차센서', '기타'];
                break;
            case "비디오게이지":
                var depth_3 = ['ALL', 'SOBRIETY', 'IMETRUM', '기타'];
                break;
            case "시험용치구":
                var depth_3 = ['ALL', 'Rubber Testing', 'Compression Testing', 'Tension Testing', 'Shear Testing', 'Fracture Toughness', 'Flexure Testing', 'Bond Testing', 'Adapters, Lock Rings, and Pins', '기타'];
                break;
            default:
                // SOBRIETY, IMETRUM, 시험용치구, 지그, 제작품
                $('#list_depth_3').empty();
                $('#list_depth_3').addClass('hide');
                var depth_3 = false;
                break;
        }

        return depth_3;
    },
    getView:function(idx, depth_1, depth_2, depth_3){
        $.ajax({
            type: 'GET',
            url: base_url+'api/products/product/detail?idx='+idx+'&depth_1='+depth_1+'&depth_2='+depth_2+'&depth_3='+depth_3+' ',
            success: function(resData){
                if(resData.status === true && resData.result.message =="NO DATA"){
                    alert("잘못된 접근입니다.");
                    window.location.href=base_url;
                    return;
                }
                else if(resData.status === true && resData.message =="success"){
                    pd.setView(resData.result.data[0]);
                }
            },
            error: function(resData){
                // console.log('error >>>');
                alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            }
        });
    },

    setView:function(res){
        var container = $('#detail_product');

        // slider
        var item = '<li class="pd-img" style="background-image:url('+base_url+res.path+'/'+res.thumb_img+');" aria-label="'+res.title+'"></li>';
        container.find('.img-area').append(item);

        if(res.img_list != ""){
            var imgList = res.img_list.split(',');
            for(var prop in imgList){
                var item = '<li class="pd-img" style="background-image:url('+base_url+res.path+'/'+imgList[prop]+');" aria-label="'+res.title+'"></li>';
                container.find('.img-area').append(item);
            }

            $('.img-area').slick({
                infinite: true, // 무한 재생
                adaptiveHeight: true, // 슬라이더 높이를 현재 슬라이드에 맞춤
                slidesToShow: 1, // 슬라이더 보여줄 갯수
                slidesToScroll: 1, // 한 번에 스크롤 할 슬라이드 수
                arrows: false, // 다음,  이전 화살표 사용
                autoplay: true, // 자동재생
                autoplaySpeed : 10000, // 자동재생 시간
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

        var kv = JSON.parse(res.key_value);
        if(kv.length >0){
            for(var prop in kv){
                if(kv[prop].val.indexOf('\n') != -1) {
                    var str = kv[prop].val.split('\n');
                    var sub_item_key = '';
                    var sub_item_val = '';
                    for(var i =0; i<str.length; i++){
                        if(i == 0){
                            sub_item_key += '<th rowspan="'+str.length+'">'+kv[prop].key+'</th><td class="dashed">'+str[i]+'</td>';
                        }
                        else{
                            sub_item_val += '<tr><td class="dashed">'+str[i]+'</td></tr>';
                        }
                    }
                    var kv_item = '<tr>'+sub_item_key+'</tr>'+sub_item_val;
                }
                else {
                    var kv_item = '<tr><th>'+kv[prop].key+'</th><td>'+kv[prop].val+'</td></tr>';
                }
                container.find('.info tbody').append(kv_item);
            }
        }

        // 부가설명
        if(res.sub_title != '')
            container.find('.info tbody').append('<tr><td colspan="2" class="sub-title">'+res.sub_title+'</td></tr>');

        // file-list
        if(res.file_law_name != ""){
            var file_name ='';

            if(res.file_law_name.indexOf(',') != -1) {
                // 멀티 파일
                var sp_files = res.file_law_name.split(',');
                var sp_file_real = res.file_real_name.split(',');

                for(var i=0; i<sp_files.length; i++){
                    var icon = sp_files[i].split('.')[1];
                    var file_name = '<li id="product_li_file_'+i+'"><p class="'+icon+'" onClick="pd.fileDownload(\'product_li_file_'+i+'\');">\
                                        <span>'+sp_file_real[i]+'</span>\
                                    </p></li>';
                    $('#file_list').append(file_name);
                    $('#product_li_file_'+i).data('path', '.'+res.path+'/'+sp_files[i]);
                    $('#product_li_file_'+i).data('file_real', sp_file_real[i]);
                }
            }
            else{
                // 단일 파일
                var sp_file = res.file_law_name.split('.')[0];
                var sp_file_real = res.file_real_name.split(',');
                var icon = res.file_law_name.split('.')[1];
                // var date = new Date(sp_file.slice(0,-1) * 1000);
                file_name = '<li id="product_li_file_0"><p class="'+icon+'" onClick="pd.fileDownload(\'product_li_file_0\');">\
                                        <span>'+res.file_real_name+'</span>\
                                    </p></li>';
                $('#file_list').append(file_name);
                $('#product_li_file_0').data('path', '.'+res.path+'/'+res.file_law_name);
                $('#product_li_file_0').data('file_real', res.file_real_name);
            }

        }
        else{
            $('.file-wrap').remove();
        }
    },

    fileDownload:function(id){
        var selector = $('#'+id);
        window.location.href=base_url+'home/product/file_downLoad?file='+selector.data('path')+'&file_real='+selector.data('file_real');
    },

};

var pt = {
    setSpan:function(txt, name, selector){
        $('#trail_depth'+selector+'_txt').text(txt);
        $('#trail_depth'+selector+'_txt').data('name', name);
    },
    top_list_d2:function(depth_1){
        /*
            * 계측장비 3뎁스 -> 2뎁스로 이동
        */
        var depth_2 = new Array(); // [0] : data(name) , [1] : text
        switch (depth_1) {
            case "계측장비":
                depth_2[0] = ['', 'JSH',  'KYOWA', 'DEWESOFT', 'Campbell Scientific', '기타'];
                depth_2[1] = ['ALL', 'JSH', 'KYOWA', 'DEWESOFT', 'Campbell Scientific', '기타'];
                break;
            case "스트레인게이지":
                depth_2[0] = ['스트레인게이지', '악세사리'];
                depth_2[1] = ['스트레인게이지', '악세사리'];
                break;
            case "계측센서":
                depth_2[0] = ['하중계', '지진/가속도계', '변위계', '신율계', '토압계', '변형률계n무응력계', '압력계', '경사계', '온도계', '기타'];
                depth_2[1] = ['하중계', '지진/가속도계', '변위계', '신율계', '토압계', '변형률계&무응력계', '압력계', '경사계', '온도계', '기타'];
                break;
            case "비디오게이지":
                depth_2[0] = ['', 'SOBRIETY', 'IMETRUM', '기타'];
                depth_2[1] = ['ALL', 'SOBRIETY', 'IMETRUM', '기타'];
                break;
            case "시험용치구":
                depth_2[0] = ['', 'Rubber Testing', 'Compression Testing', 'Tension Testing', 'Shear Testing', 'Fracture Toughness', 'Flexure Testing', 'Bond Testing', 'Adapters, Lock Rings, and Pins', '기타'];
                depth_2[1] = ['ALL', 'Rubber Testing', 'Compression Testing', 'Tension Testing', 'Shear Testing', 'Fracture Toughness', 'Flexure Testing', 'Bond Testing', 'Adapters, Lock Rings, and Pins', '기타'];
                break;
            case "제작품":
                depth_2 = false;
                break;
        }

        return depth_2;

    },
    top_set_d2:function(arr){
        if(arr == false)
            return;

        $('#trail_item_depth2').empty();

        var item ='';
        for(var i=0; i<arr[0].length; i++){
            item +='<li data-name="'+arr[0][i]+'">'+arr[1][i]+'</li>';
        }

        $('#trail_item_depth2').append(item);
        pt.setSpan(arr[1][0], arr[0][0], 2);
    },
    top_list_d3:function(depth_2){

        var depth_3 = new Array(); // [0] : data(name) , [1] : text
        switch (depth_2) {
            case "스트레인게이지":
                depth_3[0] = ['',  'MM', 'KYOWA', 'SHOWA', '기타'];
                depth_3[1] = ['ALL',  'MM', 'KYOWA', 'SHOWA', '기타'];
                break;
            case "악세사리":
                if($('#trail_depth1_txt').data('name') == "시험용치구")
                    depth_3 = false;
                else{
                    depth_3[0] = ['', 'Adhesives', 'Coating Materials', 'Gauge installation Tape', 'Extension Cable', 'Spot welder', 'Strain Gauge Clamp', 'Strain Gauge Installation Tool kit', '기타'];
                    depth_3[1] = ['ALL', 'Adhesives', 'Coating Materials', 'Gauge installation Tape', 'Extension Cable', 'Spot welder', 'Strain Gauge Clamp', 'Strain Gauge Installation Tool kit', '기타'];
                }
                break;
            case "하중계":
                depth_3[0] = ['', 'Compression', 'Tension/Compression', 'Tension', 'Component', 'Torque', '기타'];
                depth_3[1] = ['ALL', 'Compression', 'Tension/Compression', 'Tension', 'Component', 'Torque', '기타'];
                break;
            case "지진/가속도계":
                depth_3[0] = ['', 'Servo Type', 'Strain Gauge Type', 'ICP Type', 'Mems Type', '기타'];
                depth_3[1] = ['ALL', 'Servo Type', 'Strain Gauge Type', 'ICP Type', 'Mems Type', '기타'];
                break;
            case "변위계":
                depth_3[0] = ['', 'Strain Gauge Type', 'Laser Type', 'Potentio Meter Type', '기타'];
                depth_3[1] = ['ALL', 'Strain Gauge Type', 'Laser Type', 'Potentio Meter Type', '기타'];
                break;
            case "신율계":
                depth_3[0] = ['', 'Axial', 'High Temperature Axial', 'Clip-on Gauge', 'Deflectometers', 'Laser Extensometers', 'Calibrators', '기타'];
                depth_3[1] = ['ALL', 'Axial', 'High Temperature Axial', 'Clip-on Gauge', 'Deflectometers', 'Laser Extensometers', 'Calibrators', '기타'];
                break;
            case "토압계":
                depth_3[0] = ['', 'JSH',  'KYOWA', 'SSK', '기타'];
                depth_3[1] = ['ALL', 'JSH',  'KYOWA', 'SSK', '기타'];
                break;
            case "변형률계n무응력계":
                depth_3[0] = ['', 'JSH',  'GEOKON', 'ROCTEST', '기타'];
                depth_3[1] = ['ALL', 'JSH',  'GEOKON', 'ROCTEST', '기타'];
                break;
            case "압력계":
                depth_3[0] = ['', 'JSH',  'KYOWA', '기타'];
                depth_3[1] = ['ALL', 'JSH', 'KYOWA', '기타'];
                break;
            case "경사계":
                depth_3[0] = ['', 'JSH', '기타'];
                depth_3[1] = ['ALL', 'JSH', '기타'];
                break;
            case "온도계":
                depth_3[0] = ['', 'Thermocouple', 'Thermistor', 'PT100', 'iButton', '기타'];
                depth_3[1] = ['ALL', 'Thermocouple', 'Thermistor', 'PT100', 'iButton', '기타'];
                break;
            case "기타":
                depth_3[0] = ['', '균열계', '콤프레소미터', '풍향풍속계', '유량계', '철근계', '간극수압계', '수위계', '지중변위계', '침하계', '부식센서', '자동차센서', '기타'];
                depth_3[1] = ['ALL', '균열계', '콤프레소미터', '풍향풍속계', '유량계', '철근계', '간극수압계', '수위계', '지중변위계', '침하계', '부식센서', '자동차센서', '기타'];
                break;
            default:
                depth_3 = false;
                break;
        }

        return depth_3;
    },
    top_set_d3:function(arr){
        if(arr == false)
            return;

        $('#trail_item_depth3').empty();

        var item ='';
        for(var i=0; i<arr[0].length; i++){
            item +='<li data-name="'+arr[0][i]+'">'+arr[1][i]+'</li>';
        }
        $('#trail_item_depth3').append(item);

        pt.setSpan(arr[1][0], arr[0][0], 3);
    },
    hideDepth:function(selector){
        $('#trail_depth'+selector).addClass('hide');
    },
    showDepth:function(selector){
        $('#trail_depth'+selector).removeClass('hide');
    },
    movePage:function(depth_1, depth_2, depth_3){
        window.location.href=base_url+'home/product?menu_code=product&menu_up_code=&depth_1='+depth_1+'&depth_2='+depth_2+'&depth_3='+depth_3+'';
    },

};

var sync_select = {
    exc_2:function(){
        $('#trail_select_depth2').append('<option>ALL</option>');
    },
    get_list:function(depth){
        // depth = number(1,2,3)
        $('#trail_item_depth'+depth+' li').each(function(index) {
            $('#trail_select_depth'+depth).append('<option>'+$('#trail_item_depth'+depth+' li').eq(index).text()+'</option>');
        });

        $("#trail_select_depth"+depth).val($('#trail_depth'+depth+'_txt').text()).prop("selected", true);
    },
};

function showSelect(selector){
    $('#select_mobile_'+selector).removeClass('hide');
};

function hideSelect(selector){
    $('#select_mobile_'+selector).addClass('hide');
};


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


        var url = base_url+'home/product?menu_code='+mCode+'&menu_up_code='+mUpCode+'';
        var query_string = '&depth_1='+pd.config.depth_1+'&depth_2='+pd.config.depth_2+'&depth_3='+pd.config.depth_3+'&search_word='+pd.config.search_word+'';
        if(pd.config.search_word != '')
            query_string += '&search_flag=t';
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