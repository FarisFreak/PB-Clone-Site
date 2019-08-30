<?php error_reporting(0); include $_SERVER['DOCUMENT_ROOT'].'/core/inc.php'; session_start(); $page=new template; $log=0 ; ?>
<!doctype html>
<html xmlns="//www.w3.org/1999/xhtml">
<?php $page->header_page($title); ?>
<script>
	function List(){
		document.location.href = "./list.php";
	}
</script>
<body>
    <?php $page->top_bar(); ?>
    <div id="wrap">
        <?php $page->gnb(); ?>
        <div class="substance">
            <?php $page->lnb(); ?>

            <div class="contents">
			<?php
			$db = new db;
			$id = $db -> escape_string($_GET['id']);
			$_query = "SELECT * FROM notice_news WHERE news_id = '$id'";
			//$query = $db -> query($_query);
			$result = $db -> num_rows($_query);
			//
			$news_title = "";
			$news_date = "";
			$news_post = "";
			//
			if ($result == 0){
				echo '<script>window.location = "/index.php";</script>';
			}else{
				$news = $db -> fetch_assoc($_query);
				
				$_date = strtotime($news['news_date']);
				
				$news_title = $news['news_title'];
				$news_date = date('j F, Y', $_date);
				$news_post = nl2br($news['news_post']);
			}
			?>
                <div class="sub_title">News</div>
                <div class="sub_contents">
                    <ul class="bbs_view_tit">
                        <li class="tit"><?php echo $news_title; ?></li>
                        <li class="date">
                            <?php echo $news_date; ?></li>
                    </ul>
                    <div class="bbs_view">
						<?php echo $news_post; ?>
                    </div>
                    <div class="cont_btn">
                        <p class="btn"><span class="btn_cont_w135"><a class="btn" href="javascript:void(0);" onclick="List();">List</a></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php $page->footer_page(); ?>
    </div>
</body>

</html>
