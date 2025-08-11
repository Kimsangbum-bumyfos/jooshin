var token_name = 'ci_t';
jQuery(document).ready(function(){

	deviceChk(); // 최초 1회 디바이스 체크

	/*
		* 리사이즈시 디바이스 체크
	*/
	$(window).on('resize', debounce(function(e){
		deviceChk();
    },200));

    // 연락처 필드 숫자만 입력 가능
    $('.numbersOnly').keyup(function () {
        if (this.value != this.value.replace( /[^0-9]/g, '')) {
           this.value = this.value.replace(/[^0-9]/g, '');
        }
    });
});
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

/*
	* 모달 open-close
*/
function showModal(modal) {
    $('.modal' + modal).addClass('active');
}
function hideModal(modal) {
    $('.modal' + modal).removeClass('active');
    $(".wrap").css("overflow","hidden"); // 추가
}

/*
    연락처 유효성검사 정규식
*/
function cnf_phone(phoneVal){
    var regPhone = /^((01[1|6|7|8|9])[1-9]+[0-9]{6,7})|(010[1-9][0-9]{7})$/;
    return (regPhone.test(phoneVal));
};

/*
    * 이메일 유효성 정규식 확인
*/
function cnf_e_mail(emailVal){
    var regEmail=/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return (regEmail.test(emailVal));
};

/* 
    Ajax 로딩
*/
function loading(on){
    if(on){
        var loading = '<div class="loading"><span></span></div>';
        var $loading = $(loading);

        $loading.attr("src", base_url+"assets/home/img/gif/Spinner.gif");
        $loading.css({
            'position':'fixed',
            'top':'0',
            'bottom':'0',
            'right':'0',
            'left':'0',
            'width':'100%',
            'height': '100%',
            'background':'transparent'
        });
        $loading.find('span').css({
            'display':'block',
            'position':'absolute',
            'top':'50%',
            'left':'50%',
            'transform':'translate(-50%,-50%)',
            'width':'70px',
            'height': '70px',
            'border-radius':'14px',
            'margin' : '0 auto',
            'background':'rgba(0,0,0,.3) url( '+base_url+'assets/home/img/gif/Spinner.gif) 50% 50% / 100px auto no-repeat'
        });

        $('body').append($loading[0]);
    }
    else {
        $('body').find('.loading').remove();
    }
};

/*
    * 오늘 하루 템플릿당 좋아요 기회1회 부여
    * 기회는 하루에 1회가 아닌 통합 1회
*/
function temp_setLike(temp_id){
     setCookie(''+temp_id+'','Y',9999);
};

/*
    * 쿠키 삭제
*/
function deleteCookie(cookieName){
    var expireDate = new Date();
  
    // 어제 날짜를 쿠키 소멸 날짜로 설정
    expireDate.setDate( expireDate.getDate() - 1 );
    document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString() + "; path=/";
}

/*
    * 쿠키 설정
*/
function setCookie(name, value, expiredays) {
    var today = new Date();
        today.setDate(today.getDate() + expiredays);
        document.cookie = name + '=' + escape(value) + '; path=/; expires=' + today.toGMTString() + ';'
}

/*
    * 쿠키 가져오기
*/
function getCookie(name) 
{ 
    var cName = name + "="; 
    var x = 0; 
    while ( x <= document.cookie.length ) 
    { 
        var y = (x+cName.length); 
        if ( document.cookie.substring( x, y ) == cName ) 
        { 
            if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 ) 
                endOfCookie = document.cookie.length;
            return unescape( document.cookie.substring( y, endOfCookie ) ); 
        } 
        x = document.cookie.indexOf( " ", x ) + 1; 
        if ( x == 0 ) 
            break; 
    } 
    return ""; 
}

/*
    * 팝업 일반 닫기
*/
$(document).on('click','.btn-popup-close',function(){
    var tg_id = $(this).closest('.popup-modal').attr('id');
    close_popup(tg_id);
});

function close_popup(popup_id){
    $("#"+popup_id).fadeOut(700).delay(700).queue(function(next){
        $("#"+popup_id).remove();
        next(); 
    });
}


/*
    * 모달 쿠키
    * 오늘하루 보지 않기 체크시 팝업 닫기
*/
function close_popup_not_today(popup_id){
    setCookie(''+popup_id+'','Y',1);
    $("#"+popup_id).fadeOut(700).delay(700).queue(function(next){
        $("#"+popup_id).remove();
        next(); 
    });
};


/*
    * 리사이즈 콜백 제어
*/
function debounce(fn, delay) {
    var timer = null;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            fn.apply(context, args);
        }, delay);
    };
}

/*
    * string -> string(,) 생성
*/
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

/*
    * view 페이지 URL idx 추출 for Noti
*/
function sliceUrlIdx(){
    var origUrl =document.location.href;
    var spUrl = origUrl.split("/"); // url 구분자(/)
    var urlLength = spUrl.length;
    var lastUrl = spUrl[urlLength-1];
    var spLastUrl = lastUrl.split("="); // 문자열 구분자(=)
    return spLastUrl[1];
};

/*
    * view 페이지 URL idx 추출 2 for POST
*/
function getUrlIdx(){
    var origUrl =document.location.href;
    var spUrl = origUrl.split("/"); // url 구분자(/)
    var urlLength = spUrl.length;
    var lastUrl = spUrl[urlLength-1];
    var spLastUrl = lastUrl.split("="); // 문자열 구분자(=)
    var finalUrl = lastUrl.split("?")[1].split("&")[0].split("=")[1];
    return finalUrl;
};

/*
    * 통계 코드
*/
function linkClicks(category,action,label) {
    gtag('event', 'event', {
      'event_category' : category,
      'event_action' : action,
      'event_label' : label
    });
}

/*
    * URL parse
*/
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}