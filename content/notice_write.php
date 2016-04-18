<section>
    <form id="notice-form" action="./lib/upload_notice.php" method="post">
        <div class="form_table">
            <table>
                <col width='20%'/>
                <col width='*'/>
                <tr>
                    <th>제목</th>
                    <td data-title='제목'><input type="text" name="title" id="title" placeholder="제목" required/></td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td data-title='내용'>
                        <textarea class="" name="content" id="content" placeholder="내용 " required></textarea>
                    </td>
                </tr>
            </table>
        </div>
        <div class="board_button">
            <a href="./sub.php?page=notice_list" class="b-button color"><span><i class="ion-ios-list"></i>목록</span></a>
            <?php
            session_start();
            $user = $_SESSION['user_key'];
            //display write button when user is admin
            if ($user == 3) {
                echo "<a href=\"#\" class=\"b-button active\" id=\"btn-notice\"><span><i class=\"ion-arrow-up-c\"></i>업로드</span></a>";
            }
            ?>
            <script>
                //submit form with jQuery, because we use button instead of input type=submit
                $('#btn-notice').click(function () {
                    $('#notice-form').submit();
                    return false;
                });
            </script>

        </div>
    </form>
