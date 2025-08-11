jQuery(document).ready(function(){

	/*
		* 스킵 네비게이션
		* 네비게이션 탭 => 포커스
	*/
	var $tab_list = $('.tab_menu');

	$tab_list.find('ul ul').hide();
	$tab_list.find('li.active>ul').show();

	function tabMenu(e){
	    e.preventDefault();
	    var $this = $(this);
	    $this.next('ul').show().parent('li').addClass('active').siblings('li').removeClass('active').find('>ul').hide();
	}
	$tab_list.find('>ul>li>a').click(tabMenu).focus(tabMenu);

    /*
		* 헤더 모바일 메뉴 열기 | 닫기
    */
	$('.menu-btn-area').on('click', debounce(function(e){ // 열기
		e.preventDefault();
    	e.stopPropagation();

		$('body').css("position","fixed");
		$('.menu-box').addClass('active').animate({"left":"0px"}, 700); // 메뉴 판
		$('.nav-area').addClass('active'); // 메뉴 목록
	},200));

	$('.menu-area-dimmed, .header-menu-close').click(function(){ // 닫기

		if(wrap_width>767)
			$('.menu-box').animate({"left":"-1024px"}, 700);
		else
			$('.menu-box').animate({"left":"-1024px"}, 700);
		

		setTimeout(function(){
			$('body').css("position","relative");
            $('.menu-box').removeClass('active');
        }, 450);

        if($('.slide').length){ // 메인 일 경우 슬라이드 활성화
			$.fn.fullpage.setAllowScrolling(true);
  			$.fn.fullpage.setKeyboardScrolling(true);
		}
	});

	/*
		* 페이지 리사이즈 체크
	*/
	$(window).on('resize', debounce(function(e){
        wrap_width = window.innerWidth;

        // 팝업 보이는 갯수 조절
        if(window.innerWidth >= 1024) {
            $(".popup-modal.main-popup").css("display","block");
            for(var i=0; i<$(".popup-modal.main-popup").length; i++){
               if( i !=0){
                    $(".popup-modal.main-popup").eq(i).css("left",i*400+((i+1)*30));
                }
                else{
                    $(".popup-modal.main-popup").eq(i).css("left","30px");
                }
            }
        }
        else{
            for(var i=0; i<$(".popup-modal.main-popup").length; i++){
                if($(".popup-modal.main-popup").eq(i).is(":visible")){
                    $(".popup-modal.main-popup").eq(i).css("left","50%");
                    $(".popup-modal.main-popup").not(":eq("+i+")").css("display","none");
                }
            }
        }

        if(wrap_width>1023){

        	$('.list-item-sub').css({'display':'none'});


        	if($('.menu-box').hasClass('active')){
        		// 열려있는 메뉴 검색 후 초기화
        		$('.header-nav-link').each(function(index){
        			if($('.header-nav-link').eq(index).hasClass('active')){
        				$('.header-nav-link').eq(index).siblings('.list-item-sub').css({'display':'none'});
        				$('.header-nav-link').eq(index).removeClass('active');
        				// $('.header-nav-link').eq(index).siblings('.list-item-accodian').removeClass('active');
        			}
        		});
        		$('.menu-area').find('.header-menu-close').trigger('click'); // 열린상태시 닫기
        		// prev_item.addClass('active'); // 현재 메뉴만 엑티브
        	}
        }
        else{
        	$('.header').removeClass('active');
        }
    },200));

    /*
		* 헤더 메뉴 조회
	*/
	getMenu();

	/*
		* POST 더보기
		* @메뉴코드, @메뉴업코드, @오프셋, @리미트(css list style)
	*/
	$('.post-list-more').on('click', debounce(function(event){
		getPostList(mCode, mUpCode, g_offset.post_offset, $(this).data('limit'));
	},200));


	/*
		* POST 디테일 진입
		* @idx(url)
	*/
	if($('#skipt_detail_A').length){
		var idx = getUrlIdx();
		getPostDetail(idx);
	}

	/*
		* 팝업 열기
	*/
	getMainPopUp();

	/*
		* 사이트 검색
	*/
	$('#gnbSearch, #gnbSearch_m').on('keyup', debounce(function(event){
		var search_word = $(this).val();

		if(event.keyCode == 13){ // Ente{
			$(this).val('');
			gnb.config.offset = 1;
			gnb.clearList();
			gnb.getSearchList(gnb.config.offset, gnb.config.limit, search_word);
		}
	},200));

	$('#ico_gnbSearch').on('click', debounce(function(event){
		if($(this).hasClass('toggle')){

			if($('#gnbSearch').val() != ''){
				gnb.config.offset = 1;
				gnb.clearList();
				gnb.getSearchList(gnb.config.offset, gnb.config.limit, $('#gnbSearch').val());
			}
			else{
				$(this).removeClass('toggle');
				$('#gnbSearch').animate({width:'toggle'},350);
			}
		}
		else{
			$(this).addClass('toggle');
			$('#gnbSearch').animate({width:'toggle'},350);
		}
	},200));

	$('#ico_gnbSearch_m').on('click', debounce(function(event){
		if($(this).hasClass('toggle')){

			if($('#gnbSearch_m').val() != ''){
				gnb.config.offset = 1;
				gnb.clearList();
				gnb.getSearchList(gnb.config.offset, gnb.config.limit, $('#gnbSearch_m').val());
			}
			else{
				$(this).removeClass('toggle');
				$('#gnbSearch_m').animate({width:'toggle'},350);
			}
		}
		else{
			$(this).addClass('toggle');
			$('#gnbSearch_m').animate({width:'toggle'},350);
		}
	},200));

	/*
		* GNB 검색
	*/
	if($('#wrap_search').length){
		var gnb_search = JSON.parse(sessionStorage.getItem('gnb_search'));
		// sessionStorage.removeItem("gnb_search");
		// 검색어 후 페이지 이동됨
		gnb.config.offset = 1;
		gnb.getSearchList(gnb.config.offset, gnb.config.limit,gnb_search.search_word);
	}


	/*
        * GNB 더보기
    */
    $('#btn_gnb_more').on('click', debounce(function(event){
    	gnb.getSearchList(gnb.config.offset, gnb.config.limit, gnb.config.search_word);
    },200));


	/*
		* 메가메뉴 셋팅
	*/
	m_product.setList();


	/*
		* 페이지 탑으로가기 생성
	*/
	init_top();



});
var wrap_width = window.innerWidth; // 페이지 가로

/*
	* 헤더 메뉴 조회
*/
function getMenu(){

	$.ajax({
        type: 'GET',
        url: base_url+'api/menu/list',
        success: function(resData) {
            // console.log('success >>>>');
            // console.log(resData);
            if(resData.status === true && resData.result.message == "NO DATA"){ // 메뉴 없음
            	alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            	return false;
            }
            else if(resData.status === true && resData.message == "Get List Success"){// 메뉴 존재
            	setMenu(resData.result);
            }
            else if(resData.status === false && resData.message == "Parameter ERROR"){// 메뉴 파라미터 에러
            	alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            	return false;
            }
            else{ // 그 외 분기(있으면안됨)
            	alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            	return false;
            }
        },
        error: function(resData) {
            // console.log('error >>>');
            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }
    });
};

/*
	* 전체 메뉴 생성
*/
function setMenu(res){
	// console.log(res);
	// 메뉴 리스트
	var menu = new Object();
	menu['one'] = [];
	menu['two'] = [];

	// 메뉴 뎁스 구분 후 저장
	for(var i=0; i<res.length; i++){
		if(res[i].menu_level === "1")
			menu['one'].push(res[i]);
		else if(res[i].menu_level === "2")
			menu['two'].push(res[i]);
	}


	/************** 1뎁스 메뉴 ************************************/

	// 1뎁스 메뉴 정렬(메뉴 순서)
	menu.one.sort(function(a,b){
		return (a.menu_order < b.menu_order)? -1 : (a.menu_order > b.menu_order) ? 1:0;
	});

	// 1뎁스 생성
	add_oneMenu(menu.one);

	/*************** 2뎁스 메뉴 ***********************************/

	// 2뎁스 메뉴 정렬(메뉴 순서)
	menu.two.sort(function(a,b){
		return a.menu_order - b.menu_order;
	});

	// 2뎁스 메뉴 정렬(메뉴 업코드)
	menu.two.sort(function(a,b){
		return (a.menu_up_code < b.menu_up_code)? -1 : (a.menu_up_code > b.menu_up_code) ? 1:0;
	});

	// 2뎁스 생성
	add_twoMenu(menu.two);

	/*
		* 헤더 메뉴 아코디언 셋팅
		* 하위메뉴 존재X => 아코디언, 사용안하는 서브메뉴 숨김
	*/
	setMenu_accodian();

	/*
		* POST 리스트 조회
		* 메뉴 데이터(active 부여 && 메인페이지가 아닐 경우에만 Ajax)
	*/
	if(!$("#fullpage").length){ // 메인 페이지 X

		if($('#wrap_search').length)
			return;

		$("li").find("[data-menu-code='"+mCode+"']").addClass('active'); // 현재 페이지 메뉴에 active 부여

		// 현재 페이지 메뉴 정보 저장
		var c_item = ''; // 서브 메뉴
		var p_item = ''; // 대 메뉴
		var p_bool = false; // 대 메뉴 여부

		// 현재 메뉴 저장(1개)
		$.each(res, function(i, v) {
		    if (v.menu_code == mCode) {
		        c_item = v;
		        return;
		    }
		});

		if(c_item.menu_up_code !== null){// 소 메뉴 일 경우 대 메뉴 저장
			$.each(res, function(i, v) {
			    if (v.menu_code == mUpCode) {
			        p_item = v;
			        return;
			    }
			});
			p_bool = true; // 대 메뉴 플래그
		}


		// 카테고리 리스트 작성
		menu['sort'] = [];
		if(p_bool === false){ // 대 메뉴일 경우

			// 하위 메뉴 정보 저장
			$.each(res, function(i, v) {
			    if (v.menu_up_code == c_item.menu_code) {
			        menu['sort'].push(v);
			    }
			});
		}
		else{
			// 소 메뉴 일 경우
			// 현재 메뉴의 상위 메뉴 -> 상위 메뉴의 하위 메뉴 정보 저장
			$.each(res, function(i,v) {
				if(v.menu_up_code == p_item.menu_code){
					menu['sort'].push(v);
				}
			});
		}

		// 메뉴 헤더 정보 셋팅
		// @현재 메뉴, @대 메뉴(없으면 현재메뉴), @대 메뉴 존재여부 플래그, @하위메뉴 정보
		setMenuData(c_item, p_item, p_bool, menu['sort']);
	}

	// 메뉴 링크 정보 수정
	// @1뎁스메뉴, @2뎁스메뉴
	modify_menuLink(menu['one'], menu['two']);
};

/*
	* 1뎁스 메뉴 생성
*/
function add_oneMenu(one){
	var list = {};

	for(var prop in one){
		// console.log(one[prop]);
		// 메뉴 타입 -> 링크 매칭
		var type = setMenuType(one[prop].menu_type, one[prop].menu_code,'');

		list[prop] = '<li class="list-item" data-menu-yn="'+one[prop].sub_menu_yn+'"  data-menu-code="'+one[prop].menu_code+'" data-list-idx="'+one[prop].idx+'" data-list-type="'+one[prop].menu_type+'" data-t-type="'+one[prop].template_type+'"\
							data-bg-header="'+one[prop].menu_bg_header+'"  data-bg-path="'+one[prop].path+'"  data-bg-title="'+one[prop].menu_title+'" data-bg-desc="'+one[prop].menu_desc+'" >\
							<a href="'+base_url+'home/'+type+'" class="header-nav-link">'+one[prop].menu_name+'</a>\
							<span class="list-item-accodian"></span>\
							<ul class="list-item-sub" data-up-code="'+one[prop].menu_code+'"  style="background-image:url(\''+base_url+one[prop].path+'/'+one[prop].menu_bg_header+'\');" ></ul>\
						</li>';
		$('.nav-area').append(list[prop]);

		var searchTg = $('[data-list-idx="'+one[prop].idx+'"]'); // 필터링할 메뉴

		if(type === "blank_link"){ // 외부 링크시
			searchTg.children('.header-nav-link').attr('target','_blank'); // 새창

			if($('body').hasClass('mobile')){
				var catalog_width = window.innerWidth;
				var catalog_height = window.innerHeight;
			}
			else {
				var catalog_width = 488;
				var catalog_height = 700;
			}

			searchTg.children('.header-nav-link').attr("onclick","javascript:window.open('"+one[prop].link_url+"', 'catalog', 'width="+catalog_width+", height="+catalog_height+"');return false");
		}
	}
};

/*
	* 2뎁스 메뉴 생성
*/
function add_twoMenu(two){
	var list = {};

	for(var prop in two){
		// console.log(two[prop]);
		// 메뉴 타입 -> 링크 매칭
		var type = setMenuType(two[prop].menu_type, two[prop].menu_code, two[prop].menu_up_code);

		list[prop] = '<li data-menu-code="'+two[prop].menu_code+'" data-sub-type="'+two[prop].menu_type+'" data-sub-idx="'+two[prop].idx+'" data-t-type="'+two[prop].template_type+'">\
						<a href="'+base_url+'home/'+type+'">'+two[prop].menu_name+'</a>\
					</li>';

		// .replace(/ /g, '')


		// 1뎁스 검색 후 추가
		$('.list-item-sub').each(function(index){
			if($('.list-item-sub').eq(index).data('upCode') === two[prop].menu_up_code)
				$('.list-item-sub').eq(index).append(list[prop]);
		});

		var searchTg = $('[data-sub-idx="'+two[prop].idx+'"]');// 필터링할 메뉴

		if(type === "blank_link"){ // 외부 링크시
			searchTg.children('a').attr('href',two[prop].link_url); // link 변경
			searchTg.children('a').attr('target','_blank'); // 새창
		}
	}
};

/*
	* 아코디언 및 2뎁스 메뉴 셋팅(하드코딩식으로 변경)
*/
function setMenu_accodian(){
	var tg = $('.nav-area .list-item:eq(1)'); // 제품소개
	var list = ['계측장비', '스트레인게이지', '계측센서', '비디오게이지', '시험용치구', '제작품'];

	var list =[
		{
			"name" : "계측장비",
			"url" : "&depth_1=계측장비",
		},
		{
			"name" : "스트레인게이지",
			"url" : "&depth_1=스트레인게이지&depth_2=스트레인게이지&depth_3=",
		},
		{
			"name" : "계측센서",
			"url" : "&depth_1=계측센서&depth_2=하중계&depth_3=",
		},
		{
			"name" : "비디오게이지",
			"url" : "&depth_1=비디오게이지",
		},
		{
			"name" : "시험용치구",
			"url" : "&depth_1=시험용치구",
		},
		{
			"name" : "제작품",
			"url" : "&depth_1=제작품",
		}
	];

	var item = '';
	for(var prop in list){
		item += '<li><a href="'+base_url+'home/product?menu_code=product&menu_up_code='+list[prop].url+'" \
		title="'+list[prop].name+'">'+list[prop].name+'</a></li>'; 
	}

	tg.append('<ul id="hd_depth_2">'+item+'</ul><span id="hd_acc_2"></span>');
};

/*
	* 메뉴 코드 링크 셋팅
*/
function setMenuType(type, menu_code, menu_up_code){

	switch (type) {
		case "BOARD_NOTICE": // 게시판 공지
			return 'support/notice?menu_code='+menu_code+'&menu_up_code='+menu_up_code+'';
            break;
        case "BOARD_FAQ": // 게시판 faq
        	return 'support/faq?menu_code='+menu_code+'&menu_up_code='+menu_up_code+''; 
            break;
        case "BOARD_EVENT": // 게시판 이벤트
        	return 'support/event?menu_code='+menu_code+'&menu_up_code='+menu_up_code+''; 
            break;
        case "COMPANY": // 회사소개
        	return 'info/company?menu_code='+menu_code+'&menu_up_code='+menu_up_code+''; 
            break;
        case "PRODUCT": // 제품소개
        	return 'product?menu_code='+menu_code+'&menu_up_code='+menu_up_code+'&depth_1=계측장비'; 
            break;
        case "SERVICE": // 시험 및 용역
        	return 'service?menu_code='+menu_code+'&menu_up_code='+menu_up_code+''; 
            break;
        case "CS": // 고객문의
        	return 'info/cs?menu_code='+menu_code+'&menu_up_code='+menu_up_code+''; 
            break;
        case "LINK":
        	return 'blank_link'; // 외부링크
            break;
        case "BRANCH": // 지점
        	return 'branch?menu_code='+menu_code+'&menu_up_code='+menu_up_code+'';
            break;
        case "CONTS": // 콘텐츠
        	return 'post?menu_code='+menu_code+'&menu_up_code='+menu_up_code+'';
        	break;
	}
};

/*
	* 메뉴 헤더 정보 셋팅
	* @현재 메뉴 정보 @대메뉴 @대메뉴 여부 @하위 메뉴정보
*/
function setMenuData(c_item, p_item, p_bool, sort){
	// console.log(c_item); // 현재
	// console.log(p_item); // 부모(있을경우)
	// console.log(p_bool); // 부모 여부


	var contSub = true; // 플래그 추가

	if(p_bool === true){ // 대 메뉴 O (현재 메뉴 : 소 메뉴 진입)
		var bg_pc = base_url+p_item.path+'/'+p_item.menu_bg_pc; // 배경 PC
		var bg_m = base_url+p_item.path+'/'+p_item.menu_bg_mobile; // 배경 M
		var tType = p_item.template_type; // css 스타일 타입
		var pType = setMenuType(p_item.menu_type, p_item.menu_code, p_item.menu_up_code); // 링크 매칭
		var all_link = base_url+'home/'+pType; // ALL 카테고리 링크

		if(p_item.menu_type == 'CONTS') // POST 리스트 일경우 플래그 활성화
			var conts = true;

		// 현재 메뉴 표시
		$('.nav-area .header-nav-link').each(function(index) {
			if($('.nav-area .header-nav-link').eq(index).text() == p_item.menu_name)
				$('.nav-area .header-nav-link').eq(index).addClass('active');
		});
	}
	else{ // 대 메뉴 X (현재 메뉴 : 대 메뉴 진입)
		var bg_pc = base_url+c_item.path+'/'+c_item.menu_bg_pc; // 배경 PC
		var bg_m = base_url+c_item.path+'/'+c_item.menu_bg_mobile; // 배경 M
		var tType = c_item.template_type; // css 스타일 타입
		var cType = setMenuType(c_item.menu_type, c_item.menu_code, c_item.menu_up_code); // 링크 매칭
		var all_link = base_url+'home/'+cType; // ALL 카테고리 링크

		if(c_item.menu_type == 'CONTS') // POST 리스트 일경우 플래그 활성화
			var conts = true;

		// 현재 메뉴 표시
		$('.nav-area .header-nav-link').each(function(index) {
			if($('.nav-area .header-nav-link').eq(index).text() == c_item.menu_name)
				$('.nav-area .header-nav-link').eq(index).addClass('active');
		});
	}

	/*
		* 컨테이너 배경 및 텍스트 셋팅
	*/
	if(c_item.menu_header != null){
		$('.section-bg-text h3').addClass('active');
	}

	$('.section-bg-text h3').html(c_item.menu_header);
	$('.section-bg-text h2').css('color',c_item.text_color); // 타이틀 색상
	$('.section-bg-text h2').html(c_item.menu_title); // 타이틀
	$('.section-bg-text h2').css('color',c_item.text_color); // 타이틀 색상
	$('.section-bg-text p').html(c_item.menu_sub_title); // 서브타이틀
	$('.section-bg-text p').css('color',c_item.text_color); // 서브타이틀 색상
	$('.section-bg-img .section-bg-pc').css({'background-image':'url('+bg_pc+')'}); // PC 이미지
	$('.section-bg-img .section-bg-m').css({'background-image':'url('+bg_m+')'}); // M 이미지

	/*
		* 카테고리 순서 정렬 후 링크 셋팅
	*/
	var c_panel = $('.section-category-post .category-group ul'); // 카테고리 판넬
	var active_li = $("li").find("[data-menu-code='"+c_item.menu_code+"']").children('a').text(); // 현재 active 메뉴 검색
	if(sort != undefined){ // 하위 메뉴정보 존재
		sort.sort(function(a,b){ // 오름차순 정렬
			return a.menu_order - b.menu_order;
		});

		for(var prop in sort){// 카테고리 생성
			// console.log(sort[prop].menu_type);
			var type = setMenuType(sort[prop].menu_type, sort[prop].menu_code, sort[prop].menu_up_code); // 타입 매칭
			var item ='<li onClick="location.href=\''+base_url+'home/'+type+'\'"><span>'+sort[prop].menu_name+'</span></li>';

			c_panel.append(item);

			if(c_item.menu_level == 2){ // 소 메뉴 일경우
				var cnt = parseInt(prop)+1; // +1(ALL)
				if(active_li == sort[prop].menu_name)
					c_panel.children('li').eq(cnt).addClass('active'); // 현재 메뉴 카테고리에 active style
			}

			if(sort[prop].menu_type != 'CONTS'){ // POST 타입이 없을 경우 플래그
				conts = false;
				contSub = false;// 플래그 추가
			}
		}

		if(c_item.menu_level ==2 && c_item.menu_type == 'CONTS') // 서브 메뉴 CONTS 진입일 경우 변경
			conts = true;
	}

	// 카테고리 ALL에 link 추가
	c_panel.children('li').eq(0).attr('onclick',"location.href='"+all_link+"'");

	// 서브 페이지 ALL만 생성될 경우 삭제(하위 메뉴가 없을 경우)
	if(c_panel.children('li').length == 1){
		$('.section-category-post').remove(); // 카테고리 영역 삭제
		$('#section_list').addClass('active'); // 포스트 영역 간격
		$('.section-notice, .section-faq').addClass('active');// 고객센터 영역 간격
	}


	if(c_item.menu_level == 1){ // 현재 메뉴 : 대 메뉴 인 경우 all에 active
		c_panel.children('li').removeClass('active');
		c_panel.children('.category-all').addClass('active');
	}

	/*
		* 리스트 스타일 적용
		* 메뉴 코드 매칭
	*/
	var limit = swapType(tType);

	/*
		* 버튼 데이터 셋팅(가변 데이터)
		* @메뉴코드 @업코드 @리미트
	*/
	$('.post-list-more').data('menu-code', c_item.menu_code);
	$('.post-list-more').data('menu-up-code', c_item.menu_up_code);
	$('.post-list-more').data('limit', limit);

	if(conts === false || contSub === false)// CONTS 로 구성되지 않은 메뉴의 경우 ALL 삭제
		c_panel.children('.category-all').remove();

	// 모든 메뉴가 포스트 일 경우에만 ajax 호출
	if(conts === true)
		getPostList(c_item.menu_code, c_item.menu_up_code, g_offset.post_offset, limit);


	// 주신산업 제품소개 json menu

};

/*
    * 리미트 반환
*/
function swapType(tType){
	switch (tType) {
		case "01":
			$('#section_list').addClass('section-list-A');
			return 8;
			break;
		case "02":
			$('#section_list').addClass('section-list-B');
			return 3;
			break;
		case "03":
			$('#section_list').addClass('section-list-C');
			return 6;
			break;
	}
};


/*
	* 메뉴 설정 마지막 단계
	* 링크 재설정
	* @1뎁스 메뉴, @2뎁스 메뉴
*/
function modify_menuLink(one, two){

	var modi = new Object();
	modi['sort'] = [];

	// 원뎁스 메뉴 검색
	for(var i=0; i<one.length; i++){

		// 대 메뉴와 메뉴 타입이 다른 서브 메뉴 검색 후 저장
		$.each(two, function(index, v) {
		    if (v.menu_up_code == one[i].menu_code && v.menu_type != one[i].menu_type) {
		       	modi['sort'].push(one[i]);
		    }
		});
	}

	// 검색 된 메뉴 0번째 링크 변경
	for(var prop in modi['sort']){
		var code = modi['sort'][prop].menu_code;

		$('.list-item').each(function(index) {
			if($('.list-item').eq(index).data('menuCode') === code){
				var link = $('.list-item').eq(index).children('.list-item-sub').children('li').eq(0).children('a').attr('href');
				$('.list-item').eq(index).children('.header-nav-link').attr('href', link);
			}
		});
	}
};

// post list offset
var g_offset = {
	post_offset : 1, // 포스트 리스트 오프셋
	noti_offset:1,
    faq_offset :1,
    branch_offset:1,
    event_offset: 1,
};

/*
	* 포스트 리스트 조회
	* @메뉴코드, @메뉴업코드, @오프셋, @리미트
*/
function getPostList(menu_code, menu_up_code, offset, limit){
	// loading(true);

	if(menu_up_code == null || menu_up_code == '' || menu_up_code == 'null'){ // 대메뉴 진입시
		var menu_level = 1;
		var menu_up_code = '';
	}
	else{ // 소메뉴 진입시
		var menu_level = 2;
	}

	// 하위 메뉴가 있는 대 메뉴는 업코드 수정(url error 방지)
	if($('.section-category-post').find('ul').length != 0){ // 서브 메뉴 판 여부로 판별
		 var menu_up_code = menu_code;
	}

	$.ajax({
        type: 'GET',
        url: base_url+'api/posts/post/list?menu_code='+menu_code+'&menu_up_code='+menu_up_code+'&offset='+offset+'&limit='+limit+'&menu_level='+menu_level+' ',
        success: function(resData) {
            // console.log('success >>>>');
            // console.log(resData);
            if(resData.status === true && resData.result.message == "NO DATA"){ // POST 리스트 없음
            	loading(false); 
            	$('.post-list-more').addClass('active'); // 더보기 숨김

            	// 더보기 X && 리스트가 없을 경우
            	if($('#section_list').find('.list-item-t').length == 0){
            		var no_list = '<div class="list-none-t"><span>등록된 글이 존재하지않습니다.</span></div>';
            		$('#section_list').find('.list-group-t').append(no_list);
            	}
            }
            else if(resData.status === true && resData.message == "Get List Success"){ // POST 리스트 존재
            	loading(false);
            	setPostList(resData.result.data, limit, resData.result.total_count);
            }
            else if(resData.status === false && resData.message == "Parameter ERROR"){ // POST 파라미터 에러
            	loading(false);
            	$('.post-list-more').addClass('active'); // 더보기 숨김
            	alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            	return false;
            }
            else{ // 그 외 분기(있으면안됨)
            	alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            	loading(false);
            	return false;
            }
        },
        error: function(resData) {
            // console.log('error >>>');
            loading(false);
            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }
    });
};

/*
	* 포스트 리스트 생성
	* @결과 데이터, @리미트
*/
function setPostList(res, limit, total_count){
	// console.log(res);
    var list ={};
    if(res != undefined){// POST 리스트 존재
    	for(var i=0; i<res.length; i++){
            list[i] ='<div class="list-item-t wp-box scale-up" data-animate-effect="fadeInUp">\
	            			<a href="'+base_url+'home/post/detail?idx='+res[i].idx+'&menu_code='+res[i].menu_code+'&menu_up_code='+res[i].menu_up_code+'">\
	            				<div class="list-item-t-img-area">\
	            					<div class="list-item-t-img scale-img" style="background-image:url(\''+base_url+res[i].path+'/'+res[i].thumb_img+'\');" aria-label="'+res[i].title+'"></div>\
	                            </div>\
	                            <div class="list-item-t-text">\
	                            	<div class="list-item-t-title">\
	                            		<h4 class="ellipsis-line-one">'+res[i].title+'</h4>\
	                            	</div>\
	                            	<div class="list-item-t-desc">\
	                            		<span class=" ellipsis-line-two">'+res[i].sub_title+'</span>\
	                            	</div>\
	                            	<div class="list-item-t-read btn-view">\
	                            		<button type="button"><span>VIEW</span></button>\
	                            	</div>\
	                            </div>\
	                        </a>\
                       	</div>';


            $('#section_list .list-group-t').append(list[i]);
        }

        if(res.length<limit){ // 리스트 < 리미트 => 다음 데이터 없음
           	$('.post-list-more').addClass('active'); // 더보기 숨김
            g_offset.post_offset = 1;
        }
        else if(res.length == limit){ // 리스트 == 리미트 => 다음 데이터 존재 가능 확인
            var cnt = $('.list-item-t').length;
            if(total_count == cnt){ // 더보기 X
                $('.post-list-more').addClass('active'); // 더보기 숨김
            	g_offset.post_offset = 1;
            }
            else{ // 더보기 O
                $('.post-list-more').removeClass('active'); // 더보기 숨김
            	g_offset.post_offset++;
            }
        }
    }
	else{ // POST 리스트 X (더보기 결과 없을떄)
	    $('.post-list-more').addClass('active');// 버튼 비활성화
	    g_offset.post_offset = 1;
	}
	waypointContent(); // 웨이포인트
};

/*
	* 포스트 상세 조회
*/
function getPostDetail(idx){
	// loading(true);
	$.ajax({
        type: 'GET',
        url: base_url+'api/posts/post/detail?idx='+idx+'',
        success: function(resData) {
            // console.log('success >>>>');
            // console.log(resData);
            if(resData.status === true && resData.result.message == "NO DATA"){ // POST 디테일 없음
            	loading(false);
            	alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            	return false;
            }
            else if(resData.status === true && resData.message == "success"){ // POST 디테일 존재
            	loading(false);
            	setPostDetail(resData.result.data[0]); // 단일 결과 데이터
            }
            else if(resData.status === false && resData.message == "Parameter ERROR"){ // POST 파라미터 에러
            	loading(false);
            	alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            	return false;
            }
            else{ // 그 외 분기(있으면안됨)
            	loading(false);
            	alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
            	return false;
            }
        },
        error: function(resData) {
            // console.log('error >>>');
            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }
    });
};

/*
	* 포스트 상세 설정
	* @결과 데이터
*/
function setPostDetail(res){
	/*
		* X 버튼(뒤로가기) 링크 추가
		* 타이틀, 등록일, 조회수 출력
		* 내용 출력
		* SNS 좋아요 연동
	*/
	// console.log(res);

	// X 버튼(뒤로가기) 링크 추가
	var return_link = base_url+'home/post?menu_code='+res.menu_code+'&menu_up_code='+res.menu_up_code;
	$('.detail-close').attr('onclick',"location.href='"+return_link+"'");

	// 타이틀, 등록일, 조회수 출력
	$('.detail-B-title h3').text(res.title);
	// $('.detail-B-title .detail-B-date').text(res.reg_date.slice(0,10));
	// $('.detail-B-title .detail-B-view-cnt').text(res.view_cnt);


	// 내용 출력
	$('.detail-B-contents').html(res.contents);
};

/*
	* 헤더 메뉴(호버) PC
*/
// $(document).on({
//     mouseenter: function () {
//         if(wrap_width>1023){// PC && 하위메뉴 보여주기 설정시
//         	$('.header').addClass('active');

//         }
//     },
//     mouseleave: function () {
//         if(wrap_width>1023){ // PC && 하위메뉴 보여주기 설정시
//         	$('.header').removeClass('active');

//         }
//     }
// }, ".header");


$(document).on({
    mouseenter: function () {
    	// Only PC
    	if(wrap_width<1024) {
    		return;
    	}

    	if($('#fullpage').length){
    		if(!$('.header').hasClass('hd-fixed'))
    			$('.header').addClass('bg-black');
    	}

    	$('.menu-drop-down').addClass('active');
    	$('.menu-drop-down').slideDown(250);
    },
    mouseleave: function () {
      
    }
}, "li.list-item:eq(1)");

$(document).on({
    mouseleave: function () {

    	if($('#fullpage').length){
    		$('.header').removeClass('bg-black');
    	}

    	$('.menu-drop-down').removeClass('active');
    	$('.menu-drop-down').slideUp(250);
    }
}, ".menu-drop-down");

/*
	* 헤더 모바일 서브메뉴 열기 | 닫기
*/
// $(document).on('click', '.header-nav-link',  function(e){
// 	var tg = $(this);
// 	if(wrap_width<1023){
// 		if($(this).siblings('.list-item-sub').length) {
// 			e.preventDefault();// 서브 메뉴 존재시 이동X

// 			if($(this).hasClass('toggle')){
// 				// 열린 상태 => 닫기
// 				$(this).removeClass('toggle');
// 				$(this).removeClass('active');
// 				$(this).siblings('.list-item-sub').slideUp('700');

// 			}
// 			else {
// 				// 닫힌 상태 => 열기
// 				$('.header-nav-link').removeClass('toggle');
// 				$('.header-nav-link').removeClass('active');
// 				$(this).addClass('toggle');
// 				$(this).addClass('active');
// 				$('.list-item-sub').slideUp('700'); // 전체 닫기
// 				$(this).siblings('.list-item-sub').slideDown('700');
// 			}
// 		}
// 	}
// });

/*
	* 헤더 스티키 구현
	* 스크롤 다운시 상단으로가기 active
*/
$(window).on('scroll', debounce(function(e){

	if($('.section-bg').length)
		var vh = $(window).height()*.2; // 서브페이지
	else
		var vh = $(window).height()*.55; // 메인 페이지

	var wd = window.innerWidth;
	var top = $(document).scrollTop();

	if(top>=vh){
		if($('.header').hasClass('hd-fixed')) // 스티키 중복 방지
			return false;

	    $('.header').css({'opacity': '0.5', 'transition':'all .1s ease-in-out'}).delay(50).queue(function(next){
        	$('.header').addClass('hd-fixed');
        	$('.header').css({'opacity': '1'});
	        next(); 
	    });
	}
	else{
		$('.header').removeClass('hd-fixed');
	}

},200));

/*
    * 팝업
*/
function getMainPopUp() {
    // loading(true);
    $.ajax({
        type: 'GET',
        url: base_url+'api/contents/popup/list?type=01',
        success: function(resData) {
            // console.log('success >>>>');
            if(resData.status === true && resData.result.message == "NO DATA"){
            	// 팝업 없음 = 생성 X
            }
            else if(resData.status === true && resData.message == "Get List Success"){
            	// 팝업 생성
            	doneMainPopUp(resData);
            }
        },
        error: function(resData) {
            // console.log('error >>>');
            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }
    });
};

/*
    * 메인 팝업 출력
    * 쿠키 사용 시 : 오늘 하루 보지 않기
    * 쿠키 사용 안할 시 : 팝업 닫기
*/
function doneMainPopUp(resData) {
    loading(false);
    var list ={};
    var res = resData.result.data;
    if(res != undefined){// 팝업 존재
        for(var i=0; i<res.length; i++){
            var cookie_s = false;

            // 생성된 쿠키 존재시 생성 X
            if(getCookie("popup_main_"+res[i].idx) == 'Y'){
                cookie_s = true;
            }

            list[i] = '<div class="popup-modal main-popup" id="popup_main_'+res[i].idx+'"  data-cookie-yn="'+res[i].cookie_yn+'">\
                            <a href="' + res[i].link_url + '" class="" title="'+res[i].title+'" aria-label="' + res[i].title + '" target="' + res[i].link_target + '">\
                                <div class="popup-contents">\
                                    <img src="'+base_url+res[i].path+'/'+res[i].pc_img+'" class="popup-img-pc" alt="' + res[i].title + '">\
                                    <img src="'+base_url+res[i].path+'/'+res[i].mobile_img+'" class="popup-img-m" alt="' + res[i].title + '">\
                                </div>\
                            </a>\
                            <div class="popup-btn">\
                                <input type="checkbox" id="" class="checkbox">\
                                <label for="cs-agreement" class="popup-desc main-popup-desc" title="오늘 하루 보지 않기"><span></span>오늘 하루 보지 않기</label>\
                                <a href="javascript:return false;" class="btn-aside-close btn-popup-close" aria-label="popup close" title="팝업닫기"></a>\
                            </div>\
                    </div>';

            if(cookie_s === false){
                $(".container").append(list[i]);
            }

            // 노출 플랫폼 필터링
            if(res[i].device_type == "PC" && $("body").attr("class") == "mobile" || res[i].device_type == "MOBILE" && $("body").attr("class") == "pc"){
                $("#popup_main_"+res[i].idx).remove();
            }

            if(res[i].cookie_yn =='N'){
                $("#popup_main_"+res[i].idx).find('.popup-desc').text('팝업닫기');
            }

            // 위치 조절
            if($("#popup_main_"+res[i].idx).is(":visible")){
                if( i !=0){
                    $("#popup_main_"+res[i].idx).css("left",i*400+((i+1)*30));
                }
            }
        }

        // 모바일시 1개만 노출
        if($('.wrap').width()<1023){
            for(var i=0; i<res.length; i++){
                if($(".popup-modal.main-popup").eq(i).is(":visible")){
                    $(".popup-modal.main-popup").not(":eq("+i+")").css("display","none");
                }
            }
        }
    }
};

/*
    * 메인 팝업 오늘하루 보지 않기 클릭
*/
$(document).on('click','.main-popup-desc',function(){
    var tg_id = $(this).closest('.popup-modal.main-popup').attr('id');
    // 오늘 하루 보지 않기
    if($(this).closest('.popup-modal.main-popup').data('cookieYn') == 'Y'){
        close_popup_not_today(tg_id);
    }
    else{ // 일반 닫기
        close_popup(tg_id);
    }
});

/*
	* 사이트 검색
*/
var gnb = {
	config:{
		offset: 1,
		limit: 10,
		search_word: '',
		pageFlag:false,		// 페이지 이동 여부
	},
	getSearchList:function(offset, limit, search_word){

		var search_word = encodeURIComponent(search_word);

		$.ajax({
			type: 'GET',
			global: false,	// ajax stop 에외
			url: base_url+'api/search/list?search_word='+search_word+'&offset='+offset+'&limit='+limit+' ',
	        success: function(resData) {
	            gnb.chkPage();	// 현재 페이지 체크

	            search_word = decodeURIComponent(search_word);

	           	if(resData.status == true && resData.result.message == "NO DATA"){
	           		gnb.config.offset = 1;
	           		gnb.btnHide();
	           		if(gnb.config.pageFlag == true){
	           			gnb.flagProc(search_word);		// 페이지 이동 전처리
	           		}
	           		else{
	           			$('#list_txt').addClass('hide');
	           			gnb.clearList();				// 리스트 비우기
	           			gnb.noList(search_word);		// 결과 없음 출력
	           		}
	           	}
	           	else if(resData.status == true && resData.message == "Get List Success"){
	           		if(gnb.config.pageFlag == true){
	           			gnb.flagProc(search_word);		// 페이지 이동 전처리
	           		}
	           		else{
	           			$('#list_txt').removeClass('hide');
	           			gnb.config.search_word = search_word;
	           			gnb.setTxt(search_word, resData.result.total_count);// 총 검색결과 출력
	           			gnb.setList(resData.result.data, resData.result.total_count);
	           		}
	           	}
	           	else{
	           		return;
	           	}
	        },
	        error: function(resData) {
	            console.log('error >>>');
	            alert("불러올 데이터가 없거나 네트워크에 문제가 발생했습니다.");
	        }
		});
	},
	chkPage:function(){
		var origUrl =document.location.href;
	    var spUrl = origUrl.split("/"); // url 구분자(/)
	    var urlLength = spUrl.length;
	    var lastUrl = spUrl[urlLength-1];
		if(lastUrl != 'search')
			gnb.config.pageFlag = true;
		else
			gnb.config.pageFlag = false;
	},
	movePage:function(){
		window.location.href=base_url+'home/search';
	},
	flagProc:function(search_word){
		// 패이지 이동전 처리
		var gnb_search = {
    		search_word:search_word
    	};
    	sessionStorage.removeItem("gnb_search");
    	sessionStorage.setItem("gnb_search", JSON.stringify(gnb_search));

    	gnb.movePage();					// 페이지 이동후 else로 이동
	},
	noList:function(search_word){
		$('#list_no_result').removeClass('hide');
		$('#list_result').addClass('hide');

		$('#search_val_no').text(search_word);
	},
	setList:function(res, total_count){
		// console.log(res);
		$('#list_no_result').addClass('hide');
		$('#list_result').removeClass('hide');

		// 리스트 출력		
		for(var i=0; i<res.length; i++) {
			var item ='<div id="product_item_'+res[i].idx+'" class="list-item wp-box scale-up" data-animate-effect="fadeInUp">\
                        <a href="'+base_url+'home/product/detail?idx='+res[i].idx+'&menu_code=product&menu_up_code=&depth_1='+res[i].depth_1+'&depth_2='+res[i].depth_2+'&depth_3='+res[i].depth_3+'">\
                            <div class="list-item-img-area">\
                                <div class="list-item-img scale-img" style="background-image:url('+base_url+res[i].path+'/'+res[i].thumb_img+');" aria-label="'+res[i].title+'"></div>\
                            </div>\
                            <div class="list-desc"></div>\
                        </a>\
                    </div>';

			$('#list_result').append(item);

			if(res[i].depth_1 == "시험용치구"){
				// 타입
            	if(res[i].type != "" && res[i].type != null && res[i].type != 'null')
                	$('#product_item_'+res[i].idx).find('.list-desc').append('<span class="ellipsis-line-one">타입 : <i>'+res[i].type+'</i></span>');
                // 모델명(시험방식)
				if(res[i].model_name != "" && res[i].model_name != null && res[i].model_name != 'null')
					$('#product_item_'+res[i].idx).find('.list-desc').append('<span class="ellipsis-line-one">시험방식 : <i>'+res[i].model_name+'</i></span>');
				// 제조사
				if(res[i].manufacturer != "" && res[i].manufacturer != null && res[i].manufacturer != 'null')
					$('#product_item_'+res[i].idx).find('.list-desc').append('<span class="ellipsis-line-one">제조사 : <i>'+res[i].manufacturer+'</i></span>');
			}
			else{
				// 제품명
				if(res[i].title != "" && res[i].title != null && res[i].title != 'null')
					$('#product_item_'+res[i].idx).find('.list-desc').append('<span class="ellipsis-line-one">제품명 : <i>'+res[i].title+'</i></span>');
				// 모델명
				if(res[i].model_name != "" && res[i].model_name != null && res[i].model_name != 'null')
					$('#product_item_'+res[i].idx).find('.list-desc').append('<span class="ellipsis-line-one">모델명 : <i>'+res[i].model_name+'</i></span>');
				// 제조사
				if(res[i].manufacturer != "" && res[i].manufacturer != null && res[i].manufacturer != 'null')
					$('#product_item_'+res[i].idx).find('.list-desc').append('<span class="ellipsis-line-one">제조사 : <i>'+res[i].manufacturer+'</i></span>');
				// 타입
	            if(res[i].type != "" && res[i].type != null && res[i].type != 'null')
	                $('#product_item_'+res[i].idx).find('.list-desc').append('<span class="ellipsis-line-one">타입 : <i>'+res[i].type+'</i></span>');
	            // 측정범위
	            if(res[i].sensor_range != "" && res[i].sensor_range != null && res[i].sensor_range != 'null')
	                $('#product_item_'+res[i].idx).find('.list-desc').append('<span class="ellipsis-line-two">측정범위 : <i>'+res[i].sensor_range+'</i></span>');
			}

			if(res[i].depth_2 =="토압계")
	            if(res[i].sensor_outline != "" && res[i].sensor_outline != null && res[i].sensor_outline != 'null')
	                $('#product_item_'+res[i].idx).find('.list-desc').append('<span class="ellipsis-line-one">외경 : <i>'+res[i].sensor_outline+'</i></span>');			
		}

		waypointContent();

		if(res.length<gnb.config.limit){ // 리스트 < 리미트 => 다음 데이터 없음
            gnb.btnHide();
            gnb.config.offset = 1;
        }
        else if(res.length == gnb.config.limit){ // 리스트 == 리미트 => 다음 데이터 존재 가능 확인
            var cnt = $('#list_result .list-item').length;

            if(total_count == cnt){ // 더보기 X
                gnb.btnHide();
                gnb.config.offset = 1;
            }
            else{ // 더보기 O
                gnb.btnShow();
                gnb.config.offset++;
            }
        }
	},
	setTxt:function(search_word, cnt){
		if(search_word == '' || search_word == undefined)
			$('#list_txt h3 strong').text('전체검색');
		else
			$('#list_txt h3 strong').text(search_word);
		
		$('#search_list_cnt').text(cnt);
	},
	clearList:function(){
		// console.log('clearlist');
		$('#list_result').empty();
	},
	btnHide:function(){
        $('.js-list-more').addClass('hide');
    },
    btnShow:function(){
        $('.js-list-more').removeClass('hide');
    },
};

var json_product =
[
	{
		"name" : "계측장비",
		"url" : "&depth_1=계측장비",
	},
	{
		"name" : "스트레인게이지",
		"url" : "&depth_1=스트레인게이지&depth_2=스트레인게이지&depth_3=",
		"detail_item" : [
			{
				"name" : "스트레인게이지",
				"url" : "&depth_1=스트레인게이지&depth_2=스트레인게이지&depth_3=",
			},
			{
				"name" : "악세사리",
				"url" : "&depth_1=스트레인게이지&depth_2=악세사리&depth_3=",
			}]
	},
	{
		"name" : "계측센서",
		"url" : "&depth_1=계측센서&depth_2=하중계&depth_3=",
		"detail_item" : [
			{
				"name" : "하중계",
				"url" : "&depth_1=계측센서&depth_2=하중계&depth_3=",
			},
			{
				"name" : "지진/가속도계",
				"url" : "&depth_1=계측센서&depth_2=지진/가속도계&depth_3=",
			},
			{
				"name" : "변위계",
				"url" : "&depth_1=계측센서&depth_2=변위계&depth_3=",
			},
			{
				"name" : "신율계",
				"url" : "&depth_1=계측센서&depth_2=신율계&depth_3=",
			},
			{
				"name" : "토압계",
				"url" : "&depth_1=계측센서&depth_2=토압계&depth_3=",
			},
			{
				"name" : "변형률계&무응력계",
				"url" : "&depth_1=계측센서&depth_2=변형률계n무응력계&depth_3=",
			},
			{
				"name" : "압력계",
				"url" : "&depth_1=계측센서&depth_2=압력계&depth_3=",
			},
			{
				"name" : "경사계",
				"url" : "&depth_1=계측센서&depth_2=경사계&depth_3=",
			},
			{
				"name" : "온도계",
				"url" : "&depth_1=계측센서&depth_2=온도계&depth_3=",
			},
			{
				"name" : "기타",
				"url" : "&depth_1=계측센서&depth_2=기타&depth_3=",
			}]
	},
	{
		"name" : "비디오게이지",
		"url" : "&depth_1=비디오게이지&depth_2=",
	},
	{
		"name" : "시험용치구",
		"url" : "&depth_1=시험용치구",
	},
	{
		"name" : "제작품",
		"url" : "&depth_1=제작품",
	},
];

/*
	* 메가메뉴
*/
var m_product = {
	setList:function(){
		for(var prop in json_product){
			var _depth_1 = '<li id="gnb_2_'+prop+'"><a href="'+base_url+'home/product?menu_code=product&menu_up_code='+json_product[prop].url+'" title="'+json_product[prop].name+'">'+json_product[prop].name+'</a></li>';
			$('#drop_menu').append(_depth_1);

			if(json_product[prop].detail_item != ''){
				$('#gnb_2_'+prop).append('<ul id="ul_2_'+prop+'"></ul>');

				for(var item in json_product[prop].detail_item){
					var depth_2 = '<li><a href="'+base_url+'home/product?menu_code=product&menu_up_code='+json_product[prop].detail_item[item].url+'" title="'+json_product[prop].detail_item[item].name+'">'+json_product[prop].detail_item[item].name+'</a></li>';
					$('#ul_2_'+prop).append(depth_2);
				}
			}
		}
	},
};

/*
	* PC 상단으로가기
*/
$(document).on('click', '#go_top_wrap', function(){
	$("html,body").animate({ scrollTop: 0 }, "slow");
});

/*
	* PC 상단으로가기 스크롤 0시 숨김
*/
$(document).on('scroll', debounce(function(e){
    if($(window).scrollTop() !== 0) {
        $('#go_top_wrap').fadeIn(300);
    } else {
        $('#go_top_wrap').fadeOut(300);
    }
},200));


function init_top(){
	var item = '<div id="go_top_wrap" title="상단으로 이동" style="display:none;"></div>';
	$('.wrap').append(item);
};


/*
	* 제품소개 클릭시 2뎁스 메뉴 온오프
*/
$(document).on('click', '.nav-area.active .list-item:eq(1) > a', function(e){
	if(wrap_width<1024){
		e.preventDefault();

		if($(this).hasClass('toggle')){
			// 열린 상태 => 닫기
			$(this).removeClass('toggle');
			// $(this).removeClass('active');
			$('#hd_acc_2').removeClass('active');
			$('#hd_depth_2').slideUp(300);
		}
		else{
			$(this).addClass('toggle');
			// $(this).addClass('active');
			$('#hd_acc_2').addClass('active');
			$('#hd_depth_2').slideDown('300');
		}
	}


});
$(document).on('click', '#hd_acc_2', function(e){
	if(wrap_width<1024){
		e.preventDefault();

		var tg = $(this).siblings('a');

		if(tg.hasClass('toggle')){
			// 열린 상태 => 닫기
			tg.removeClass('toggle');
			// $(this).removeClass('active');
			$('#hd_acc_2').removeClass('active');
			$('#hd_depth_2').slideUp(300);
		}
		else{
			tg.addClass('toggle');
			// $(this).addClass('active');
			$('#hd_acc_2').addClass('active');
			$('#hd_depth_2').slideDown('300');
		}
	}


});