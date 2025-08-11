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
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/jquery.min.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/vendor/datepickk/datepickk.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/script.js"></script>
    <!--//Page Level include --> 

    <!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {

            // 텍스트 입력 필드가 있는 경우 첫 텍스트 필드로 포커스 이동
            $("#write_action :input:text:visible:enabled:first").focus();
            
            $("#write_btn").click(function() {
                
                if ($("#title").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("팝업제목을 입력해 주세요.");
                    $("#title").focus();
                    return;
                }else if($("#s_date").val() == ''){
                    showModal('#popupModal');
                    $("#popup-msg").text("노출될 기간을 입력해 주세요.");
                    $("#s_date").focus();
                    return;
                }else if($("#e_date").val() == ''){
                    showModal('#popupModal');
                    $("#popup-msg").text("노출될 기간을 입력해 주세요.");
                    $("#e_date").focus();
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
                            <h2>팝업관리 - 등록</h2>
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
                            <div class="content-area">
                                <?=form_open('', 'id="write_action" enctype="multipart/form-data"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <fieldset>
                                <legend class="hidden-text">팝업관리등록</legend>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="180">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th>팝업제목*</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">팝업제목</label>
                                                    <input type="text" class="form" name="title" id="title" value="<?=set_value('title')?>" placeholder="팝업 제목을 입력해주세요.">
                                                </div>
                                                <?=form_error('title','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr style="display:none;">
                                            <th>팝업위치</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">팝업위치</label>
                                                    <select class="form" name="popup_type">
                                                        <option value="01">전체</option>                                                      
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- range달력 -->
                                        <tr>
                                            <th>노출기간*</th>
                                            <td>
                                                <div class="calendar-form">
                                                    <div class="col-25">
                                                        <label for="" class="hidden-text">시작일</label>
                                                        <input type="text" class="form date" placeholder="날짜를 선택하세요" name="s_date" value="<?=set_value('s_date')?>" readonly data-set>
                                                    </div>
                                                    <span class="m-blank">~</span>
                                                    <div class="col-25">
                                                        <label for="" class="hidden-text">종료일</label>
                                                        <input type="text" class="form date" placeholder="날짜를 선택하세요" name="e_date" value="<?=set_value('e_date')?>" readonly>
                                                    </div>
                                                    <?=form_error('s_date','<div class="col-error">', '</div>')?>
                                                    <?=form_error('e_date','<div class="col-error">', '</div>')?>
                                                    <div class="calendar-panel">
                                                        <p class="cal-info"><span class="fas fa-info-circle gray-6 m-r-5"></span>날짜를 선택해주세요.</p>
                                                        <div class="calendar" id="calMulti1"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>노출플랫폼</th>
                                            <td>
                                                <div class="col-100">
                                                    <input type="radio" id="device_type" name="device_type" value="ALL" checked>
                                                    <label class="radio-label" for="device_type"><span></span>모두</label>

                                                    <input type="radio" id="device_type2" name="device_type" value="PC">
                                                    <label class="radio-label" for="device_type2"><span></span>PC</label>

                                                    <input type="radio" id="device_type3" name="device_type" value="MOBILE">
                                                    <label class="radio-label" for="device_type3"><span></span>모바일</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>쿠키사용</th>
                                            <td>
                                                <div class="col-100">
                                                    <input type="radio" id="cookie_yn" name="cookie_yn" value="Y" checked>
                                                    <label class="radio-label" for="cookie_yn"><span></span>쿠키사용</label>
                                                    <input type="radio" id="cookie_yn2" name="cookie_yn" value="N">
                                                    <label class="radio-label" for="cookie_yn2"><span></span>쿠키사용안함</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>팝업이미지(PC)*</th>
                                            <td>
                                                <div class="preview-img"></div>
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
                                                        <input type="file" name="userfile[]" id="input_file" class="upload-hidden" accept="image/*" value="<?=set_value('userfile[0]')?>">
                                                        <?=form_error('userfile[0]','<div class="col-error">', '</div>')?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>팝업이미지(Mobile)*</th>
                                            <td>
                                                <div class="preview-img"></div>
                                                <div class="file">
                                                    <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                    <span class="ico-file-cancel"></span>
                                                    <br>
                                                    <div class="col-100 m-t-8">
                                                        <label class="btn typeA-blue pointer btn-file" for="input_file2"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                        <span class="help">
                                                            <div class="tooltip">
                                                                <div class="tooltip-box">
                                                                    <p>권장 이미지 사이즈는<br>가로 400px 세로(400~500px)입니다.</p>
                                                                </div>
                                                            </div>
                                                        </span>
                                                        <input type="file" name="userfile[]" id="input_file2" class="upload-hidden" accept="image/*" value="<?=set_value('userfile[1]')?>">
                                                        <?=form_error('userfile[1]','<div class="col-error">', '</div>')?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>링크주소</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">링크주소</label>
                                                    <input type="text" class="form" name="link_url" value="<?=set_value('link_url')?>" placeholder="링크 사용시 주소를 입력해주세요.">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>링크타켓</th>
                                            <td>
                                                <div class="col-100">
                                                    <input type="radio" id="link_target" name="link_target" value="_SELF" checked>
                                                    <label class="radio-label" for="link_target"><span></span>현재창</label>
                                                    <input type="radio" id="link_target2" name="link_target" value="_BLANK">
                                                    <label class="radio-label" for="link_target2"><span></span>새창</label>
                                                </div>
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <th>사용여부</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">사용여부</label>
                                                    <select class="form" name="open_yn">
                                                        <option value="N">대기</option>
                                                        <option value="Y">진행</option>                                                        
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
                                    <button class="btn typeA-darkgray" onclick="history.back(); return false;">취소</button>
                                    <button type="submit" class="btn typeA-blue" id="write_btn">저장</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //각 페이지 별 -->
        </div><!-- //바디 -->
    </div>    

    <script type="text/javascript">
    function init() {
        window.datepicker = new Datepickk();

        /*Set minDate*/
        var today = new Date();
        datepicker.minDate = new Date(today.getFullYear(),today.getMonth(),today.getDate());

        /*Set container*/
        datepicker.container = document.querySelector('#calendar');

        // 최대 선택 가능한 날
        /*Set maxSelections*/
        datepicker.maxSelections = 3;

        /*Set lang*/
        datepicker.lang = 'kr';

        datepicker.show();

        // 날짜 선택 시
        datepicker.onSelect = function(checked) {
            var state = (checked)?'selected':'unselected';
            console.log('[onSelect] ' + this.toLocaleDateString() + ' - ' + state);


            function reset()
            {
                var highlight = {
                    start: new Date(datepicker.el._data[0]),
                    end: new Date(datepicker.el._data[1]),
                    backgroundColor: '',
                    color: '',
                };
                datepicker.highlight = highlight;

                datepicker.el._data.length = 0;
                datepicker.unselectAll();

                $('#startDate')[0].value = '';
                $('#endDate')[0].value = '';
            }


            if (checked) {

                if (!datepicker.el._data) {
                    datepicker.el._data = [];
                }

                console.log('[onSelect] set day ['+this.toLocaleDateString()+']');
                datepicker.el._data.push(this);

                // 두 날짜 이후 새로운 날짜 선택시
                if (datepicker.el._data.length == 3) {
                    reset();
                    datepicker.selectDate(this);

                    console.log('[onSelect] reset and new selected day ['+this.toLocaleDateString()+']');
                }

                // 두개의 날자 선택 시
                else if (datepicker.el._data.length == 2) {

                    // 두 날짜간의 시간차
                    var days = (new Date(datepicker.el._data[1]) - new Date(datepicker.el._data[0]))/1000/60/60/24;

                    console.log('[onSelect] set day ['+datepicker.el._data[0]+'] ~ ['+datepicker.el._data[1]+'] days['+days+']');

                    // 두번째 날짜가 과거일 경우
                    if (days < 0) {
                        reset();    
                        datepicker.selectDate(this);

                        console.log('[onSelect] past - reset and new selected day ['+this.toLocaleDateString()+']');
                    }
                    // 최대 날자 이상 선택시
                    // else if (days > 4) {
                    //     reset();

                    //     alert('예약은 최대 4박까지만 가능합니다.');
                    //     console.log('[onSelect] Max Range Over selecte days max');
                    // }
                    else {
                        var highlight = {
                            start: new Date(datepicker.el._data[0]),
                            end: new Date(datepicker.el._data[1]),
                            backgroundColor: '#057bd9',
                            color: '#ffffff',
                        };
                        datepicker.highlight = highlight;

                        $('#startDate')[0].value = datepicker.el._data[0].toLocaleDateString().slice(0, -1);
                        $('#endDate')[0].value = datepicker.el._data[1].toLocaleDateString().slice(0, -1);
                        $('#calendar').hide();
                    }
                }
            }
            else {

                // 기존에 선택되어 있던 날짜가 있는 상태에서 취소가 들어온다는건 해당 날짜를 다시 누른경우
                if (datepicker.el._data.length == 2) {
                    reset();
                    datepicker.selectDate(this);
                }
                else if (datepicker.el._data.length == 1) {
                    reset();
                    datepicker.selectDate(this);
                }
            }
        };
    }
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