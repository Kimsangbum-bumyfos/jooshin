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

        $('.calendar-panel').removeClass('active');

        //달력 열린 상태  
        if (calArea.hasClass('active')) {
            if ($(this) || calArea){
                console.log('자기 자신을 누르면 닫히지 않습니다');
            } else {
                calArea.removeClass('active');
        }

        //달력 닫힘
        } else {
            initCalendar(chkMulti ? true:false, chkName);
            calArea.addClass('active');
            console.log('멀티달력입니까?: ' + chkMulti);
            console.log('달력이름은: ' + chkName);
        }

        //다른 곳을 클릭하면 사라짐
        $('html').click(function(e) {
            if ($(e.target).parents('.calendar-form').length==0) {
                calArea.removeClass('active');
                $(this).unbind(e);
            }
        });

        
    });

    //날짜 선택 버튼으로 날짜 입력
    $('.btn-cal').click(function(e){
        e.preventDefault();

        var input = $(this).parents('.calendar-form').find('input.date');

        for (var i = 0; i < input.length; i++) {
            input.eq(i).val(input.eq(i).data('date'));

            console.log("eq(0)"+input.eq(0).val());

            // input.eq(i).data('date', ''); //메타데이터를 지운다 
        }

        //날짜를 입력하지 않고 선택버튼을 누를 경우 
        if (input.eq(0).val() == '') {
            alert('날짜가 선택되지 않았습니다.');            
        } else {
            $(this).parents('.calendar-panel').removeClass('active');   
        }
    });

});

// 달력 옵션
function initCalendar(isMulti, calName)
{
    if (!window[calName]) {
        window[calName] = new Datepickk();

        // TODO - 선택 가능한 날짜 지정.
        // window[calName].minDate = new Date('2018-5-1'); // 특정일
        window[calName].minDate = new Date();           // 오늘

        console.log(calName+' 달력이 생성되었습니다');

        /*Set container*/
        if (isMulti) {
            window[calName].container = document.querySelector(calName);

            // 최대 선택 가능한 날
            window[calName].rangeDate = 100;
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

        if (isMulti) {
            input.eq(0).data('date',dates[0].toLocaleDateString().slice(0, -1));
            input.eq(1).data('date',dates[1].toLocaleDateString().slice(0, -1));
            console.log(input.eq(1).data());
        } else {
            // 한 자릿수 달, 일을 두 자릿수로 만듬
            ("0"+(dates[0].getMonth()+1)).slice(-2); 
            ("0"+(dates[0].getDate())).slice(-2); 
            input.eq(0).data('date',dates[0].getFullYear()+"-"+ ("0"+(dates[0].getMonth()+1)).slice(-2)+"-"+("0"+(dates[0].getDate())).slice(-2));
            
            // input.eq(0).data('date',dates[0].toLocaleDateString().slice(0, -1) );
            console.log(input.eq(0).data());

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
        if($('.nav').hasClass('narrow')){
            $('.nav').removeClass('narrow');
            $('.sidebar').css({'width':'260px'});
            $('.section').css({'margin-left':'260px'});
            $('.section-content').css({'min-width':'1003px'});

            $('.logo-area').show();

            // 트렌지션 끝난 후에 실행
            $('.section').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
                console.log("transitionEnd!!");
                $('.list-name').show();
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
            $('.list-name').hide();
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
        {url:'/makehome/assets/cms/img/login/bg_1.png', color:'#fff'},
        {url:'/makehome/assets/cms/img/login/bg_2.png', color:'#fff'},
        {url:'/makehome/assets/cms/img/login/bg_3.png', color:'#6d8f95'}
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
    bgImg.sort(shuffle);

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
        var search_word = $("#searchWord").val();

        if($("#searchWord").val()==''){
            var act = rootUrl+'/'+menuNm+'/lists/page/1';
        }else{
            var act = rootUrl+'/'+menuNm+'/lists/search_word/'+search_word+'/page/1';   
        }                        
        $("#search").attr('action', act).submit();        
    });

    //카테고리 , 검색어 있는 경우 사용
    // ROOT_URL : 사이트 루트 기본 디렉토리
    // menu_name : 현재 페이지 메뉴명
    $("#search_btn2").click(function() {
            
            var menuNm = $('#menuNm').val();
            var rootUrl = $("#rootUrl").val();
            var search_word = $("#searchWord").val();
            var category = $("#category").val();

            console.log(category);

            if($("#searchWord").val()==''){

                if($("#category").val()!=='0000'){

                    var goAction = rootUrl+'/'+menuNm+'/lists/category/'+category+'/page/1';

                }else{
                    var goAction = rootUrl+'/'+menuNm+'/lists/page/1';
                }
                
            }else{

                //카테고리가 전체인 경우에는 키워드만 검색한다.
                if($("#category").val()=='' || $("#category").val()==undefined || $("#category").val()=='0000'){

                     console.log('if');
                
                    var goAction = rootUrl+'/'+menuNm+'/lists/search_word/'+search_word+'/page/1';
                
                }else{
                    console.log('else');

                    var goAction = rootUrl+'/'+menuNm+'/lists/search_word/'+search_word+'/category/'+category+'/page/1';
                }                
            }    

            $("#search").attr('action', goAction).submit();
    });

    //관리자 관리 아이디 중복 체크
    $('#id_dupl_chk').click(function(){
        var auth_id = $('#auth_id').val();
        // ajax 실행
        $.ajax({
            type : 'POST',
            url : '/makehome/admin/auth/id_dupl_chk',
            data:
            {
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

}); 