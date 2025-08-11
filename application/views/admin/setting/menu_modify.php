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
    <title><?php echo $this->config->item('HOMEPAGE_TITLE'); ?></title>

    <!-- Page Level include -->
    <link rel="stylesheet" href="<?php echo $this->config->item('home_assets_url'); ?>/cms/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('home_assets_url'); ?>/cms/vendor/minicolors/jquery.minicolors.css">
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/jquery.min.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/vendor/datepickk/datepickk.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/vendor/minicolors/jquery.minicolors.min.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/script.js"></script>
    <!--//Page Level include --> 

    <!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {

            // 텍스트 입력 필드가 있는 경우 첫 텍스트 필드로 포커스 이동
            $("#write_action :input:text:visible:enabled:first").focus();
            
            $("#write_btn").click(function() {
                
                // if ($("#title").val() == '') {
                //     showModal('#popupModal');
                //     $("#popup-msg").text("제목을 입력해 주세요.");
                //     $("#title").focus();
                //     return;
                // }

                $("#write_action").submit();                
            });

            /* 
                * 칼라피커 셋팅 
            */
            $('.demo').minicolors({
                animationSpeed: 50,// animation speed
                animationEasing: 'swing',// easing function
                changeDelay: 0,// defers the change event from firing while the user makes a selection
                control: 'wheel',// hue, brightness, saturation, or wheel
                defaultValue: '#FFF',// default color
                format: 'hex',// hex or rgb
                showSpeed: 100,// show/hide speed
                hideSpeed: 100,
                inline: false,// is inline mode?
                keywords: '',// a comma-separated list of keywords that the control should accept (e.g. inherit, transparent, initial).
                letterCase: 'lowercase',// uppercase or lowercase
                opacity: false,// enables opacity slider
                position: 'bottom left',// custom position
                theme: 'default',// additional theme class
                swatches: [],// an array of colors that will show up under the main color <a href="https://www.jqueryscript.net/tags.php?/grid/">grid</a>
                change: function(value){
                    $("#color_pick").val(value);
                }
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
                            <h2>메뉴관리 - 수정</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">메뉴관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <input type="hidden" id="token" value="<?=$this->security->get_csrf_hash()?>">
                                <?=form_open('', 'id="write_action" enctype="multipart/form-data"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <input type="hidden" name="idx" value="<?php echo $views->idx;?>">
                                <fieldset>
                                <legend class="hidden-text">메뉴관리등록</legend>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="180">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th>메뉴명</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">메뉴명</label>
                                                    <input type="text" class="form" name="menu_name" id="menu_name" value="<?php echo $views->menu_name;?>">
                                                </div>
                                                <?=form_error('menu_name','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>메뉴코드(수정불가)</th>
                                            <td>
                                                <div class="col-50">
                                                    <label for="" class="hidden-text">메뉴코드</label>
                                                    <input type="text" class="form" name="menu_code" id="menu_code" value="<?php echo $views->menu_code;?>" readonly>
                                                </div>
                                                <?=form_error('menu_code','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>메뉴순서</th>
                                            <td>
                                                <div class="col-50">
                                                    <label for="" class="hidden-text">메뉴순서</label>
                                                    <input type="number" class="form" name="menu_order" id="menu_order" value="<?php echo $views->menu_order;?>">
                                                    <input type ="hidden" id="menu_level" value="1">
                                                </div>
                                                <button type="button" class="btn typeA-blue" id="order_no_chk">메뉴순서중복확인</button>
                                                <?=form_error('menu_order','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>메뉴속성</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">메뉴속성</label>
                                                    <select class="form" name="menu_type">
                                                        <option value="CONTS" <?php if($views->menu_type=='CONTS') echo "selected";?>>콘텐츠</option>
                                                        <option value="BOARD_NOTICE" <?php if($views->menu_type=='BOARD_NOTICE') echo "selected";?>>게시판-공지사항</option>
                                                        <option value="BOARD_FAQ" <?php if($views->menu_type=='BOARD_FAQ') echo "selected";?>>게시판-FAQ</option>
                                                        <option value="BOARD_FAQ" <?php if($views->menu_type=='BOARD_EVENT') echo "selected";?>>게시판-이벤트</option>
                                                        <option value="COMPANY" <?php if($views->menu_type=='COMPANY') echo "selected";?>>회사소개</option>
                                                        <option value="PRODUCT" <?php if($views->menu_type=='PRODUCT') echo "selected";?>>제품관리</option>
                                                        <option value="SERVICE" <?php if($views->menu_type=='SERVICE') echo "selected";?>>용역관리</option>
                                                        <option value="CS" <?php if($views->menu_type=='CS') echo "selected";?>>고객문의</option>
                                                        <option value="BRANCH" <?php if($views->menu_type=='BRANCH') echo "selected";?>>지점정보</option>
                                                        <option value="LINK" <?php if($views->menu_type=='LINK') echo "selected";?>>외부링크</option>
                                                    </select>                                                    
                                                </div>
                                            </td>
                                        </tr> 

                                        <tr>
                                            <th>템플릿 리스트 유형</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">메뉴속성</label>
                                                    <select class="form" name="template_type">
                                                        <option value="01" <?php if($views->template_type=='01') echo "selected";?>>TypeA</option>
                                                        <option value="02" <?php if($views->template_type=='02') echo "selected";?>>TypeB</option>
                                                        <option value="03" <?php if($views->template_type=='03') echo "selected";?>>TypeC</option>                                                        
                                                    </select>                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>메뉴타이틀</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">메뉴타이틀</label>
                                                    <input type="text" class="form" name="menu_title" id="slideText-A" value="<?php echo $views->menu_title;?>">
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>메뉴서브타이틀</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">메뉴이미지타이틀</label>
                                                    <input type="text" class="form" name="menu_sub_title" id="slideText-A" placeholder="메뉴 서브타이틀을  입력해주세요." value="<?php echo $views->menu_sub_title;?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>메뉴설명</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">메뉴설명</label>
                                                    <input type="text" class="form" name="menu_desc" id="slideText-H" value="<?php echo $views->menu_desc;?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>서브메뉴 OFF</th>
                                            <td>
                                                <div class="col-100">
                                                    <input type="checkbox" name="sub_menu_yn" id="sub_menu_yn" value="Y" <?php if($views->sub_menu_yn == 'Y') echo "checked"; ?>>
                                                    <label class="checkbox-label" for="sub_menu_yn"><span></span>체크하시면 상단 메뉴 선택 시 서브 메뉴가 출력되지 않습니다.</label>
                                                </div>
                                            </td>
                                        </tr>
                                   
                                        <tr>
                                            <th>텍스트 색상</th>
                                            <td>
                                                <div class="col-100">
                                                    <input type="hidden" id="color_pick" name="text_color" value="">
                                                    <input type="text" id="demo" name="text_color" class="demo" value="<?php echo $views->text_color;?>">
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>링크주소</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">링크주소</label>
                                                    <input type="text" class="form" name="link_url" value="<?php echo $views->link_url;?>">
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>섬네일(PC)</th>
                                            <td>
                                                <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->menu_bg_pc?>') 50% center / 100%;"></div>
                                                <div class="file">
                                                    <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                    <span class="ico-file-cancel"></span>
                                                    <br>
                                                    <div class="col-100 m-t-8">
                                                        <label class="btn typeA-blue pointer btn-file" for="input_file"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                        <input type="file" name="userfile[]" id="input_file" class="upload-hidden" accept="image/*">
                                                        <input type="hidden" name="thumb_chk" value ="<?php echo $views->menu_bg_pc;?>">                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>섬네일(Mobile)</th>
                                            <td>
                                                <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->menu_bg_mobile?>') 50% center / 100%;"></div>
                                                <div class="file">
                                                    <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                    <span class="ico-file-cancel"></span>
                                                    <br>
                                                    <div class="col-100 m-t-8">
                                                        <label class="btn typeA-blue pointer btn-file" for="input_file2"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                        <input type="file" name="userfile[]" id="input_file2" class="upload-hidden" accept="image/*">
                                                        <input type="hidden" name="thumb_chk2" value ="<?php echo $views->menu_bg_mobile;?>">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>섬네일(상단메뉴)</th>
                                            <td>
                                                <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->menu_bg_header?>') 50% center / 100%;"></div>
                                                <div class="file">
                                                    <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                    <span class="ico-file-cancel"></span>
                                                    <br>
                                                    <div class="col-100 m-t-8">
                                                        <label class="btn typeA-blue pointer btn-file" for="input_file3"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                        <input type="file" name="userfile[]" id="input_file3" class="upload-hidden" accept="image/*">
                                                        <input type="hidden" name="thumb_chk3" value ="<?php echo $views->menu_bg_header;?>">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>                             
                                                                        
                                        <tr>
                                            <th>사용여부</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">사용여부</label>
                                                    <select class="form" name="open_yn">
                                                        <option value="N" <?php if($views->open_yn=='N') echo "selected";?>>사용안함</option>
                                                        <option value="Y" <?php if($views->open_yn=='Y') echo "selected";?>>사용</option>
                                                    </select>
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