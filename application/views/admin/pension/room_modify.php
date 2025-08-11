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
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/vendor/ckeditor/ckeditor.js"></script>
    <!--//Page Level include --> 

    <!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {
            // 텍스트 입력 필드가 있는 경우 첫 텍스트 필드로 포커스 이동
            $("#write_action :input:text:visible:enabled:first").focus();

            $("#write_btn").click(function() {
                if ($("#car_name").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("차량명을 입력해 주세요.");
                    $("#car_name").focus();
                    return;
                }
                $("#write_action").submit();
            });
        });
    </script>
    <!-- //유효성 검사 -->
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
                            <h2>객실관리 - 수정</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">객실관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id="write_action" enctype="multipart/form-data"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <fieldset>
                                <legend class="hidden-text">객실관리수정</legend>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="180">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th>객실명 *</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">객실명</label>
                                                    <input type="text" class="form" name="name" id="name" value="<?=$views->name;?>" placeholder="객실명을 입력하세요">
                                                </div>
                                                <?=form_error('name','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>객실설명</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">객실명</label>
                                                    <input type="text" class="form" name="sub_title" id="sub_title" value="<?=$views->sub_title;?>"  placeholder="객실설명을 입력하세요">
                                                </div>
                                                <?=form_error('sub_title','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>정원/최대인원 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">객실명</label>
                                                    <input type="number" class="form" name="fixed_number" id="fixed_number" value="<?=$views->fixed_number;?>" placeholder="객실기본정원">
                                                </div>                                                
                                                <?=form_error('fixed_number','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">객실명</label>
                                                    <input type="number" class="form" name="max_number" id="max_number" value="<?=$views->max_number;?>" placeholder="객실최대인원">
                                                </div>
                                                <?=form_error('max_number','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>평형 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">평형</label>
                                                    <input type="number" class="form" name="space" id="space" value="<?=$views->space;?>"   placeholder="평형을 입력하세요">
                                                </div>                                                
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <th>비수기요금 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">비수기(평일)</label>
                                                    <input type="number" class="form" name="off_season_normal_fee" id="off_season_normal_fee" placeholder="비수기(평일)" value="<?=$views->off_season_normal_fee;?>">
                                                </div>
                                                <?=form_error('off_season_normal_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">비수기(금요일)</label>
                                                    <input type="number" class="form" name="off_season_friday_fee" id="off_season_friday_fee" placeholder="비수기(금요일)" value="<?=$views->off_season_friday_fee;?>">
                                                </div>
                                                <?=form_error('off_season_friday_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">비수기(주말)</label>
                                                    <input type="number" class="form" name="off_season_weekend_fee" id="off_season_weekend_fee" placeholder="비수기(주말)" value="<?=$views->off_season_weekend_fee;?>">
                                                </div>
                                                <?=form_error('off_season_weekend_fee','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>준성수기요금 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">준성수기(평일)</label>
                                                    <input type="number" class="form" name="mid_season_normal_fee" id="mid_season_normal_fee" placeholder="준성수기(평일)" value="<?=$views->mid_season_normal_fee;?>">
                                                </div>
                                                <?=form_error('mid_season_normal_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">준성수기(금요일)</label>
                                                    <input type="number" class="form" name="mid_season_friday_fee" id="mid_season_friday_fee" placeholder="준성수기(금요일)" value="<?=$views->mid_season_friday_fee;?>">
                                                </div>
                                                <?=form_error('off_season_friday_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">준성수기(주말)</label>
                                                    <input type="number" class="form" name="mid_season_weekend_fee" id="mid_season_weekend_fee" placeholder="준성수기(주말)" value="<?=$views->mid_season_weekend_fee;?>">
                                                </div>
                                                <?=form_error('mid_season_weekend_fee','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>성수기요금 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">성수기(평일)</label>
                                                    <input type="number" class="form" name="peak_season_normal_fee" id="peak_season_normal_fee" placeholder="성수기(평일)" value="<?=$views->peak_season_normal_fee;?>">
                                                </div>
                                                <?=form_error('peak_season_normal_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">성수기(금요일)</label>
                                                    <input type="number" class="form" name="peak_season_friday_fee" id="peak_season_friday_fee" placeholder="성수기(금요일)" value="<?=$views->peak_season_friday_fee;?>">
                                                </div>
                                                <?=form_error('peak_season_friday_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">성수기(주말)</label>
                                                    <input type="number" class="form" name="peak_season_weekend_fee" id="peak_season_weekend_fee" placeholder="성수기(주말)" value="<?=$views->peak_season_weekend_fee;?>">
                                                </div>
                                                <?=form_error('peak_season_weekend_fee','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>극성수기요금 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">극성수기(평일)</label>
                                                    <input type="number" class="form" name="high_peak_season_normal_fee" id="high_peak_season_normal_fee" placeholder="극성수기(평일)" value="<?=$views->high_peak_season_normal_fee;?>">
                                                </div>
                                                <?=form_error('high_peak_season_normal_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">극성수기(금요일)</label>
                                                    <input type="number" class="form" name="high_peak_season_friday_fee" id="high_peak_season_friday_fee" placeholder="극성수기(금요일)" value="<?=$views->high_peak_season_friday_fee;?>">
                                                </div>
                                                <?=form_error('high_peak_season_friday_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">극성수기(주말)</label>
                                                    <input type="number" class="form" name="high_peak_season_weekend_fee" id="high_peak_season_weekend_fee" placeholder="극성수기(주말)" value="<?=$views->high_peak_season_weekend_fee;?>">
                                                </div>
                                                <?=form_error('high_peak_season_weekend_fee','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                                                              
                                        <tr>
                                            <th>추가요금(1인추가) *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">시간당추가요금</label>
                                                    <input type="number" class="form" name="additional_fee" id="additional_fee" value="<?=$views->additional_fee;?>">
                                                </div>                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>객실옵션</th>
                                            <td>
                                                <div class="col-100">
                                                    <input type="checkbox" name="p_options[]" id="p_options"  value="퀸사이즈침대" <?php if(strpos($views->p_options, '퀸사이즈침대') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options"><span></span>퀸사이즈침대</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options2"  value="침구" <?php if(strpos($views->p_options, '침구') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options2"><span></span>침구</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options3"  value="TV" <?php if(strpos($views->p_options, 'TV') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options3"><span></span>TV</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options4"  value="에어컨" <?php if(strpos($views->p_options, '에어컨') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options4"><span></span>냉난방에어컨</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options5"  value="개별바베큐" <?php if(strpos($views->p_options, '개별바베큐') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options5"><span></span>개별바베큐</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options6"  value="냉장고" <?php if(strpos($views->p_options, '냉장고') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options6"><span></span>냉장고</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options7"  value="전자레인지" <?php if(strpos($views->p_options, '전자레인지') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options7"><span></span>전자레인지</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options8"  value="전기주전자" <?php if(strpos($views->p_options, '전기주전자') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options8"><span></span>전기주전자</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options9"  value="정수기" <?php if(strpos($views->p_options, '정수기') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options9"><span></span>정수기</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options10"  value="WiFi" <?php if(strpos($views->p_options, 'WiFi') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options10"><span></span>WiFi</label>
                                                    <br>
                                                    <input type="checkbox" name="p_options[]" id="p_options11"  value="조리도구" <?php if(strpos($views->p_options, '조리도구') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options11"><span></span>조리도구</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options12"  value="헤어드라이어" <?php if(strpos($views->p_options, '헤어드라이어') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options12"><span></span>헤어드라이어</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options13"  value="욕실어메니티" <?php if(strpos($views->p_options, '욕실어메니티') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options13"><span></span>욕실어메니티</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options14"  value="대용량욕실용품" <?php if(strpos($views->p_options, '대용량욕실용품') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options14"><span></span>대용량욕실용품</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options15"  value="실내수영장" <?php if(strpos($views->p_options, '실내수영장') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="p_options15"><span></span>실내수영장</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>검색태그</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">검색태그</label>
                                                    <input type="text" class="form" name="tags" id="tags" placeholder="검색태그를입력하세요(쉼표로구분)" value="<?=$views->tags;?>">
                                                </div>                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>대표이미지 *</th>
                                            <td>
                                                <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->p_thumb_img?>') 50% center / 100%;" ></div>
                                                <div class="file">
                                                    <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                    <span class="ico-file-cancel"></span>
                                                    <br>
                                                    <div class="col-100 m-t-8">
                                                        <label class="btn typeA-blue pointer btn-file" for="input_file"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                        <span class="help">
                                                                <div class="tooltip">
                                                                    <div class="tooltip-box">
                                                                        <p>권장 이미지 사이즈는<br>가로 400px 세로(400~500px)입니다.</p>
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        <input type="file" name="userfile[]" id="input_file" class="upload-hidden" accept="image/*" >
                                                        <input type="hidden" name="thumb_chk1" value ="<?=$views->p_thumb_img;?>">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                           <th>객실사진(최대5장) *</th>
                                            <td class="shop-td">
                                                <div class="shop-img-group clearfix">
                                                    <div class="shop-200">                                                        
                                                        <?php
                                                            if($views->p_img01 !==''){
                                                        ?>
                                                            <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->p_img01?>') 50% center / 100%;"></div>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <div class="preview-img"></div>
                                                        <?php
                                                            }
                                                        ?>
                                                        <div class="file">
                                                            <input class="form upload-name shop-item" placeholder="이미지 추가" readonly>
                                                            <span class="ico-file-cancel"></span>
                                                            <br>
                                                            <div class="col-25 m-t-8">
                                                                <label class="btn typeA-blue pointer btn-file" for="input_file2"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                                <input type="file" name="userfile[]" id="input_file2" class="upload-hidden" accept="image/*">
                                                                <input type="hidden" name="thumb_chk2" value ="<?=$views->p_img01;?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="shop-200">
                                                        <?php
                                                            if($views->p_img02 !==''){
                                                        ?>
                                                            <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->p_img02?>') 50% center / 100%;"></div>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <div class="preview-img"></div>
                                                        <?php
                                                            }
                                                        ?>
                                                        <div class="file">
                                                            <input class="form upload-name shop-item" placeholder="이미지 추가" readonly>
                                                            <span class="ico-file-cancel"></span>
                                                            <br>
                                                            <div class="col-25 m-t-8">
                                                                <label class="btn typeA-blue pointer btn-file" for="input_file3"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                                <input type="file" name="userfile[]" id="input_file3" class="upload-hidden" accept="image/*">         
                                                                <input type="hidden" name="thumb_chk3" value ="<?=$views->p_img02;?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="shop-200">
                                                        <?php
                                                            if($views->p_img03 !==''){
                                                        ?>
                                                            <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->p_img03?>') 50% center / 100%;"></div>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <div class="preview-img"></div>
                                                        <?php
                                                            }
                                                        ?>
                                                        <div class="file">
                                                            <input class="form upload-name shop-item" placeholder="이미지 추가" readonly>
                                                            <span class="ico-file-cancel"></span>
                                                            <br>
                                                            <div class="col-25 m-t-8">
                                                                <label class="btn typeA-blue pointer btn-file" for="input_file4"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                                <input type="file" name="userfile[]" id="input_file4" class="upload-hidden" accept="image/*">
                                                                <input type="hidden" name="thumb_chk4" value ="<?=$views->p_img03;?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="shop-200">
                                                        <?php
                                                            if($views->p_img04 !==''){
                                                        ?>
                                                            <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->p_img04?>') 50% center / 100%;"></div>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <div class="preview-img"></div>
                                                        <?php
                                                            }
                                                        ?>
                                                        <div class="file">
                                                            <input class="form upload-name shop-item" placeholder="이미지 추가" readonly>
                                                            <span class="ico-file-cancel"></span>
                                                            <br>
                                                            <div class="col-25 m-t-8">
                                                                <label class="btn typeA-blue pointer btn-file" for="input_file5"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                                <input type="file" name="userfile[]" id="input_file5" class="upload-hidden" accept="image/*">
                                                                <input type="hidden" name="thumb_chk5" value ="<?=$views->p_img04;?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="shop-200">
                                                        <?php
                                                            if($views->p_img05 !==''){
                                                        ?>
                                                            <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->p_img05?>') 50% center / 100%;"></div>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <div class="preview-img"></div>
                                                        <?php
                                                            }
                                                        ?>
                                                        <div class="file">
                                                            <input class="form upload-name shop-item" placeholder="이미지 추가" readonly>
                                                            <span class="ico-file-cancel"></span>
                                                            <br>
                                                            <div class="col-25 m-t-8">
                                                                <label class="btn typeA-blue pointer btn-file" for="input_file6"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                                <input type="file" name="userfile[]" id="input_file6" class="upload-hidden" accept="image/*">
                                                                <input type="hidden" name="thumb_chk6" value ="<?=$views->p_img05;?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>게시여부</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">게시여부</label>
                                                    <select class="form" name="open_yn">
                                                        <option value="Y" <?=$views->open_yn === 'Y' ? 'selected' : ''?>>게시</option>
                                                        <option value="N" <?=$views->open_yn === 'N' ? 'selected' : ''?>>대기</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>객실상세정보</th>
                                            <td>
                                                <div class="col-100">
                                                    <div>
                                                        <textarea name="contents" id="contents" rows="30" style="width:100%;"><?=$views->p_desc?></textarea>
                                                        <!-- ckeditor 호출 및 파일 업로드 실행 파일 경로 설정 -->
                                                        <script>
                                                            CKEDITOR.replace( 'contents', {
                                                                filebrowserUploadUrl: '<?=$this->config->item('ADMIN_ROOT'); ?>/CKE_Upload/cke_upload'
                                                            });
                                                        </script><!--// ckeditor 호출 및 파일 업로드 실행 파일 경로 설정 -->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </fieldset>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="content-area clearfix">
                                <div class="btn-group fl-l">
                                    <button class="btn typeA-gray" onclick="goDelete('<?=$this->config->item('ADMIN_ROOT'); ?>/pension/room/delete/<?=$views->idx ?>?v=<?=$v?>')">삭제</button>
                                </div>
                                <div class="btn-group fl-r">
                                    <button class="btn typeA-darkgray" onclick="history.go(<?=$v+1?>); return false;">취소</button>
                                    <button type="submit" class="btn typeA-blue" id="write_btn">저장</button>
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

    <!-- 팝업(삭제) -->
    <div class="modal" id="popupModalDelete">
        <div class="modal-dimmed">
            <div class="modal-panel">
                <div class="modal-header">
                    <p class="font-16 gray-6" id="delete-popup-msg"></p>
                </div>
                <div class="btn-group">
                    <button onclick="hideModal('#popupModalDelete')" class="btn typeA-gray">아니요</button>
                    <button class="btn typeA-blue" id="delete">예</button>
                </div>
            </div>
        </div>
    </div><!-- //팝업 -->

</body>
</html>