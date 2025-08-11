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
                                        <col width="23%">
                                        <col width="10%">
                                        <col width="23%">
                                        <col width="10%">
                                        <col width="23%">
                                    </colgroup>
                                    <thead>
                                                                            
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>이름/생년월일</th>
                                            <td><?=$views->reserve_name;?> (<?=$views->reserve_birth;?>) </td>
                                            <th>예약일</th>
                                            <td><?=$views->reserve_date;?> (<?=$views->isMobile;?>)</td>
                                            <th>연락처</th>
                                            <td><?=$views->reserve_phone;?></td>                                                                        
                                        </tr>
                                        <tr>
                                            <th>신청차량</th>
                                            <td><?=$views->car_name;?> (<?=$views->car_type;?>)</td>
                                            <th>대여기간</th>
                                            <td>
                                                <?php
                                                $s_date = new DateTime($views->rental_s_date);
                                                $e_date = new DateTime($views->rental_e_date);

                                                $diff = date_diff($s_date, $e_date);
                                                ?>
                                                <?=substr($views->rental_s_date,0,16); ?> ~ <?=substr($views->rental_e_date,0,16); ?> (<?=$diff->days?>일<?=$diff->h?>시간)
                                            </td>
                                            <th>대여지점</th>
                                            <td><?=$views->rental_branch;?>(<?=$views->rental_area;?>)</td>
                                        </tr>
                                        <tr>
                                            <th>보험여부</th>
                                            <td><?=$views->insur_svc;?></td>
                                            <th>배차</th>
                                            <td><?php if($views->operate_svc =='Y') echo "선택"; else echo "선택안함";?></td>
                                            <th>회차</th>
                                            <td><?php if($views->release_svc =='Y') echo "선택"; else echo "선택안함";?></td>          
                                        </tr>
                                        <tr>
                                            <th>예상금액</th>
                                            <td colspan="6"><span class="color-positive"><?=number_format($views->estimate);?>원</span></td>                                            
                                        </tr>
                                        <tr>
                                            <th>최종금액</th>
                                            <td colspan="6">
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">예상금액</label>
                                                    <input type="number" class="form" name="total_sum" id="total_sum" placeholder="숫자만입력" value="<?=$views->total_sum;?>">
                                                </div>    
                                            </td>                                            
                                        </tr>
                                        <tr>
                                            <th>최종금액내용</th>
                                            <td colspan="6">  
                                                <div class="col-100">                                              
                                                    <label for="" class="hidden-text">최종금액내용</label>
                                                    <textarea class="table-textarea" name="total_sum_desc" rows="3"><?=$views->total_sum_desc;?></textarea>
                                                </div>    
                                            </td>                                                                
                                        </tr>   
                                        <tr>
                                            <th>처리여부</th>
                                            <td colspan="6">
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">처리여부</label>
                                                    <select class="form" name="process_result">
                                                        <option value="Y" <?php if($views->process_result =='Y') echo "selected"; ?>>완료</option>
                                                        <option value="N" <?php if($views->process_result =='N') echo "selected"; ?>>대기</option>
                                                        <option value="C" <?php if($views->process_result =='C') echo "selected"; ?>>취소</option>
                                                    </select>
                                                </div>    
                                            </td>                                            
                                        </tr>                                                  
                                        <tr>
                                            <th>처리결과메모</th>
                                            <td colspan="6"> 
                                                <div class="col-100">                                               
                                                    <label for="" class="hidden-text">처리결과메모</label>
                                                    <textarea class="table-textarea" name="process_result_memo" rows="3"><?=$views->process_result_memo;?></textarea>
                                                </div>   
                                            </td>                                                                
                                        </tr>
                                        <tr>
                                            <th>처리일자</th>
                                            <td colspan="6"><?=substr($views->submit_date,0,16);?></td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="content-area clearfix">
                                <div class="btn-group fl-l">
                                    <button class="btn typeA-gray" onclick="goDelete('<?=$this->config->item('ADMIN_ROOT'); ?>/rent/reservation/delete/<?=$views->idx ?>')">삭제</button>
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