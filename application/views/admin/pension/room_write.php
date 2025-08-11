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
                            <h2>객실관리 - 등록</h2>
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
                                <input type="hidden" name="k" value="<?=$hash?>">
                                <fieldset>
                                <legend class="hidden-text">객실관리등록</legend>
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
                                                    <input type="text" class="form guidetext" name="name" id="name" value="<?=set_value('name')?>" placeholder="객실명을 입력하세요">
                                                </div>
                                                <?=form_error('name','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>객실설명</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">객실명</label>
                                                    <input type="text" class="form guidetext" name="sub_title" id="sub_title" value="<?=set_value('sub_title')?>" placeholder="객실설명을 입력하세요">
                                                </div>
                                                <?=form_error('sub_title','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>정원/최대인원 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">객실명</label>
                                                    <input type="number" class="form guidetext" name="fixed_number" id="fixed_number" value="<?=set_value('fixed_number')?>" placeholder="객실기본정원">
                                                </div>                                                
                                                <?=form_error('fixed_number','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">객실명</label>
                                                    <input type="number" class="form guidetext" name="max_number" id="max_number" value="<?=set_value('max_number')?>" placeholder="객실최대인원">
                                                </div>
                                                <?=form_error('max_number','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>평형 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">평형</label>
                                                    <input type="number" class="form guidetext" name="space" id="space" value="<?=set_value('space')?>"   placeholder="평형을 입력하세요">
                                                </div>                                                
                                                <?=form_error('space','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <th>비수기요금 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">비수기(평일)</label>
                                                    <input type="number" class="form guidetext" name="off_season_normal_fee" id="off_season_normal_fee" placeholder="비수기(평일)" value="<?=set_value('off_season_normal_fee')?>">
                                                </div>
                                                <?=form_error('off_season_normal_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">비수기(금요일)</label>
                                                    <input type="number" class="form guidetext" name="off_season_friday_fee" id="off_season_friday_fee" placeholder="비수기(금요일)" value="<?=set_value('off_season_friday_fee')?>">
                                                </div>
                                                <?=form_error('off_season_friday_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">비수기(주말)</label>
                                                    <input type="number" class="form guidetext" name="off_season_weekend_fee" id="off_season_weekend_fee" placeholder="비수기(주말)" value="<?=set_value('off_season_weekend_fee')?>">
                                                </div>
                                                <?=form_error('off_season_weekend_fee','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>준성수기요금 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">준성수기(평일)</label>
                                                    <input type="number" class="form guidetext" name="mid_season_normal_fee" id="mid_season_normal_fee" placeholder="준성수기(평일)" value="<?=set_value('mid_season_normal_fee')?>">
                                                </div>
                                                <?=form_error('mid_season_normal_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">준성수기(금요일)</label>
                                                    <input type="number" class="form guidetext" name="mid_season_friday_fee" id="mid_season_friday_fee" placeholder="준성수기(금요일)" value="<?=set_value('mid_season_friday_fee')?>">
                                                </div>
                                                <?=form_error('off_season_friday_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">준성수기(주말)</label>
                                                    <input type="number" class="form guidetext" name="mid_season_weekend_fee" id="mid_season_weekend_fee" placeholder="준성수기(주말)" value="<?=set_value('mid_season_weekend_fee')?>">
                                                </div>
                                                <?=form_error('mid_season_weekend_fee','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>성수기요금 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">성수기(평일)</label>
                                                    <input type="number" class="form guidetext" name="peak_season_normal_fee" id="peak_season_normal_fee" placeholder="성수기(평일)" value="<?=set_value('mid_season_normal_fee')?>">
                                                </div>
                                                <?=form_error('peak_season_normal_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">성수기(금요일)</label>
                                                    <input type="number" class="form guidetext" name="peak_season_friday_fee" id="peak_season_friday_fee" placeholder="성수기(금요일)" value="<?=set_value('peak_season_friday_fee')?>">
                                                </div>
                                                <?=form_error('peak_season_friday_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">성수기(주말)</label>
                                                    <input type="number" class="form guidetext" name="peak_season_weekend_fee" id="peak_season_weekend_fee" placeholder="성수기(주말)" value="<?=set_value('peak_season_weekend_fee')?>">
                                                </div>
                                                <?=form_error('peak_season_weekend_fee','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>극성수기요금 *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">극성수기(평일)</label>
                                                    <input type="number" class="form guidetext" name="high_peak_season_normal_fee" id="high_peak_season_normal_fee" placeholder="극성수기(평일)" value="<?=set_value('high_peak_season_normal_fee')?>">
                                                </div>
                                                <?=form_error('high_peak_season_normal_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">극성수기(금요일)</label>
                                                    <input type="number" class="form guidetext" name="high_peak_season_friday_fee" id="high_peak_season_friday_fee" placeholder="극성수기(금요일)" value="<?=set_value('high_peak_season_friday_fee')?>">
                                                </div>
                                                <?=form_error('high_peak_season_friday_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">극성수기(주말)</label>
                                                    <input type="number" class="form guidetext" name="high_peak_season_weekend_fee" id="high_peak_season_weekend_fee" placeholder="극성수기(주말)" value="<?=set_value('high_peak_season_weekend_fee')?>">
                                                </div>
                                                <?=form_error('high_peak_season_weekend_fee','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                                                              
                                        <tr>
                                            <th>추가요금(1인추가) *</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">시간당추가요금</label>
                                                    <input type="number" class="form guidetext" name="additional_fee" id="additional_fee">
                                                </div>                                                
                                                <?=form_error('additional_fee','<div class="col-error">', '</div>')?>
                                            </td>                                            
                                        </tr>
                                        <tr>
                                            <th>객실옵션</th>
                                            <td>
                                                <div class="col-100">
                                                    <input type="checkbox" name="p_options[]" id="p_options"  value="퀸사이즈침대" <?=set_value('p_options[0]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options"><span></span>퀸사이즈침대</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options2"  value="침구" <?=set_value('p_options[1]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options2"><span></span>침구</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options3"  value="TV" <?=set_value('p_options[2]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options3"><span></span>TV</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options4"  value="에어컨" <?=set_value('p_options[3]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options4"><span></span>냉난방에어컨</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options5"  value="개별바베큐" <?=set_value('p_options[4]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options5"><span></span>개별바베큐</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options6"  value="냉장고" <?=set_value('p_options[5]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options6"><span></span>냉장고</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options7"  value="전자레인지" <?=set_value('p_options[6]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options7"><span></span>전자레인지</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options8"  value="전기주전자" <?=set_value('p_options[7]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options8"><span></span>전기주전자</label>
                                                    <br>

                                                    <input type="checkbox" name="p_options[]" id="p_options9"  value="정수기" <?=set_value('p_options[8]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options9"><span></span>정수기</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options10"  value="WiFi" <?=set_value('p_options[9]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options10"><span></span>WiFi</label>
                                                    
                                                    <input type="checkbox" name="p_options[]" id="p_options11"  value="조리도구" <?=set_value('p_options[10]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options11"><span></span>조리도구</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options12"  value="헤어드라이어" <?=set_value('p_options[11]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options12"><span></span>헤어드라이어</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options13"  value="욕실어메니티" <?=set_value('p_options[12]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options13"><span></span>욕실어메니티</label>

                                                    <input type="checkbox" name="p_options[]" id="p_options14"  value="대용량욕실용품" <?=set_value('p_options[13]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options14"><span></span>대용량욕실용품</label>
                                                    
                                                    <input type="checkbox" name="p_options[]" id="p_options15"  value="실내수영장" <?=set_value('p_options[14]') ? 'checked' : ''?>>
                                                    <label class="checkbox-label" for="p_options15"><span></span>실내수영장</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>검색태그</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">검색태그</label>
                                                    <input type="text" class="form guidetext" name="tags" id="tags" placeholder="검색태그를입력하세요(쉼표로구분)">
                                                </div>                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>대표이미지 *</th>
                                            <td>
                                                <div class="preview-img"></div>
                                                <div class="file">
                                                    <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                    <span class="ico-file-cancel"></span>
                                                    <br>
                                                    <div class="col-100 m-t-8">
                                                        <label class="btn typeA-blue pointer btn-file" for="input_file"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                        <input type="file" name="userfile[]" id="input_file" class="upload-hidden" accept="image/*">
                                                    </div>
                                                    <?=form_error('userfile[0]','<div class="col-error">', '</div>')?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                           <th>객실사진(최대5장) *</th>
                                            <td class="shop-td">
                                                <div class="shop-img-group clearfix">
                                                    <div class="shop-200">
                                                        <div class="preview-img"></div>
                                                        <div class="file">
                                                            <input class="form upload-name shop-item" placeholder="이미지 추가" readonly>
                                                            <span class="ico-file-cancel"></span>
                                                            <br>
                                                            <div class="col-25 m-t-8">
                                                                <label class="btn typeA-blue pointer btn-file" for="input_file2"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                                <input type="file" name="userfile[]" id="input_file2" class="upload-hidden" accept="image/*">                                                                   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="shop-200">
                                                        <div class="preview-img"></div>
                                                        <div class="file">
                                                            <input class="form upload-name shop-item" placeholder="이미지 추가" readonly>
                                                            <span class="ico-file-cancel"></span>
                                                            <br>
                                                            <div class="col-25 m-t-8">
                                                                <label class="btn typeA-blue pointer btn-file" for="input_file3"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                                <input type="file" name="userfile[]" id="input_file3" class="upload-hidden" accept="image/*">                                                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="shop-200">
                                                        <div class="preview-img"></div>
                                                        <div class="file">
                                                            <input class="form upload-name shop-item" placeholder="이미지 추가" readonly>
                                                            <span class="ico-file-cancel"></span>
                                                            <br>
                                                            <div class="col-25 m-t-8">
                                                                <label class="btn typeA-blue pointer btn-file" for="input_file4"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                                <input type="file" name="userfile[]" id="input_file4" class="upload-hidden" accept="image/*">                                                                   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="shop-200">
                                                        <div class="preview-img"></div>
                                                        <div class="file">
                                                            <input class="form upload-name shop-item" placeholder="이미지 추가" readonly>
                                                            <span class="ico-file-cancel"></span>
                                                            <br>
                                                            <div class="col-25 m-t-8">
                                                                <label class="btn typeA-blue pointer btn-file" for="input_file5"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                                <input type="file" name="userfile[]" id="input_file5" class="upload-hidden" accept="image/*">                                                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="shop-200">
                                                        <div class="preview-img"></div>
                                                        <div class="file">
                                                            <input class="form upload-name shop-item" placeholder="이미지 추가" readonly>
                                                            <span class="ico-file-cancel"></span>
                                                            <br>
                                                            <div class="col-25 m-t-8">
                                                                <label class="btn typeA-blue pointer btn-file" for="input_file6"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                                <input type="file" name="userfile[]" id="input_file6" class="upload-hidden" accept="image/*">                                                                    
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
                                                        <option value="N">대기</option>
                                                        <option value="Y">게시</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>객실상세정보</th>
                                            <td>
                                                <div class="col-100">
                                                    <div>
                                                        <textarea name="contents" id="contents" rows="30" style="width:100%;"></textarea>
                                                        <!-- ckeditor 호출 및 파일 업로드 실행 파일 경로 설정 -->
                                                        <script>
                                                            CKEDITOR.replace( 'contents', {
                                                                filebrowserUploadUrl: '<?=$this->config->item('ADMIN_ROOT'); ?>/CKE_Upload/cke_upload?k=<?=$hash?>'
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

    <script>
    $(document).ready(function(){
        if($("#rental_fee_consultation_inquiry").is(":checked")){
            for(i=5; i<17; i++){
                $("input")[i].disabled = true;
                var InputNm="#"+$("input")[i].name;
                $(InputNm).val("");
                $(InputNm).css("background-color","#f3f3f3");
            }
            $(this).val("Y");
        }

        // 보험 필드 3개 사용안함 체크
        $('.insur-input').change(function(){
            if($(this).is(':checked')){
                $(this).parent().siblings('.col-25').find('input').attr('disabled',true);
                $(this).parent().siblings('.col-25').find('input').css("background-color","#f3f3f3");
            }
            else{
                $(this).parent().siblings('.col-25').find('input').attr('disabled',false);
                $(this).parent().siblings('.col-25').find('input').css("background-color","#FFF");
            }
        });

    });

    </script>   
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