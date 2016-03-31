jQuery(document).ready(function () {

    jQuery('.tabs .tab-links a').on('click', function (e) {
        var currentAttrValue = jQuery(this).attr('href');

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();

        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

        e.preventDefault();
    });

    /* confirm password */
    $('#password-check').on('blur', function (event) {
        if ($('#password')[0].value != $('#password-check')[0].value) {
            $('#pwdCheck_text').replaceWith('<div id="pwdCheck_text" style="color:#cf3310"><p>비밀번호가 틀립니다<p></div>');
        } else {
            $('#pwdCheck_text').replaceWith('<div id="pwdCheck_text" style="color:#50c582"><p>비밀번호가 확인되었습니다<p></div>');
        }
    });

    /* check id */
    $('#id-checker').on('click', function (event) {
        $('#id-checker').attr('clicked', 'clicked');
        $.post('process/checkEmail.php', {email: $('#email')[0].value})
            .done(function (data) {
                alert(data);
            });
    });

    /* check required fields in form */
    $('form').submit(function (event) {
        if ($('#password')[0].value != $('#password-check')[0].value) {
            alert('비밀번호를 확인해주세요');
            return false;
        }

    });

    /* client-profile Section edit */
    $('#editProfile-button').on('click', function (event) {
        $('#cl-profile').replaceWith(
            '<div class="col span-2-of-3">' +
            '<form method="post" action="./lib/cl_profile_process.php" id= "cl-profile-form" class="profile-form" enctype="multipart/form-data">' +
            '<textarea name="profile-textarea" id="profile-textarea" />' +
            '<h3>대표이미지</h3>' +
            '<input type="file" name="profile" id="profile"/>' +
            '<p>500kb 미만의 이미지파일(jpg, jped, png, gif)만 업로드 가능합니다</p>' +
            '<div class=board_button>' +
            '<a href="#" id="editProfile-submit" class="b-button color"><span><i class="ion-edit"></i>프로필 수정하기</span></a>' +
            '</div>' +
            '</form>' +
            '</div>');
        $('#editProfile-submit').click(function () {
            $('#cl-profile-form').submit();
            return false;
        });
        $('#fl-profile').replaceWith(
            '<div class="col span-2-of-3">' +
            '<form method="post" action="./lib/fl_profile_process.php" id= "fl-profile-form" class="profile-form" enctype="multipart/form-data">' +
            '<textarea name="profile-textarea" id="profile-textarea" />' +
                // '<?php $userDesc = $current_user-&gt;getUserDesc(); echo "&lt;h3&gt;$userDesc&lt;/h3&gt;"; ?>;' +
            '<h3>대표이미지</h3>' +
            '<input type="file" name="profile" id="profile"/>' +
            '<p>500kb 미만의 이미지파일(jpg, jped, png, gif)만 업로드 가능합니다</p>' +
            '<div class=board_button>' +
            '<a href="#" id="editProfile-submit" class="b-button color"><span><i class="ion-edit"></i>프로필 수정하기</span></a>' +
            '</div>' +
            '</form>' +
            '</div>');
            $('#editProfile-submit').click(function () {
             $('#fl-profile-form').submit();
             return false;
          });
    });

    //submit form with jQuery, because we use button instead of input type=submit


    /* Portfolio Section */

    /* Skill Section */
    $('#js--add-skill').on('click', function (event) {
        $('#fl-skill').replaceWith(
        '<div class="inside-value">' +
        '<form method="post" action="./lib/skill_process.php" class="skill-form" id="skill-form">' +
            '<div class="form_table">' +
            '<table>' +
            '<col width="20%"/>' +
            '<col width="*"/>' +
            '<tr>' +
            '<th>기술 / 자격증명</th>' +
            '<td data-title=\'기술자격증명\'><input type="text" name="skill_name" id="skill_name" placeholder="기술명을 입력하세요" style="width:50%" required/></td>' +
        '</tr>' +
        '<tr>' +
        '<th>숙련도 및 등급</th>' +
        '<td data-title=\'숙련도및등급\'>' +
            '<select id="skill_lvl" name="skill_lvl">' +
            '<option value="level_1"> 1급</option>' +
        '<option value="level_2"> 2급</option>' +
        '<option value="level_3"> 3급</option>' +
        '<option value="level_low"> 초급</option>' +
            '<option value="level_middle"> 중급</option>' +
            '<option value="level_high"> 고급</option>' +
            '<option value="level_etc"> 기타</option>' +
            '</select>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<th>경험 기간</th>' +
        '<td data-title=\'경험기간\'>' +
            '<select id="skill_period" name="skill_period">' +
            '<option value="veryshort"> 1년 미만</option>' +
        '<option value="short"> 1년 이상 3년 미만</option>' +
        '<option value="middle"> 3년 이상 5년 미만</option>' +
        '<option value="long"> 5년 이상 7년 미만</option>' +
        '<option value="verylong"> 7년 이상 10년 미만</option>' +
        '<option value="expert"> 10년 이상</option>' +
        '</select>' +
        '</td>' +
        '</tr>' +
        '</table>' +
        '</div>' +
        '<div class="board_button">' +
            '<a href="#" class="b-button color" id="btn-skill-upload"><span><i class="ion-arrow-up-c"></i>등록</span></a>' +
            '<a href="#" class="b-button active" id="btn-skill-cancle"><span><i class="ion-close"></i>취소</span></a>' +
        '</div>' +
            '</form>' +
            '</div>'
        )
        $('#btn-skill-upload').click(function(){
            $('#skill-form').submit();
            return false;
        })
        $('#btn-skill-cancle').click(function(){
            location.reload();
            return false;
        })
    });


    /* Freelancer Career Section */
    $('#js--add-career').on('click', function (event) {
        $('#fl-career').replaceWith(
            '<div class="inside-value">' +
            '<form method="post" action="./lib/career_process.php" class="career-form" id="career-form">' +
            '<div class="form_table">' +
            '<table>' +
            '<col width="20%"/>' +
            '<col width="*"/>' +
            '<tr>' +
            '<th>경력/학력명</th>' +
            '<td data-title=\'경력학력명\'><input type="text" name="career_name" id="career_name" placeholder="경력명을 입력하세요" style="width:50%" required/></td>' +
            '</tr>' +
            '<tr>' +
            '<th>기간</th>' +
            '<td data-title=\'기간\'>' +
            '<input type="text" name="date-from" id="date-from" style="width: 28%; display: inline-block">~' +
            '<input type="text" name="date-to" id="date-to" style="width: 28%; display: inline-block">' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<th>직책</th>' +
            '<td data-title=\'직책\'><input type="text" name="career_rank" id="career_rank" placeholder="직책명을 입력하세요" style="width:50%" required/></td>' +
            '</tr>' +
            '</table>' +
            '</div>' +
            '<div class="board_button">' +
            '<a href="#" class="b-button color" id="btn-career-cancle"><span><i class="ion-ios-list"></i>취소</span></a>' +
            '<a href="#" class="b-button active" id="btn-career-upload"><span><i class="ion-arrow-up-c"></i>등록</span></a>' +
            '</div>' +
            '</form>' +
            '</div>'
        );
        $("#date-from").datepicker();
        $("#date-to").datepicker();
        $('#btn-career-upload').click(function(){
            $('#career-form').submit();
            return false;
        })
        $('#btn-career-cancle').click(function(){
            location.reload();
            return false;
        })
    });

    //$("#proj-skill").tagit();
    /*
     $("#proj-budget").autoNumeric('init', {
     vMin: "0",
     vMax: "1000000000",
     aSign: "\\"
     });
     */


    /*freelancer-profile tab change*/
    $('#btn-seeEval').click(function(){
        $('.tab_list li.active').removeClass('active');
        $('.tabs').tabs("option", "active", 1);
        $('.tab_list li:nth-child(2)').addClass('active');
    });
    $('#btn-seePort').click(function(){
        $('.tab_list li.active').removeClass('active');
        $('.tabs').tabs("option", "active", 2);
        $('.tab_list li:nth-child(3)').addClass('active');
    });
    $('#btn-seeSkill').click(function(){
        $('.tab_list li.active').removeClass('active');
        $('.tabs').tabs("option", "active", 3);
        $('.tab_list li:nth-child(4)').addClass('active');
    });
    $('#btn-seeCareer').click(function(){
        $('.tab_list li.active').removeClass('active');
        $('.tabs').tabs("option", "active", 4);
        $('.tab_list li:nth-child(5)').addClass('active');
    });

    /*client-dashboard tab change*/
    $('#btn-seeWaiting').click(function(){
        $('.tab_list li.active').removeClass('active');
        $('.tabs').tabs("option", "active", 1);
        $('.tab_list li:nth-child(2)').addClass('active');
    });
    $('#btn-seeRecruit').click(function(){
        $('.tab_list li.active').removeClass('active');
        $('.tabs').tabs("option", "active", 2);
        $('.tab_list li:nth-child(3)').addClass('active');
    });
    $('#btn-seeCurrent').click(function(){
        $('.tab_list li.active').removeClass('active');
        $('.tabs').tabs("option", "active", 3);
        $('.tab_list li:nth-child(4)').addClass('active');
    });


    /*participant_list - Send meeting request*/
    $(".btn-meeting").on("click", function (event){
        var userKey= $(this).attr("id");
        var projKey= $(this).attr("projId");

        $("#dialog").dialog({
            resizable: false,
            height:250,
            width:400,
            modal: true,
            buttons: {
                "네, 미팅 신청합니다": function() {
                    $.post("./lib/meet_process.php", {userKey: userKey, projId: projKey}).done(function (data) {
                        alert(data);
                        location.href='./sub.php?page=participant-list&projId='+ projKey;
                    });
                },
                "아니오": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });

});