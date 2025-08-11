jQuery(document).ready(function(){

	/*
        * 템플릿 상세보기 페이지
        * 템플릿 SNS 공유하기
    */
    $("a[data-toggle='sns_share']").click(function(e){
        e.preventDefault();
        
        var _this = $(this);
        var sns_type = _this.attr('data-service');
        var href = window.location.href;
        var title = _this.attr('data-title');
        var loc = "";
        var img = $("meta[name='og:image']").attr('content');

        if( ! sns_type || !href || !title) return;
        
        if( sns_type == 'facebook' ) {
            loc = '//www.facebook.com/sharer/sharer.php?u='+href+'&t='+title;
        }
        else if ( sns_type == 'kakaostory') {
            loc = 'https://story.kakao.com/share?url='+encodeURIComponent(href);
        }
        else {
            return false;
        }
        
        window.open(loc);
        return false;
    });

    /*
        * 템플릿 상세보기 페이지
        * 템플릿 링크 복사
    */
    $(".btn-share.url").click(function(){
        var Url = document.getElementById("url");
        Url.innerHTML = window.location.href;
        Url.select();
        document.execCommand("copy");
        alert('클립보드에 주소가 복사되었습니다. Ctrl + V 로 붙여넣기 하세요.');
    });

    /*
        * 약관 페이지 제어
        * 페이지 이동시 뒤로가기
        * 새창시 페이지 닫기
    */
    $(".terms-close").click(function(){
        if(!document.referrer){ // 뒤로가기
            window.history.back();
        }
        else{
            window.close(); // 새창 진입시 닫음
            window.history.back();
        }
    });

    /*
        * 뷰 페이지 뒤로가기
    */
    // $('.view-group-A-cancel').click(function(){
    //     window.history.back();
    // });



    $('#cs_submit').click(debounce(function(event){


        if($("#cs_name").val() === undefined || $("#cs_name").val()==''){
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
        else if($("#cs_title").val() === undefined || $("#cs_title").val()==''){
            alert("제목은 필수 항목입니다.");
        }
        else if($("#cs_contents").val() === undefined || $("#cs_contents").val()==''){
            alert("문의사항은 필수 항목입니다.");
        }
        else if(!$('.cs-wrap .cs-form input[type="checkbox"]').is(':checked')){
            alert("개인정보취급동의 체크해 주세요");
        }
        else {
            csPushCustomer();
        }
    },200));
});



function csPushCustomer(){
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
            csDonePushCustomer(resData);
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
function csDonePushCustomer(res){
    loading(false);
    var res = res;
    if(res.status === true){
        // linkClicks('고객센터', '1:1문의전송', '1:1문의하기전송완료'); // 통계
        // $('#formTab .result-panel .icon').addClass('success');

        // var content = '\
        //             <span class="highlight-blue">문의가 정상적으로 등록되었습니다.</span>\
        //             <br>빠른 시간 내 답변드리도록 하겠습니다.\
        //         ';

        // $('.result-info').html(content);
        // $('.result-panel').css('display','block');

        // // 폼 비우기
        $('.cs-wrap .cs-form input, .cs-wrap .cs-form textarea').val('');
        $('.cs-wrap .cs-form input[type="checkbox"]').prop('checked',false);
        alert("문의가 정상적으로 등록되었습니다.\n빠른 시간 내 답변드리도록 하겠습니다.");
    }
    else{
        // $('#formTab .result-panel .icon').addClass('fail');
        // var content = '\
        //             <span class="highlight-blue">문의가 등록되지 않았습니다.</span>\
        //             <br>다시 한번 시도해 주세요.\
        //         ';
        // $('.result-info').html(content);
        // $('.result-panel').css('display','block');
        alert("문의가 등록되지 않았습니다.\n다시 한번 시도해 주세요.");
    }
}




// $(document).on('click', '.pagination > span', function(){
//     var offset = $(this).data('offset');

//     if(_paging.config.current == offset )               // 현재 페이지시 페이징X
//         return;
//     _paging.clearPaging();                              // 페이징 초기화

//     var strToCall = _paging.config.callBack;            // 콜백함수
//     for(var prop in _paging.config.callConfig){         // key, value로 매개변수 교체

//         if(_paging.config.callConfig[prop] != '')       // 공백이 아닐경우 매개변수 교체
//             strToCall = strToCall.replace(prop, _paging.config.callConfig[prop]);
//         else
//             strToCall = strToCall.replace(prop, "\'\'"); // 공백시 ''
//     }          

//     // callBack 함수 offset 변경
//     eval(_paging.config.callBackConfig+'.offset = '+offset);// config 저장
//     eval(strToCall);                                        // callBack 실행
// });



var paging = {
    config:{
        offset: '',
        limit: '',
        total_page:'',
    },
    setPaging:function(paging_id){
        console.log(paging_id);
        if(paging.config.total_page>10){
            
        }
        else{
            paging.setElm(1,paging_id);
        }
    },
    setElm:function(num,paging_id){
        for(var i=num; i<=paging.config.total_page; i++){
            var item = '<span>'+i+'</span>';
            $('#'+paging_id).append(item);
        }
    }


};

var _paging = {
    config:{
        offset: '',
        limit: '',
        total_count: '',
        callConfig: '',
        callBackConfig: '',
        callBack: '',
        current: '',
        start: 1,
        end: '', // end
        pagingLimit: 10,
    },
    getPaging:function(){
        console.log('[_paging.getPaging]');
        _paging.calcPage(); // 페이징 계산 - 처음 한번만 해야함 셋팅용
    },
    calcPage:function(){
        console.log('[_paging.calcPage]');
        // start - end 페이지 계산
        _paging.config.end = Math.ceil(_paging.config.total_count/_paging.config.limit); // 소수점 올림

        var i = _paging.config.offset;
        console.log('[i] : '+ i);

        if(i>1)                                                             // 이전페이지 이동 태그
            _paging.createdMovePrev(i);
        

        while(i < _paging.config.pagingLimit+_paging.config.offset){        // 최대 pagingLimit까지 생성
            if(i>_paging.config.end)                                        // 마지막 페이지가 pagingLimit 이하일 경우 
                break;
            _paging.createdElm(i);                                          // 페이징 생성
            i++;           
        }

        console.log('[=====================]');


        if(i<_paging.config.end)                                            // 다음 페이지 이동 태그
            _paging.createdMoveNext(i);


        console.log('[=====================]');


        if(_paging.config.end > 10)                 // 10개 초과시 맨앞 / 맨뒤 추가
            _paging.createdLimitElm();

    },
    createdElm:function(offset){
        console.log('[_paging.createdElm]');
        var item ='<span id="paging_item_'+offset+'" data-offset="'+offset+'">'+offset+'</span>';
        $('.pagination').append(item);

        if(_paging.config.offset == offset){
            $('#paging_item_'+offset).addClass('active');       // style
            _paging.config.current = offset;                    // 현재 페이지
        }
    },
    /*
        * createdMovePrev : 이전페이지 이동 태그
        * createdMoveNext : 다음페이지 이동 태그
    */
    createdMovePrev:function(offset){
        var item = '<i data-offset="'+parseInt(offset-1)+'" title="이전페이지">이전페이지</i>';
        $('.pagination').prepend(item);
    },
    createdMoveNext:function(offset){
        console.log('[createdMoveNext]');
        var item = '<i data-offset="'+parseInt(offset+1)+'" title="다음페이지">다음페이지</i>';
        console.log(item);
        $('.pagination').append(item);
    },
    /*
        * end > 10
        * 맨 앞으로가기
        * 맨 뒤로가기
    */
    createdLimitElm:function(){
        console.log('[_paging.createdLimitElm]');
        var item_1 = '<i data-offset="'+_paging.config.start+'" title="첫페이지">첫페이지</i>';
        var item_2 = '<i data-offset="'+_paging.config.end+'" title="마지막페이지">마지막페이지</i>';
        $('.pagination').prepend(item_1);
        $('.pagination').append(item_2);
    },
    clearList:function(selector){
        console.log('[_paging.clearList]');
        $('#'+selector).empty();
    },
    clearPaging:function(){
        console.log('[_paging.clearPaging]');
        $('.pagination').empty();
    },
    goNextPage:function(){

    },
    goPrevPage:function(){

    },
    goFirstPage:function(){

    },
    goLastPage:function(){

    },
};