<?php
include('./core/inc.php');
session_start();
$page = new template;
$log = 0;
?>
<!doctype html>
<html xmlns="//www.w3.org/1999/xhtml">
<?php
$page->header_page($title);
?>

<body>
<!-- Layer pop banner -->
    <!-- // Layer pop -->
    <!-- TOP_Brandbar -->
    <?php $page->top_bar(); ?>
    <!-- TOP_Brandbar -->
<!-- TOP_PROMOTION -->
		<!--// TOP_PROMOTION -->
<div id="wrap">
    <!-- GNB -->
	<?php $page->gnb(); ?>
    <!--// GNB -->
    <!-- CONTENTS_LAYOUT -->
    <div class="substance">
    	<!-- LNB -->
		<?php $page->lnb(); ?>
    	<!--// LNB -->
        <!-- CONTENTS -->
		
<script type="text/javascript">
	function noticeView(n) {
		var url = "/news/notice.php";

		url += "?id=" + n;

		document.location.href = url;
	}
</script>
		<div class="contents">
        	<div class="main_banner">
				<div class="main_slide">
					<?php
					$query = "SELECT * FROM notice_slide WHERE slide_enable = 't' ORDER BY slide_date DESC LIMIT 6";
					$row = db::fetch_all($query);
					foreach ($row as $r){
						echo '<div class="item"><a href="'.$r['slide_url'].'" target="_blank"><img src="'.$r['slide_img'].'" alt="'.$r['slide_title'].'"></a></div>';
					}
					?>
	                    <!--<div class="item"><a href="https://pb.tamgame.com/news/notice/view.do?page=1&idx=2061" target='_blank'><img src="/images/content/tg_basladi_rb_en.jpg" alt="ADVANTAGEOUS TAM GOLD ERA HAS BEGUN!"></a></div>
	                    <div class="item"><a href="https://pb.tamgame.com/news/notice/view.do?page=1&idx=1945"><img src="/images/content/space_RB_AR.jpg" alt="نمط جديد Space Mode"></a></div>
	                    <div class="item"><a href="https://pb.tamgame.com/news/notice/view.do?page=1&idx=1896"><img src="/images/content/update_RB_AR.jpg" alt="V3 Patch Note"></a></div>
	                    <div class="item"><a href="https://pb.tamgame.com/news/notice/view.do?page=1&idx=1944"><img src="/images/content/char_RB_AR.jpg" alt="شخصيات جديدة الأن فى الاسواق"></a></div>
	                    <div class="item"><a href="https://pb.tamgame.com/news/notice/view.do?page=1&idx=1866" target='_top'><img src="/images/content/WEB-RB_S1-Arena-2_W2-Duyuru-ENG.jpg" alt="2018/1 Arena-2 W2 Ann ENG"></a></div>
	                    <div class="item"><a href="https://pb.tamgame.com/news/notice/view.do?page=1&idx=1860" target='_top'><img src="/images/content/WEB-RB_Arena-2_Chart-Duyuru-ENG.jpg" alt="2018/1 Arena-2 Chart Ann"></a></div>
	                    <div class="item"><a href="https://pb.tamgame.com/news/notice/view.do?page=1&idx=1844" target='_top'><img src="/images/content/WEB-RB_Arena-1_W2-Duyuru-ENG.jpg" alt="2018/1 Arena-1 W2 Ann ENG"></a></div>
	                    <div class="item"><a href="https://www.tamgame.com/account/member/register.do" target='_blank'><img src="/images/content/RB_pb_eng_temp.jpg" alt="PB - Register Now"></a></div>-->
	                </div>
				<div class="main_news">
            	<div class="news">
            	                    <p class="main_tit"><a style="text-transform:uppercase;">News</a><span class="more"></span></p>
                    <ul class="special">
                        <li class="thumb">
                        <p class="bul"><img src="/images/en/common/bul_thumb_news.png"></p>                                                	<p><a href="javascript:noticeView(1981);"><img src="/images/content/bakimnotlari_thumb_ar.jpg"></a></p>
                                                </li>
                        <li class="cont">
                        	<p class="title"><a href="javascript:noticeView(1981);">Patch Notes for May 23rd 2018</a></p>
                            <p class="txt"><a href="javascript:noticeView(1981);">Dear Players</a></p>
                            <p class="date">23 May, 2018</p>
                        </li>
                    </ul>
                    <ul class="list">
						<?php
						$query = "SELECT * FROM notice_news WHERE news_enable = 't' ORDER BY news_date DESC LIMIT 4";
						$row = db::fetch_all($query);
						foreach ($row as $r){
							$_date = strtotime($r['news_date']);
							$date = date('j F, Y', $_date);
							echo '<li><a href="javascript:noticeView('.$r['news_id'].');">'.$r['news_title'].'</a><span>'.$date.'</span></li>';
						}
						?>
                                            <!--<li><a href="javascript:noticeView(1970);">جوائز بقيمة 25 دولار</a> <span>08 May, 2018</span></li>
                                            <li><a href="javascript:noticeView(1969);">عروض رمضان 2018</a> <span>08 May, 2018</span></li>
                                            <li><a href="javascript:noticeView(1968);">فعالية الحضور</a> <span>08 May, 2018</span></li>-->
					</ul>
                </div>
            </div>
            </div>
			<link rel="stylesheet" href="/css/3/owl.carousel.min.css" media="screen">
			<script src="/js/3/owl.carousel.min.js"></script>
			<script type="text/javascript">
				$(document).ready( function() {
					$owlContainer = $('.main_slide');
					$owlSlides = $owlContainer.children('div');
					if ($owlSlides.length > 1) {
						$owlContainer.owlCarousel({
							animateOut: 'fadeOut',
							navigation : false,
							loop:true,
							slideSpeed : 300,
							autoplay:true,
							autoplayTimeout:5000,
							autoplayHoverPause:true,
							items: 1,
							paginationSpeed : 400,
							mouseDrag: false,
							singleItem:true,
														dots: !0
						});
					} else {
						
					}
				});
			</script>
        </div>
		<!--<div style="float: left; width: 1000px; background: url(images/main/chat_bg.jpg); padding: 20px 0 13px 20px; ">
			<p class="main_tit"><a style="text-decoration: none;">CHATBOX</a></p>
			<div style="width: 980px; height: 200px; margin-top: 10px; background-color: yellow;">
			</div>
			<div style="width: 980px; height: 30px; background-color: red;">
				<input type="text">
			</div>
		</div>-->
	</div>
    <!--// CONTENTS_LAYOUT -->
    <?php
	$page->footer_page();
	?>
</div>
</body>
</html>
		