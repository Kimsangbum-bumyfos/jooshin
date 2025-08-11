<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?=$this->config->item('GOOGLE_ANALYTICS_CODE')?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?=$this->config->item('GOOGLE_ANALYTICS_CODE')?>');
</script>

<!-- Naver Analytics -->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
if(!wcs_add) var wcs_add = {};
wcs_add["wa"] = "<?=$this->config->item('NAVER_ANALYTICS_CODE')?>";
wcs_do();
</script>

<script>var base_url = "<?=base_url()?>";</script>