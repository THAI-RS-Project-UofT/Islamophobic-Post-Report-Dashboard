<?php
session_start();

include("dbconnect.php");
include("function.php");

$user_data = check_login($con);
$user_name = $user_data['name'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $reporter_name = $_POST['reporter_name'];
    $report_link = $_POST['report_link'];
    $location = $_POST['location'];
    $retweeted = $_POST['retweeted'];
    $followers = $_POST['followers'];
    $following = $_POST['following'];
    $total_tweet = $_POST['total_tweet'];
    $report_post = $_POST['report_post'];


    if (!empty($reporter_name) && !empty($report_link) && !empty($report_post)) {

        //save to database
        //$user_id = random_num(20);
        $query = "insert into report (reporter_name, report_link, location, retweeted, followers, following, total_tweet, report_post, user_name) values ('$reporter_name', 
			'$report_link', '$location', '$retweeted', '$followers', '$following', '$total_tweet', '$report_post','$user_name')";

        mysqli_query($con, $query);

        // echo "
        // <script type=\"text/javascript\">
        // localStorage.setItem('key', 'value');
        // </script>
        // ";

        // echo '<script> sendNotification(); </script>';

        // $_SESSION['notify_form'] = 1;
        header("Location: index_admin.php?notification=report_submitted");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Islamophobic Content Report</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
    html,
    body {
        min-height: 100%;
    }

    body,
    div,
    form,
    input,
    select,
    textarea,
    label {
        padding: 0;
        margin: 0;
        outline: none;
        font-family: Roboto, Arial, sans-serif;
        font-size: 14px;
        color: #666;
        line-height: 22px;
    }

    h1 {
        position: absolute;
        margin: 0;
        line-height: 40px;
        font-size: 40px;
        color: #fff;
        z-index: 2;
        line-height: 83px;
    }

    .testbox {
        display: flex;
        justify-content: center;
        align-items: center;
        height: inherit;
        padding: 20px;
    }

    form {
        width: 100%;
        padding: 20px;
        border-radius: 6px;
        background: #fff;
        box-shadow: 0 0 8px #cc7a00;
    }

    .banner {
        position: relative;
        height: 300px;
        background-image: url("img/back.jpg");
        background-size: 1450px 300px;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .banner::after {
        content: "";
        background-color: rgba(0, 0, 0, 0.2);
        position: absolute;
        width: 100%;
        height: 100%;
    }

    input,
    select,
    textarea {
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    input {
        width: calc(100% - 10px);
        padding: 5px;
    }

    input[type="date"] {
        padding: 4px 5px;
    }

    textarea {
        width: calc(100% - 12px);
        padding: 5px;
    }

    .item:hover p,
    .item:hover i,
    .question:hover p,
    .question label:hover,
    input:hover::placeholder {
        color: #cc7a00;
    }

    .item input:hover,
    .item select:hover,
    .item textarea:hover {
        border: 1px solid transparent;
        box-shadow: 0 0 3px 0 #cc7a00;
        color: #cc7a00;
    }

    .item {
        position: relative;
        margin: 10px 0;
    }

    .item span {
        color: red;
    }

    input[type="date"]::-webkit-inner-spin-button {
        display: none;
    }

    .item i,
    input[type="date"]::-webkit-calendar-picker-indicator {
        position: absolute;
        font-size: 20px;
        color: #cc7a00;
    }

    .item i {
        right: 1%;
        top: 30px;
        z-index: 1;
    }

    [type="date"]::-webkit-calendar-picker-indicator {
        right: 1%;
        z-index: 2;
        opacity: 0;
        cursor: pointer;
    }

    input[type=radio],
    input[type=checkbox] {
        display: none;
    }

    label.radio {
        position: relative;
        display: inline-block;
        margin: 5px 20px 15px 0;
        cursor: pointer;
    }

    .question span {
        margin-left: 30px;
    }

    .question-answer label {
        display: block;
    }

    label.radio:before {
        content: "";
        position: absolute;
        left: 0;
        width: 17px;
        height: 17px;
        border-radius: 50%;
        border: 2px solid #ccc;
    }

    input[type=radio]:checked+label:before,
    label.radio:hover:before {
        border: 2px solid #cc7a00;
    }

    label.radio:after {
        content: "";
        position: absolute;
        top: 6px;
        left: 5px;
        width: 8px;
        height: 4px;
        border: 3px solid #cc7a00;
        border-top: none;
        border-right: none;
        transform: rotate(-45deg);
        opacity: 0;
    }

    input[type=radio]:checked+label:after {
        opacity: 1;
    }

    .btn-block {
        margin-top: 10px;
        text-align: center;
    }

    button {
        width: 150px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background: #cc7a00;
        font-size: 16px;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background: #ff9800;
    }

    @media (min-width: 568px) {

        .name-item,
        .city-item {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .name-item input,
        .name-item div {
            width: calc(50% - 20px);
        }

        .name-item div input {
            width: 97%;
        }

        .name-item div label {
            display: block;
            padding-bottom: 5px;
        }
    }
    </style>
</head>

<body>
    <div class="testbox">


        <form method="post">
            <div class="banner">
                <h1>Report Islamophobic Content</h1>
            </div>


            <div class="item">
                <div class="name-item">
                    <div>
                        <label for="monday">Please enter the username of the content poster.<span>*</span></label>
                        <input id="monday" type="text" name="reporter_name" />
                    </div>

                    <div>
                        <label for="tuesday">Please enter the link of the tweet.<span>*</span></label>
                        <input id="tuesday" type="text" name="report_link" />
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="name-item">
                    <div>
                        <label for="wednesday">Please mention the location from where the tweet was posted.</label>
                        <input id="wednesday" type="text" name="location" />
                    </div>
                    <div>
                        <label for="thursday">How many times the tweet has been retweeted?</label>
                        <input id="thursday" type="number" name="retweeted" />
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="name-item">
                    <div>
                        <label for="friday">How many followers does the poster have?</label>
                        <input id="friday" type="number" name="followers" />
                    </div>
                    <div>
                        <label for="saturday">How many people do the poster is following?</label>
                        <input id="saturday" type="number" name="following" />
                    </div>
                </div>
            </div>
            <div class="item">
                <label for="sunday">What is the count of the poster's total tweet?</label>
                <input id="sunday" type="number" name="total_tweet" />
            </div>

            <div class="item">
                <label for="comment">Please enter the tweet, message, or any other content that you think represents
                    Islamophobia <span>*</span></label>
                <textarea id="comment" type="text" rows="3" name="report_post"></textarea>
            </div>

            <div>
                <input id="button" type="submit" class="btn btn-new btn-user btn-block" value="Submit Report"><br><br>
            </div>


        </form>


    </div>
</body>

</html>