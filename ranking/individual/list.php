<?php error_reporting(0); include $_SERVER['DOCUMENT_ROOT'].'/core/inc.php'; session_start(); $page=new template; $log=0 ; ?>
<!doctype html>
<html xmlns="//www.w3.org/1999/xhtml">
<?php $page->header_page($title); ?>
<?php
			$totalp = 20;
			$type = isset($_GET['ranktype']) ? $_GET['ranktype'] : 'exp';
			$xpage = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$start = ($xpage>1) ? ($xpage * $totalp) - $totalp : 0;

			$result = "SELECT nick, rank, exp FROM jogador WHERE rank < 52 ORDER BY exp DESC, rank DESC LIMIT 100";
			$total = db::num_rows($result);
			$pages = ceil($total/$totalp);

			$qEXP = db::query("SELECT nick, rank, exp FROM jogador WHERE rank < 52 ORDER BY exp DESC, rank DESC LIMIT $totalp OFFSET $start");
			$qKILL = db::query("SELECT j.nick, j.rank, s.matou FROM jogador j LEFT JOIN jogador_estatisticas s ON j.id = s.player_id WHERE rank < 52 ORDER BY exp DESC, rank DESC LIMIT $totalp OFFSET $start");
			$qHEADSHOT = db::query("SELECT j.nick, j.rank, s.headshots FROM jogador j LEFT JOIN jogador_estatisticas s ON j.id = s.player_id WHERE rank < 52 ORDER BY exp DESC, rank DESC LIMIT $totalp OFFSET $start");

			$no=$start+1;
			
?>
<script>
	function GoPage(n) {
		var url = "/ranking/individual/list.php";
		var keyword = $('#keyword').val();

		url += "?page=" + n;
		url += "&ranktype=<?php echo $type; ?>";
		url += "&keyword=" + encodeURIComponent(keyword);

		document.location.href = url;
	}

	function GoSearch() {
		var url = "/ranking/individual/list.php";
		var keyword = $('#keyword').val();

		url += "?ranktype=elo";
		url += "&keyword=" + encodeURIComponent(keyword);

		document.location.href = url;
	}

	function GoRankType(n) {
		var url = "/ranking/individual/list.php";

		url += "?ranktype=" + n;

		document.location.href = url;
	}

	function getDetail(rank, nickname, ranktype) {

		var p = new Object();
		p.url = "getRankingDetail.php";
		p.parammeters = {
			"rank": rank,
			"nickname": nickname,
			"ranktype": ranktype
		};
		p.requestMethod = "POST";
		p.successHandler = function(rs) {
			if (rs == null || rs == undefined) {
				alert("Network error.");
			} else {
				if (rs.success == true) {
					setRankDetailView(true, rs.data, nickname)
				}
				if (rs.message.length > 0) {
					alert(rs.message);
				}
			}
		};

		SendAjax(p);
	}
</script>
<body>
    <?php $page->top_bar(); ?>
    <div id="wrap">
        <?php $page->gnb(); ?>
        <div class="substance">
            <?php $page->lnb(); ?>

            <div class="contents">
			
				<div class="sub_title">Individual Ranking</div>
				<div class="sub_contents_pnone">
					<div class="sub_tab_many_line">
						<ul class="sub_tab_many sub_tab_three <!--sub_tab_four-->">
							<li class="first<?php if ($type == 'exp') { echo '_on';} ?>"><a href="javascript:void(0);" onclick="GoRankType('exp')" class="btn">XP</a></li>
							<li class="basic<?php if ($type == 'killdeath') { echo '_on';} ?>"><a href="javascript:void(0);" onclick="GoRankType('killdeath')" class="btn">KILL/DEATH</a></li>
							<li class="last<?php if ($type == 'headshot') { echo '_on';} ?>"><a href="javascript:void(0);" onclick="GoRankType('headshot')" class="btn">HEADSHOT</a></li>
							<li style="display: none" class="last<?php if ($type == 'elo') {echo '_on';} ?>"><a href="javascript:void(0);" onclick="GoRankType('elo')" class="btn">ELO</a></li>
						</ul>
					</div>
					<div class="cont_p30">
						<table class="bbs_list_rank">
							<colgroup>
								<col style="width:114px">
								<col style="width:238px">
								<col style="width:218px">
								<col style="width:100px">
							</colgroup>
							<?php
							if ($type == "exp"){
								$query = $qEXP;
								?>
								<thead>
									<tr>
										<th>Ranking</th>
										<th>Nickname</th>
										<th>Rank</th>
										<th class="last">EXP</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while ($data = pg_fetch_assoc($query)){
										?>
										<tr class="<?php if ($no == 1) { echo "first";} ?>">
											<td class="rank"><?php echo $no; $no++; ?> <p class="rank_same"></p></td>
											<td class="nick"><a href="javascript:void(0);" onclick="javacript:getDetail('<?php echo $no; ?>', '<?php echo $data['nick'];?>', 'exp');return false;"><?php echo $data['nick'];?></a></td>
											<td class="rank_class"><img src="../../core/grade_image.php?type=player&no=<?php echo $data['rank']; ?>"><?php echo player::grade_name_null($data['rank']);?></td>
											<td class="gray"><?php echo $data['exp'];?></td>
										</tr>
										<?php
									}
									?>
								</tbody>
								<?php
							}else if ($type == "killdeath"){
								$query = $qKILL;
								?>
								<thead>
									<tr>
										<th>Ranking</th>
										<th>Nickname</th>
										<th>Rank</th>
										<th class="last">Kill</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while ($data = pg_fetch_assoc($query)){
										?>
										<tr class="<?php if ($no == 1) { echo "first";} ?>">
											<td class="rank"><?php echo $no; $no++; ?> <p class="rank_same"></p></td>
											<td class="nick"><a href="javascript:void(0);" onclick="javacript:getDetail('<?php echo $no; ?>', '<?php echo $data['nick'];?>', 'exp');return false;"><?php echo $data['nick'];?></a></td>
											<td class="rank_class"><img src="../../core/grade_image.php?type=player&no=<?php echo $data['rank']; ?>"><?php echo player::grade_name_null($data['rank']);?></td>
											<td class="gray"><?php echo $data['matou'];?></td>
										</tr>
										<?php
									}
									?>
								</tbody>
								<?php
							}else if ($type == "headshot"){
								$query = $qHEADSHOT;
								?>
								<thead>
									<tr>
										<th>Ranking</th>
										<th>Nickname</th>
										<th>Rank</th>
										<th class="last">Headshot</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while ($data = pg_fetch_assoc($query)){
										?>
										<tr class="<?php if ($no == 1) { echo "first";} ?>">
											<td class="rank"><?php echo $no; $no++; ?> <p class="rank_same"></p></td>
											<td class="nick"><a href="javascript:void(0);" onclick="javacript:getDetail('<?php echo $no; ?>', '<?php echo $data['nick'];?>', 'exp');return false;"><?php echo $data['nick'];?></a></td>
											<td class="rank_class"><img src="../../core/grade_image.php?type=player&no=<?php echo $data['rank']; ?>"><?php echo player::grade_name_null($data['rank']);?></td>
											<td class="gray"><?php echo $data['headshots'];?></td>
										</tr>
										<?php
									}
									?>
								</tbody>
								<?php
							}else{
								$query = $qEXP;
								?>
								<thead>
									<tr>
										<th>Ranking</th>
										<th>Nickname</th>
										<th>Rank</th>
										<th class="last">EXP</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while ($data = pg_fetch_assoc($query)){
										?>
										<tr class="<?php if ($no == 1) { echo "first";} ?>">
											<td class="rank"><?php echo $no; $no++; ?> <p class="rank_same"></p></td>
											<td class="nick"><a href="javascript:void(0);" onclick="javacript:getDetail('<?php echo $no; ?>', '<?php echo $data['nick'];?>', 'exp');return false;"><?php echo $data['nick'];?></a></td>
											<td class="rank_class"><img src="../../core/grade_image.php?type=player&no=<?php echo $data['rank']; ?>"><?php echo player::grade_name_null($data['rank']);?></td>
											<td class="gray"><?php echo $data['exp'];?></td>
										</tr>
										<?php
									}
									?>
								</tbody>
								<?php
							}
							?>
						</table>
						<ul class="bbs_paging">
						
						<?php
							$i = 1;
								?>
							<?php
							if ($xpage - 1 < 1){
								?>
								<li class="first"><a href="javascript:void(0);"><span>First</span></a></li>
								<?php
							}else{
								?>
								<li class="first"><a href="javascript:void(0);" onclick="GoPage(1)"><span>First</span></a></li>
								<?php
							}
							if ($xpage - 1 >= 1){
								?>
								<li class="prev"><a href="javascript:void(0);" onclick="GoPage(<?php echo $xpage - 1;?>);"><span>Preview</span></a></li>
								<?php
							}
							else{
								?>
								<li class="prev"><a href="javascript:void(0);"><span>Preview</span></a></li>
								<?php
							}
							?>
								<?php
							for ($i; $i<=$pages ; $i++){
								if ($i == $xpage){
									?>
									<li class="here"><a href="javascript:void(0);"><?php echo $i;?></a></li>
									<?php
								}else{
									?>
									<li><a href="javascript:void(0);" onclick="GoPage(<?php echo $i;?>)"><?php echo $i; ?></a></li>
									<?php
								}
							}
						?>
						<?php
						if ($xpage >= $pages){
							?>
							<li class="next"><a href="javascript:void(0);"><span>Next</span></a></li>
							<?php
						}else{
							?>
							<li class="next"><a href="javascript:void(0);" onclick="GoPage(<?php echo $xpage + 1;?>)"><span>Next</span></a></li>
							<?php
						}
						
						if ($xpage == $pages || $xpage > $pages){
							?>
							<li class="last"><a href="javascript:void(0);"><span>Last</span></a></li>
							<?php
						}else{
							?>
							<li class="last"><a href="javascript:void(0);" onclick="GoPage(<?php echo $pages; ?>)"><span>Last</span></a></li>
							<?php
						}
						?>
						</ul>
					</div>
					<div class="bbs_search">
					<form name="iForm">
						<input type="hidden" id="keyword" name="keyword" value="">
						<p><input type="text" name="nickname" id="nickname" value="Please Enter Character Name" onfocus="this.style.color='black';"></p>
						<p class="btn_form"><a href="javascript:void(0);" onclick="javascript:GoSearch();" class="btn">CONTROL</a></p>
					</form>
					</div>
				</div>
            </div>
        </div>
        <?php $page->footer_page();?>
    </div>
</body>

</html>
