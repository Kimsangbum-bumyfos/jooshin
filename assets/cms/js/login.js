// 로그인페이지 onload시 실행
function initLoginPage ()
{
    // // 명언을 추가 '이 곳에 명언을 입력하세요. <p>-출처-</p>'
    // var say = [
    //     '자신감 있는 표정을 지으면 자신감이 생긴다<p>-찰스다윈-</p>',
    //     '삶이 있는 한 희망은 있다.<p>-키케로 -</p>',
    //     '하루에 3시간을 걸으면 7년 후에 지구를 한바퀴 돌 수 있다.<p>-사무엘존슨-</p>',
    //     '신은 용기있는자를 결코 버리지 않는다.<p>-켈러-</p>',
    //     '꿈을 계속 간직하고 있으면 반드시 실현할 때가 온다.<p>-괴테-</p>',
    //     '행복은 습관이다, 그것을 몸에 지니라.<p>-허버드-</p>',
    //     '1퍼센트의 가능성, 그것이 나의 길이다.<p>-나폴레옹-</p>'
    // ];

    // // 로그인 배경을 추가 (배경에 어울리는 글자색을 지정)
    // var bgImg = [
    //     {url:'./assets/img/login/bg_1.png', color:'#fff'},
    //     {url:'./assets/img/login/bg_2.png', color:'#fff'},
    //     {url:'./assets/img/login/bg_3.png', color:'#6d8f95'}
    // ];

    // // 이미지 프리로드
    // for (var i = 0; i < bgImg.length; i++) {
    //     var img = new Image();
    //     img.src = bgImg[i].url;
    // }

    // // 배열 랜덤 소팅
    // function shuffle(a, b){
    //     return .5 - Math.random();
    // }

    // say.sort(shuffle);
    // say.sort(shuffle);
    // say.sort(shuffle);

    // bgImg.sort(shuffle);
    // bgImg.sort(shuffle);
    // bgImg.sort(shuffle);

    // // 배경과 명언을 5초마다 롤링
    // function loginAutoBg ()
    // {
    //     $('.wrap.rollingImg').css({'background-image':'url('+bgImg[0].url+')'});
    //     $('.saying').html(say[0]).css('color',bgImg[0].color);

    //     setInterval(function(){
    //        $('.wrap.rollingImg').css({'background-image':'url('+bgImg[1].url+')'});
    //         $('.saying').html(say[1]).css('color',bgImg[1].color);

    //         bgImg.push(bgImg.shift());
    //         say.push(say.shift());
    //     },5000);
    // }

    // loginAutoBg();


    // 0813 - 유효성 검사 추가
    var input_valid = [0,0,0,0,0,0]; // 유효
    var input_blank = [0,0,0,0,0,1]; // 공백  

    $(".btn-login").bind("click focusin", function(){
        var tg_id = $(this).attr("id");

        switch(tg_id){
            case "btn-admin-login": {
                var input_array =['e-mail','pw'];
                for(var i=0; i<2; i++){
                    valid_check(input_array[i]);
                    valid_check_false(input_array[i]);
                }
                break;
            };

            // 비번1 이메일 입력
            case "btn-admin-pw1": {
                valid_check('e-mail');
                valid_check_false('e-mail');
            };

            case "btn-admin-pw3": {
                var input_array =['pw','pw2'];
                for(var i=0; i<2; i++){
                    valid_check(input_array[i]);
                    valid_check_false(input_array[i]);
                }
                break;
            };
        }
    });

    $(".content-panel").bind("change keyup input", function(){
        var tg_form = $(this);
        var tg_btn_id = tg_form.find('.btn-login').attr("id");
        var tg_btn_ob = $("#"+tg_btn_id);
        var input_group_cnt = $(".input-group").length;

        switch(tg_btn_id){
            case "btn-admin-login": {
                if(cnf_e_mail($("#e-mail").val()) && $("#pw").val().length>=1){ // e-mail valid && pw >1
                    btn_on(tg_btn_ob);
                }
                else{
                    btn_off(tg_btn_ob);
                }
                break;
            };

            // 비번1 이메일 입력
            case "btn-admin-pw1": {
                var ctl =1;
                btn_ctl(ctl,tg_btn_ob);
                break;
            };

            // 비번3 비번, 비번 확인 버튼
            case "btn-admin-pw3": {
                var ctl =2;
                btn_ctl(ctl,tg_btn_ob);
                break;
            };
        }

    });

    //  유효성만 검사
    $(".login-form").bind("change keyup input", function(){
        var tg_id = $(this).attr("id");
        valid_check(tg_id); 
    });

    // 경고 스타일만 출력
    $(".login-form").bind("focusout", function(){
        var tg_id = $(this).attr("id");
        valid_check_false(tg_id);
    });

    // check
    function valid_check(tg_id){
        var tg_ob =$("#"+tg_id);
        var tg_val = tg_ob.val();
        var pw_val = $("#pw").val();
        var pw2_val = $("#pw2").val();

        var ex_btn = tg_ob.parent('.input-group').siblings('.btn-login');
        var ex_btn_id = ex_btn.attr("id");

        // blank : ? 
        if(tg_val =='' || tg_val =='undefined'){
            valid_blank(tg_id);
        }
        else{
            valid_not_blank(tg_id);
        }
        
        // valid
        switch(tg_id){
            case "e-mail":{
                if(! cnf_e_mail(tg_val)){
                    input_valid[0] = 0;
                }
                else{
                    input_valid[0] = 1;
                }
                break;
            };
            case "pw" : {
                if(pw_val == pw2_val){
                    input_valid[1] = 1;
                    input_valid[2] = 1;
                }
                else if( pw_val != pw2_val ){
                    input_valid[1]=0;
                    input_valid[2]=0;
                }
                break;
            };
            case "pw2": {
                if(pw_val == pw2_val){
                    input_valid[1] = 1;
                    input_valid[2] = 1;
                }
                else if( pw_val != pw2_val ){
                    input_valid[1]=0;
                    input_valid[2]=0;
                }
                break;
            };
        }

        // exception to not enroll page
        if($(".input-group").length==2 && ex_btn_id != 'btn-admin-pw3'){
            input_valid[1] = 1;
            input_valid[2] = 1;
        }
    };

    // blank
    function valid_blank(tg_id){
        switch(tg_id){
                case "e-mail": {
                    input_blank[0]=0;
                    break;
                };
                case "pw2" :{
                    input_blank[2]=0;
                    break;
                };
                case "pw": {
                    input_blank[1]=0;
                    break;
                };
            }
    };

    // not blank
    function valid_not_blank(tg_id){
        switch(tg_id){
            case "e-mail": {
                input_blank[0]=1;
                break;
            };
            case "pw2" :{
                input_blank[2]=1;
                break;
            };
            case "pw": {
                input_blank[1]=1;
                break;
            };
        }
    };

    // alert box
    function valid_check_false(tg_id){
        var tg_ob =$("#"+tg_id);
        var tg_val = tg_ob.val();
        var tg_input_group = tg_ob.parents('.input-group');
        var tg_name = tg_ob.attr("name");
        var input_array =['e-mail','pw','pw2','name','phone'];
        var input_index = jQuery.inArray(tg_id, input_array); // id == index 

        var pw_val = $("#pw").val();
        var pw2_val = $("#pw2").val();
        var pw_parent = $("#pw").parent();
        var pw2_parent = $("#pw2").parent();

        if(input_blank[input_index] == 0){ // blank check2
            var alert_text = tg_name+"을 입력하세요.";
            if(input_index==1 || input_index==4){
                alert_text = tg_name+"를 입력하세요.";
            }
            insert_false(tg_input_group, alert_text);
        }
        else{
            // valid check
            if(input_valid[input_index] == 0){ // false
                switch(input_index){
                    case 0:{ // 이메일
                        alert_text = "이메일을 형식에 맞게 입력하세요.";
                        insert_false(tg_input_group, alert_text);
                        break;
                    };
                    case 1:{ // 비밀번호 
                        if(pw_val != pw2_val && input_blank[2] == 1 && input_blank[1] == 1 ){
                            alert_text = "비밀번호가 일치하지 않습니다.";
                            insert_false(pw2_parent, alert_text);
                            insert_true(pw_parent);
                        }
                        else if(input_blank[2] ==0){
                            insert_true(pw_parent);
                        }
                        else if(input_blank[1] ==1 && input_blank[2] == 1){
                            insert_true(pw_parent);
                        }
                        break;
                    };
                    case 2:{ // 비밀번호 확인
                        if(input_valid[1] != 1 && input_blank[1] ==1){
                            alert_text = "비밀번호가 일치하지 않습니다.";
                            insert_false(tg_input_group, alert_text);
                        }
                        else if(input_blank[1] == 1 && input_blank[1] == 1){
                            alert_text = "비밀번호가 일치하지 않습니다.";
                            insert_false(tg_input_group, alert_text);
                        }
                        else if(input_blank[1] == 0){
                            insert_true(tg_input_group);
                        }
                        break;
                    };
                }
            }
            else if(input_valid[input_index] == 1){ // valid true
                switch(input_index){
                    case 0:{ // 이메일 
                        insert_true(tg_input_group);
                        break;
                    };
                    case 1:{ // 비밀번호
                        if(pw_val == pw2_val || input_valid[1] ==1 && input_valid[2] ==1){
                            insert_true(tg_input_group);
                            insert_true(pw2_parent);
                        }
                        else if(pw_val != pw2_val && input_blank[2] == 0) {
                            insert_true(pw2_parent);
                        }
                        break;
                    };
                    case 2:{ // 비밀번호 확인
                        if( input_blank[1] == 0){
                            insert_true(tg_input_group);
                        }
                        else if(input_valid[1] == 1 && input_valid[2] == 1) {
                            insert_true(pw_parent);
                            insert_true(tg_input_group);
                        }
                        break;
                    };
                }
            }
        }
    };

    // false alert css
    function insert_false(tg_input_group, alert_text){
        tg_input_group.addClass('wrong');

        if(tg_input_group.find('.wrong-info').length<1){
            var p_tag = "<p class='wrong-info'></p>"
            tg_input_group.append(p_tag);
        }

        tg_input_group.find('.wrong-info').text(alert_text);
        tg_input_group.css({"margin-bottom":"32px"});

    };

    // true - alert del
    function insert_true(tg_input_group){
        tg_input_group.css({"margin-bottom":"15px"});
        tg_input_group.removeClass('wrong');
        tg_input_group.find('.wrong-info').remove();
    };

    // btn_login control
    function btn_ctl(ctl,tg_btn_ob){
        var cnt = 0;
        for(var i=0; i<input_valid.length; i++){
            if(input_valid[i]==1){
                cnt++;
                console.log("cnt :"+cnt);
            }
        }
        console.log("cnt확인!"+cnt);

        if(cnt==ctl){
            btn_on(tg_btn_ob);
            cnt==0;
        }
        else{
            btn_off(tg_btn_ob);
            cnt==0;
        }
    };

}

// login-btn on || off
function btn_on(tg_btn_ob){
    tg_btn_ob.addClass("active");
    tg_btn_ob.attr("type","submit");
};

function btn_off(tg_btn_ob){
    tg_btn_ob.removeClass("active");
    tg_btn_ob.attr("type","button");
};

// validity check e-mail
function cnf_e_mail(emailVal){
    var regEmail=/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
     return (regEmail.test(emailVal));
};