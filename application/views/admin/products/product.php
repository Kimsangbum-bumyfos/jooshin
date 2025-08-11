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
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/jooshin.js"></script>
    <!--//Page Level include -->

    <script>
        $(document).ready(function() {
            initDepth("<?= $depth_1?>", "<?= $depth_2?>", "<?= $depth_3 ?>"); // 카테고리 셋팅
        });
    </script>
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
                            <h2>제품관리</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#">HOME</a></li>
                                <li><a href="#">제품관리</a></li>                                
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                                <div class="search-area">
                                    <form id="search" method="get">
                                        <fieldset>
                                            <legend class="hidden-text">검색하기</legend>
                                            <div class="col-15">
                                                <label for="depth_1" class="hidden-text">분류</label>
                                                <select class="form product_depth_1" name="depth_1" id="depth_1">
                                                    <option value="" <?php if($depth_1 =='') echo "selected" ?>>전체</option>
                                                    <option value="계측장비" <?php if($depth_1 =='계측장비') echo "selected" ?>>계측장비</option>
                                                    <option value="스트레인게이지" <?php if($depth_1 =='스트레인게이지') echo "selected" ?>>스트레인게이지</option>
                                                    <option value="계측센서" <?php if($depth_1 =='계측센서') echo "selected" ?>>계측센서</option>
                                                    <option value="비디오게이지" <?php if($depth_1 =='비디오게이지') echo "selected" ?>>비디오게이지</option>
                                                    <option value="시험용치구" <?php if($depth_1 =='시험용치구') echo "selected" ?>>시험용치구</option>
                                                    <option value="제작품" <?php if($depth_1 =='제작품') echo "selected" ?>>제작품</option>
                                                </select>
                                            </div>
                                            <div class="col-15">
                                                <label for="depth_2" class="hidden-text">분류</label>
                                                <select class="form product_depth_2" name="depth_2" id="depth_2">
                                                    <option selected hidden value="">선택하세요.</option>
                                                </select>
                                            </div>
                                            <div class="col-15">
                                                <label for="depth_3" class="hidden-text">분류</label>
                                                <select class="form product_depth_3" name="depth_3" id="depth_3">
                                                    <option selected hidden value="">선택하세요.</option>
                                                </select>
                                            </div>
                                            <div class="col-55 with-btn fl-r">
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
                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th class="m-hide">NO</th>
                                            <th>제품사진</th>
                                            <th>제품명</th>
                                            <th>카테고리</th>
                                            <th>메인노출여부</th>
                                            <th>사용여부</th>
                                            <th>등록일</th>
                                        </tr>
                                        <?php
                                            $item_no = $total_row - ($limit*($page-1));
                                            foreach($list as $lt){
                                        ?>
                                        <tr>
                                            <td class="m-hide"><?=$item_no ?></td>
                                            <td>
                                                <a href="<?=$this->config->item('ADMIN_BASE_URL'); ?>/products/product/modify/<?=$lt->idx;?>?page=<?=$page?>" class="thumb-img"><img src="<?=base_url().$lt->path.'/'.$lt->thumb_img?>"></a>
                                            </td>
                                            <td class="txt-left"><a href="<?=$this->config->item('ADMIN_BASE_URL'); ?>/products/product/modify/<?=$lt->idx;?>?page=<?=$page?>" class="underline"><?=$lt->title; ?></a></td>
                                            <td><?= $lt->depth_1; ?></td>
                                            <td class="m-hide"><span class="color-positive">
                                                <?php
                                                    if($lt->page_main == 'Y')
                                                        echo 'Y';
                                                    else
                                                        echo 'N'; 
                                                ?>
                                            </span></td>
                                            <td class="m-hide"><span class="color-positive"><?=$lt->open_yn; ?></span></td>
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
                                        <?=$pagination?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="content-area clearfix">
                                <div class="btn-group fl-r">
                                    <button onclick="goPage('<?=$this->config->item('ADMIN_BASE_URL'); ?>/products/product/write/')" class="btn typeA-blue">신규</button>
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