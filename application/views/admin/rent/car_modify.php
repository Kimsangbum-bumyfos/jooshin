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
                            <h2>자동차관리 - 등록</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">자동차관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id="write_action" enctype="multipart/form-data"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <fieldset>
                                <legend class="hidden-text">자동차관리등록</legend>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="180">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th>차량명</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">차량명</label>
                                                    <input type="text" class="form" name="car_name" id="car_name" value ="<?=$views->car_name;?>">
                                                </div>
                                                <?=form_error('car_name','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>차량유형</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">차량유형</label>
                                                    <select class="form" name="car_type">
                                                        <option value="01" <?php if($views->car_type == '01') echo "selected"; ?>>소형</option>
                                                        <option value="02" <?php if($views->car_type == '02') echo "selected"; ?>>중형</option>
                                                        <option value="03" <?php if($views->car_type == '03') echo "selected"; ?>>대형</option>
                                                        <option value="04" <?php if($views->car_type == '04') echo "selected"; ?>>고급</option>
                                                        <option value="05" <?php if($views->car_type == '05') echo "selected"; ?>>SUV</option>
                                                        <option value="06" <?php if($views->car_type == '06') echo "selected"; ?>>승합</option>
                                                        <option value="07" <?php if($views->car_type == '07') echo "selected"; ?>>수입</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>가격사용안함</th>
                                            <td>
                                               <!--  <div class="col-100">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="rental_fee_consultation_inquiry" id="rental_fee_consultation_inquiry" value="Y" <?php if($views->rental_fee_consultation_inquiry == 'Y') echo "checked"; ?>>
                                                        <span>체크하시면 예약 시 가격이 노출되지 않고 가격문의로 노출됩니다.</span>
                                                    </label>                                                                      
                                                </div> -->

                                                <div class="col-100">
                                                    <input type="checkbox" name="rental_fee_consultation_inquiry" id="rental_fee_consultation_inquiry"  value="Y" <?php if($views->rental_fee_consultation_inquiry == 'Y') echo "checked"; ?>>
                                                    <label class="checkbox-label" for="rental_fee_consultation_inquiry"><span></span>체크하시면 예약 시 가격이 노출되지 않고 가격문의로 노출됩니다.</label>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>정상가격(1일)</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">정상가격(1일)</label>
                                                    <input type="number" class="form" name="rental_fee" id="rental_fee" value ="<?=$views->rental_fee;?>">
                                                    <?=form_error('rental_fee','<div class="col-error">', '</div>')?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>할인가(1일)</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">정상가격(1일)</label>
                                                    <input type="number" class="form" name="rental_fee_12" id="rental_fee_12" placeholder="일반가격(1~2일)" value ="<?=$views->rental_fee_12;?>">
                                                </div>
                                                <?=form_error('rental_fee_12','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">정상가격(1일)</label>
                                                    <input type="number" class="form" name="rental_peak_fee_12" id="rental_peak_fee_12" placeholder="성수기가격(1~2일)" value ="<?=$views->rental_peak_fee_12;?>">
                                                </div>
                                                <?=form_error('rental_peak_fee_12','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">정상가격(1일)</label>
                                                    <input type="number" class="form" name="rental_high_peak_fee_12" id="rental_high_peak_fee_12" placeholder="극성수기가격(1~2일)" value ="<?=$views->rental_high_peak_fee_12;?>">
                                                </div>
                                                <?=form_error('rental_high_peak_fee_12','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>3~6일가격</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">3~6일가격</label>
                                                    <input type="number" class="form" name="rental_fee_36" id="rental_fee_36" placeholder="일반가격(1~2일)" value ="<?=$views->rental_fee_36;?>">
                                                </div>
                                                <?=form_error('rental_fee_36','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">3~6일가격</label>
                                                    <input type="number" class="form" name="rental_peak_fee_36" id="rental_peak_fee_36" placeholder="성수기가격(1~2일)" value ="<?=$views->rental_peak_fee_36;?>">
                                                </div>
                                                <?=form_error('rental_peak_fee_36','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">3~6일가격</label>
                                                    <input type="number" class="form" name="rental_high_peak_fee_36" id="rental_high_peak_fee_36" placeholder="극성수기가격(1~2일)" value ="<?=$views->rental_high_peak_fee_36;?>">
                                                </div>
                                                <?=form_error('rental_high_peak_fee_36','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>7일이상</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">7일이상</label>
                                                    <input type="number" class="form" name="rental_fee_7" id="rental_fee_7" placeholder="일반가격(1~2일)" value ="<?=$views->rental_fee_7;?>">
                                                </div>
                                                <?=form_error('rental_fee_7','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">7일이상</label>
                                                    <input type="number" class="form" name="rental_peak_fee_7" id="rental_peak_fee_7" placeholder="성수기가격(1~2일)" value ="<?=$views->rental_peak_fee_7;?>">
                                                </div>
                                                <?=form_error('rental_peak_fee_7','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">7일이상</label>
                                                    <input type="number" class="form" name="rental_high_peak_fee_7" id="rental_high_peak_fee_7" placeholder="극성수기가격(1~2일)" value ="<?=$views->rental_high_peak_fee_7;?>">
                                                </div>
                                                <?=form_error('rental_high_peak_fee_7','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>주말가격</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">주말가격</label>
                                                    <input type="number" class="form" name="rental_weekend_fee" id="rental_weekend_fee" value ="<?=$views->rental_weekend_fee;?>">
                                                </div>
                                                <?=form_error('rental_weekend_fee','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>시간당추가요금</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">시간당추가요금</label>
                                                    <input type="number" class="form" name="add_hours_fee" id="add_hours_fee" value ="<?=$views->add_hours_fee;?>">
                                                </div>
                                                <?=form_error('add_hours_fee','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>배/회차요금</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">배차가격</label>
                                                    <input type="number" class="form" name="operate_svc" id="operate_svc" placeholder="배차가격" value ="<?=$views->operate_svc_fee;?>">
                                                </div>
                                                <?=form_error('operate_svc','<div class="col-error">', '</div>')?>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">회차가격</label>
                                                    <input type="number" class="form" name="release_svc" id="release_svc" placeholder="회차가격" value ="<?=$views->release_svc_fee;?>">
                                                </div>
                                                <?=form_error('release_svc','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>보험-고객부담금 없음</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">보험-완전자차</label>
                                                    <input type="number" class="form" name="insur_fee" id="insur_fee" value ="<?=$views->insur_fee;?>">
                                                </div>
                                                <?=form_error('insur_fee','<div class="col-error">', '</div>')?>
                                                <div class="col-50">
                                                    <input type="checkbox" class="insur-input" name="insur_fee_open_yn[]" id="insur_fee_open_yn"  value="01" <?php if(strpos($views->insur_fee_open_yn, '01') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="insur_fee_open_yn"><span></span>사용안함 (선택하시면 예약 시 노출되지 않습니다.)</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>보험-고객부담금 10만원</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">보험-완전자차</label>
                                                    <input type="number" class="form" name="insur_fee_10" id="insur_fee_10" value ="<?=$views->insur_fee_10;?>">
                                                </div>
                                                <?=form_error('insur_fee_10','<div class="col-error">', '</div>')?>
                                                <div class="col-50">
                                                    <input type="checkbox" class="insur-input" name="insur_fee_open_yn[]" id="insur_fee_open_yn2"  value="02" <?php if(strpos($views->insur_fee_open_yn, '02') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="insur_fee_open_yn2"><span></span>사용안함 (선택하시면 예약 시 노출되지 않습니다.)</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>보험-고객부담금 30만원</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">보험-완전자차</label>
                                                    <input type="number" class="form" name="insur_fee_30" id="insur_fee_30" value ="<?=$views->insur_fee_30;?>">
                                                </div>
                                                <?=form_error('insur_fee_30','<div class="col-error">', '</div>')?>
                                                <div class="col-50">
                                                    <input type="checkbox" class="insur-input" name="insur_fee_open_yn[]" id="insur_fee_open_yn3"  value="03" <?php if(strpos($views->insur_fee_open_yn, '03') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="insur_fee_open_yn3"><span></span>사용안함 (선택하시면 예약 시 노출되지 않습니다.)</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>차량옵션</th>
                                            <td>
                                                <div class="col-100">
                                                    <input type="checkbox" name="rental_opt[]" id="rental_opt"  value="네비게이션" <?php if(strpos($views->rental_opt, '네비게이션') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="rental_opt"><span></span>네비게이션</label>

                                                    <input type="checkbox" name="rental_opt[]" id="rental_opt2"  value="후방카메라" <?php if(strpos($views->rental_opt, '후방카메라') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="rental_opt2"><span></span>후방카메라</label>

                                                    <input type="checkbox" name="rental_opt[]" id="rental_opt3"  value="금연차량" <?php if(strpos($views->rental_opt, '금연차량') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="rental_opt3"><span></span>금연차량</label>

                                                    <input type="checkbox" name="rental_opt[]" id="rental_opt4"  value="카시트" <?php if(strpos($views->rental_opt, '카시트') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="rental_opt4"><span></span>카시트</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>차량이미지</th>
                                            <td>
                                                <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->thumb_img?>') 50% center / 100%;"></div>
                                                <div class="file">
                                                    <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                    <span class="ico-file-cancel"></span>
                                                    <br>
                                                    <div class="col-100 m-t-8">
                                                        <label class="btn typeA-blue pointer btn-file" for="input_file3"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                        <input type="file" name="userfile" id="input_file3" class="upload-hidden" accept="image/*">
                                                        <input type="hidden" name="thumb_chk" value ="<?=$views->thumb_img;?>">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>게시여부</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">사용여부</label>
                                                    <select class="form" name="open_yn">
                                                        <option value="N" <?php if($views->open_yn == 'N') echo "selected"; ?>>대기</option>
                                                        <option value="Y" <?php if($views->open_yn == 'Y') echo "selected"; ?>>게시</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>인기차량 등록</th>
                                            <td>
                                                <div class="col-100">
                                                    <input type="checkbox" name="popular_car" id="popular_car"  value="1" <?php if($views->popular_car === '1') echo "checked" ?>>
                                                    <label class="checkbox-label" for="popular_car"><span></span>인기차량 등록</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>차량 상세정보</th>
                                            <td>
                                                <div class="col-100">
                                                    <div>
                                                        <textarea name="contents" id="contents" rows="30" style="width:100%;"><?=$views->detail_info?></textarea>
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
                                <div class="btn-group fl-l">
                                    <button class="btn typeA-gray" onclick="goDelete('<?=$this->config->item('ADMIN_ROOT'); ?>/rent/car/delete/<?=$views->idx ?>?v=<?=$v?>')">삭제</button>
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

    <script>
    $(document).ready(function(){
        if($("#rental_fee_consultation_inquiry").is(":checked")){
            for(i=4; i<16; i++){
                $("input")[i].disabled = true;
                var InputNm="#"+$("input")[i].name;
                $(InputNm).val("");
                $(InputNm).css("background-color","#f3f3f3");
            }
        }
        //가격 안보이게 설정하는 경우 가격 입력 필드 박스 disable처리하기
        $("#rental_fee_consultation_inquiry").change(function(){
            if($("#rental_fee_consultation_inquiry").is(":checked")){
              //2~15
              for(i=4; i<16; i++){
                $("input")[i].disabled = true;  
                var InputNm="#"+$("input")[i].name;
                $(InputNm).val("");
                $(InputNm).css("background-color","#f3f3f3");
              }

            }else{
               
                for(i=4; i<16; i++){
                $("input")[i].disabled = false;  
                var InputNm="#"+$("input")[i].name;
                $(InputNm).css("background-color","");
              }
            }
        });

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

        if($('.insur-input').length){
            var cnt = $('.insur-input').length;
            for(var i=0; i<cnt; i++){
                if($('.insur-input').eq(i).is(':checked')){
                    $('.insur-input').eq(i).parent().siblings('.col-25').find('input').css("background-color","#f3f3f3");
                    $('.insur-input').eq(i).parent().siblings('.col-25').find('input').attr('disabled',true);
                }
            }
        }
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