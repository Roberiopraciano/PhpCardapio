<?php

if(!$_POST) exit;

// Email verification, do not edit.
function isEmail($email_review ) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email_review ));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");
$restaurant_name     = $_POST['restaurant_name'];
$name_review     = $_POST['name_review'];
$email_review    = $_POST['email_review'];
$food_review = $_POST['food_review'];
$price_review = $_POST['price_review'];
$punctuality_review = $_POST['punctuality_review'];
$courtesy_review = $_POST['courtesy_review'];
$review_text = $_POST['review_text'];
$verify_review   = $_POST['verify_review'];

if(trim($name_review) == '') {
	echo '<div class="error_message">You must enter your Name.</div>';
	exit();
} else if(trim($email_review) == '') {
	echo '<div class="error_message">Please enter a valid email address.</div>';
	exit();
} else if(!isEmail($email_review)) {
	echo '<div class="error_message">You have enter an invalid e-mail address, try again.</div>';
	exit();
} else if(trim($food_review ) == '') {
	echo '<div class="error_message">Please rate Food Quality.</div>';
	exit();
} else if(trim($price_review ) == '') {
	echo '<div class="error_message">Please rate Price.</div>';
	exit();
} else if(trim($punctuality_review ) == '') {
	echo '<div class="error_message">Please rate Punctuality.</div>';
	exit();
} else if(trim($courtesy_review ) == '') {
	echo '<div class="error_message">Please rate Courtesy.</div>';
	exit();
} else if(trim($review_text) == '') {
	echo '<div class="error_message">Please enter your review.</div>';
	exit();
} else if(!isset($verify_review) || trim($verify_review) == '') {
	echo '<div class="error_message"> Please enter the verification number.</div>';
	exit();
} else if(trim($verify_review) != '4') {
	echo '<div class="error_message">The verification number you entered is incorrect.</div>';
	exit();
}

if(get_magic_quotes_gpc()) {
	$review_text = stripslashes($review_text);
}


//$address = "HERE your email address";
$address = "test@domain.com";


// Below the subject of the email
$e_subject = 'QuickFood Restaurant Review';

// You can change this if you feel that you need to.
$e_body = "You have been contacted by $name_review with the following Restaurant name review: $restaurant_name:" . PHP_EOL . PHP_EOL;
$e_content = "Food Quality rate: $food_review.\nPrice rate: $price_review.\nPunctuality rate: $punctuality_review.\nCourtesy rate: $courtesy_review.\n\nReview: $review_text" . PHP_EOL . PHP_EOL;
$e_reply = "You can contact $name_review  $lastname_review via email: $email_review.";

$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );

$headers = "From: $email_review" . PHP_EOL;
$headers .= "Reply-To: $email_review" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

$user = "$email_review";
$usersubject = "Thank You";
$userheaders = "From: review@quickfood.com\n";
$usermessage = "Thank you for review $restaurant_name. Here a summary of your review: \n $e_content. ";
mail($user,$usersubject,$usermessage,$userheaders);

if(mail($address, $e_subject, $msg, $headers)) {

	// Success message
	echo "<div id='success_page' style='padding:90px 0 80px 0; color:#fff;font-size:16px;'>";
	echo "<strong >Email Sent.</strong>";
	echo "Thank you <strong>$name_review</strong>,<br> your review has been submitted.";
	echo "</div>";

} else {

	echo 'ERROR!';

}
