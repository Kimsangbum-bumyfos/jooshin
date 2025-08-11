<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?php echo $this->config->item('LANG'); ?>">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo $this->config->item('HOMEPAGE_TITLE'); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="<?php echo $this->config->item('META_DATA'); ?>" name="description" />
       
        <!-- BEGIN PLUGIN, JS INCLUDE -->
        <?php $this->load->view('admin/include/js_inc'); ?>
        <!-- END PLUGIN, JS INCLUDE -->

        <link rel="shortcut icon" href="favicon.ico" /> 
        <script>
            $(document).ready(function() {

                $("#write_btn").click(function() {
                    
                    if ($("#branch_name").val() == '') {
                        alert('지점명을 입력해 주세요.');
                        $("#branch_name").focus();
                        return false;
                    } else if ($("#addr").val() == '') {
                        alert('주소를 입력해 주세요.');
                        $("#addr").focus();
                        return false;
                    } else {
                        $("#write_action").submit();
                    }
                });
            });
       </script>
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <?php $this->load->view('admin/include/header_inc'); ?>
                    <!-- END HEADER -->
                </div>
            </div>
            <div class="page-wrapper-row full-height">
                <div class="page-wrapper-middle">
                    <!-- BEGIN CONTAINER -->
                    <div class="page-container">
                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->
                            <!-- BEGIN PAGE HEAD-->
                            <div class="page-head">
                                <div class="container">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1>지점 관리</h1>
                                    </div>
                                    <!-- END PAGE TITLE -->
                                </div>
                            </div>
                            <!-- END PAGE HEAD-->
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container">
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <!-- BEGIN BORDERED TABLE PORTLET-->
                                                <div class="portlet box green ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-sitemap"></i>
                                                            <span class="caption-subject uppercase">지점 등록</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <form class="form-horizontal" method="post" action="" id="write_action" enctype="multipart/form-data"> 
                                                        <div class="table-scrollable">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="col-md-2"> 지점명 </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <input type="text" name="branch_name" id="branch_name" class="form-control"> 
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="col-md-2"> 주소 </td>
                                                                        <td>
                                                                            <div class="col-md-10 form-inline">
                                                                                <input type="text" name="addr_code" id="sample6_postcode" placeholder="우편번호" class="form-control" readonly>
                                                                                <input type="button" class="btn btn-danger  btn-sm" onclick="sample6_execDaumPostcode()" value="우편번호 찾기">
                                                                            </div>

                                                                            <div class="col-md-10" style="margin-top:2px">    
                                                                                <input type="text" name ="addr" id="sample6_address" placeholder="주소" class="form-control" readonly>
                                                                                <input type="text" name ="addr2" id="sample6_address2" placeholder="상세주소" class="form-control" style="margin-top:2px">
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="col-md-2"> 사무실번호 </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                               <input type="text" name="phone1" id="phone1" class="form-control" placeholder="' - '를 포함하여 입력해 주세요(예 : 02-777-1389)">
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="col-md-2"> 휴대폰번호 </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                               <input type="text" name="phone2" id="phone2" class="form-control" placeholder="' - '를 포함하여 입력해 주세요(예 : 02-777-1389)">
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="col-md-2"> FAX </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                               <input type="text" name="fax" id="fax" class="form-control" placeholder="' - '를 포함하여 입력해 주세요(예 : 02-777-1389)">
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="col-md-2"> 찾아오는길 </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                              <textarea name="map_comment" id="map_comment" rows="5" style="width:100%;"></textarea>

                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="col-md-2"> 기타 부연설명<br>
                                                                            (소개,인사말 등) </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                              <textarea name="add_comment" id="add_comment" rows="3" style="width:100%;"></textarea>

                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> 게시여부 </td>
                                                                        <td>
                                                                            <div class="col-md-3">
                                                                            <select class="bs-select form-control" data-width="125px" name="open_yn">
                                                                                <option selected value="Y">게시</option>
                                                                                <option value="N">대기</option>';
                                                                            </select>
                                                                          </div>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </form>
                                                        <!--  start search group -->
                                                        <div align="right" class="form-actions noborder">
                                                            <button type="submit" class="btn btn-primary" id="write_btn">저장</button>
                                                            <a href="javascript:history.back()"><button type="button" class="btn btn-default">취소</button></a>
                                                        </div>
                                                        <!-- input-group -->
                                                    </div>
                                                </div>
                                                <!-- END BORDERED TABLE PORTLET-->
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    <!-- END PAGE CONTENT INNER -->
                                </div>
                            </div>
                            <!-- END PAGE CONTENT BODY -->
                            <!-- END CONTENT BODY -->
                        </div>
                        <!-- END CONTENT -->
                        
                    </div>
                    <!-- END CONTAINER -->
                </div>
            </div>
            <?php $this->load->view('admin/include/footer_inc'); ?>
        </div>
        
        <!--[if lt IE 9]>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/respond.min.js"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/excanvas.min.js"></script> 
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/ie8.fix.min.js"></script> 
        <![endif]-->
         <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        
        <!-- BEGIN PAGE LEVEL PLUGINS Fileinput-->
        <script src="<?php echo $this->config->item('INCLUDE_DIR');?>/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript">
        </script>
        <!-- END PAGE LEVEL PLUGINS -->

        <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
        <script>
            function sample6_execDaumPostcode() {
                new daum.Postcode({
                    oncomplete: function(data) {
                        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                        // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                        var fullAddr = ''; // 최종 주소 변수
                        var extraAddr = ''; // 조합형 주소 변수

                        // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                        if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                            fullAddr = data.roadAddress;

                        } else { // 사용자가 지번 주소를 선택했을 경우(J)
                            fullAddr = data.jibunAddress;
                        }

                        // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                        if(data.userSelectedType === 'R'){
                            //법정동명이 있을 경우 추가한다.
                            if(data.bname !== ''){
                                extraAddr += data.bname;
                            }
                            // 건물명이 있을 경우 추가한다.
                            if(data.buildingName !== ''){
                                extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                            }
                            // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                            fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                        }

                        // 우편번호와 주소 정보를 해당 필드에 넣는다.
                        document.getElementById('sample6_postcode').value = data.zonecode; //5자리 새우편번호 사용
                        document.getElementById('sample6_address').value = fullAddr;

                        // 커서를 상세주소 필드로 이동한다.
                        document.getElementById('sample6_address2').focus();
                    }
                }).open();
            }
        </script>
    </body>
</html>