<?php
/**
 * Created by PhpStorm.
 * User: ensemble lab
 * Date: 2016-02-02
 * Time: 오후 3:30
 */

session_start();

//현재 세션에 저장된 정보가 있는지 확인한다.

if(isset($_SESSION['user_key'])){
    session_destroy();
    echo "<script>
            alert('로그아웃 되었습니다.');
            location.href='./index.php';
            </script>";
}else{
    //세션에 저장된 정보가 없을 경우 실행을 끝낸다
    exit();
}
?>