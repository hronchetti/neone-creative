<?php
require_once('config/setEnv.php');
require_once('classes/pdoDB.class.php');

$db = pdoDB::getConnection();
// Getting test answers from request stream (HTTP_GET)
$question1Answer = isset($_REQUEST['question1']) ? $_REQUEST['question1'] : null;
$question2Answer = isset($_REQUEST['question2']) ? $_REQUEST['question2'] : null;
$question3Answer = isset($_REQUEST['question3']) ? $_REQUEST['question3'] : null;
$question4Answer = isset($_REQUEST['question4']) ? $_REQUEST['question4'] : null;
$question5Answer = isset($_REQUEST['question5']) ? $_REQUEST['question5'] : null;
$question6Answer = isset($_REQUEST['question6']) ? $_REQUEST['question6'] : null;
$question7Answer = isset($_REQUEST['question7']) ? $_REQUEST['question7'] : null;
$question8Answer = isset($_REQUEST['question8']) ? $_REQUEST['question8'] : null;
$question9Answer = isset($_REQUEST['question9']) ? $_REQUEST['question9'] : null;
$question10Answer = isset($_REQUEST['question10']) ? $_REQUEST['question10'] : null;
$question11Answer = isset($_REQUEST['question11']) ? $_REQUEST['question11'] : null;
$question12Answer = isset($_REQUEST['question12']) ? $_REQUEST['question12'] : null;
$question13Answer = isset($_REQUEST['question13']) ? $_REQUEST['question13'] : null;
$question14Answer = isset($_REQUEST['question14']) ? $_REQUEST['question14'] : null;
$question15Answer = isset($_REQUEST['question15']) ? $_REQUEST['question15'] : null;
$question16Answer = isset($_REQUEST['question16']) ? $_REQUEST['question16'] : null;
$question17Answer = isset($_REQUEST['question17']) ? $_REQUEST['question17'] : null;
$question18Answer = isset($_REQUEST['question18']) ? $_REQUEST['question18'] : null;
// Getting user demographics entered in test form
$gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : null;
$age = isset($_REQUEST['age']) ? $_REQUEST['age'] : null;
$town = isset($_REQUEST['town']) ? $_REQUEST['town'] : null;
$discipline = isset($_REQUEST['discipline']) ? $_REQUEST['discipline'] : null;
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
// Creating an array of the answers so they can be cycled through easily
$answers = array($question1Answer, $question2Answer, $question3Answer, $question4Answer, $question5Answer, $question6Answer, $question7Answer, $question8Answer, $question9Answer, $question10Answer, $question11Answer, $question12Answer, $question13Answer, $question14Answer, $question15Answer, $question16Answer, $question17Answer, $question18Answer);
// Creating empty variables for the archetype counters prevent NULL errors
$contemplative = '';
$impulsive = '';
$inquisitive = '';
$introspective = '';
$intuitive = '';
$proactive = '';
$progressive = '';
$reactive = '';
$transactive = '';

foreach ($answers as $answer) {
    // COUNTERS FOR ANSWERS
    if ($answer === 'Contemplative') {
        $contemplative++;
    } else if ($answer === 'Impulsive') {
        $impulsive++;
    } else if ($answer === 'Inquisitive') {
        $inquisitive++;
    } else if ($answer === 'Introspective') {
        $introspective++;
    } else if ($answer === 'Intuitive') {
        $intuitive++;
    } else if ($answer === 'Proactive') {
        $proactive++;
    } else if ($answer === 'Progressive') {
        $progressive++;
    } else if ($answer === 'Reactive') {
        $reactive++;
    } else if ($answer === 'Transactive') {
        $transactive++;
    }
}
// Inserting all answers counters into an array with keys so values stored aren't just numbers
$answerFrequencies = array('contemplative' => $contemplative, 'impulsive' => $impulsive, 'inquisitive' => $inquisitive, 'introspective' => $introspective, 'intuitive' => $intuitive, 'proactive' => $proactive, 'progressive' => $progressive, 'reactive' => $reactive, 'transactive' => $transactive);

// Ordering answers counters highest to lowest
arsort($answerFrequencies);
// Getting the key values of the ordered array, and splitting into the 3 groups - 1 for each
$highest3Answers = array_keys(array_slice($answerFrequencies, 0, 3, true));
$middle3Answers = array_keys(array_slice($answerFrequencies, 3, 3, true));
$lowest3Answers = array_keys(array_slice($answerFrequencies, 6, 3, true));

$insertSQL = pdoDB::getConnection()->prepare("INSERT INTO user_inputs (question1Answer, question2Answer, question3Answer, question4Answer, question5Answer, question6Answer, question7Answer, question8Answer, question9Answer, question10Answer, question11Answer, question12Answer, question13Answer, question14Answer, question15Answer, question16Answer, question17Answer, question18Answer, gender, age, town, discipline, email, contemplative, impulsive, inquisitive, introspective, intuitive, proactive, progressive, reactive, transactive)
              VALUES (:question1Answer, :question2Answer, :question3Answer, :question4Answer, :question5Answer, :question6Answer, :question7Answer, :question8Answer, :question9Answer, :question10Answer, :question11Answer, :question12Answer, :question13Answer, :question14Answer, :question15Answer, :question16Answer, :question17Answer, :question18Answer, :gender, :age, :town, :discipline, :email, :contemplative, :impulsive, :inquisitive, :introspective, :intuitive, :proactive, :progressive, :reactive, :transactive)");

$insertSQL->execute(array(
    "question1Answer" => $question1Answer,
    "question2Answer" => $question2Answer,
    "question3Answer" => $question3Answer,
    "question4Answer" => $question4Answer,
    "question5Answer" => $question5Answer,
    "question6Answer" => $question6Answer,
    "question7Answer" => $question7Answer,
    "question8Answer" => $question8Answer,
    "question9Answer" => $question9Answer,
    "question10Answer" => $question10Answer,
    "question11Answer" => $question11Answer,
    "question12Answer" => $question12Answer,
    "question13Answer" => $question13Answer,
    "question14Answer" => $question14Answer,
    "question15Answer" => $question15Answer,
    "question16Answer" => $question16Answer,
    "question17Answer" => $question17Answer,
    "question18Answer" => $question18Answer,
    "gender" => $gender,
    "age" => $age,
    "town" => $town,
    "discipline" => $discipline,
    "email" => $email,
    "contemplative" => $contemplative,
    "impulsive" => $impulsive,
    "inquisitive" => $inquisitive,
    "introspective" => $introspective,
    "intuitive" => $intuitive,
    "proactive" => $proactive,
    "progressive" => $progressive,
    "reactive" => $reactive,
    "transactive" => $transactive
));

/*----- EMAILS ----- */

include('email/emailTemplate.php');

if(isset($email)){
    require 'PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                             // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                     // Enable SMTP authentication
    $mail->Username = 'neonecreative@gmail.com';               // SMTP username
    $mail->Password = 'NEOC_cfne18';                           // SMTP password
    $mail->Port = 587;                                          // TCP port to connect to
    $mail->setFrom('neonecreative@gmail.com', 'NEone Creative');         // From address
    $mail->addAddress($email);                                  // Add a recipient
    $mail->addReplyTo('neonecreative@gmail.com', 'NEone Creative');
    $mail->isHTML(true);                                 // Set email format to HTML
    $mail->Subject = 'Your IPBAR Test Result';
    $mail->Body    = $emailContent;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="I just took the freelancer/independent professional archetype test, take yours now">
    <meta property="og:url" content="http://harryronchetti.com/neone-creative/">
    <meta property="og:description" content="I just took the freelancer/independent professional archetype test and found out I demonstrate <?php
    foreach ($highest3Answers as $archetype){
        echo $archetype . ', ';
    }
    ?> behaviours. Take your test here: http://harryronchetti.com/neone-creative/">
    <meta property="og:site_name" content="NEone Creative">
    <title>Your result</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet">
    <link href="libs/css/main.css" rel="stylesheet">
</head>
<body>
<header class="header--purple">
    <section class="wrapper">
        <nav class="nav--purple">
            <span class="nav__logo">
                <img class="nav__logoImage" src="libs/img/CF_Logo--Purple.png">
                <span class="nav__logoText">NEone Creative</span>
            </span>
            <div class="nav__items">
                <a class="button" href="index.html">Back to home</a>
            </div>
        </nav>
        <article>
            <h1 class="h1 text--dark">Your result</h1>
            <div class="sharethis-inline-share-buttons"></div>
            <p class="text--light col__12-8 test__resultIntro">
                This Independent Professional Behaviour Archetypes Report (IPBAR) is designed to provide you with insights into how you might behave or respond to particular challenges as a freelancer.  It has been constructed from research gathered from independent professionals across the North East of England but it may also hold value if you are from outside of this geographic region.  Like many reports following personality tests this should be read with an open and critical mind as it is designed to help you reflect upon your self-awareness and self-management behaviours.
            </p>
        </article>
    </section>
</header>
<main class="wrapper">
    <h2 class="h2 text--dark">3 Behaviours you may recognise in yourself</h2>
    <?php
    foreach ($highest3Answers as $similarArchetype) {
        include('partials/' . $similarArchetype . 'Behaviour.html');
    }
    ?>
    <article class="archetype__behaviour">
        <section class="archetype__behaviourSecondary col__12-6">
            <h3 class="h2 text--dark">3 Behaviours you could find support from</h3>
            <ul class="archetype__list">
                <?php
                foreach ($middle3Answers as $supportiveArchetype) {
                    $captialisedValue = ucwords($supportiveArchetype);
                    echo <<<BEHAVIOURS
                        <li><a class="archetype__link" href="$supportiveArchetype.html" target="_blank">$captialisedValue</a></li>
BEHAVIOURS;
                }
                ?>
            </ul>
        </section>
        <section class="archetype__behaviourSecondary col__12-6">
            <h3 class="h2 text--dark">3 Behaviours that could show you a new perspective</h3>
            <ul class="archetype__list">
                <?php
                foreach ($lowest3Answers as $contrastingArchetype) {
                    $captialisedValue = ucwords($contrastingArchetype);
                    echo <<<BEHAVIOURS
                        <li><a class="archetype__link" href="$contrastingArchetype.html" target="_blank">$captialisedValue</a></li>
BEHAVIOURS;
                }
                ?>
            </ul>
        </section>
    </article>
    <footer class="footer">&copy; Copyright 2018 NEone Creative</footer>
    <div id="result"></div>
    <script type='text/javascript'
            src='//platform-api.sharethis.com/js/sharethis.js#property=5b8becdd5f7cb000119f5b16&product=inline-share-buttons'
            async='async'></script>
    <script>
        // Storing the completion status of the test in a localStorage variable so that it can be checked on other pages
        localStorage.setItem('finishedTest', 'Yes');
    </script>
</main>
</body>
</html>