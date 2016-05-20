<?php
/*
 * check session
 */
$project_key = $_GET['projId'];
session_start();
$_SESSION['current_project'] = $project_key;

/*
session_start();

if (!isset($_SESSION['user_key'])) {
    header("Location: http://localhost/makebuy_web/index.php");
    exit();
}
*/

require_once(__DIR__ . '/../class/project_list.php');
require_once(__DIR__ . '/../class/user_info.php');
require_once(__DIR__ . '/../class/participant_list.php');
require_once(__DIR__ . '/../class/cl_rating_list.php');
require_once(__DIR__ . '/../class/comment_list.php');

// Load Project Info
$project_list_class = new project_list();
$project_list_class->getDB('projKey', $project_key);

$project = $project_list_class->getProjList();
$project = $project[0];

$projName = $project->getProjName();
$projClientKey = $project->getClientKey();
$projExpPrice = $project->getProjExpPrice();
$projExpPeriod = $project->getProjExpPeriod();
$projState = $project->getProjState();
$projDeadLine = $project->getProjDeadLine();
$projDescription = $project->getProjDescription();

$project->getProjectType($project_key);
$projTypes = $project->getProjTypes();
$projTypeList = "";

foreach ($projTypes as $projType) {
    $projTypeName = $projType->getProjType();
    $projTypeList = $projTypeList . $projTypeName . "&nbsp;";
}

// $projTypes = implode(", ", $projTypes);

// Load Client Info
$user_info_class = new user_info();
$user_info_class->getDB($project->getClientKey());

$user_info = $user_info_class->getCurrentUser();
$client_name = $user_info->getUserId();
$client_desc = $user_info->getUserDesc();

// Load Project Participant List
$participant_list_class = new participant_list();
$participant_list_class->getDB('projKey', $project_key);

$participant_list = $participant_list_class->getPartList();
$participant_number = count($participant_list);
if ($participant_number == null) {
    $participant_number = 0;
}

// Load Project Comment List
$comment_list_class = new comment_list();
$comment_list_class->getSelectedDB($project_key);

$comment_list = $comment_list_class->getCommentList();
$comment_number = count($comment_list);
if ($comment_list == null) {
    $comment_number = 0;
}

?>

<script>
    $(document).ready(function () {
        menu_over("프로젝트 찾기", "프로젝트 찾기", "1", "0");
    })
</script>
<section class="section-project js--section-project">
    <div class='title' style='padding-bottom:30px;'>
        <h2>
            <?php echo $projName; ?>
            <div class='border'><span></span></div>
        </h2>
        <h3>
            <?php echo $projTypeList; ?>
            &nbsp;필요
            <span class="m-button active"><span><?php echo $projState; ?></span></span>
        </h3>
    </div>
    <div class="form_table">
        <table>
            <col width="15%">
            <col width="35%">
            <col width="15%">
            <col width="">
            <thead>
            <tr>
                <th>예상금액</th>
                <td>&#8361;&nbsp;<?php echo number_format($projExpPrice); ?></td>
                <th>예상기한</th>
                <td><?php echo $projExpPeriod; ?></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>지원마감</th>
                <td><?php
                    $projDeadLine = date('Y-m-d', strtotime($projDeadLine));
                    echo $projDeadLine; ?></td>
                <th>지원자</th>
                <td><?php echo $participant_number; ?>&nbsp;명</td>
            </tr>
            </tbody>
        </table>
    </div>
</section>
</div>
</div>
<div class="sec2">
    <div class="container">
        <div class="tab-content">
            <div class='divide_l'>
                <h3 class="content-subject">&lt; 프로젝트 개요 &gt;</h3>
                <div class='tbl_type'>
                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                        <tr>
                            <td class='subject' style="height:74px;">
                                <p><?php
                                    $projDescription = nl2br(htmlentities($projDescription, ENT_QUOTES, 'UTF-8'));
                                    echo $projDescription; ?></p><br/><br/>
                                <br/><br/>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
                <h3 class="content-subject">&lt; 프로젝트 개요 &gt;</h3>
                <div class='tbl_type'>
                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                        <tr>
                            <td class='subject clearfix' style="height:auto;">
                                <p><?php
                                    $projDescription = nl2br(htmlentities($projDescription, ENT_QUOTES, 'UTF-8'));
                                    echo $projDescription; ?></p><br/><br/>
                                <br/><br/>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class='divide_r'>
                <h3 class="content-subject">&lt; 클라이언트 정보 &gt;</h3>
                <div class='form_table'>
                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                        <col width="15%">
                        <col width="">
                        <tr>
                            <th>이름:</th>
                            <td><?php echo $client_name; ?></td>
                        </tr>
                        <tr>
                            <th>평점:</th>
                            <?php
                            $user_rating = new cl_rating_list();
                            //get rating info
                            $user_rating->getDB($projClientKey);
                            $user_rating_list = $user_rating->getRatingList();
                            $profSum = 0;
                            $commSum = 0;
                            $timeSum = 0;
                            $passionSum = 0;
                            $workAgainSum = 0;
                            foreach ($user_rating_list as $user_rating) {
                                $accuracySum = $profSum + $user_rating->getRAccuracy();
                                $commSum = $commSum + $user_rating->getRComm();
                                $paySum = $timeSum + $user_rating->getRPay();
                                $workAgainSum = $passionSum + $user_rating->getRAgain();
                                $manageSum = $workAgainSum + $user_rating->getRManage();
                            }
                            $accuracySum = $accuracySum / count($user_rating_list);
                            $commAverage = $commSum / count($user_rating_list);
                            $paySum = $paySum / count($user_rating_list);
                            $passionAverage = $passionSum / count($user_rating_list);
                            $workAgainAverage = $workAgainSum / count($user_rating_list);
                            $manageSum = $manageSum / count($user_rating_list);
                            $overallAverage = ($accuracySum + $commAverage + $paySum + $workAgainAverage + $manageSum) / 5;
                            echo '<td>' . $overallAverage . ' 점</td>'
                            ?>
                        </tr>
                        <tr>
                            <th>소개</th>
                            <td><?php
                                $client_desc = nl2br(htmlentities($client_desc, ENT_QUOTES, 'UTF-8'));
                                echo $client_desc; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="board_button">
                <?php
                session_start();
                if ($_SESSION['user_type'] == 'freelancer') {
                    echo "<a href='./sub.php?page=project-regist&projId=$project_key' class='b-button color'><span><i class='ion-checkmark-round'></i>프로젝트 지원하기</span></a>";
                }
                ?>
                <a href="./sub.php?page=search-projects" class="b-button active"><span><i class="ion-refresh"></i>목록으로 돌아가기</span></a>
            </div>
        </div>
    </div>
    </section>
</div>

<section class="section-project js--section-project">
    <div class="container">
        <script>
            function reply_comment(button) {
                $("#comment-write").remove();
                var commentKey = button.id.split("_");
                var commentKey = commentKey[1];
                $("#comment_" + commentKey).append("" +
                    "<div class='comment-write clearfix' id='comment-write' name='comment-write' style='margin-top: 20px; margin-bottom: 20px; background-color: #f2f5f4; overflow: hidden;'>" +
                    "<form class='comment-write-form' action='./lib/comment_process.php' method='POST'>" +
                    "<input type='text' id='isReply' name='isReply' style='display:none' value='" + commentKey + "'>" +
                    "<div style='display: inline-block; width: 80%; float: left'>" +
                    "<textarea id='comment' name='comment' placeholder='댓글을 입력해주세요' required></textarea>" +
                    "<span class='clearfix' style='white-space: nowrap;'>" +
                    "<input type='checkbox' id='secret' name='secret'>" +
                    "<label for='secret'>&nbsp;비밀글로 작성합니다</label>" +
                    "</span>" +
                    "</div>" +
                    "<div class='right-border' style='width: 20%; float: right'>" +
                    "<div class='inner-border clearfix' style='display: block;'>" +
                    "<input type='submit' id='submit_comment' name='submit_comment' value='댓글 달기' style='width: 100%; height: 130px; float: right'>" +
                    "</div>" +
                    "</div>" +
                    "</form>" +
                    "</div>");
            }

            function delete_comment(button) {
                if(confirm("댓글을 삭제하시겠습니까?") == true) {
                    $.ajax({
                        url: './lib/comment_delete.php',
                        type: 'POST',
                        data: ({current_comment: button.id}),
                        success: function (result) {
                            var currentProject = "./sub.php?page=project-intro&projId=" + result;
                            window.location = currentProject;
                        }, error: function () {
                            alert("오류가 발생했습니다");
                        }
                    });
                }
            }
        </script>

        <style>
            .comment-title {
                background-color: #f2f5f4;
            }

            .reply-comment {
                padding-left: 30px;
            }

            .comment-title > * {
                display: inline-block;
                padding: 5px;
            }

            .comment-content {
                padding: 5px;
            }

            .comment-content p {
                font-size: 150%;
            }

            .ion-reply {
                -moz-transform: rotate(180deg);
                -webkit-transform: rotate(180deg);
                -o-transform: rotate(180deg);
                -ms-transform: rotate(180deg);
                transform: rotate(180deg);
            }

            .single-comment input[type="button"] {
                float: right;
                color: #fff;
                font-size: 60%;
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                border-radius: 5px;
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5);
                cursor: pointer;
            }

            .single-comment .green-button {
                background-color: #09b262;
                border: 1px solid #09b262;
            }

            .single-comment .red-button {
                background-color: #ff3232;
                border: 1px solid #ff3232;
            }

            .single-comment input[type=button]:hover .green-button {
                background-color: #3ac181;
            }

            .single-comment input[type=button]:hover .red-button {
                background-color: #ff7f7f;
            }

            .comment-write {
                padding: 10px;
            }

            .inner-border > * {
                padding: 10px 0 10px 0;
            }


        </style>
        <?php
        foreach ($comment_list as $comment) {
            // Find the Writer of the Comment
            require_once(__DIR__ . '/../class/user_info.php');
            $user_info_class = new user_info();
            $user_info_class->getDB($comment->getCWriterKey());
            $current_user = $user_info_class->getCurrentUser();
            $user_name = $current_user->getUserId();
            $user_type = $current_user->getUserType();

            // Indicate whether the Writer matches the 'Current User' stored inside Session
            if ($comment->getCWriterKey() == $_SESSION['user_key']) {
                $isWriter = true;
            } else {
                $isWriter = false;
            }

            // Comment Title & Timestamp does not get reflected by the 'isWriter' indicator

            if ($comment->getCommentKey() == $comment->getOCommKey()) {
                echo "<div class='single-comment' id='comment_" . $comment->getCommentKey() . "'>";
                echo "<div class='comment-title'>";
            } else {
                echo "<div class='single-comment reply-comment' id='comment_" . $comment->getCommentKey() . "'>";
                echo "<div class='comment-title'>";
                echo "<i class='ion-reply' style='font-size: 80%;'></i>";
            }

            echo "<p>" . $user_name . "&nbsp;님</p>";
            echo "<p>" . $comment->getCDate() . "</p>";

            // Draw a Lock icon if the Comment is marked as private
            if($comment->getCPrivate()) {
                echo "<i class='ion-locked' style='font-size: 80%;'></i>";
            }

            // The 'Reply' button only exists to the original, not derivative
            // The 'Reply' button
            if ($comment->getCommentKey() == $comment->getOCommKey()) {
                if ($comment->getCActive() == 1) {
                    echo "<input type='button' class='green-button' value='답글달기' id='reply_" . $comment->getCommentKey() . "' name='reply_" . $comment->getCommentKey() . "' onclick='reply_comment(this)'>";
                }
            }

            // If the Writer is True and the Comment is Active, Delete Button appears
            if ($isWriter) {
                if ($comment->getCActive() == 1) {
                    echo "<input type='button' class='red-button' value='삭제하기' id='comment_" . $comment->getCommentKey() . "' name='comment_" . $comment->getCommentKey() . "' onclick='delete_comment(this)'>";
                }
            }
            echo "</div>";
            echo "<div class='comment-content'>";

            // If the Writer is True or the Current User is the Project Owner, One can see the Private Comment
            // $isWriter firstly detects whether the Comment writer
            if ($comment->getCActive()) {
                if ($comment->getCPrivate()) {
                    if ($isWriter) {
                        echo "<p>" . $comment->getCContent() . "</p>";
                    } elseif ($projClientKey == $_SESSION['user_key']) {
                        echo "<p>" . $comment->getCContent() . "</p>";
                    } else {
                        echo "<p>비밀 댓글입니다</p>";
                    }
                } else {
                    echo "<p>" . $comment->getCContent() . "</p>";
                }
            } else {
                echo "<p style='color: #e6e6e6'>삭제된 댓글입니다</p>";
            }

            echo "</div>";
            echo "</div>";
        }
        ?>
        <!-- Code for Comment-Write Section
             Please update the 'reply_comment (js)' Part same has here whenever there is a change
        -->
        <div class="comment-write clearfix" id="comment-write" name="comment-write"
             style="margin-top: 20px; margin-bottom: 20px; background-color: #f2f5f4; overflow: hidden;">
            <form class="comment-write-form" action="./lib/comment_process.php" method="POST">
                <div style="display: inline-block; width: 80%; float: left">
                    <textarea id="comment" name="comment" placeholder="댓글을 입력해주세요" required></textarea>
                    <span class="clearfix" style="white-space: nowrap;">
                        <input type="checkbox" id="secret" name="secret">
                        <label for="secret">&nbsp;비밀글로 작성합니다</label>
                    </span>
                </div>
                <div class="right-border" style="width: 20%; float: right">
                    <div class="inner-border clearfix" style="display: block;">
                        <input type="submit" id="submit_comment" name="submit_comment" value="댓글 달기"
                               style="width: 100%; height: 130px; float: right">
                    </div>
                </div>
            </form>
        </div>
    </div>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="board_button">
                <?php
                session_start();
                if ($_SESSION['user_type'] == 'freelancer') {
                    echo "<a href='./sub.php?page=project-regist&projId=$project_key' class='b-button color'><span><i class='ion-checkmark-round'></i>프로젝트 지원하기</span></a>";
                }
                ?>
                <a href="./sub.php?page=search-projects" class="b-button active"><span><i class="ion-refresh"></i>목록으로 돌아가기</span></a>
            </div>
        </div>
    </div>
    </section>
</div>

<section class="section-project js--section-project">
    <div class="container">
        <script>
            function reply_comment(button) {
                $("#comment-write").remove();
                var commentKey = button.id.split("_");
                var commentKey = commentKey[1];
                $("#comment_" + commentKey).append("" +
                    "<div class='comment-write clearfix' id='comment-write' name='comment-write' style='margin-top: 20px; margin-bottom: 20px; background-color: #f2f5f4; overflow: hidden;'>" +
                    "<form class='comment-write-form' action='./lib/comment_process.php' method='POST'>" +
                    "<input type='text' id='isReply' name='isReply' style='display:none' value='" + commentKey + "'>" +
                    "<div style='display: inline-block; width: 80%; float: left'>" +
                    "<textarea id='comment' name='comment' placeholder='댓글을 입력해주세요' required></textarea>" +
                    "<span class='clearfix' style='white-space: nowrap;'>" +
                    "<input type='checkbox' id='secret' name='secret'>" +
                    "<label for='secret'>&nbsp;비밀글로 작성합니다</label>" +
                    "</span>" +
                    "</div>" +
                    "<div class='right-border' style='width: 20%; float: right'>" +
                    "<div class='inner-border clearfix' style='display: block;'>" +
                    "<input type='submit' id='submit_comment' name='submit_comment' value='댓글 달기' style='width: 100%; height: 70px; float: right'>" +
                    "</div>" +
                    "</div>" +
                    "</form>" +
                    "</div>");
            }

            function delete_comment(button) {
                if (confirm("댓글을 삭제하시겠습니까?") == true) {
                    $.ajax({
                        url: './lib/comment_delete.php',
                        type: 'POST',
                        data: ({current_comment: button.id}),
                        success: function (result) {
                            var currentProject = "./sub.php?page=project-intro&projId=" + result;
                            window.location = currentProject;
                        }, error: function () {
                            alert("오류가 발생했습니다");
                        }
                    });
                }
            }
        </script>

        <style>
            .comment-title {
                background-color: #f2f5f4;
            }

            .reply-comment {
                padding-left: 30px;
            }

            .comment-title > * {
                display: inline-block;
                padding: 5px;
            }

            .comment-content {
                padding: 5px;
            }

            .ion-reply {
                -moz-transform: rotate(180deg);
                -webkit-transform: rotate(180deg);
                -o-transform: rotate(180deg);
                -ms-transform: rotate(180deg);
                transform: rotate(180deg);
            }

            .single-comment input[type="button"] {
                float: right;
                color: #fff;
                font-size: 60%;
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                border-radius: 5px;
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5);
                cursor: pointer;
            }

            .single-comment .green-button {
                background-color: #09b262;
                border: 1px solid #09b262;
            }

            .single-comment .red-button {
                background-color: #ff3232;
                border: 1px solid #ff3232;
            }

            .single-comment input[type=button]:hover .green-button {
                background-color: #3ac181;
            }

            .single-comment input[type=button]:hover .red-button {
                background-color: #ff7f7f;
            }

            .comment-write {
                padding: 10px;
            }

            .inner-border > * {
                padding: 10px 0 10px 0;
            }

            textarea {
                height: 60px;
            }

        </style>
        <?php
        foreach ($comment_list as $comment) {
            // Find the Writer of the Comment
            require_once(__DIR__ . '/../class/user_info.php');
            $user_info_class = new user_info();
            $user_info_class->getDB($comment->getCWriterKey());
            $current_user = $user_info_class->getCurrentUser();
            $user_name = $current_user->getUserId();
            $user_type = $current_user->getUserType();

            // Indicate whether the Writer matches the 'Current User' stored inside Session
            if ($comment->getCWriterKey() == $_SESSION['user_key']) {
                $isWriter = true;
            } else {
                $isWriter = false;
            }

            // Comment Title & Timestamp does not get reflected by the 'isWriter' indicator

            if ($comment->getCommentKey() == $comment->getOCommKey()) {
                echo "<div class='single-comment' id='comment_" . $comment->getCommentKey() . "'>";
                echo "<div class='comment-title'>";
            } else {
                echo "<div class='single-comment reply-comment' id='comment_" . $comment->getCommentKey() . "'>";
                echo "<div class='comment-title'>";
                echo "<i class='ion-reply' style='font-size: 80%;'></i>";
            }

            echo "<p>" . $user_name . "&nbsp;님</p>";
            echo "<p>" . $comment->getCDate() . "</p>";

            // Draw a Lock icon if the Comment is marked as private
            if ($comment->getCPrivate()) {
                echo "<i class='ion-locked' style='font-size: 80%;'></i>";
            }

            // The 'Reply' button only exists to the original, not derivative
            // The 'Reply' button
            if ($comment->getCommentKey() == $comment->getOCommKey()) {
                if ($comment->getCActive() == 1) {
                    echo "<input type='button' class='green-button' value='답글달기' id='reply_" . $comment->getCommentKey() . "' name='reply_" . $comment->getCommentKey() . "' onclick='reply_comment(this)'>";
                }
            }

            // If the Writer is True and the Comment is Active, Delete Button appears
            if ($isWriter) {
                if ($comment->getCActive() == 1) {
                    echo "<input type='button' class='red-button' value='삭제하기' id='comment_" . $comment->getCommentKey() . "' name='comment_" . $comment->getCommentKey() . "' onclick='delete_comment(this)'>";
                }
            }
            echo "</div>";
            echo "<div class='comment-content'>";

            // If the Writer is True or the Current User is the Project Owner, One can see the Private Comment
            // $isWriter firstly detects whether the Comment writer
            if ($comment->getCActive()) {
                if ($comment->getCPrivate()) {
                    if ($isWriter) {
                        echo "<p>" . $comment->getCContent() . "</p>";
                    } elseif ($projClientKey == $_SESSION['user_key']) {
                        echo "<p>" . $comment->getCContent() . "</p>";
                    } else {
                        echo "<p>비밀 댓글입니다</p>";
                    }
                } else {
                    echo "<p>" . $comment->getCContent() . "</p>";
                }
            } else {
                echo "<p style='color: #e6e6e6'>삭제된 댓글입니다</p>";
            }

            echo "</div>";
            echo "</div>";
        }
        ?>
        <!-- Code for Comment-Write Section
             Please update the 'reply_comment (js)' Part same has here whenever there is a change
        -->
        <div class="comment-write clearfix" id="comment-write" name="comment-write"
             style="margin-top: 20px; margin-bottom: 20px; background-color: #f2f5f4; overflow: hidden;">
            <form class="comment-write-form" action="./lib/comment_process.php" method="POST">
                <div style="display: inline-block; width: 80%; float: left">
                    <textarea id="comment" name="comment" placeholder="댓글을 입력해주세요" required></textarea>
                    <span class="clearfix" style="white-space: nowrap;">
                        <input type="checkbox" id="secret" name="secret">
                        <label for="secret">&nbsp;비밀글로 작성합니다</label>
                    </span>
                </div>
                <div class="right-border" style="width: 20%; float: right">
                    <div class="inner-border clearfix" style="display: block;">
                        <input type="submit" id="submit_comment" name="submit_comment" value="댓글 달기"
                               style="width: 100%; height: 70px; float: right">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
