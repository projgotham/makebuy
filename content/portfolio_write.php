<link rel="stylesheet" href="../css/style.css?ver=20160307" xmlns:about="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="../css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="../css/settings.css" media="screen" />

<script src="../js/jquery-1.11.0.min.js" type="text/javascript"></script> <!-- jQuery -->

<form id="port-form" action="../lib/upload_portfolio_s3.php" method="post" enctype="multipart/form-data">
    <h3 class="content-subject">포트폴리오</h3>
    <div class="form_table">
        <table>
            <col width='20%' />
            <col width='*' />
            <tr>
                <th>제목</th>
                <td data-title='제목'><input type="text" name="subject" id="subject" placeholder="제목" required /></td>
            </tr>
            <tr>
                <th>내용</th>
                <td data-title='설명'>
                    <textarea class="" name="content" id="content" placeholder="포트폴리오 설명 " required></textarea>
                </td>
            </tr>
            <tr>
                <th>대표이미지</th>
                <td data-title='이미지'>
                    <input type="file" name="portfolio" id="portfolio"/>
                    <br/>
                    <br/>
                    <p>500kb 미만의 이미지파일(jpg, jped, png, gif)만 업로드 가능합니다</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="board_button">
        <a href="#" class="b-button color" onclick="window.close();"><span><i class="ion-ios-list"></i>취소</span></a>
        <a href="#" class="b-button active" id="upload-port"><span><i class="ion-arrow-up-c"></i>업로드</span></a>
        <script>
            //submit form with jQuery, because we use button instead of input type=submit
            $('#upload-port').click(function(){
                $('#port-form').submit();
                return false;
            });
        </script>

    </div>
</form>


