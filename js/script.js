jQuery(document).ready(function () {

    jQuery('.tabs .tab-links a').on('click', function(e)  {
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
        $('#client-profile').replaceWith(
            '<div class="col span-2-of-3">' +
            '<form method="post" action="../lib/cl_profile_process.php" class="profile-form">' +
            '<textarea name="profile-textarea" id="profile-textarea" />' +
            '<input type="submit" value="프로필 수정하기" id="editProfile-submit" name="editProfile-submit" class="btn-big">' +
            '</form>' +
            '</div>');
        $('#fl-profile').replaceWith(
            '<div class="col span-2-of-3">' +
            '<form method="post" action="../lib/cl_profile_process.php" class="profile-form">' +
            '<textarea name="profile-textarea" id="profile-textarea" />' +
                // '<?php $userDesc = $current_user-&gt;getUserDesc(); echo "&lt;h3&gt;$userDesc&lt;/h3&gt;"; ?>;' +
            '<input type="submit" value="프로필 수정하기" id="editProfile-submit" name="editProfile-submit" class="btn-big">' +
            '</form>' +
            '</div>');
    });

    /* Portfolio Section */

    /* Skill Section */
    $('#js--add-skill').on('click', function (event) {
        $('#fl-skill').replaceWith(
            '<div class="inside-value">' +
                '<form method="post" action="../lib/skill_process.php" class="skill-form">' +
                    '<div class="row">' +
                        '<div class="col span-1-of-2" style="text-align: center">' +
                            '<label for="skill_name">기술/자격증명</label>' +
                        '</div>' +
                        '<div class="col span-1-of-2" style="text-align: left">' +
                            '<input type="text" id="skill_name" name="skill_name" placeholder="기술명을 입력하세요" style="width:50%">' +
                        '</div>' +
                    '</div>' +
                    '<div class="row">' +
                        '<div class="col span-1-of-2" style="text-align: center">' +
                            '<label>숙련도 및 등급</label>' +
                        '</div>' +
                        '<div class="col span-1-of-2" style="text-align: left">' +
                            '<select id="skill_lvl" name="skill_lvl">' +
                                '<option value="level_1">1급</option>' +
                                '<option value="level_2">2급</option>' +
                                '<option value="level_3">3급</option>' +
                                '<option value="level_low">초급</option>' +
                                '<option value="level_middle">중급</option>' +
                                '<option value="level_high">고급</option>' +
                                '<option value="level_etc">기타</option>' +
                            '</select>' +
                        '</div>' +
                    '</div>' +
                        '<div class="row">' +
                            '<div class="col span-1-of-2" style="text-align: center">' +
                                '<label>경험 기간</label>' +
                            '</div>' +
                            '<div class="col span-1-of-2" style="text-align: left">' +
                                '<select id="skill_period" name="skill_period">' +
                                    '<option value="veryshort">1년 미만</option>' +
                                    '<option value="short">1년 이상 3년 미만</option>' +
                                    '<option value="middle">3년 이상 5년 미만</option>' +
                                    '<option value="long">5년 이상 7년 미만</option>' +
                                    '<option value="verylong">7년 이상 10년 미만</option>' +
                                    '<option value="expert">10년 이상</option>' +
                                '</select>' +
                            '</div>' +
                        '</div>' +
                    '<div class="row" style="text-align: center; padding-top: 20px;">' +
                        '<input type="submit" id="submit_skill" name="submit_skill" value="추가하기">' +
                    '</div>' +
                '</form>' +
            '</div>'
        )
    });


    /* Freelancer Career Section */
    $('#js--add-career').on('click', function (event) {
        $('#fl-career').replaceWith(
            '<div class="inside-value">' +
                '<form method="post" action="../lib/career_process.php" class="career-form">' +
                    '<div class="row">' +
                        '<div class="col span-1-of-2" style="text-align: center">' +
                            '<label for="career_name">경력/학력명</label>' +
                        '</div>' +
                        '<div class="col span-1-of-2" style="text-align: left">' +
                            '<input type="text" id="career_name" name="career_name" placeholder="경력명을 입력하세요" style="width:50%">' +
                        '</div>' +
                    '</div>' +
                    '<div class="row">' +
                        '<div class="col span-1-of-2" style="text-align: center">' +
                            '<label>기간</label>' +
                        '</div>' +
                        '<div class="col span-1-of-2" style="text-align: left">' +
                            '<input type="text" name="date-from" id="date-from" style="width: 28%; display: inline-block">~' +
                            '<input type="text" name="date-to" id="date-to" style="width: 28%; display: inline-block">' +
                        '</div>' +
                    '</div>' +
                    '<div class="row">' +
                        '<div class="col span-1-of-2" style="text-align: center">' +
                            '<label for="career_rank">직책</label>' +
                        '</div>' +
                        '<div class="col span-1-of-2" style="text-align: left">' +
                            '<input type="text" id="career_rank" name="career_rank" placeholder="직책명을 입력하세요" style="width:50%">' +
                        '</div>' +
                    '</div>' +
                    '<div class="row" style="text-align: center; padding-top: 20px;">' +
                        '<input type="submit" id="submit_career" name="submit_career" value="추가하기">' +
                    '</div>' +
                '</form>' +
            '</div>'
        );
        $("#date-from").datepicker();
        $("#date-to").datepicker();
    });

    //$("#proj-skill").tagit();
    /*
    $("#proj-budget").autoNumeric('init', {
        vMin: "0",
        vMax: "1000000000",
        aSign: "\\"
    });
    */
});