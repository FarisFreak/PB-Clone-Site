<?php
//include('./config.php');
class db{
	public static function connect(){
		global $dbhost, $dbport, $dbuser, $dbpass, $dbname;
		$con = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass");
		return $con;
	}
	public static function query($query){
		$con = self::connect();
		$query = pg_query($con, $query);
		return $query;
	}
	public static function fetch_assoc($query){
		$con = self::connect();
		$q = self::query($query);
		return pg_fetch_assoc($q);
	}
	public static function fetch_array($query){
		$con = self::connect();
		$q = self::query($query);
		return pg_fetch_array($q);
	}
	public static function fetch_all($query){
		$con = self::connect();
		$q = self::query($query);
		return pg_fetch_all($q);
	}
	public static function num_rows($query){
		$con = self::connect();
		$q = self::query($query);
		return pg_num_rows($q);
	}
	public static function escape_string($string){
		$con = self::connect();
		return pg_escape_string($con, $string);
	}
}
// Simple Function
function getIP(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function session($name, $val){
	return $_SESSION[$name] = $val;
}

function baseinclude(){
	include $_SERVER['DOCUMENT_ROOT'].'core/inc.php';
}
//
class clan{
	public static function base($col, $id){
		$query = "SELECT $col FROM jogador_clan WHERE id = $id;";
		$res = db::fetch_assoc($query);
		return $res;
	}
	public static function name($id){
		$res = self::base('name', $id);
		return $res['name'];
	}
	public static function grade($username){
		$res = self::base('rank', $id);
		return $res['rank'];
	}
	public static function eexp($id){
		$res = self::base('exp', $id);
		return $res['exp'];
	}
	public static function ranking_champion($name, $rank, $exp){
		?>
		
                       <p class="nick"><?php echo $name; ?></p>
                       <p class="rank"><img src="/core/grade_image.php?type=clan&no=<?php echo $rank; ?>"/> <?php echo $exp;?></p>
                    
		<?php
	}
	public static function ranking_grade($num, $name, $rank, $exp){
		$n = '';
		switch ($num){
			case 2:
				$n = "second";
				break;
			case 3:
				$n = "third";
				break;
			case 4:
				$n = "fourth";
				break;
			case 5:
				$n = "fifth";
				break;
		}
		?>
		<p>
			<span class="nick <?php echo $n; ?>"><?php echo $name; ?></span>
			<span class="exp"><img src="/core/grade_image.php?type=clan&no=<?php echo $rank; ?>"/> <?php echo $exp;?></span>
		</p>
		<?php
	}
}
class player{
	public static function base($col, $username){
		$query = "SELECT $col FROM jogador INNER JOIN contas ON jogador.id = contas.id WHERE login = '$username';";
		$res = db::fetch_assoc($query);
		return $res;
	}
	public static function nickname($username){
		$res = self::base('nick', $username);
		if($res['nick'] == ""){
			return "-";
		}else{
			return $res['nick'];
		}
	}
	public static function grade($username){
		$res = self::base('rank', $username);
		return $res['rank'];
	}
	public static function point($username){
		$res = self::base('gold', $username);
		return $res['gold'];
	}
	public static function cash($username){
		$res = self::base('cash', $username);
		return $res['cash'];
	}
	public static function grade_name($username){
		$grade = self::grade($username);
		switch ($grade){
			case 0:
				return "Trainee";
				break;
			case 1:
				return "Senior Trainee";
				break;
			case 2:
				return "Private";
				break;
			case 3:
				return "Corporal";
				break;
			case 4:
				return "Sergeant";
				break;
			case 6:
				return "Staff Sgt. Grade 1";
				break;
			case 7:
				return "Staff Sgt. Grade 2";
				break;
			case 8:
				return "Staff Sgt. Grade 3";
				break;
			case 9:
				return "Sgt. 1st Class Grade 1";
				break;
			case 10:
				return "Sgt. 1st Class Grade 2";
				break;
			case 11:
				return "Sgt. 1st Class Grade 3";
				break;
			case 12:
				return "Sgt. 1st Class Grade 4";
				break;
			case 13:
				return "Master Sgt. Grade 1";
				break;
			case 14:
				return "Master Sgt. Grade 2";
				break;
			case 15:
				return "Master Sgt. Grade 3";
				break;
			case 16:
				return "Master Sgt. Grade 4";
				break;
			case 17:
				return "Master Sgt. Grade 5";
				break;
			case 18:
				return "2nd Lt. Grade 1";
				break;
			case 19:
				return "2nd Lt. Grade 2";
				break;
			case 20:
				return "2nd Lt. Grade 3";
				break;
			case 21:
				return "2nd Lt. Grade 4";
				break;
			case 22:
				return "1st Lt. Grade 1";
				break;
			case 23:
				return "1st Lt. Grade 2";
				break;
			case 24:
				return "1st Lt. Grade 3";
				break;
			case 25:
				return "1st Lt. Grade 4";
				break;
			case 26:
				return "1st Lt. Grade 5";
				break;
			case 26:
				return "Capt. Grade 1";
				break;
			case 27:
				return "Capt. Grade 2";
				break;
			case 28:
				return "Capt. Grade 3";
				break;
			case 29:
				return "Capt. Grade 4";
				break;
			case 30:
				return "Capt. Grade 5";
				break;
			case 31:
				return "Major Grade 1";
				break;
			case 32:
				return "Major Grade 2";
				break;
			case 33:
				return "Major Grade 3";
				break;
			case 34:
				return "Major Grade 4";
				break;
			case 35:
				return "Major Grade 5";
				break;
			case 36:
				return "Lt. Col. Grade 1";
				break;
			case 37:
				return "Lt. Col. Grade 2";
				break;
			case 38:
				return "Lt. Col. Grade 3";
				break;
			case 39:
				return "Lt. Col. Grade 4";
				break;
			case 40:
				return "Lt. Col. Grade 5";
				break;
			case 41:
				return "Col. Grade 1";
				break;
			case 42:
				return "Col. Grade 2";
				break;
			case 43:
				return "Col. Grade 3";
				break;
			case 44:
				return "Col. Grade 4";
				break;
			case 45:
				return "Col. Grade 5";
				break;
			case 46:
				return "Brigadier";
				break;
			case 47:
				return "Major General";
				break;
			case 48:
				return "Lt. General";
				break;
			case 49:
				return "General";
				break;
			case 50:
				return "Commander";
				break;
			case 51:
				return "Hero";
				break;
			case 52:
				return "Bomber";
				break;
			case 53:
				return "Game Master";
				break;
			case 54:
				return "Moderator";
				break;
		}
	}
	
	public static function grade_name_null($grade){
		switch ($grade){
			case 0:
				return "Trainee";
				break;
			case 1:
				return "Senior Trainee";
				break;
			case 2:
				return "Private";
				break;
			case 3:
				return "Corporal";
				break;
			case 4:
				return "Sergeant";
				break;
			case 5:
				return "Staff Sgt. Grade 1";
				break;
			case 6:
				return "Staff Sgt. Grade 2";
				break;
			case 7:
				return "Staff Sgt. Grade 3";
				break;
			case 8:
				return "Sgt. 1st Class Grade 1";
				break;
			case 9:
				return "Sgt. 1st Class Grade 2";
				break;
			case 10:
				return "Sgt. 1st Class Grade 3";
				break;
			case 11:
				return "Sgt. 1st Class Grade 4";
				break;
			case 12:
				return "Master Sgt. Grade 1";
				break;
			case 13:
				return "Master Sgt. Grade 2";
				break;
			case 14:
				return "Master Sgt. Grade 3";
				break;
			case 15:
				return "Master Sgt. Grade 4";
				break;
			case 16:
				return "Master Sgt. Grade 5";
				break;
			case 17:
				return "2nd Lt. Grade 1";
				break;
			case 18:
				return "2nd Lt. Grade 2";
				break;
			case 19:
				return "2nd Lt. Grade 3";
				break;
			case 20:
				return "2nd Lt. Grade 4";
				break;
			case 21:
				return "1st Lt. Grade 1";
				break;
			case 22:
				return "1st Lt. Grade 2";
				break;
			case 23:
				return "1st Lt. Grade 3";
				break;
			case 24:
				return "1st Lt. Grade 4";
				break;
			case 25:
				return "1st Lt. Grade 5";
				break;
			case 26:
				return "Capt. Grade 1";
				break;
			case 27:
				return "Capt. Grade 2";
				break;
			case 28:
				return "Capt. Grade 3";
				break;
			case 29:
				return "Capt. Grade 4";
				break;
			case 30:
				return "Capt. Grade 5";
				break;
			case 31:
				return "Major Grade 1";
				break;
			case 32:
				return "Major Grade 2";
				break;
			case 33:
				return "Major Grade 3";
				break;
			case 34:
				return "Major Grade 4";
				break;
			case 35:
				return "Major Grade 5";
				break;
			case 36:
				return "Lt. Col. Grade 1";
				break;
			case 37:
				return "Lt. Col. Grade 2";
				break;
			case 38:
				return "Lt. Col. Grade 3";
				break;
			case 39:
				return "Lt. Col. Grade 4";
				break;
			case 40:
				return "Lt. Col. Grade 5";
				break;
			case 41:
				return "Col. Grade 1";
				break;
			case 42:
				return "Col. Grade 2";
				break;
			case 43:
				return "Col. Grade 3";
				break;
			case 44:
				return "Col. Grade 4";
				break;
			case 45:
				return "Col. Grade 5";
				break;
			case 46:
				return "Brigadier";
				break;
			case 47:
				return "Major General";
				break;
			case 48:
				return "Lt. General";
				break;
			case 49:
				return "General";
				break;
			case 50:
				return "Commander";
				break;
			case 51:
				return "Hero";
				break;
			case 52:
				return "Bomber";
				break;
			case 53:
				return "Game Master";
				break;
			case 54:
				return "Moderator";
				break;
		}
	}

	public static function ranking_champion($name, $rank, $exp){
		?>
		
                       <p class="nick"><?php echo $name; ?></p>
                       <p class="rank"><img src="/core/grade_image.php?type=player&no=<?php echo $rank; ?>"/> <?php echo $exp;?></p>
                    
		<?php
	}
	public static function ranking_grade($num, $name, $rank, $exp){
		$n = '';
		switch ($num){
			case 2:
				$n = "second";
				break;
			case 3:
				$n = "third";
				break;
			case 4:
				$n = "fourth";
				break;
			case 5:
				$n = "fifth";
				break;
		}
		?>
		<p>
			<span class="nick <?php echo $n; ?>"><?php echo $name; ?></span>
			<span class="exp"><img src="/core/grade_image.php?type=player&no=<?php echo $rank; ?>"/> <?php echo $exp;?></span>
		</p>
		<?php
	}
}

?>