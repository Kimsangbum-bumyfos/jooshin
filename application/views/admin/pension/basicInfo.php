<!DOCTYPE html>
<html lang="<?php echo $this->config->item('LANG'); ?>">
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
    <title><?php echo $this->config->item('HOMEPAGE_TITLE');?></title>

    <!-- Page Level include -->
    <link rel="stylesheet" href="<?php echo $this->config->item('home_assets_url'); ?>/cms/css/style.css">
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/jquery.min.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/vendor/datepickk/datepickk.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/script.js"></script>
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/vendor/ckeditor/ckeditor.js"></script>
    <!--//Page Level include -->


    <!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {
            $('#write_btn').click(function () {
                $("#write_action").submit();   
            });
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
                            <h2>팬션기본정보설정</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">설정</a></li>
                                <li><a href="#">팬션기본정보설정</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id="write_action" enctype="multipart/form-data"')?>
                                <fieldset>
                                    <legend class="hidden-text">FAQ수정</legend>
                                    <table class="table table-typeB">
	                                    <colgroup>
	                                    	<col width="180">
	                                        <col>
	                                    </colgroup>
	                                    <tbody>
	                                    	<tr>
	                                    		<th>팬션이름</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="pension_name" class="hidden-text">회사명</label>
	                                    				<input type="text" name="pension_name" id="pension_name" class="form" value="<?=@$lt['pension_name']?>" placeholder="회사명을 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
                                            <tr>
                                            <th>팬션주소</th>
                                                <td>
                                                    <div class="col-50 m-b-5">
                                                        <label for="" class="hidden-text">우편번호</label>
                                                        <input class="form form-50 p-l-20" type="text" name="pension_addr_code" value="<?=@$lt['pension_addr_code']?>" id="postcode" readonly>
                                                        <button type="button" class="btn typeA-blue" onclick="execPostcode()" ><i class="fas fa-search">&nbsp;</i>우편번호 찾기</button>
                                                    </div>
                                                    <div class="col-100 m-b-5">
                                                        <label for="" class="hidden-text">도로명 주소</label>
                                                        <input class="form" type="text" name="pension_addr" id="address" value="<?=@$lt['pension_addr']?>" readonly>
                                                    </div>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">지번 주소</label>
                                                        <input class="form" type="text" name="pension_addr2" id="address2" value="<?=@$lt['pension_addr2']?>">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>대표번호</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="pension_phone" class="hidden-text">대표번호</label>
                                                        <input type="text" name="pension_phone" id="pension_phone" class="form" value="<?=@$lt['pension_phone']?>" placeholder="대표번호를 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>대표자명</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="ceo_name" class="hidden-text">대표자명</label>
                                                        <input type="text" name="ceo_name" id="ceo_name" class="form" value="<?=@$lt['ceo_name']?>" placeholder="대표자명을 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>사업자등록번호</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="company_reg_no" class="hidden-text">사업자등록번호</label>
                                                        <input type="text" name="company_reg_no" id="company_reg_no" class="form" value="<?=@$lt['company_reg_no']?>" placeholder="사업자등록번호를 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>이메일주소</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="pension_email" class="hidden-text">이메일주소</label>
                                                        <input type="text" name="pension_email" id="pension_email" class="form" value="<?=@$lt['pension_email']?>" placeholder="이메일 주소를 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>입/퇴실시간</th>
                                                <td>
                                                    <div class="col-50">
                                                        <label for="check_in" class="hidden-text">입실시간</label>
                                                        <input type="text" name="check_in" id="check_in" class="form" value="<?=@$lt['check_in']?>" placeholder="입실시간을 입력하세요">
                                                    </div>
                                                    <div class="col-50">
                                                        <label for="check_out" class="hidden-text">퇴실시간</label>
                                                        <input type="text" name="check_out" id="check_out" class="form" value="<?=@$lt['check_out']?>" placeholder="퇴실시간을 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>입금은행1</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="bank" class="hidden-text">입금은행</label>
                                                        <input type="text" name="bank" id="bank" class="form" value="<?=@$lt['bank']?>" placeholder="입금은행을입력하세요(은행명, 계좌번호, 예금주)">
                                                    </div>                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>입금은행2</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="bank2" class="hidden-text">입금은행2</label>
                                                        <input type="text" name="bank2" id="bank2" class="form" value="<?=@$lt['bank2']?>" placeholder="입금은행을입력하세요(은행명, 계좌번호, 예금주)">
                                                    </div>                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>입금은행3</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="bank3" class="hidden-text">입금은행3</label>
                                                        <input type="text" name="bank3" id="bank3" class="form" value="<?=@$lt['bank3']?>" placeholder="입금은행을입력하세요(은행명, 계좌번호, 예금주)">
                                                    </div>                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>주의사항</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">내용</label>
                                                        <div>
                                                            <textarea name="contents" id="contents" rows="10" style="width:100%;"><?=set_value('contents')?><?=@$lt['contents']?></textarea>
                                                            <!-- ckeditor 호출 및 파일 업로드 실행 파일 경로 설정 -->
                                                            <script>
                                                                CKEDITOR.replace( 'contents', {
                                                                    filebrowserUploadUrl: '<?=$this->config->item('ADMIN_ROOT'); ?>/CKE_Upload/cke_upload',
                                                                    height: 200
                                                                });
                                                            </script><!--// ckeditor 호출 및 파일 업로드 실행 파일 경로 설정 -->
                                                        </div>
                                                    </div>                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>환불규정</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">내용</label>
                                                        <div>
                                                            <textarea name="contents2" id="contents2" rows="10" style="width:100%;"><?=set_value('contents')?><?=@$lt['contents2']?></textarea>
                                                            <!-- ckeditor 호출 및 파일 업로드 실행 파일 경로 설정 -->
                                                            <script>
                                                                CKEDITOR.replace( 'contents2', {
                                                                    filebrowserUploadUrl: '<?=$this->config->item('ADMIN_ROOT'); ?>/CKE_Upload/cke_upload',
                                                                    height: 300
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
                                    <button class="btn typeA-blue" id="write_btn">저장</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //각 페이지 별 -->
        </div><!-- //바디 -->

        <!-- 우편번호/주소 검색 모듈-->
        <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
        <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/vendor/postCode/postCode.js"></script>
        <!-- //우편번호/주소 검색 모듈-->

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

    </div>
</body>
</html>