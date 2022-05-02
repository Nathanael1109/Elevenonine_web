<?php
if (isset($_POST['Email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "nathanael.lamproye@hotmail.fr";
    $email_subject = "[Elevenonine] Nouveau message !";

    function problem($error)
    {
        echo "Nous sommes désolés, mais votre message n'a pas pu être envoyé. ";
        echo "Les erreurs sonts listés ci dessou.<br><br>";
        echo $error . "<br><br>";
        echo "Essayez de corriger ces erreurs ou essayez plustot via l'adresse Email suivant : 'nathanael.lamporye@hotmail.fr' ou via Discord : 'Nathanaël#0406'.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Je suis désolé, mais un probléme est survenu.');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= "L'adresse Email n'est pas valide.<br>";
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= "Le nom n'est pas valide.</p>.<br>";
    }

    if (strlen($message) < 2) {
        $error_message .= "Le message n'est pas valide.<br>";
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- include your success message below -->

    Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais. Merci de votre intérêt.

<?php
}
?>