<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">
<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous"> -->

<!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
<style>
    @import url(http://fonts.googleapis.com/earlyaccess/nanumgothic.css);

    a {
        text-decoration: none !important;
    }

    body {
        font-family: 'Nanum Gothic', sans-serif;
    }

    .faq-title {
        line-height: 100%;
        font-size: 40px;
        font-weight: 400;
    }

    .faq-title .border {
        bottom: 0px;
        width: 100%;
        height: 3px;
        background-color: #ced9d4;
        margin: 15px 0 25px 0;
    }

    .faq-title .border span {
        float: left;
        width: 70px;
        height: 3px;
        background-color: #09b262;
    }

    .accordian-title-content {
        margin-bottom: 30px;
    }

    .accordian-title {
        margin: 10px 10px 20px 10px;
    }

    .accordian-title h3 {
        font-size: 25px;
        border-left: 3px solid #09b262;
        padding-left: 15px;
    }

    #box {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #ced9d4;
        border-radius: 5px;
        margin: 1px 0;
    }

    #box .tap {
        background-color: #f2f5f4;

    }

    #box .tap-title {
        font-size: 18px;
        color: #434343;
        text-decoration: none;
        margin: 0 0 5px 0;
    }

    #box .question {
        font-weight: 600;
        font-size: 25px;
        color: #09b262;
        margin: 5px;
    }

    #box .answer {
        font-size: 15px;
        line-height: 22px;
        text-indent: 15px;

    }
</style>
<div class="col-md-9 col-md-offset-1">
    <div class="title">
            <span class="faq-title">FAQ
            <div class="border">
                <span></span>
            </div>
            </span>
    </div>
    <sector class="total-group" style="text-align:left" style="font-family: 'Nanum Gothic', sans-serif;">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="accordian-title-content">
                <div class="accordian-title">
                    <h3>공통</h3>
                </div>
                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                           aria-expanded="true" aria-controls="collapseOne">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="tap-title">
                                    <span class="question">Q</span> 메이크바이는 어떻게 이용하나요?
                                    <div class="border">
                                        <span></span>
                                    </div>
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <p class="answer">
                                <br>
                                 <strong>클라이언트</strong><br>
                                1. 프로젝트 등록을 위해서 회원가입 후 ‘프로젝트 등록’ 페이지에서 원하는 프로젝트 내용을 작성하시고 등록해주세요.<br><br>
                                2. 프로젝트의 정확한 내용 확인을 위해 메이크바이에서 검수 후에 프로젝트 모집이 시작됩니다.<br><br>
                                3. ‘클라이언트 대시보드’에서 현재 등록된 프로젝트와 지원자를 확인하실 수 있습니다. 지원받은 프리랜서 중에서 미팅을 신청하시면 일정조율 후 미팅이
                                진행됩니다.<br><br>
                                4. 미팅 후 프로젝트에 대해서 최종적으로 합의된 내용으로 계약서 작성이 이뤄집니다. 계약서에 날인이 되고, 프로젝트 대금이 입금되면 프로젝트가
                                시작됩니다.<br><br><br><br>
                                 <strong>프리랜서</strong><br>
                                1. ‘프로젝트 찾기’페이지에서 원하는 프로젝트에 지원해주세요.<br><br>
                                2. 클라이언트가 미팅을 요청할 경우, 개별적으로 연락을 드리고 미팅을 하게 됩니다. <br><br>
                                3. 최종적으로 합의된 계약서에 날인이 되고, 프로젝트 대금이 입금되면 프로젝트가 시작됩니다.<br>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                           aria-expanded="false" aria-controls="collapseTwo" id="tap">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="tap-title">
                                    <span class="question">Q</span> 회원유형을 바꾸고 싶은데 어떻게 하나요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <p class="answer">
                                <br>현재 메이크바이의 회원유형은 ‘클라이언트’와 ‘프리랜서’로 나눠져 있습니다.
                                <br>회원유형을 바꾸기 위해서는 새로운 이메일로 회원가입을 해야 합니다.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                           aria-expanded="false" aria-controls="collapseThree">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>탈퇴하고 싶은데 어떻게 하나요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingThree">
                        <div class="panel-body">
                            <p class="answer">
                                고객센터 이메일(help@makebuy.co.kr)로 탈퇴 신청을 해주시면 됩니다.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="accordian-title-content">
                <div class="accordian-title">
                    <h3>클라이언트(발주자)</h3>
                </div>
                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                           aria-expanded="true" aria-controls="collapseFour">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>서비스 이용료는 얼마인가요?
                                    <div class="border">
                                        <span></span>
                                    </div>
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingFour">
                        <div class="panel-body">
                            <p class="answer">
                                프로젝트 등록부터 종료까지 별도의 비용 없이 무료입니다.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                           aria-expanded="false" aria-controls="collapseFive" id="tap">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="tap-title">
                                    <span class="question">Q</span> 전문지식이 없는데 프로젝트 내용을 작성할 수 있나요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingFive">
                        <div class="panel-body">
                            <p class="answer">
                                프로젝트 내용 작성에 어려움을 겪는다면 기획도우미 서비스를 통해 도움을 받으실 수 있습니다. 혹은 고객센터로 연락을 주시면 상담을 통해 프로젝트 내용을
                                구체화시킬 수 있습니다.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix"
                           aria-expanded="false" aria-controls="collapseSix">
                            <div class="panel-heading" role="tab" id="headingSix">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>기획도우미란 무엇인가요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                        <div class="panel-body">
                            <p class="answer">
                                기획도우미란 원하는 앱의 대략적인 견적을 살펴볼 수 있는 서비스입니다. 곧 출시예정이니 기대해주세요.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven"
                           aria-expanded="false" aria-controls="collapseSeven">
                            <div class="panel-heading" role="tab" id="headingSeven">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>프로젝트 내용을 무조건 공개해야 하나요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingSeven">
                        <div class="panel-body">
                            <p class="answer">
                                공개가 어려운 부분을 제외한 내용으로 프로젝트 모집 후에 미팅 시 자세한 내용을 말하는 방법으로 프로젝트 진행이 가능합니다. 또한 미팅 시
                                NDA(비밀계약유지서) 작성을 원하실 경우 지원해드립니다.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight"
                           aria-expanded="false" aria-controls="collapseEight">
                            <div class="panel-heading" role="tab" id="headingEight">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>미팅은 어떤 방식으로 진행되나요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingEight">
                        <div class="panel-body">
                            <p class="answer">
                                미팅은 프로젝트 등록 시에 선택하셨던 온라인, 오프라인 미팅 중 하나의 형태로 이뤄집니다.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine"
                           aria-expanded="false" aria-controls="collapseNine">
                            <div class="panel-heading" role="tab" id="headingNine">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>진행 중에 분쟁이 발생하거나, 프로젝트가 중지될 경우 어떻게 되는건가요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseNine" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingNine">
                        <div class="panel-body">
                            <p class="answer">
                                일차적으로 클라이언트와 프리랜서 간 협의에 따라 분쟁이 조정됩니다. 둘 사이에서 합의점을 찾지 못할 경우, 이용약관에 명시된 메이크바이의 분쟁 해결절차를
                                따르게 됩니다.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen"
                           aria-expanded="false" aria-controls="collapseTen">
                            <div class="panel-heading" role="tab" id="headingTen">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>프로젝트가 종료된 이후에도 유지보수를 받을 수 있나요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                        <div class="panel-body">
                            <p class="answer">
                                계약된 내용에 따라 하자보수 기간에 유지보수를 받을 수 있습니다. 그러나 계약 범위를 넘어선 문제에 대해서는 추가적인 계약에 따라 유지보수가 이뤄집니다.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven"
                           aria-expanded="false" aria-controls="collapseEleven">
                            <div class="panel-heading" role="tab" id="headingEleven">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>프로젝트를 취소하고 환불받을 수 있나요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingEleven">
                        <div class="panel-body">
                            <p class="answer">
                                프로젝트 완료 후에는 취소나 환불이 안됩니다. 프로젝트 진행 중에 취소를 원하시면 계약서에 협의된 내용에 따라 작업 범위나 기간에 따라 대금을 환불 받게
                                됩니다.
                            </p>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve"
                           aria-expanded="false" aria-controls="collapseTwelve">
                            <div class="panel-heading" role="tab" id="headingTwelve">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>세금계산서를 발급 받을 수 있는 건가요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingTwelve">
                        <div class="panel-body">
                            <p class="answer">
                                네, 가능합니다. 세금계산서 발행을 원하실 경우 고객센터(help@makebuy, 070-7500-5850)로 연락해주시면 됩니다.
                            </p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="accordian-title-content">
                <div class="accordian-title">
                    <h3>프리랜서(수주자)</h3>
                </div>
                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThirdteen"
                           aria-expanded="true" aria-controls="collapseThirdTeen">
                            <div class="panel-heading" role="tab" id="heading-tap">
                                <h4 class="tap-title">
                                    <span class="question">Q</span> 서비스 이용료는 얼마인가요?
                                    <div class="border">
                                        <span></span>
                                    </div>
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseThirdteen" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingThirdteen">
                        <div class="panel-body">
                            <p class="answer">
                                서비스 이용료는 프로젝트 완료 시, 전체 프로젝트 대금의 10%입니다.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFourteen"
                           aria-expanded="false" aria-controls="collapseFourteen" id="tap">
                            <div class="panel-heading" role="tab" id="headingFourteen">
                                <h4 class="tap-title">
                                    <span class="question">Q</span> 개인도 프리랜서로 활동 가능한가요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseFourteen" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingFourteen">
                        <div class="panel-body">
                            <p class="answer">
                                네, 가능합니다. 사업자가 아니셔도 프로젝트 수주와 진행이 가능합니다.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFifteen"
                           aria-expanded="false" aria-controls="collapseFifteen">
                            <div class="panel-heading" role="tab" id="headingFifteen">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>프로젝트 지원하면 어떤 기준으로 선택되는 건가요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseFifteen" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingFifteen">
                        <div class="panel-body">
                            <p class="answer">
                                프리랜서 선정은 클라이언트의 선택으로 이뤄집니다. 자기소개 및 보유기술, 포트폴리오 등을 매력적으로 작성하시면 선택될 확률이 높아집니다.
                            </p>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSixteen"
                           aria-expanded="false" aria-controls="collapseSixteen">
                            <div class="panel-heading" role="tab" id="headingSixteen">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>대금 지급은 어떻게 정해지나요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseSixteen" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingSixteen">
                        <div class="panel-body">
                            <p class="answer">
                                대금 지급은 메이크바이의 에스크로 서비스에 따라 클라이언트가 선입금한 대금을 프로젝트 완료 후 지급받게 됩니다.
                            </p>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default" id="box">
                    <div class="tap">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeventeen"
                           aria-expanded="false" aria-controls="collapseSeventeen">
                            <div class="panel-heading" role="tab" id="headingSeventeen">
                                <h4 class="tap-title">
                                    <span class="question">Q</span>프로젝트 완료 후 바로 대금을 받을 수 있는 건가요?
                                </h4>
                            </div>
                        </a>
                    </div>
                    <div id="collapseSeventeen" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingSeventeen">
                        <div class="panel-body">
                            <p class="answer">
                                대금 지급은 프로젝트 완료 후 클라이언트의 승인이 이뤄진 후 24시간 이내에 이뤄집니다.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </sector>
</div>