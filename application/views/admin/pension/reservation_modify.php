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
    <!--//Page Level include --> 

    <!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {

            $("#write_btn").click(function() {                
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
                            <h2>실시간예약 관리</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">실시간예약관리</a></li>
                                <li><a href="#">실시간예약조회</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id="write_action"')?>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="10%">
                                        <!-- <col width="23%">
                                        <col width="10%">
                                        <col width="23%">
                                        <col width="10%">
                                        <col width="23%">
                                        <col width="23%"> -->
                                    </colgroup>
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>예약자명</th>
                                            <td><?=$views->reserve_name;?></td>
                                            <th>연락처</th>
                                            <td><?=$views->reserve_phone;?></td>                                                                       
                                            <th>이메일</th>
                                            <td colspan="3"><?=$views->reserve_email;?></td>
                                        </tr>
                                        <tr>
                                            <th>객실명</th>
                                            <td><?=$views->room_name;?></td>
                                            <th>투숙기간</th>
                                            <td>
                                                <?php
                                                $s_date = new DateTime($views->stay_s_date);
                                                $e_date = new DateTime($views->stay_e_date);

                                                $diff = date_diff($s_date, $e_date);
                                                ?>
                                                <?=substr($views->stay_s_date,0,10); ?> ~ <?=substr($views->stay_e_date,0,10); ?> (<?=$diff->days?>박)
                                            </td>                                            
                                            <th>예약일</th>
                                            <td><span class="color-positive"><?=$views->reservation_date;?></span></td>
                                            <th>예약플랫폼</th>
                                            <td><?=$views->isMobile;?></td>
                                        </tr>
                                        <tr>
                                            <th>총인원</th>
                                            <td><?=$views->total_number."명";?></td>
                                            <th>추가인원</th>
                                            <td><?php  if($views->additional_number!='') echo $views->additional_number."명"; else echo "없음"; ?></td>                                        
                                            <th>부가서비스</th>
                                            <td><?=$views->reserve_options;?></td>                                       
                                        </tr>
                                        <tr>
                                            <th>예약메모</th>
                                            <td colspan="8"><?=$views->reserve_memo;?></td>                                            
                                        </tr>                                     
                                        <tr>
                                            <th>예상이용금액</th>
                                            <td colspan="8"><span class="color-positive"><?=number_format($views->estimate_cost);?>원</span></td>                                            
                                        </tr>
                                        <tr>
                                            <th>이용금액내역</th>
                                            <td colspan="8"><span class="color-positive">
                                                1) 객실이용료 : <?=number_format($roomCharge['roomTotPrice']);?> (<?=$diff->days?>박) <br> 

                                                2) 추가인원요금 : <?php if($views->additional_number!=''){ ?>

                                                    <?=number_format($roomCharge['addTotPrice'])."(".$views->additional_number."인)";?>

                                                <?php 
                                                    }else{

                                                        echo "없음";
                                                    }
                                                ?>
                                                <br> 
                                                3) 부가서비스 : <?php if($optCharge!=0){ ?>

                                                    <?=number_format($optCharge);?>(<?=$views->reserve_options;?>) 
                                                
                                                <?php 
                                                    }else{

                                                        echo "선택안함";
                                                    }
                                                ?>
                                                <br><br>
                                                4) 합계 : <?php echo number_format((int)$roomCharge['roomTotPrice'] + (int)$roomCharge['addTotPrice'] + (int)$optCharge) ?>원
                                            </td>                                            
                                        </tr>
                                        <tr>
                                            <th>예약상태</th>
                                            <td colspan="8">
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">예약상태</label>
                                                    <select class="form" name="reserve_status">
                                                        <option value="done" <?php if($views->reserve_status=='done') echo "selected"; ?>>예약완료</option>
                                                        <option value="cancel_doing" <?php if($views->reserve_status =='cancel_doing') echo "selected"; ?>>취소요청</option>
                                                        <option value="cancel_done" <?php if($views->reserve_status =='cancel_done') echo "selected"; ?>>취소완료</option>                                                       
                                                    </select>                                                    
                                                </div>
                                                <?php 
                                                    if($views->reserve_status =='cancel_doing'){
                                                ?>
                                                    <div class="col-50">취소일시 : <?=substr($views->cancel_date,0,16);?></div>    
                                                <?php
                                                    }
                                                ?>
                                            </td>                                            
                                        </tr>
                                         <tr>
                                            <th>결제상태</th>
                                            <td colspan="8">
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">결제상태</label>
                                                    <select class="form" name="payment_status">
                                                        <option value="doing" <?php if($views->payment_status=='doing') echo "selected"; ?>>입금대기</option>
                                                        <option value="done" <?php if($views->payment_status =='done') echo "selected"; ?>>입금완료</option>
                                                        <option value="cancel" <?php if($views->payment_status =='cancel') echo "selected"; ?>>환불완료</option>                                                       
                                                    </select>                                                    
                                                </div>                                          
                                            </td>                                            
                                        </tr>              
                                        <tr>
                                            <th>최종금액</th>
                                            <td colspan="8">
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">예상금액</label>
                                                    <input type="number" class="form" name="total_sum" id="total_sum" placeholder="숫자만입력" value="<?=$views->total_sum;?>">
                                                </div>    
                                            </td>                                            
                                        </tr>
                                        <tr>
                                            <th>최종금액내용메모</th>
                                            <td colspan="8">  
                                                <div class="col-100">                                              
                                                    <label for="" class="hidden-text">최종금액내용</label>
                                                    <textarea class="table-textarea" name="total_sum_desc" rows="3"><?=$views->total_sum_desc;?></textarea>
                                                </div>    
                                            </td>                                                                
                                        </tr>   
                                        <tr>
                                            <th>처리상태</th>
                                            <td colspan="8">
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">처리여부</label>
                                                    <select class="form" name="confirm_result">
                                                        <option value="done" <?php if($views->confirm_result=='done') echo "selected"; ?>>처리완료</option>
                                                        <option value="doing" <?php if($views->confirm_result =='doing') echo "selected"; ?>>대기</option>                                                        
                                                    </select>
                                                </div>    
                                            </td>                                            
                                        </tr>                                                  
                                        <tr>
                                            <th>처리결과메모</th>
                                            <td colspan="8"> 
                                                <div class="col-100">                                               
                                                    <label for="" class="hidden-text">처리결과메모</label>
                                                    <textarea class="table-textarea" name="confirm_result_memo" rows="3"><?=$views->confirm_result_memo;?></textarea>
                                                </div>   
                                            </td>                                                                
                                        </tr>
                                        <tr>
                                            <th>처리일자</th>
                                            <td colspan="8"><?=substr($views->submit_date,0,16);?></td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="content-area clearfix">
                                <div class="btn-group fl-l">
                                    <button class="btn typeA-gray" onclick="goDelete('<?=$this->config->item('ADMIN_ROOT'); ?>/pension/reservation/delete/<?=$views->idx ?>')">삭제</button>
                                </div>
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