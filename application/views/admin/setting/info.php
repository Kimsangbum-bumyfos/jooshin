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
                            <h2>설정 - 기본정보설정</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">설정</a></li>
                                <li><a href="#">기본정보설정</a></li>
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
	                                    		<th>회사명</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="com_name" class="hidden-text">회사명</label>
	                                    				<input type="text" name="com_name" id="com_name" class="form" value="<?=@$lt['com_name']?>" placeholder="회사명을 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
                                            <tr>
                                            <th>주소</th>
                                                <td>
                                                    <div class="col-50 m-b-5">
                                                        <label for="" class="hidden-text">우편번호</label>
                                                        <input class="form form-50 p-l-20" type="text" name="company_addr_code" value="<?=@$lt['company_addr_code']?>" id="postcode" readonly>
                                                        <button type="button" class="btn typeA-blue" onclick="execPostcode()" ><i class="fas fa-search">&nbsp;</i>우편번호 찾기</button>
                                                    </div>
                                                    <div class="col-100 m-b-5">
                                                        <label for="" class="hidden-text">도로명 주소</label>
                                                        <input class="form" type="text" name="company_addr" id="address" value="<?=@$lt['company_addr']?>" readonly>
                                                    </div>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">지번 주소</label>
                                                        <input class="form" type="text" name="company_addr2" id="address2" value="<?=@$lt['company_addr2']?>">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>대표번호</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="company_phone" class="hidden-text">대표번호</label>
                                                        <input type="text" name="company_phone" id="company_phone" class="form" value="<?=@$lt['company_phone']?>" placeholder="대표번호를 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>팩스번호</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="company_fax" class="hidden-text">팩스번호</label>
                                                        <input type="text" name="company_fax" id="company_fax" class="form" value="<?=@$lt['company_fax']?>" placeholder="팩스번호를 입력하세요">
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
                                                <th>통신판매신고번호</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="mail_order_sales_report_no" class="hidden-text">통신판매신고번호</label>
                                                        <input type="text" name="mail_order_sales_report_no" id="mail_order_sales_report_no" class="form" value="<?=@$lt['mail_order_sales_report_no']?>" placeholder="통신판매신고번호를 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>개인정보담당자</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="privacy_mgr" class="hidden-text">개인정보담당자</label>
                                                        <input type="text" name="privacy_mgr" id="privacy_mgr" class="form" value="<?=@$lt['privacy_mgr']?>" placeholder="개인정보담당자를 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Copyright</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="copyright" class="hidden-text">Copyright</label>
                                                        <input type="text" name="copyright" id="copyright" class="form" value="<?=@$lt['copyright']?>" placeholder="카피라이터를 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
	                                        <tr>
	                                    		<th>사이트제목</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="site_name" class="hidden-text">사이트제목</label>
	                                    				<input type="text" name="site_name" id="site_name" class="form" value="<?=@$lt['site_name']?>" placeholder="사이트제목을 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                    		<th>사이트내용</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="site_contents" class="hidden-text"></label>
	                                    				<input type="text" name="site_contents" id="site_contents" class="form" value="<?=@$lt['site_contents']?>" placeholder="사이트내용을 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                    		<th>사이트키워드</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="site_keyword" class="hidden-text"></label>
	                                    				<input type="text" name="site_keyword" id="site_keyword" class="form" value="<?=@$lt['site_keyword']?>" placeholder="사이트키워드을 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                    		<th>공식이메일주소</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="site_email" class="hidden-text"></label>
	                                    				<input type="text" name="company_email" id="company_email" class="form" value="<?=@$lt['company_email']?>" placeholder="공식이메일주소를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
                                            <th>로고(메인)</th>
	                                            <td>
	                                                <div class="preview-img" style="background: url('<?=base_url().@$lt['logo_pc']?>') 50% center / 100%;"></div>
	                                                <div class="file">
	                                                    <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
	                                                    <span class="ico-file-cancel"></span>
	                                                    <br>
	                                                    <div class="col-100 m-t-8">
	                                                        <label class="btn typeA-blue pointer btn-file" for="input_file"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
	                                                        <input type="file" name="userfile[]" id="input_file" class="upload-hidden" accept="image/*">
	                                                        <input type="hidden" name="thumb_chk" value="<?=@$lt['logo_pc']?>">
	                                                    </div>
	                                                </div>
	                                            </td>
	                                        </tr>
                                            <th>로고(서브)</th>
                                                <td>
                                                    <div class="preview-img" style="background: url('<?=base_url().@$lt['logo_pc_sub']?>') 50% center / 100%;"></div>
                                                    <div class="file">
                                                        <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                        <span class="ico-file-cancel"></span>
                                                        <br>
                                                        <div class="col-100 m-t-8">
                                                            <label class="btn typeA-blue pointer btn-file" for="input_file2"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                            <input type="file" name="userfile[]" id="input_file2" class="upload-hidden" accept="image/*">
                                                            <input type="hidden" name="thumb_chk2" value="<?=@$lt['logo_pc_sub']?>">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>로고(모바일메뉴)</th>
                                                <td>
                                                    <div class="preview-img" style="background: url('<?=base_url().@$lt['logo_mobile']?>') 50% center / 100%;"></div>
                                                    <div class="file">
                                                        <input class="form upload-name"  placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                        <span class="ico-file-cancel"></span>
                                                        <br>
                                                        <div class="col-100 m-t-8">
                                                            <label class="btn typeA-blue pointer btn-file" for="input_file3"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                            <input type="file" name="userfile[]" id="input_file3" class="upload-hidden" accept="image/*">
                                                            <input type="hidden" name="thumb_chk3" value="<?=@$lt['logo_mobile']?>">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>로고(PC-footer용)</th>
                                                <td>
                                                    <div class="preview-img" style="background: url('<?=base_url().@$lt['logo_pc_footer']?>') 50% center / 100%;"></div>
                                                    <div class="file">
                                                        <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                        <span class="ico-file-cancel"></span>
                                                        <br>
                                                        <div class="col-100 m-t-8">
                                                            <label class="btn typeA-blue pointer btn-file" for="input_file4"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                            <input type="file" name="userfile[]" id="input_file4" class="upload-hidden" accept="image/*">
                                                            <input type="hidden" name="thumb_chk4" value="<?=@$lt['logo_pc_footer']?>">
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
                                    <!-- <button class="btn typeA-darkgray" onclick="history.go(-1); return false;">취소</button> -->
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