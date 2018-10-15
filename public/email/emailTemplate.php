<?php
$topAnswers = '';
$midAnswers = '';
$lowAnswers = '';

foreach ($highest3Answers as $similarArchetype2) {
    $topAnswers .= file_get_contents('email/partials/' . $similarArchetype2 . '.html');
}

foreach ($lowest3Answers as $supportiveArchetype2) {
    $captialisedValue = ucwords($supportiveArchetype2);
    $midAnswers .= '<li><a style="font-size: 16px; color: #009EFF; text-decoration: underline;" href="http://www.neone-creative.com/' . $supportiveArchetype2 . '.html">' . $captialisedValue . '</a></li>';
}

foreach ($lowest3Answers as $contrastingArchetype2) {
    $captialisedValue = ucwords($contrastingArchetype2);
    $lowAnswers .= '<li><a style="font-size: 16px; color: #009EFF; text-decoration: underline;" href="http://www.neone-creative.com/' . $contrastingArchetype2 . '.html">' . $captialisedValue . '</a></li>';
}

$emailContent = <<<EMAIL
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your IPBAR Test Result</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style type="text/css">
        
    </style>
</head>
<body>
<table width="600" align="center" cellpadding="0" cellspacing="0" border="0" frame="0" bgcolor="#fff" style="border-spacing: 0; padding: 0; border: 0; font-family: Arial, Helvetica, sans-serif; background-color: #fff; border-collapse: collapse; font-size: 16px; line-height: 24px;">
    <tbody>
    <tr>
        <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" frame="0" bgcolor="#fff" style="border-spacing: 0; padding: 0; border: 0; font-family: Arial, Helvetica, sans-serif; background-color: #fff; border-collapse: collapse; font-size: 16px; line-height: 24px;">
                <tbody>
                    <tr>
                        <td width="168"><img src="http://harryronchetti.com/storage/CF_Logo--Purple.png" alt="Creative Fuse Logo" width="168" height="90" style="display: block; border: none;"/></td>
                        <td width="30"></td>
                        <td width="422"><span style="font-size: 24px; color: #AA26FF; font-weight: bold;">NEone Creative</span></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <h1 style="font-size: 32px; color: #291A33; margin: 26px 0 26px 0;">Your result</h1>
            <p style="font-size: 16px; color: #9C8DA6; margin: 0 0 26px 0">This Independent Professional Behaviour Archetypes Report (IPBAR) is designed to provide you with insights into how you might behave or respond to particular challenges as a freelancer. It has been constructed from research gathered from independent professionals across the North East of England but it may also hold value if you are from outside of this geographic region. Like many reports following personality tests this should be read with an open and critical mind as it is designed to help you reflect upon your self-awareness and self-management behaviours.</p>
            <h2 style="font-size: 24px; color: #291A33; margin: 0 0 26px 0;">3 Behaviours you may recognise in yourself</h2>
        </td>
    </tr>
        $topAnswers
    <tr>
        <td><h2 style="font-size: 24px; color: #291A33; margin: 0 0 16px 0;">3 Behaviours you could find support from</h2></td>
    </tr>
    <tr>
        <td>
            <ul>
                $midAnswers
            </ul>
        </td>
    </tr>
    <tr>
        <td><h2 style="font-size: 24px; color: #291A33; margin: 0 0 16px 0;">3 Behaviours that could show you a new perspective</h2></td>
    </tr>
    <tr>
        <td>
            <ul>
                $lowAnswers
            </ul>
        </td>
    </tr>
    <tr>
        <td>
            <p style="font-size: 16px; color: #9C8DA6; margin: 26px 0 26px 0;">&copy; Copyright 2018 NEone Creative</p>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>

EMAIL;
