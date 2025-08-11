<div id="skip_menu" class="header">
    <!-- drop down -->
    <div class="menu-drop-down">
        <div class="inner-drop">
            <ul id="drop_menu" class="drop-menu"></ul>
        </div>
    </div>
    <div class="header-area">
        <!-- menu-area -->
        <div class="menu-area">
            <label for="gnbSearch_m">
                <input type="text" id="gnbSearch_m" placeholder="검색어 입력">
                <span id="ico_gnbSearch_m" class="white"></span>
            </label>
            <div class="menu-btn-area">
                <span class="ico-btn-menu" title="메뉴" aria-label="전체 메뉴 버튼"></span>
            </div>
            <div class="logo-area">
               <a href="<?=base_url()?>" class="logo">
                    <h1 class="logo-header" style="background-image:url('<?=base_url()?><?=$this->config->item('SITE_LOGO_PC')?>');" aria-label="<?=$this->config->item('COMPANY_NAME')?>"></h1>
                </a>
            </div>
            <!-- menu-box -->
            <div class="menu-box clearfix">
                <div class="menu-box-title">
                    <span class="ico-cancel-white header-menu-close" aria-label="닫기"></span>
                </div>
                <!-- getMenu -->
                <ul class="nav-area"></ul>
                <!-- // getMenu -->

                <label for="gnbSearch">
                    <input type="text" id="gnbSearch" placeholder="검색어를 입력해주세요.">
                    <span id="ico_gnbSearch" class="white"></span>
                </label>
                <div class="m-logo">
                    <h2 style="background-image:url('<?=base_url()?><?=$this->config->item('SITE_LOGO_PC')?>');" aria-label="<?=$this->config->item('COMPANY_NAME')?>"></h2>
                </div>
            </div>
            <!-- // menu-box -->
        </div>
        <!-- // menu-area -->
    </div>
</div>