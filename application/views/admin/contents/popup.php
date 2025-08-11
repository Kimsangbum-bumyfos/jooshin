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
                            <h2>팝업관리</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">팝업관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                                <div class="search-area">
                                    <form method="get" id="search">
                                        <fieldset>
                                            <legend class="hidden-text">검색하기</legend>
                                            <div class="col-100 with-btn fl-r">
                                                <label for="" class="hidden-text">검색어입력</label>
                                                <input type="text" class="form" placeholder="검색어를 입력하세요" id="search_word" name="search_word" value="<?=$search_word ?>">
                                                
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
                                            <th class="m-hide">NO</th>
                                            <th>이미지</th>
                                            <th>제목</th>
                                            <th class="m-hide">노출기간</th>
                                            <th class="m-hide">노출플랫폼</th>
                                            <th class="m-hide">게시여부</th>
                                            <th class="m-hide">등록일</th>
                                        </tr>
                                        </tr>

                                        <?php
                                            $item_no = $total_row - ($limit*($page-1));
                                            foreach($list as $lt){
                                        ?>
                                        <tr>
                                            <td class="m-hide"><?=$item_no?></td>
                                            <td><a href="<?=$this->config->item('ADMIN_BASE_URL'); ?>/contents/popup/modify/<?=$lt->idx;?>?page=<?=$page?>" class="thumb-img"><img src="<?=base_url().$lt->path.'/'.$lt->pc_img?>"></a></td>
                                            <td><a href="<?=$this->config->item('ADMIN_BASE_URL'); ?>/contents/popup/modify/<?=$lt->idx;?>?page=<?=$page?>" class="underline"><?=$lt->title; ?></a></td>
                                            <!-- <td><?php if($lt->popup_type=='01') echo "메인"; else echo "서브"; ?></td> -->
                                            <td class="m-hide"><?=substr($lt->s_date,0,10) ?> ~ <?=substr($lt->e_date,0,10) ?></td>
                                            <td class="m-hide"><?php if($lt->device_type=='ALL') echo "PC, MOBILE"; else echo $lt->device_type; ?></td>
                                            <td class="m-hide"><span class="color-positive"><?=$lt->open_yn ?></span></td>
                                            <td class="m-hide"><?=substr($lt->reg_date,0,10) ?></td>
                                        </tr>
                                        <?php
                                                $item_no--;
                                            } 
                                        ?>
                                        <!-- 검색결과 없는 경우 -->
                                        <?php
                                            if($total_row==0){
                                                echo "<tr><td colspan='8' align='center'> 검색된 결과가 없습니다.</td></tr>";
                                            }
                                        ?><!--// 검색결과 없는 경우 -->

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
                                    <button onclick="goPage('<?=$this->config->item('ADMIN_BASE_URL'); ?>/contents/popup/write/')" class="btn typeA-blue">신규</button>
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