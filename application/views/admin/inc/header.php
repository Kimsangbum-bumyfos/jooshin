<!-- 헤더 -->
        <div class="header">
            <div class="logo-area">
                <a href="#"><h1>company Logo</h1></a>
            </div>
            <div class="gnb">
                <div class="gnb-menu">
                    <a href="#" class="ico-menu"><span class="hidden-text">메뉴열기/메뉴닫기</span></a>
                </div>            
                <ul class="gnb-items">
                    
                    <li class="gnb-item notice">
                        <a href="#" class="gnb-news">
                            <span class="hidden-text">메세지</span>
                            <span class="gnb-icon ico-news"></span>
                        </a>
                        <?php
                            //신규 실시간 예약 카운트가 있는 경우 파동 처리
                            $rCnt = get_customer('count'); 
                            if($rCnt>0){ 
                        ?>
                        <!-- 파동 -->
                        <div class="badge">
                            <span class="wave-dot"></span>
                            <span class="wave"></span>
                        </div>
                        <?php } ?>
                        <!-- 드롭다운패널 -->
                        <div class="dropdown-panel">
                            <div class="dropdown-header">
                                <div class="dr-title">
                                    <h3>고객문의</h3>
                                    <div class="dr-badge <?php if(get_customer('count')==0) echo "empty";?>"><?=get_customer('count'); ?></div>
                                </div>
                            </div>
                            <div class="dropdown-body">

                                <?php
                                    if(get_customer('count')==0){
                                ?>
                                <!-- 내용없음 -->
                                <div class="dr-content-empty">
                                    <p class="ico-empty"></p>
                                    <p>신규문의가없습니다.</p>
                                </div>
                                <?php 
                                    } 
                                ?>

                                <!-- 내용있음 -->
                                <ul class="dr-list-items">
                                    <?php
                                        //처리 안된 최신 고객센터 5개를 가져온다.
                                        $list = get_customer();
                                        foreach($list as $lt){
                                    ?>
                                        <li><a href="<?=$this->config->item('ADMIN_BASE_URL'); ?>/customer/inquire/modify/<?=$lt->idx;?>">
                                            <?=$lt->title;?>
                                            <span class="dr-list-date"><?=substr($lt->reg_date,0,10);?></span>
                                            </a>
                                        </li>
                                    <?php 
                                        } 
                                    ?>                                  
                                </ul>
                            </div>
                            <div class="dropdown-footer">
                                <button class="dr-btn" onclick="goPage('<?=$this->config->item('ADMIN_BASE_URL'); ?>/customer/inquire')">고객문의 전체보기&nbsp;<i class="fas fa-angle-right"></i></button>
                            </div>
                        </div>
                        <!-- //드롭다운패널 -->
                    </li>
                    <li class="gnb-item">
                        <a href="#" class="gnb-profile">
                            <img src="<?=$this->config->item('home_assets_url'); ?>/cms/img/dummy/user-profile1.jpg" class="gnb-profile-img" alt="">                            
                            <span class="user-name"><?=$this->session->userdata('auth_name')?></span>
                        </a>
                    </li>
                    <li class="gnb-item">
                        <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/auth/logout">
                            <span class="hidden-text">로그아웃</span>
                            <span class="gnb-icon ico-logout"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div><!-- //헤더 -->