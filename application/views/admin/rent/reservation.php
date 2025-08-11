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
                            <h2>실시간예약관리</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">실시간예약관리</a></li>
                                <li><a href="#">실시간예약관리</a></li>
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
                                    <tbody>
                                        <tr>
                                            <th>NO</th>
                                            <th>예약자</th>
                                            <th>연락처</th>
                                            <th>예약일</th>
                                            <th>차량명</th>
                                            <th>대여기간</th>                                            
                                            <th>배차</th>
                                            <th>회차</th>
                                            <th>보험</th>                                            
                                            <th>예상금액</th>                                            
                                            <th>최종금액</th>                                            
                                            <th>처리여부</th>
                                        </tr>
                                        <?php
                                            $item_no = $total_row - ($limit*($page-1));
                                            foreach($list as $lt){
                                        ?>
                                        <tr>
                                            <td><?=$item_no ?></td>
                                            <td><a href="<?=$this->config->item('ADMIN_BASE_URL'); ?>/rent/reservation/modify/<?=$lt->idx;?>" class="underline"><?=$lt->reserve_name; ?></a></td>
                                            <td><?=$lt->reserve_phone; ?></td>
                                            <td><?=substr($lt->reserve_date,0,16); ?></td>
                                            <td><?=$lt->car_name; ?></td>
                                            <td>
                                                <?php
                                                    $s_date = new DateTime($lt->rental_s_date);
                                                    $e_date = new DateTime($lt->rental_e_date);

                                                    $diff = date_diff($s_date, $e_date);
                                                ?>
                                                <?=substr($lt->rental_s_date,0,16); ?> ~ <?=substr($lt->rental_e_date,0,16); ?> (<?=$diff->days?>일<?=$diff->h?>시간)
                                            </td>
                                            <td>
                                                <?php if($lt->operate_svc=='Y') echo "선택"; ?>                                                
                                                <?php if($lt->operate_svc=='N') echo "-"; ?>
                                            </td>
                                            <td>
                                                <?php if($lt->release_svc=='Y') echo "선택"; ?>                                                
                                                <?php if($lt->release_svc=='N') echo "-"; ?>
                                            </td>
                                            <td><?=$lt->insur_svc; ?></td>
                                            <td><?=number_format($lt->estimate); ?></td>
                                            <td><?php if($lt->total_sum !=="") echo number_format($lt->total_sum); else echo "-"?></td>
                                            <td>
                                                <span class="color-positive">
                                                    <?php if($lt->process_result=='Y') echo "완료"; ?>
                                                    <?php if($lt->process_result=='N') echo "대기"; ?>
                                                    <?php if($lt->process_result=='C') echo "취소"; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php
                                            
                                            $item_no--;
                                            } 
                                        ?>    
                                        
                                        <?php
                                            if($total_row==0){
                                        ?>
                                            <tr>
                                                <td colspan='12' align="center"> 검색된 결과가 없습니다. </td>
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
                                        <?=$pagination?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="content-area clearfix">
                                <div class="btn-group fl-r">
                                <!--     <button onclick="goPage('<?=$this->config->item('ADMIN_BASE_URL'); ?>/notice/write/')" class="btn typeA-blue">신규</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //각 페이지 별 -->
        </div><!-- //바디 -->        
    </div>
</body>
</html>