<?php
if(isset($_POST['email'])) {

    // Change this to your email address.
    $email_to = "ouattaraismael1999@mail.com";

    $email_subject = "Form subission detected";


    function died($error) {
      //echo '<script type="text/javascript">alert("Sorry this is a very big file .. max file size is '.$maxSize.' Bytes = 1 MB");</script>';

      //  echo "Sorry, but errors occured when you filled out the form. ";
      //  echo "These errors appear below.<br /><br />";
      //  echo $error."<br /><br />";
      //  echo "Please correct these errors, and then submit again..<br /><br />";
        echo '<script type="text/javascript">
        alert("Sorry, but errors occured:- '.$error.' please correct these errors.");
        window.history.back();
        </script>';
        //sleep(10);
        //header('Location: ' . $_SERVER["HTTP_REFERER"] );
        die();
    }

    if(
        !isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message']) ||
        !isset($_POST['phone'])) {
        died('There appears to be a problem with what you submitted.');
    }

   
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email_from = $_POST['email'];
    $message = $_POST['message'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid. ';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid. ';
  }
  if(strlen($message) < 2) {
    $error_message .= 'The message you entered do not appear to be valid. ';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Details are below.\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "message: ".clean_string($message)."\n";

$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>

<script type="text/javascript">
alert("Thank you for contacting us!  We'll be in touch soon!");
window.history.go(-2);
</script>;

<?php
}
die();
?>
