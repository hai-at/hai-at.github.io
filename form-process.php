<?php
if (isset($_POST['email'])) {
    
    // REPLACE THIS 2 LINES AS YOU DESIRE
    $email_to = "vpetsck@know-center.at";
    $email_subject = "[HAI] new contact - send me info";
    
    function problem($error)
    {
        echo "Oh looks like there is some problem with your form data: <br><br>";
        echo $error . "<br><br>";
        echo "Please fix those to proceed.<br><br>";
        die();
    }
    
    // validation expected data exists
    if (
        !isset($_POST['fullName']) ||
        !isset($_POST['email'])
        // !isset($_POST['message'])
        ) {
            problem('Oh looks like there is some problem with your form data.');
        }
        
    $name = $_POST['fullName']; // required
    $email = $_POST['email']; // required
  //  $message = $_POST['message']; // required
    $message= "Hello, please send me more information about projects.";

    
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    
    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Email address does not seem valid.<br>';
    }
    
    $string_exp = "/^[A-Za-z .'-]+$/";
    
    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Name does not seem valid.<br>';
    }
    
    if (strlen($message) < 2) {
        $error_message .= 'Message should not be less than 2 characters<br>';
    }
    
    if (strlen($error_message) > 0) {
        problem($error_message);
    }
    
    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }
    
    $email_message = clean_string($message) . "\n\n";
    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    
    $headers = 'From: ' . $email . "\r\n";
    $headers .= 'Reply-To: ' . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Send the email
    $mailSuccess = mail($email_to, $email_subject, $email_message, $headers);

    echo 'Thank you for contacting us! We will get back to you as soon as possible.';
}
?>