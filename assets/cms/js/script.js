jQuery(document).ready(function(){

    // 사이드메뉴
    initSideMenu();

    // 드롭다운패널
    $('.gnb-item.notice>a').click(function(e) {
        if($(this).parent().find('.dropdown-panel').hasClass('active')) {
            $(this).parent().find('.dropdown-panel').removeClass('active');
        } else {
            $('.dropdown-panel').removeClass('active');
            $(this).parent().find('.dropdown-panel').addClass('active');
        }
        $('html').click(function(e) {
            if ($(e.target).parents('.gnb-item.notice>a').length==0) {
                $('.dropdown-panel').removeClass('active');
                $(this).unbind(e);
            }
        })
    });

    // 가이드텍스트
    $('.guidetext').each(function(){
        var guideText = this.defaultValue;
        var tg = $(this);

        tg.focus(function(){
            if(tg.val()===guideText){
                tg.val('').removeClass('form-guide');
            }
        }).blur(function(){
            if(tg.val()===''){
                tg.val(guideText).addClass('form-guide');
            }
        });

        if(tg.val()===guideText){
            tg.addClass('form-guide');
        }
    });

    // 페이징
    $('.page-nums>a').click(function(){
        $('.page-nums>a').removeClass('active');
        $(this).addClass('active');
    });

    //달력1
    $('.calendar-form input.date').click(function(e){
        
        //멀티체크, 달력영역, 달력아이디체크 
        var chkMulti = $(this).parents('.calendar-form').find('input.date').length > 1;
        var calArea = $(this).parents('.calendar-form').find('.calendar-panel');
        var chkName = '#'+calArea.find('.calendar').attr('id');

        // 07.24 클래스 확인 추가 - mindate 설정 바꾸기용
        var chkClass = '.'+calArea.find('.calendar').attr('class');
        chkClass = chkClass.slice(10,20);

        $('.calendar-panel').removeClass('active');

        //달력 열린 상태  
        if (calArea.hasClass('active')) {
            if ($(this) || calArea){
                // console.log('자기 자신을 누르면 닫히지 않습니다');
            } else {
                calArea.removeClass('active');
        }

        //달력 닫힘
        } else {
            initCalendar(chkMulti ? true:false, chkName , chkClass);
            calArea.addClass('active');
            // console.log('멀티달력입니까?: ' + chkMulti);
            // console.log('달력이름은: ' + chkName);
        }

        //다른 곳을 클릭하면 사라짐
        $('html').click(function(e) {
            if ($(e.target).parents('.calendar-form').length==0) {
                calArea.removeClass('active');
                $(this).unbind(e);
            }
        });
    });


    //썸네일
    var clone_up_name = [$(".upload-name").eq(0).clone()]; // 썸네일 인풋 복사

    // 파일 업로드 및 미리보기
    $(".upload-hidden").click(function(){

        var fileTarget = $(".file .upload-hidden");
        // 파일 추출
        fileTarget.on('change', function(){
            if(window.FileReader){
                // 파일명 추출
                var filename = $(this)[0].files[0].name;
            } 
            else {
                // Old IE 파일명 추출
                var filename = $(this).val().split('/').pop().split('\\').pop();
            };

            $(this).parents().siblings('.upload-name').val(filename);

            var preview_bg = $(this).parents().parents().siblings('.preview-img'); // 썸네일 이미지 등록 공간
            var img_cancel = $(this).parents().siblings('.ico-file-cancel'); // 취소 아이콘
            
            if(window.FileReader) {
                //image 파일 인지 확인
                if (!$(this)[0].files[0].type.match(/image\//)){
                    // console.log("이미지 파일이 아닙니다.");
                    return;
                }

                var reader_img = new FileReader();

                reader_img.onload = function(e){
                    var src = e.target.result;
                    preview_bg.src=reader_img.result;
                    preview_bg.css("background","url("+src+") 50%/100%");
                }
                reader_img.readAsDataURL($(this)[0].files[0]);
            }

            // 취소 버튼 위치 조정
            var tg_upload_name = $(this).parents().siblings('.upload-name');
            var upload_name_length = tg_upload_name.val().length;
            var upload_name_val = tg_upload_name.val();
            var byte = 0; // 문자를 진수 단위로 나눔

            for (var i = 0; i < upload_name_length; i++) {
                char = upload_name_val.charAt(i);

                if (escape(char).length > 4) {
                    byte += 2;
                } else {
                    byte++;
                }
            }
            // 바이트당 6씩 이동
            if(byte>20) {
                img_cancel.css({"display":"block", "left":60+byte*6+"px"});
            }
            else {
                img_cancel.css({"display":"block", "left":40+byte*6+"px"});
            }


            if(img_cancel.parent().parent().hasClass('shop-200')){
                img_cancel.css({"display":"block", "left":"130px","top":"-72px"});
            }

        });
    });//end thumb

    // 파일 업로드 취소
    $(".ico-file-cancel").click(function(){
        var tg = $(this);
        var tg_upload = tg.siblings('.col-100').children('.upload-hidden');
        var tg_upload_name = tg.siblings('.upload-name');
        var tg_preview_bg = tg.parents('.file').siblings('.preview-img');

        // 썸네일 이미지 지우기
        tg_preview_bg.css('background', '');

        // 히든 초기화
        tg_upload.type="radio";
        tg_upload.val("");
        tg_upload.type="file";

        // 이름 초기화
        clone_up_name[1] = clone_up_name[0].clone(true);
        tg_upload_name.replaceWith(clone_up_name[1]);

        $(this).hide();
    });

    /*
        * 모바일 대응
    */
    mSetting.default();
});

// 달력 옵션
function initCalendar(isMulti, calName, chkClass)
{
    if (!window[calName]) {
        window[calName] = new Datepickk();

        // TODO - 선택 가능한 날짜 지정.
        // window[calName].minDate = new Date('2018-5-1'); // 특정일
        window[calName].minDate = new Date();           // 오늘

        // 2018.07.24
        // 이전날짜 선택 가능 옵션 추가
        // 클래스에 notMinDate
        if( chkClass == 'notMinDate' ){
            window[calName].minDate = new Date('1980-1-1');
        }

        if( chkClass == 'notMinEnd') {
            window[calName].minDate = new Date('1980-1-1');
        }

        // console.log(calName+' 달력이 생성되었습니다');

        /*Set container*/
        if (isMulti) {
            window[calName].container = document.querySelector(calName);

            // 최대 선택 가능한 날
            window[calName].rangeDate = 4000;
        } else {
            window[calName].container = document.querySelector(calName);

            // 최대 선택 가능한 날
            window[calName].rangeDate = 1;
        }

    }

    window[calName].show();

    // 선택 날짜를 받을 함수
    window[calName].onSelectedDate = function(dates, error)
    {
        var input = $(calName).parents('.calendar-form').find('input.date');

        // 2018.07.24
        // 날짜 출력 형식 변환 yyyy-mm-dd
        // 달, 월 - 두 자릿수
        if (isMulti) {
            input.eq(0).data('date',dates[0].getFullYear()+"-"+ ("0"+(dates[0].getMonth()+1)).slice(-2)+"-"+("0"+(dates[0].getDate())).slice(-2));
            input.eq(1).data('date',dates[1].getFullYear()+"-"+ ("0"+(dates[1].getMonth()+1)).slice(-2)+"-"+("0"+(dates[1].getDate())).slice(-2));
            // console.log(input.eq(1).data());
        }
        else{

            // 2020. 03. 09
            // 싱글 달력으로 멀티 표현시 제한
            if(input.hasClass('single-limit')){
                // 시작일 선택시
                if(input.attr('id') == 's_date'){
                    if($('#e_date').val() != ''){
                        var singe_start_date =  new Date(dates[0].getFullYear()+','+("0"+(dates[0].getMonth()+1)).slice(-2)+','+("0"+(dates[0].getDate())).slice(-2));
                        var single_end_date = new Date($('#e_date').val().slice(0,4)+','+$('#e_date').val().slice(5,7)+','+$('#e_date').val().slice(8,10));
                        var calc_days = (singe_start_date - single_end_date)/1000/60/60/24;

                        if(calc_days>=0){
                            alert("시작일을 종료일보다 우선 설정해주세요.");
                            return false;
                        }
                    }
                }
                // 종료일 선택시
                if(input.attr('id') == 'e_date'){
                    if($('#s_date').val() != ''){
                        var singe_start_date = new Date($('#s_date').val().slice(0,4)+','+$('#s_date').val().slice(5,7)+','+$('#s_date').val().slice(8,10));
                        var single_end_date = new Date(dates[0].getFullYear()+','+("0"+(dates[0].getMonth()+1)).slice(-2)+','+("0"+(dates[0].getDate())).slice(-2));
                        var calc_days = (single_end_date - singe_start_date)/1000/60/60/24;

                        if(calc_days<=0){
                            alert("종료일은 시작일보다 우선 설정해주세요.");
                            return false;
                        }
                    }
                }
                input.eq(0).data('date',dates[0].getFullYear()+"-"+ ("0"+(dates[0].getMonth()+1)).slice(-2)+"-"+("0"+(dates[0].getDate())).slice(-2));
            }   
            else{
                input.eq(0).data('date',dates[0].getFullYear()+"-"+ ("0"+(dates[0].getMonth()+1)).slice(-2)+"-"+("0"+(dates[0].getDate())).slice(-2));
            }
            // console.log(input.eq(0).data());
        }
        
        // 선택완료 버튼 없이 날짜 입력
        window[calName].hide(); // 라이브러리 달력 닫기
        $('.calendar-panel').removeClass('active'); // 달력 폼 닫기

        for (var i = 0; i < input.length; i++) {
            input.eq(i).val(input.eq(i).data('date'));
            // console.log("eq(0)"+input.eq(0).val());
        }
    }
}

// 사이드 메뉴
function initSideMenu()
{
    // 사이드바
    $('.nav>ul>li>a:first-child').click(function(){
        var list = $('.nav>ul>li');
        var tg = $(this);
        var sublist = $('.sub-list');

        list.removeClass('active');
        sublist.find('li').removeClass('active');
        $('.ico-list-toggle').removeClass('active');

        // 사이드바 narrow 상태시
        if($('.nav').hasClass('narrow')){
            tg.siblings(sublist).find('li:first-child').addClass('active');

        } else {
            sublist.not(tg.siblings(sublist)).slideUp();
            tg.siblings(sublist).slideDown();
            tg.next('.ico-list-toggle').addClass('active');
            tg.siblings(sublist).find('li:first-child').addClass('active');
        }
        tg.closest('li').addClass('active');
    });

    // 아코디언 on/off
    $('.ico-list-toggle').click(function(){
        if($(this).next('.sub-list').is(':visible')){
            $(this).next('.sub-list').slideUp();
            $(this).removeClass('active');
        } else {
            $(this).next('.sub-list').slideDown();
            $(this).addClass('active');
        }
    });

    // 서브메뉴 클릭시 on/off
    $('.sub-list>li').click(function(){
        $('.sub-list>li').removeClass('active');
        $('.nav>ul>li').removeClass('active');
        $('.sub-list').not($(this).parent($('.sub-list'))).slideUp();
        $(this).parent().parent().addClass('active');
        $(this).addClass('active');
    });

    // 사이드바 expand/narrow
    $('.gnb-menu').click(function(){

        mSetting.bubbles(event); // 모바일 이벤트 전파 방지

        if($('.nav').hasClass('narrow')){
            $('.nav').removeClass('narrow');
            $('.sidebar').css({'width':'260px'});
            $('.section').css({'margin-left':'260px'});
            $('.section-content').css({'min-width':'1003px'});

            $('.logo-area').show();

            // 트렌지션 끝난 후에 실행
            // 2018.07.24
            // 실행 순서를 바꿈 - 초기는 web 부터 시작 트렌지션 앤드가 마지막
            $('.section').on(' transitionend webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd',function(){
                // console.log("transitionEnd!!");
                // $('.list-name').show();
                $('.list-name').css('visibility','visible');
                $('.sidebar-footer').show();
                $('.ico-list-toggle').show();
                $('.nav>ul').find('.active').children('.sub-list').show();
                $('.nav>ul').find('.active').children('.ico-list-toggle').addClass('active');
                $(this).unbind();
            });
        } else {
            $('.nav').addClass('narrow');
            $('.sidebar').css({'width':'80px'});
            $('.section').css({'margin-left':'80px'});
            $('.section-content').css({'min-width':'1183px'});

            $('.logo-area').hide();
            // $('.list-name').hide();
            $('.list-name').css('visibility','hidden');
            $('.sidebar-footer').hide();
            $('.ico-list-toggle').hide();
            $('.sub-list').hide();
        }
    });
}

// 모달
function showModal(modal) {
    $( '.modal' + modal ).addClass('active');
}

function hideModal(modal) {
    $( '.modal' + modal ).removeClass('active');
}   

// 로그인페이지 onload시 실행
function initLoginPage ()
{
    // 명언을 추가 '이 곳에 명언을 입력하세요. <p>-출처-</p>'
    var say = [
        '자신감 있는 표정을 지으면 자신감이 생긴다<p>-찰스다윈-</p>',
        '삶이 있는 한 희망은 있다.<p>-키케로 -</p>',
        '하루에 3시간을 걸으면 7년 후에 지구를 한바퀴 돌 수 있다.<p>-사무엘존슨-</p>',
        '신은 용기있는자를 결코 버리지 않는다.<p>-켈러-</p>',
        '꿈을 계속 간직하고 있으면 반드시 실현할 때가 온다.<p>-괴테-</p>',
        '행복은 습관이다, 그것을 몸에 지니라.<p>-허버드-</p>',
        '1퍼센트의 가능성, 그것이 나의 길이다.<p>-나폴레옹-</p>'
    ];

    // 로그인 배경을 추가 (배경에 어울리는 글자색을 지정)
    var bgImg = [
        {url:base_url+'assets/cms/img/login/bg_1.png', color:'#fff'},
        // {url:base_url+'assets/cms/img/login/bg_2.png', color:'#fff'},
        {url:base_url+'assets/cms/img/login/bg_3.png', color:'#fff'}
    ];

    // 이미지 프리로드
    for (var i = 0; i < bgImg.length; i++) {
        var img = new Image();
        img.src = bgImg[i].url;
    }

    // 배열 랜덤 소팅
    function shuffle(a, b){
        return .5 - Math.random();
    }

    // say.sort(shuffle);
    // say.sort(shuffle);
    // say.sort(shuffle);

    bgImg.sort(shuffle);
    bgImg.sort(shuffle);
    // bgImg.sort(shuffle);

    // 배경과 명언을 5초마다 롤링
    function loginAutoBg ()
    {
        $('.login-area').css({'background-image':'url('+bgImg[0].url+')'});
        //$('.saying').html(say[0]).css('color',bgImg[0].color);
        $('.saying').css('color',bgImg[0].color);

        setInterval(function(){
            $('.login-area').css({'background-image':'url('+bgImg[1].url+')'});
            //  $('.saying').html(say[1]).css('color',bgImg[1].color);
            $('.saying').css('color',bgImg[1].color);
            
            bgImg.push(bgImg.shift());
            say.push(say.shift());
        },8000);
    }

    loginAutoBg();
}

function goPage(url,type){

    if(type=='' || type==undefined){
        type="_self";
    }
    window.open(url,type);
    //location.href=url;
}

function goDelete(url){

    showModal('#popupModalDelete');
    $("#delete-popup-msg").text("정말로 삭제하시겠습니까?");  
    
    $("#delete").click(function() {
        location.href=url;        
    });
}

function goUnregister(url){

    showModal('#popupModalDelete');
    $("#delete-popup-msg").text("정말로 탈퇴시키겠습니까? 탈퇴 시 복구할 수 없습니다.");  
    
    $("#delete").click(function() {
        location.href=url;        
    });
}

$(document).ready(function() {

    //검색어 입력 후 엔터 시 검색 실행
    //엔터가 실행 됐을 때 검색 버튼을 강제로 실행한다.  
    $("input[name=searchWord]").keydown(function (key) { 
        if(key.keyCode == 13){
            $('#search_btn').trigger('click');
        } 
    });
    
    //리스트 검색 공통 모듈
    //검색어만 있는 경우 사용
    $("#search_btn").click(function() {

        var menuNm = $('#menuNm').val();
        var rootUrl = $("#rootUrl").val();
        var act = rootUrl+'/'+menuNm+'/lists';


        $("#search").attr('action', act).submit();        
    });

    //카테고리 , 검색어 있는 경우 사용
    // ROOT_URL : 사이트 루트 기본 디렉토리
    // menu_name : 현재 페이지 메뉴명
    $("#search_btn2").click(function() {
            
            var menuNm = $('#menuNm').val();
            var rootUrl = $("#rootUrl").val();

            var goAction = rootUrl+'/'+menuNm+'/lists';

            $("#search").attr('action', goAction).submit();
    });


    //메뉴 순서 중복 확인
    $('#order_no_chk').click(function(){

        var menu_order = $('#menu_order').val();
        var menu_level = $('#menu_level').val();

        //이메일이 공백인지 체크
        if (menu_order == '') {
            showModal('#popupModal');
            $("#popup-msg").text("메뉴순서를 입력하세요.");
            return false;
        }

        // ajax 실행
        $.ajax({
            type : 'POST',
            url : base_url+'admin/setting/menu/order_no_chk',
            data:
            {
                ci_t : $('#token').val(),
                menu_order :menu_order,
                menu_level :menu_level
            },
                success : function(response) {                    
                if (response.trim() == "success") {
                    showModal('#popupModal');
                    $("#popup-msg").text("사용가능한 번호입니다.");  
    
                } else {
                     showModal('#popupModal');
                    $("#popup-msg").text("이미 등록된 번호입니다.다른 번호를 입력하세요.");  
                }
            }
        }); // end ajax
        return false;
    }); // end keyup

    //서브 메뉴 순서 중복 확인
    $('#sub_order_no_chk').click(function(){

        var menu_order = $('#menu_order').val();
        var menu_level = $('#menu_level').val();
        var menu_up_code = $('#menu_up_code').val();

        //공백인지 체크
        if (menu_order == '') {
            showModal('#popupModal');
            $("#popup-msg").text("메뉴순서를 입력하세요.");
            return false;
        }
        // ajax 실행
        $.ajax({
            type : 'POST',
            url : base_url+'admin/setting/menu/sub_order_no_chk',
            data:
            {
                ci_t : $('#token').val(),
                menu_order :menu_order,
                menu_level :menu_level,
                menu_up_code :menu_up_code
            },
                success : function(response) {                    
                if (response.trim() == "success") {
                    showModal('#popupModal');
                    $("#popup-msg").text("사용가능한 번호입니다.");  
    
                } else {
                     showModal('#popupModal');
                    $("#popup-msg").text("이미 등록된 번호입니다.다른 번호를 입력하세요.");  
                }
            }
        }); // end ajax
        return false;
    }); // end keyup



    //메뉴 코드 중복 확인
    $('#menu_code_chk').click(function(){

        var menu_code = $('#menu_code').val();

        //이메일이 공백인지 체크
        if (menu_code == '') {
            showModal('#popupModal');
            $("#popup-msg").text("메뉴 코드를 입력하세요.");
            return false;
        }

        // ajax 실행
        $.ajax({
            type : 'POST',
            url : base_url+'admin/setting/menu/menu_code_chk',
            data:
            {
                ci_t : $('#token').val(),
                menu_code :menu_code
            },
                success : function(response) {                    
                if (response.trim() == "success") {
                    showModal('#popupModal');
                    $("#popup-msg").text("사용가능한 코드입니다.");  
    
                } else {
                     showModal('#popupModal');
                    $("#popup-msg").text("이미 등록된 코드입니다.다른 코드를 입력하세요.");  
                }
            }
        }); // end ajax
        return false;
    }); // end keyup



    //관리자 관리 아이디 중복 체크
    $('#id_dupl_chk').click(function(){
        var auth_id = $('#auth_id').val();

        //이메일이 공백인지 체크
        if (auth_id == '') {
            showModal('#popupModal');
            $("#popup-msg").text("검색하실 아이디를 입력해 주세요.");
            return false;
        }

        // ajax 실행
        $.ajax({
            type : 'POST',
            url : base_url+'admin/user/super/id_dupl_chk',
            data:
            {
                ci_t : $('#token').val(),
                auth_id :auth_id
            },
                success : function(response) {
                if (response.trim() == "success") {
                    showModal('#popupModal');
                    $("#popup-msg").text("사용가능한 아이디입니다.");  
    
                } else {
                     showModal('#popupModal');
                    $("#popup-msg").text("이미 등록된 아이디입니다.");  
                }
            }
        }); // end ajax
        return false;
    }); // end keyup

    //관리자 이메일 중복 체크
    $('#email_dupl_chk').click(function(){

        var auth_email = $('#auth_email').val();

        //이메일이 공백인지 체크
        if (auth_email == '') {
            showModal('#popupModal');
            $("#popup-msg").text("검색하실 이메일을 입력해 주세요.");
            return false;
        }
        
        // ajax 실행
        $.ajax({
            type : 'POST',
            url : base_url+'admin/user/super/email_dupl_chk',
            data:
            {
                ci_t : $('#token').val(),
                auth_email :auth_email
            },
                success : function(response) {
                if (response.trim() == "success") {
                    showModal('#popupModal');
                    $("#popup-msg").text("사용가능한 이메일입니다.");  
    
                } else {
                     showModal('#popupModal');
                    $("#popup-msg").text("이미 등록된 이메일입니다.");  
                }
            }
        }); // end ajax
        return false;
    }); // end keyup

}); 



/*
    * 모바일 대응
*/
var mSetting = {
    width : window.innerWidth, // 가로 사이즈
    /*
        * 디폴트
    */
    default:function(){
        if(mSetting.width<768){

            $('.table.table-typeA, .table.table-typeB').find('colgroup').remove(); // 인라인 % 제거

            // tr
            $('.table.table-typeB tr').each(function(index) {
                var tr = $('.table.table-typeB tr').eq(index);
                var cnt = $('.table.table-typeB tr').eq(index).children().length;

                if(cnt>2){
                    for(var k=0; k<cnt; k++){
                        if(k % 2 == 0){
                            var ev = parseInt(k+1);
                            var tag ='<tr><th>'+tr.children().eq(k).html()+"</th><td>"+tr.children().eq(ev).html()+'</td></tr>';
                            tr.before(tag);
                        }
                    }
                    tr.remove();
                }
            });

            // td colspan 초기화
            $('.table.table-typeB td').each(function(index) {
                $('.table.table-typeB td').eq(index).attr('colspan', 1);

                // 모바일에서 colspan = 2 셋팅해야하는 td 수정
                if($('.table.table-typeB td').eq(index).hasClass('m-col-2')){
                    $('.table.table-typeB td').eq(index).attr('colspan', 2);
                }
            });

        }
    },
    /*
        * 기존 이벤트 막기
    */
    bubbles:function(event){
        if(mSetting.width<768){

            var sidebar = $('.sidebar');

            if(sidebar.hasClass('mobile')){ // 열림 => 닫기
                sidebar.removeClass('mobile');
            }
            else{ // 닫힘 => 열기
                sidebar.addClass('mobile');
            }

            throw "stop"; // 강제 error 버블링 해제
        }
    },
};



/*
    * 드래그 이벤트 On
*/
$(document).on('click', '#start_drag', function(){


    if($('body').hasClass('mobile')){
        // alert("모바일에서는 지원하지 않는 기능입니다.\nPC로 접속해주세요.");
        showModal('#popupModal');
        $("#popup-msg").text("모바일에서는 지원하지 않는 기능입니다. PC로 접속해주세요.");  
        return;
    }

    // 드래그할 아이템이 2개이상 존재하는지 확인하기

    
    drag.page(); // 현재 페이지?

    drag.backUpZone(); // 기존 태그 백업

    drag.onEvent(event); // 이벤트 추가

    drag.chkItem(); // 드래그 아이템 갯수 체크


    drag.btnOn(); // 제어 버튼 On
});

/*
    * 드래그 저장
*/
$(document).on('click', '#modify_drag', function(){
    // console.log('저장');
    // alert("[대메뉴 우선 셋팅 - 저장] Update key:menu_order, value : menu_code");

    // 성공 떨어지면
    drag.offEvent(); // 드래그 이벤트 Off
    drag.btnOff(); // 제어 버튼 Off



    // 상위 메뉴 꺼

    // var postData = new Object();
    // drag.items.each(function(index) {
    //     var _index = drag.items.eq(index).find('td').eq(0).text();
    //     var _menu_code = drag.items.eq(index).find('td').eq(2).text();
    //     postData[index] = _menu_code;
    // });


    // if(isEmpty(postData) === true){ // 빈 값 체크 (수정안하고 저장 혹은 에러시)
    //     return;
    // }

    // $.ajax({
    //     type: 'POST',
    //     url : base_url+'admin/setting/menu/modify_menuOrder',
    //     data: {
    //         ci_t : $('#token').val(),
    //         menu: postData,
    //     },
    //     success: function(resData){
    //         console.log('success >>>');
    //         console.log(resData);

    //     },
    //     error: function(resData){
    //         console.log('error >>>');
    //         console.log(resData);
    //     }
    // });


    // 전송 데이터 준비
    switch (drag.currentPage) {
        case "menu_parent": // 상위 메뉴 
        case "menu_child": // 하위 메뉴
            // console.log('하위 메뉴 들어왔는지 체크'); 
            comps.setData(0,2);
            comps.menuOrder_post();
            break;
        default:
            alert("잘못된 접근입니다");
            break;
    }

});

var postData = new Object(); // 전송 데이터 배열

var comps = {
    // postData : new Object(), // 전송 데이터 배열
    /*
        * 전송 데이터 준비
        * td_index = 메뉴 순서
        * td_code_index = 메뉴 코드
    */
    setData:function(td_index, td_code_index){
        // console.log('전송 데이터 준비 ');
        // console.log('td_index : '+td_index  );
        // console.log('td_code_index : '+td_code_index  );
        drag.items.each(function(index) {
            var _index = drag.items.eq(index).find('td').eq(td_index).text();
            var _menu_code = drag.items.eq(index).find('td').eq(td_code_index).text();
            postData[index] = _menu_code;
        });

        // console.log(postData);

        // 빈 값 체크 (수정안하고 저장 혹은 에러시)
        if(isEmpty(postData) === true){
            return;
        }

    },
    /*
        * 메뉴 순서 수정
    */
    menuOrder_post:function(){
        $.ajax({
            type: 'POST',
            url : base_url+'admin/setting/menu/modify_menuOrder',
            data: {
                ci_t : $('#token').val(),
                menu: postData,
            },
            success: function(resData){
                // console.log('success >>>');
                // console.log(resData);
                if(resData == "success"){
                    showModal('#popupModal');
                    $("#popup-msg").text("메뉴가 수정되었습니다.");
                }
                else{
                    showModal('#popupModal');
                    $("#popup-msg").text("송할 데이터가 없거나 네트워크에 문제가 발생했습니다.");
                }

            },
            error: function(resData){
                // console.log('error >>>');
                // console.log(resData);
                alert("전송할 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            }
        });
    },
};


/*
    * 드래그 수정 취소
*/
$(document).on('click', '#cancel_drag', function(){
    // console.log('취소');

    if(confirm("현재 수정중인 항목을 취소하시겠습니까?")){
        drag.offEvent(); // 드래그 이벤트 Off

        drag.btnOff(); // 제어 버튼 Off

        drag.rollBack(); // 기존 데이터 원복
    }
});

/*
    * 드래그 (공용)
    * 적용 : 상위메뉴 관리(순서), 하위메뉴 관리(순서)
*/
var drag = {
    currentPage:'', // 현재 페이지
    backUp: '', // 기존 태그 백업
    items: $('.ui-sortable-handle'), // 드래그 타겟 아이템
    /*
        * 제어 버튼 On
    */
    btnOn:function(){
        // console.log('제어버튼 On');
        showModal('#popupModal');
        $("#popup-msg").text("메뉴를 수정합니다. 마우스로 변경할 메뉴를 드래그해주세요.");  
        $('#start_drag').attr('disabled',true); // 수정 버튼 비활성화
        $('.drag-cont').not('.is-modify').removeClass('hide'); // 수정용 버튼 활성화, 수정 버튼은 제외
        $('.modify-guide-area').removeClass('hide');// 가이드 텍스트 활성화
    },
    /*
        * 제어 버튼 Off
    */
    btnOff:function(){
        // console.log('제어버튼 Off');
        $('#start_drag').attr('disabled',false); // 수정 버튼 활성화
        $('.drag-cont').not('.is-modify').addClass('hide'); // 수정용 버튼 숨김, 수정 버튼은 제외
        $('.modify-guide-area').addClass('hide');// 가이드 텍스트 비활성화
    },
    /*
        * 현재 페이지 ?
    */
    dropZone : '', // 드래그를 사용할 판넬
    page:function(){
        var url = $(location).attr('href').split("/").splice(3, 6).join("/");
        var segments = url.split( '/' );

        /*
            * 개발기 템플릿이랑 유저랑 segment가 1개 차이날꺼임
            * 나중에 다시 계산할떄는 고려하기
        */
        var menu = segments[2]; // 관리자 대메뉴
        var cont = segments[3]; // 컨트롤
        var act = segments[4]; // 액션
        var paging = segments[5]; // 페이지

        // console.log('menu : '+segments[2]);
        // console.log('cont : '+segments[3]);
        // console.log('act : '+segments[4]);
        // console.log('paging : '+segments[5]);

        // 대메뉴 코드
        switch (menu) {
            case "setting": // 환경설정
                // 상위 메뉴 관리
                if(cont == "menu" && act === undefined && paging === undefined){
                    // console.log('상위 메뉴 관리');
                    drag.currentPage = 'menu_parent';
                    drag.dropZone = $('.table.table-typeA tbody');
                }
                else if(cont == "menu" && act == "subMenu"){
                    // console.log('하위 메뉴 관리');
                    drag.currentPage = 'menu_child';
                    drag.dropZone = $('.table.table-typeA tbody');
                }
                break;
            default:
                // statements_def
                break;
        };
    },
    onEvent:function(evnet){
        // console.log('이벤트 전파');
        drag.dropZone.sortable({
            // placeholder: "drag-highlight",
            opacity: 0.7,
            start: function (event) {
                // console.log('start event');
                // drag.items.toggleClass("drag-highlight");
            },
            update:function(){
                // console.log('update event');
                // 아이템 리스트 업데이트
                drag.items = $('.ui-sortable-handle');

            },
            stop: function (event) {
                // drag.items.toggleClass("drag-highlight");
                // console.log('stop event');

                /*
                    * 현재 작동중인게 어떤건지 분기 필요
                */
                // console.log(drag.items);

                // 임시 분기 X  =>  상위, 하위 메뉴 수정이라고 치고
                drag.items.each(function(index) {
                    var _index = parseInt(index)+parseInt(1);
                    drag.items.eq(index).find('td').eq(0).text(_index);
                });
            },
        });
        drag.dropZone.disableSelection();
    },
    /*
        * 드래그 취소 액션
    */
    offEvent:function(){
        // console.log('destroy!');
        drag.dropZone.sortable("destroy");
    },
    /*
        * 드래그할 아이템 체크
        * 2개 이상 있어야 동작 On
    */
    chkItem:function(){
        if($('.ui-sortable-handle').length <2){
            // drag.offEvent(); // 드래그 이벤트 Off

            // console.log('2개 이상 아님 처리 넣기');

            // alert("변경할 메뉴가 부족합니다");

            showModal('#popupModal');
            $("#popup-msg").text("변경할 메뉴가 부족합니다");  

            drag.offEvent(); // 드래그 이벤트 Off

            throw "stop";

            return;
        }
    },
    /*
        * 기존 태그 백업
    */
    backUpZone:function(){
        // console.log('기존 순서 백업');
        // console.log(drag.dropZone);
        drag.backUp = drag.dropZone.html();

        // console.log(drag.backUp);

    },
    /*
        * 기존 태그 원복
    */
    rollBack:function(){
        // console.log('기존 태그 원복');

        drag.dropZone.html(drag.backUp);
    },
};

/*
    * 빈 값 || 빈 배열 체크
*/
var isEmpty = function(value){ 
    if( value == "" || value == null || value == undefined || ( value != null && typeof value == "object" && !Object.keys(value).length)){ 
        return true 
    }
    else{ 
        return false 
    } 
};


/*
    * 디바이스 타입 체크
*/
function deviceChk(){
    if(isMobile.any() === true){
        $('body').addClass('mobile');
        $('body').removeClass('pc');
    }
    else{
        $('body').removeClass('mobile');
        $('body').addClass('pc');
    }
}

var isMobile = {
        Android: function () {
                 return navigator.userAgent.match(/Android/i) == null ? false : true;
        },
        BlackBerry: function () {
                 return navigator.userAgent.match(/BlackBerry/i) == null ? false : true;
        },
        IOS: function () {
                 return navigator.userAgent.match(/iPhone|iPad|iPod/i) == null ? false : true;
        },
        Opera: function () {
                 return navigator.userAgent.match(/Opera Mini/i) == null ? false : true;
        },
        Windows: function () {
                 return navigator.userAgent.match(/IEMobile/i) == null ? false : true;
        },
        any: function () {
                 return (isMobile.Android() || isMobile.BlackBerry() || isMobile.IOS() || isMobile.Opera() || isMobile.Windows());
        }
};



