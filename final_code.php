<?php 
    session_start();
    if (!isset($_SESSION['ans'])) {
        $_SESSION['ans'] = rand(1, 99);   
    }
    if (!isset($_SESSION['min'])) {
        $_SESSION['min'] = 1;
    }
    if (!isset($_SESSION['max'])) {
        $_SESSION['max'] = 99;
    }

    $ans = $_SESSION['ans'];
    $warning = '';
    $yourAns = 0;

    if (isset($_POST["answer"])) {
        $yourAns = $_POST["answer"];
    };

    if(!$yourAns){
        $warning = '請輸入數字！';
    } else if ($yourAns > $ans) {
        $_SESSION['max'] = $yourAns;
    } else if ($yourAns < $ans ){
        $_SESSION['min'] = $yourAns;
    } else {
        unset($_SESSION['ans']);
        $_SESSION['min'] = 1;
        $_SESSION['max'] = 99;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>終極密碼</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .main-container {
            width: 100%;
            height: 100%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 52px;
            padding: 20px;
            color: #3B4551;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(50px);
        }

        .color-circle {
            position: absolute;
            border-radius: 50%;
            aspect-ratio: 1 / 1;
        }

        .color-circle#blue {
            position: absolute;
            background: #C4D6FF;
            width: 28%;
            min-width: 320px;
            bottom: 56px;
            left: -120px;
        }

        .color-circle#smallgreen {
            position: absolute;
            background: #D0F3F7;
            width: 265px;
            bottom: 15px;
            left: 265px;
        }

        .color-circle#biggreen {
            position: absolute;
            background: #D0F3F7;
            width: 26%;
            min-width: 300px;
            top: -180px;
            right: 71px;
        }

        .color-circle#red {
            position: absolute;
            background: #FEE9EC;
            width: 360px;
            bottom: -129px;
            right: 100px;
        }

        header, main {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            box-shadow: 0 0 50px 18px rgba(223, 224, 226, 0.5);
            padding: 20px 50px;
        }

        header {
            width: 100%;
            max-width: 950px;
            min-height: 115px;
            text-align: center;
        }
        
        header h1 {
            font-size: 30px;            
        }

        header p {
            font-size: 18px;    
            margin-top: 5px;        
        }

        main {
            width: 100%;
            max-width: 950px;
            height: 500px;
        }

        .hint-container {
            margin-top: 10px;
        }

        .hint-container p:nth-child(1),
        .form-container p:nth-child(1),
        .win-container p:nth-child(1){
            text-align: center;
            font-weight: 600;
            font-size: 22px;
        }

        .hint-container p:nth-child(2){
            text-align: center;
            font-weight: 600;
            font-size: 40px;
            color: #00A2B4;
            display: flex;
            align-items: center;
            gap:18px;
            justify-content: center;
        }

        .hint-container p .dash-line{
            background-color: #3B4551;
            width: 10px;
            height: 3px;
            display: inline-block;
        }

        .divide-line {
            width: 100%;
            display: block;    
            height: 2px;
            background-image: linear-gradient(to right, #24BDCE 0%, #24BDCE 50%, transparent 50%);
            background-size: 10px 8px;
            background-repeat: repeat-x;
            margin: 25px auto;
        }

        .form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-top: 25px;
        }

        .form-container input {
            width: 400px;
            border: none;
            background: #F1F4F8;
            margin-top: 25px;
            padding: 16px 18px;
            border-radius: 5px;
            font-size: 16px;
            border: 1.5px solid #F1F4F8;
            transition: border 0.2s ease-in;
            outline: none;
        }

        .form-container input:focus{
            border-color: #4AC8D6;
        }

        .warning-container {
            font-size: 14px;
            color: #e84545;
        }

        .form-container button {
            width: 400px;
            border: none;
            background-color: #4AC8D6;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            color: #fff;
            padding: 16px;
            border-radius: 5px;
            margin-top: 30px;
            animation: animate 5s ease-out infinite normal;
        }

        .win-container p:nth-child(2) {
            text-align: center;
            font-weight: 200;
            margin: 20px 0;
        }

        .win-container p:nth-child(2) span {
            font-size: 22px;
            color: #00A2B4;
        }

        @keyframes animate {
            0% {
                transform: scale(0.9);
            }

            25% {
                transform: scale(1);
            }

            50% {
                transform: scale(0.9);
            }

            75% {
                transform: scale(1);
            }

            100% {
                transform: scale(0.9);
            }
        }
    </style>
</head>
<body>
    <!-- 背景用的圓圈圈 -->
    <div class="color-circle" id="blue"></div>
    <div class="color-circle" id="smallgreen"></div>
    <div class="color-circle" id="biggreen"></div>
    <div class="color-circle" id="red"></div>

    <!-- 以下為功課內容 -->
    <div class="main-container">
        <header>
            <h1>終極密碼</h1>
            <p>依照提示輸入數字，答錯即縮小範圍直到回答正確為止</p>
        </header>
        <main>
            <div class="hint-container">
                <p>提示</p>
                <p>
                    <span>
                        <?php echo $_SESSION['min'] ?>
                    </span>
                    <span class="dash-line"></span>
                    <span>
                        <?php echo $_SESSION['max'] ?>
                    </span> 
                </p>
            </div>
            <span class="divide-line"></span>
            <div>
                <form class="form-container" action="final_code.php" method="post" id="guess_form">
                    <?php if ($yourAns != $ans): ?> 
                        <p>你的答案</p>
                        <input placeholder="請輸入答案" class="answer-container" type="number" name="answer" id="answerInput"  min="<?php echo $_SESSION['min'] ?>" max="<?php echo $_SESSION['max'] ?>" />
                        <p class="warning-container"><?php echo $warning ?></p>
                        <button id="submitanswer" type="submit">提交答案</button>
                    <?php else: ?>
                        <div class="win-container">
                            <p>恭喜答對</p>
                            <p>答案就是 <span><?php echo $ans ?></span></p>
                            <button type="submit">重新開始</button>
                        </div>
                    <?php endif ?>
                </form>
            </div>
        </main>
    </div>
</body>
</html>