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

                if ($("#peak_title").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("성수기명을 입력해 주세요.");
                    $("#peak_title").focus();
                    return;
                }else if($("#s_date").val() == ''){
                    showModal('#popupModal');
                    $("#popup-msg").text("성수기 시작일을 입력해 주세요.");
                    $("#s_date").focus();
                    return;
                }else if($("#e_date").val() == ''){
                    showModal('#popupModal');
                    $("#popup-msg").text("성수기 종료일을 입력해 주세요.");
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
                            <h2>성수기관리 - 등록</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">성수기관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id="write_action"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <fieldset>
                                <legend class="hidden-text">성수기관리등록</legend>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="180">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th>성수기명</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">성수기명</label>
                                                    <input type="text" class="form" name="peak_title" id="peak_title" value="<?=set_value('title')?>">
                                                </div>
                                                <?=form_error('peak_title','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>성수기유형</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">성수기유형</label>
                                                    <select class="form" name="peak_type">
                                                        <option value="01">성수기</option>
                                                        <option value="02">극성수기</option>                                       
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>성수기기간</th>
                                            <td>
                                                <div class="row">
                                                    <div class="calendar-form col-25">
                                                        <div>
                                                            <label for="" class="hidden-text">날짜지정</label>
                                                            <input type="text" class="form date" placeholder="날짜를 선택하세요" name="s_date" value="<?=set_value('s_date')?>" readonly>
                                                        </div>
                                                        <div class="calendar-panel cal-w100">
                                                            <p class="cal-info"><span class="fas fa-info-circle gray-6 m-r-5"></span>날짜를 선택해주세요.</p>
                                                            <div class="calendar notMinDate" id="calSingle1"></div>
                                                        </div>
                                                    </div>
                                                    <span>~</span>
                                                    <div class="calendar-form col-25">
                                                        <div>
                                                            <label for="" class="hidden-text">날짜지정</label>
                                                            <input type="text" class="form date" placeholder="날짜를 선택하세요"  name="e_date" value="<?=set_value('e_date')?>" readonly>
                                                        </div>

                                                        <div class="calendar-panel cal-w100">
                                                            <p class="cal-info"><span class="fas fa-info-circle gray-6 m-r-5"></span>날짜를 선택해주세요.</p>
                                                            <div class="calendar notMinDate" id="calSingle2"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?=form_error('s_date','<div class="col-error">', '</div>')?>
                                                <?=form_error('e_date','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>사용여부</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">사용여부</label>
                                                    <select class="form" name="use_yn">
                                                        <option value="Y">사용</option>
                                                        <option value="N">사용안함</option>                   
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