<!DOCTYPE html>
<html lang="<?=$this->config->item('LANG'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="Referrer" content="origin">
    <meta name="referrer" contents="always"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content=""> 
    <title><?=$this->config->item('HOMEPAGE_TITLE'); ?></title>

    <!-- Page Level include -->
    <link rel="stylesheet" href="<?=$this->config->item('home_assets_url'); ?>/cms/css/style.css">
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/js/jquery.min.js"></script>
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/vendor/datepickk/datepickk.js"></script>
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/js/script.js"></script>
    <!--//Page Level include -->

    <!-- Jquery-Ui -->
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/vendor/jqueryUi/jquery-ui.min.js"></script>
    <!-- // Jquery-Ui -->
</head>
<body>
    <div class="wrap">
        
        <!--Page Header include -->
        <?php $this->load->view('admin/inc/header'); ?>
        <!--//Page Header include -->

        <!-- 바디 -->
        <div class="container">
            
            <!--Page sidemenu include -->
            <?php $this->load->view('admin/inc/sidemenu'); ?>
            <!--Page sidemenu include -->

            <!-- 각 페이지 별 -->
            <div class="section">
                <div class="section-content">
                    <div class="section-header">
                        <div class="section-title">
                            <h2>하위메뉴관리</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">하위메뉴관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                                <div class="search-area">
                                    <form id="search" method="get">
                                        <fieldset>
                                            <legend class="hidden-text">검색하기</legend>
                                            <div class="col-100 with-btn fl-r">
                                                <label for="" class="hidden-text">검색어입력</label>
                                                <input type="text" class="form" placeholder="검색어를 입력하세요" id="searchWord" name="search_word" value="<?=$search_word ?>">
                                                
                                                <!-- 검색어 파라미터 -->
                                                <input type ="hidden" id="menuNm" value="<?=$this->uri->segment(2).'/'.$this->uri->segment(3)?>">
                                                <input type ="hidden" id="rootUrl" value="<?=$this->config->item('ADMIN_ROOT'); ?>">
                                                <!-- //검색어 파라미터 -->
                                                
                                                <button type="button" class="btn btn-with-form" id="search_btn"><i class="fas fa-search">&nbsp;</i>
                                                검색</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        <div class="row">
                            <div class="content-area">
                                <table class="table table-typeA">
                                    <colgroup>
                                        <col>
                                        <col>
                                        <col>
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>메뉴순서</th>
                                            <th>메뉴명</th>
                                            <th class="m-hide">메뉴코드</th>
                                            <th class="m-hide">상위메뉴코드</th>
                                            <th>메뉴속성</th>
                                            <th>사용여부</th>
                                            <th class="m-hide">등록일</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $item_no = $total_row;
                                            foreach($list as $lt){
                                        ?>
                                        <tr>
                                            <td><?=$lt->menu_order; ?></td>
                                            <td><a href="<?=$this->config->item('ADMIN_BASE_URL'); ?>/setting/menu/subMenuModify/<?=$lt->idx;?>" class="underline"><?=$lt->menu_name; ?></a></td>
                                            <td class="m-hide"><?=$lt->menu_code; ?></td>
                                            <td class="m-hide"><?=$lt->menu_up_code; ?></td>
                                            <td>
                                                <?php
                                                    if($lt->menu_type=='CONTS')
                                                        echo "콘텐츠 ";
                                                    else if($lt->menu_type=="BOARD_NOTICE")
                                                        echo "게시판-공지사항";
                                                    else if($lt->menu_type=="BOARD_FAQ")
                                                        echo "게시판-FAQ";
                                                    else if($lt->menu_type=="BOARD_EVENT")
                                                        echo "게시판-이벤트";
                                                    else if($lt->menu_type=="COMPANY")
                                                        echo "회사소개";
                                                    else if($lt->menu_type=="PRODUCT")
                                                        echo "제품관리";
                                                    else if($lt->menu_type=="SERVICE")
                                                        echo "용역관리";
                                                    else if($lt->menu_type=="CS")
                                                        echo "고객문의";
                                                    else if($lt->menu_type=="BRANCH")
                                                        echo "지점정보";
                                                    else if($lt->menu_type=="LINK")
                                                        echo "외부링크";
                                                ?>
                                            </td>
                                            <td><span class="color-positive"><?=$lt->open_yn; ?></span></td>
                                            <td class="m-hide"><?=substr($lt->reg_date,0,10); ?></td>                                            
                                        </tr>
                                        <?php
                                            
                                            $item_no--;
                                            } 
                                        ?>    
                                        
                                        <?php
                                            if($total_row==0){
                                        ?>
                                            <tr>
                                                <td colspan='7' align="center"> 검색된 결과가 없습니다. </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="content-area">
                                <div class="pagination">
                                    <span class="page-nums">
                                       <!--  <?=$pagination?> -->
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="content-area clearfix">
                                <div class="btn-group fl-r width-100">
                                    <button id="start_drag" class="btn typeA-green fl-l drag-cont is-modify" type="button">메뉴순서 수정</button>
                                    <button id="cancel_drag" class="btn typeA-gray fl-l drag-cont hide" type="button">취소</button>
                                    <button id="modify_drag" class="btn typeA-blue fl-l drag-cont hide" type="button">저장</button>
                                    <button onclick="goPage('<?=$this->config->item('ADMIN_BASE_URL'); ?>/setting/menu/subMenuWrite/<?=$this->uri->segment(5)?>')" class="btn typeA-blue fl-r">신규</button>
                                    <button class="btn typeA-darkgray fl-r" onclick="history.go(-1); return false;">상위메뉴목록</button>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //각 페이지 별 -->
        </div><!-- //바디 -->       
    </div>
    <!-- 팝업 -->
    <div class="modal" id="popupModal">
        <div class="modal-dimmed">
            <div class="modal-panel">
                <div class="modal-header">
                    <p class="font-16 gray-6" id="popup-msg"></p>
                </div>
                <div class="btn-group">
                    <button onclick="hideModal('#popupModal')" class="btn typeA-blue">확인</button>
                </div>
            </div>
        </div>
    </div><!-- //팝업 -->
</body>
</html>