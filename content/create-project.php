<?php
/*
 * check session
 */
session_start();
if (!isset($_SESSION['user_key'])) {
	header("Location: http://localhost/makebuy_web/index.php");
	exit();
} else if ($_SESSION['user_type'] == 'freelancer') {
	echo "<script>
                alert('프로젝트 등록은 클라이언트만 가능합니다');
                location.href='../content/freelancer-dashboard.php';
           </script>";
}
/* in case of temporary saved */
if (isset($_GET['project'])) {

	/*
	require('../class/db.php');
	$db = new db();
	$connection = $db->connect();
	$projKey = $db->quote($_GET['project']);
	$_SESSION['project'] = $projKey; // save for temporary saved
	$sql = "SELECT * FROM project_tb WHERE projKey='$projKey'";
	$rows = $db->select($sql);

	$projName = $rows[0]['proj_nm'];
	//$budget = $rows[0]['']; just radio button
	$projBudget = $rows[0]['proj_price'];
	$projDue = $rows[0]['proj_period'];
	$projClass = $rows[0]['proj_class'];
	$projFieldIos = $rows[0]['proj_ios'];
	$projFieldAndroid = $rows[0]['proj_android'];
	$projFieldHybrid = $rows[0]['proj_hybrid'];
	$projDescription = $rows[0]['proj_desc'];
	$projMeeting = $rows[0]['proj_a_sido'];
	$projOffline = false;
	if ($projMeeting != 'online') {
		$projOffline = true;
	}
	$projEtc = $rows[0]['proj_etc'];
	$projAdmit = $rows[0]['proj_admit'];

	$sql = "SELECT * FROM project_type_tb WHERE projKey='$projKey'";
	$rows = $db->select($sql);
	$projSkillList = array();

	$i = 0;
	$j = count($rows);
//읽어온 데이터를 배열에 넣는다.
	while ($j > 0) {
		$row = $rows[$i];
		array_push($projSkillList, $row['t_skill']);
		$i = $i + 1;
		$j = $j - 1;
	}
	$projSill = $projSkillList[0]; //tag apply 전에 임시로 표시해놓은거임
	*/

	require_once('/class/project_list.php');
	$project_list_class = new project_list();
	$project_list_class->getDB('projKey', $_GET['project']);

	$project = $project_list_class->getProjList();
	$project = $project[0];

}

?>

    <script>
        $(document).ready(function(){
			menu_over("","","0","0");
            var skills = [];
            var skill_list;
            $("#project-button").on('click', function(event){
                $("#proj-skill .tagit-label").each(function (index, el){
                    alert($(el).html());
                    skills.push($(el).html());
                });
                skills = skills.join(',');
                $.post("../lib/project_process.php", {proj_skill: skills});
            });
        })
    </script>
<section class="section-create-form js--section-signup-form">
	<form method="post" action="../lib/project_process.php" class="project-form"/>
	<div class='title'>
		<h3 style='padding-bottom:10px;'>이미 기획안이 있으신가요? 그렇다면</h3>
		<h2>
			프로젝트 일반
			<div class='border'><span></span></div>
		</h2>
	</div>
    <div class="form_table">
		<table cellpadding='0' cellspacing='0' border='0' width='100%'>
			<col width='20%' />
			<col width='*' />
			<tr>
				<th>프로젝트 이름</th>
				<td><input type="text" name="proj-name" id="proj-name" placeholder="프로젝트명을 입력하세요" value="<?php echo $projName; ?>" required /></td>
			</tr>
			<tr>
				<th>프로젝트 규모</th>
				<td>
					<form class="likert-scale">
						<input type="radio" name="budget" value="tiny" id="tiny"><label for="tiny">매우 작음</label>
						<input type="radio" name="budget" value="small" id="small"><label for="small">작음</label>
						<input type="radio" name="budget" value="medium" id="medium"><label for="medium">중간</label>
						<input type="radio" name="budget" value="big" id="big"><label for="big">큼</label>
						<input type="radio" name="budget" value="group" id="group"><label for="group">그룹</label>
					</form>
				</td>
			</tr>
			<tr>
				<th>프로젝트 예산</th>
				<td>
					<!-- AUTO NUMERIC LIBRARY GOES HERE -->
					<input type="text" name="proj-budget" id="proj-budget" placeholder="예산을 입력하세요" value="<?php echo $projBudget; ?>" required>
				</td>
			</tr>
			<tr>
				<th>프로젝트 기간</th>
				<td>
					<input type="text" name="proj-due" id="proj-due" placeholder="기간을 입력하세요" value="<?php echo $projDue; ?>" required>
				</td>
			</tr>
		</table>
	</div>
	<div class='title' style='padding-top:50px;'>
		<h2>
			프로젝트 기획
			<div class='border'><span></span></div>
		</h2>
	</div>
	<div class="form_table">
		<table cellpadding='0' cellspacing='0' border='0' width='100%'>
			<col width='20%' />
			<col width='*' />
			<tr>
				<th>프로젝트 분류</th>
				<td>
					<select class="dropdown" name="proj-class">
						<option value="new" <?php if ($projClass == 'new') {
							echo "selected = selected";
						} ?>>신규 제작
						</option>
						<option value="main" <?php if ($projClass == 'main') {
							echo "selected = selected";
						} ?>>유지보수
						</option>
						<option value="module" <?php if ($projClass == 'module') {
							echo "selected = selected";
						} ?>>부분 제작
						</option>
						<option value="modify" <?php if ($projClass == 'modify') {
							echo "selected = selected";
						} ?>>개선
						</option>
						<option value="consult" <?php if ($projClass == 'consult') {
							echo "selected = selected";
						} ?>>상담 및 조언
						</option>
						<option value="etc" <?php if ($projClass == 'etc') {
							echo "selected = selected";
						} ?>>기타
						</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>프로젝트 분야</th>
				<td>
					<input type="checkbox" name="proj-field-ios" id="proj-field" value="iOS" <?php if ($projFieldIos) { echo "checked"; } ?>>
					<label>iOS</label>
					<input type="checkbox" name="proj-field-android" id="proj-field" value="Android" <?php if ($projFieldAndroid) { echo "checked"; } ?>>
					<label>Android</label>
					<input type="checkbox" name="proj-field-hybrid" id="proj-field" value="Hybrid" <?php if ($projFieldHybrid) { echo "checked"; } ?>>
					<label>기타</label>
				</td>
			</tr>
			<tr>
				<th>필요 기술</th>
				<td>
					<ul id="proj-skill" class="tagit ui-widget ui-widget-content ui-corner-all"> </ul>
				</td>
			</tr>
			<tr>
				<th>프로젝트 설명</th>
				<td>
					<textarea name="proj-desc" id="proj-desc" placeholder="&nbsp;< 프로젝트 진행방식 >" style='width:99%;'><?php echo $projDescription; ?></textarea>
				</td>
			</tr>
			<tr>
				<th>프로젝트 기획서</th>
				<td class='board_button'>
						<a href="#" class="m-button active"><span><i class="ion-help"></i>프로젝트 도우미</span></a>
						<a href="#" class="m-button active"><span><i class="ion-arrow-up-c"></i>기획서 업로드</span></a>
						<a href="#" class="m-button normal"><span><i class="ion-checkmark-round"></i>업로드 완료</span></a>
				</td>
			</tr>
		</table>
	</div>
	<div class='title' style='padding-top:50px;'>
		<h2>
			프로젝트 진행사항
			<div class='border'><span></span></div>
		</h2>
	</div>
	<div class="form_table">
		<table cellpadding='0' cellspacing='0' border='0' width='100%'>
			<col width='20%' />
			<col width='*' />
			<tr>
				<th>프로젝트 회의 장소</th>
				<td>
					<select name="proj-meeting" class="dropdown">
						<option value="online" <?php if ($projMeeting == 'online') {
							echo "selected = selected";
						} ?>>온라인 회의
						</option>
						<option value="none" <?php if ($projMeeting == 'none') {
							echo "selected = selected";
						} ?>>해당사항 없음
						</option>
						<option value="seoul" <?php if ($projMeeting == 'seoul') {
							echo "selected = selected";
						} ?>>서울
						</option>
						<option value="kyunggi" <?php if ($projMeeting == 'kyunggi') {
							echo "selected = selected";
						} ?>>경기도
						</option>
						<option value="kangwon" <?php if ($projMeeting == 'kangwon') {
							echo "selected = selected";
						} ?>>강원도
						</option>
						<option value="chungcheong" <?php if ($projMeeting == 'chungcheong') {
							echo "selected = selected";
						} ?>>충청도
						</option>
						<option value="jeolla" <?php if ($projMeeting == 'jeolla') {
							echo "selected = selected";
						} ?>>전라도
						</option>
						<option value="kyungsang" <?php if ($projMeeting == 'kyungsang') {
							echo "selected = selected";
						} ?>>경상도
						</option>
						<option value="jeju" <?php if ($projMeeting == 'jeju') {
							echo "selected = selected";
						} ?>>제주도
						</option>
					</select>
				</div>
			</tr>
			<tr>
				<th>기타 사항</th>
				<div>
					<input type="text" id="proj-etc" name="proj-etc" placeholder="기타 필요 사항을 적어주세요"
						   value="<?php echo $projEtc; ?>">
				</div>
			</tr>
		</table>
    </div>
	<div class="board_button">
		<span class="b-button color"><input type="submit" value="프로젝트 등록" id="project-button" name="projSubmit" /></span>
		<span class="b-button active"><input type="button" value="임시저장" id="project-button" name="tmpSave"></span>
	</div>
</form>
</section>
