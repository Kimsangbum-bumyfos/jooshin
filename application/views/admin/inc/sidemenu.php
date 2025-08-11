<!-- 사이드메뉴 -->
<div class="sidebar">
    <div class="sidebar-scroll">
        <div class="nav">
            <ul>
                
                <!--// 고객문의관리(customer) -->
                <li class="<?php if($this->uri->segment(3)== 'inquire') echo "active"; ?>"><a href="<?=$this->config->item('ADMIN_ROOT'); ?>/customer/inquire">
                        <span class="fas fa-question-circle fa-fw nav-icon"></span><span class="list-name"><?=$this->config->item('Inquire'); ?></span></a>
                </li>
                <!--// 고객문의관리(customer) -->


                <!-- 메인관리(contents) -->
                <?php
                    //사이드 메뉴 링크 이동 시 활성화를 위한 스타일 셋팅
                    $sideMenuStyle ="";
                    if($this->uri->segment(2)=='contents'){
                        $sideMenuStyle = "style='display:block;' ";                        
                    }
                ?>
                <li class="<?php if($this->uri->segment(2)=='contents') echo "active";?>"><a href="<?=$this->config->item('ADMIN_ROOT'); ?>/contents/popup"><span class="fas fa-desktop nav-icon"></span><span class="list-name"><?=$this->config->item('content'); ?></span></a><a href="#" class="ico-list-toggle"></a>
                    <ul class="sub-list" <?=$sideMenuStyle ?> >
                        <li class="<?php if($this->uri->segment(2)=='contents' && $this->uri->segment(3)=='popup') echo "active"; ?>">
                            <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/contents/popup"><span class="ico-sub-2"></span><?=$this->config->item('popup'); ?></a>
                        </li>
                        <li class="<?php if($this->uri->segment(2)=='contents' && $this->uri->segment(3)=='mainSlide') echo "active"; ?>">
                            <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/contents/mainSlide"><span class="ico-sub-2"></span><?=$this->config->item('mainSlide'); ?></a>
                        </li>
                    </ul>
                </li><!--// 메인관리(contents) -->


                <!-- 메뉴콘텐츠관리(posts) -->
                <!-- <li class="<?php if($this->uri->segment(3)== 'post') echo "active"; ?>"><a href="<?=$this->config->item('ADMIN_ROOT'); ?>/posts/post">
                        <span class="fas fa-clone fa-fw nav-icon"></span><span class="list-name"><?=$this->config->item('posts'); ?></span></a>
                </li> -->
                <!-- 메뉴콘텐츠관리(posts) -->


                <!-- 게시판관리 (board) -->
                <?php
                    //사이드 메뉴 링크 이동 시 활성화를 위한 스타일 셋팅
                    $sideMenuStyle ="";
                    if($this->uri->segment(2)=='board'){
                        $sideMenuStyle = "style='display:block;' ";                        
                    }
                ?>
                <!-- <li class="<?php if($this->uri->segment(2)=='board') echo "active";?>"><a href="<?=$this->config->item('ADMIN_ROOT'); ?>/board/faq"><span class="fas fa-pencil-alt fa-fw nav-icon"></span><span class="list-name"><?=$this->config->item('board'); ?></span></a><a href="#" class="ico-list-toggle"></a>
                    <ul class="sub-list" <?=$sideMenuStyle ?>>
                        <li class="<?php if($this->uri->segment(2)=='board' && $this->uri->segment(3)=='faq') echo "active"; ?>">
                            <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/board/faq"><span class="ico-sub-1"></span><?=$this->config->item('faq'); ?></a>
                        </li>
                        <li class="<?php if($this->uri->segment(2)=='board' && $this->uri->segment(3)=='notice') echo "active"; ?>">
                            <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/board/notice"><span class="ico-sub-2"></span><?=$this->config->item('notice'); ?></a>
                        </li>
                        <li class="<?php if($this->uri->segment(2)=='board' && $this->uri->segment(3)=='event') echo "active"; ?>">
                            <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/board/event"><span class="ico-sub-2"></span><?=$this->config->item('event'); ?></a>
                        </li>
                    </ul>
                </li> -->
                <!--// 게시판관리 (board) -->

                <!-- 실시간예약관리 (reservation) -->
                <!-- <li class="<?php if($this->uri->segment(3)=='reservation' && $this->uri->segment(2)=='pension') echo "active"; ?>"><a href="<?=$this->config->item('ADMIN_ROOT'); ?>/pension/reservation"><span class="fas fa-th fa-fw nav-icon"></span><span class="list-name"><?=$this->config->item('pension_reservation'); ?></span></a></li> -->
                <!--// 실시간예약관리 (reservation) -->

                <!-- 제품관리(product) -->
                <li class="<?php if($this->uri->segment(3)== 'product') echo "active"; ?>"><a href="<?=$this->config->item('ADMIN_ROOT'); ?>/products/product">
                        <span class="fas fa-gift fa-fw nav-icon"></span><span class="list-name"><?=$this->config->item('products'); ?></span></a>
                </li>
                <!-- // 제품관리(product) -->
                <!-- 시험및용역관리(testingService) -->
                <li class="<?php if($this->uri->segment(3)== 'service') echo "active"; ?>"><a href="<?=$this->config->item('ADMIN_ROOT'); ?>/services/service">
                        <span class="fas fa-file-alt fa-fw nav-icon"></span><span class="list-name"><?=$this->config->item('services'); ?></span></a>
                </li>
                <!-- // 시험및용역관리(testingService) -->

                <!--  회원관리 -->
                <!-- <li class="<?php if($this->uri->segment(3)=='member' && $this->uri->segment(2)=='user') echo "active"; ?>">
                    <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/user/member"><span class="fas fa-user nav-icon"></span>
                        <span class="list-name"><?=$this->config->item('member'); ?></span>
                    </a>
                </li> -->
                <!--//회원관리 -->

                <!--  관리자관리 user -->
                <li class="<?php if($this->uri->segment(3)== 'super') echo "active"; ?>"><a href="<?=$this->config->item('ADMIN_ROOT'); ?>/user/super"><span class="fas fa-lock fa-fw nav-icon"></span><span class="list-name"><?=$this->config->item('super'); ?></span></a></li>
                <!--//  관리자관리 user -->
                
                <!-- 지점관리 (branch) -->
                <!-- <li class="<?php if($this->uri->segment(2)=='branch') echo "active"; ?>"><a href="<?=$this->config->item('ADMIN_ROOT'); ?>/branch"><span class="fas fa-building nav-icon"></span><span class="list-name"><?=$this->config->item('branch'); ?></span></a></li> -->
                <!--// 지점관리 (branch) -->

                
              <!--   <li class="<?php if($this->uri->segment(2)=='smsMgr') echo "active"; ?>">
                    <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/smsMgr"><span class="fas fa-comment-alt nav-icon"></span>
                        <span class="list-name"><?=$this->config->item('sms'); ?></span>
                    </a>
                </li>  -->
           

                <?php
                //사이드 메뉴 링크 이동 시 활성화를 위한 스타일 셋팅
                $sideMenuStyle ="";
                if($this->uri->segment(2)=='setting'){
                    $sideMenuStyle = "style='display:block;' ";
                }
                ?>
                <li class="<?php if($this->uri->segment(2)=='setting') echo "active"; ?>"><a href="<?=$this->config->item('ADMIN_ROOT'); ?>/setting/info"><span class="fas fa-cog nav-icon"></span><span class="list-name"><?=$this->config->item('setting'); ?></span></a><a href="#" class="ico-list-toggle"></a>
                    <ul class="sub-list" <?=$sideMenuStyle?>>
                        <li class="<?php if($this->uri->segment(3)=='info' && $this->uri->segment(2)=='setting') echo "active";?>">
                            <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/setting/info"><span class="ico-sub-1"></span><?=$this->config->item('basic_setting'); ?></a>
                        </li>
                        <li class="<?php if($this->uri->segment(3)=='api' && $this->uri->segment(2)=='setting') echo "active";?>">
                            <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/setting/api"><span class="ico-sub-1"></span><?=$this->config->item('api_setting'); ?></a>
                        </li>
                        <li class="<?php if($this->uri->segment(3)=='sns' && $this->uri->segment(2)=='setting') echo "active";?>">
                            <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/setting/sns"><span class="ico-sub-1"></span><?=$this->config->item('sns_setting'); ?></a>
                        </li>
                        <!-- <li class="<?php if($this->uri->segment(3)=='cms' && $this->uri->segment(2)=='setting') echo "active";?>">
                            <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/setting/cms"><span class="ico-sub-1"></span><?=$this->config->item('cms_setting'); ?></a>
                        </li> -->
                        <!-- <li class="<?php if($this->uri->segment(3)=='menu' && $this->uri->segment(2)=='setting') echo "active";?>">
                            <a href="<?=$this->config->item('ADMIN_ROOT'); ?>/setting/menu"><span class="ico-sub-1"></span><?=$this->config->item('menu_setting'); ?></a>
                        </li> -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-footer">
        <p class="copyright"><?=$this->config->item('ADMIN_COPYRIGHT'); ?></p>
    </div>
</div><!-- //사이드메뉴 -->
<script>var base_url = "<?=base_url()?>";</script>