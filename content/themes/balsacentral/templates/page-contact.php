<?php
/*
Template Name: Contact Page
*/

global $bcent_sb_pos, $bcent_email, $bcent_success_msg, $bcent_google_map;

///////////////////////////////////////
// sanitize.inc.php
// Sanitization functions for PHP
// by: Gavin Zuchlinski, Jamie Pratt, Hokkaido
// webpage: http://libox.net
// Last modified: September 27, 2003
//
// Many thanks to those on the webappsec list for helping me improve these functions
///////////////////////////////////////
// Function list:
// sanitize_paranoid_string($string) -- input string, returns string stripped of all non 
//           alphanumeric
// sanitize_system_string($string) -- input string, returns string stripped of special
//           characters
// sanitize_sql_string($string) -- input string, returns string with slashed out quotes
// sanitize_html_string($string) -- input string, returns string with html replacements
//           for special characters
// sanitize_int($integer) -- input integer, returns ONLY the integer (no extraneous 
//           characters
// sanitize_float($float) -- input float, returns ONLY the float (no extraneous 
//           characters)
// sanitize($input, $flags) -- input any variable, performs sanitization 
//           functions specified in flags. flags can be bitwise 
//           combination of PARANOID, SQL, SYSTEM, HTML, INT, FLOAT, LDAP, 
//           UTF8
///////////////////////////////////////
define("PARANOID", 1);
define("SQL", 2);
define("SYSTEM", 4);
define("HTML", 8);
define("INT", 16);
define("FLOAT", 32);
define("LDAP", 64);
define("UTF8", 128);
 
// internal function for utf8 decoding
// thanks to Jamie Pratt for noticing that PHP's function is a little 
// screwy
function my_utf8_decode($string)
{
return strtr($string, 
  "???????¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ", 
  "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
}
 
// paranoid sanitization -- only let the alphanumeric set through
function sanitize_paranoid_string($string, $min='', $max='')
{
  $string = preg_replace("/[^a-zA-Z0-9]/", "", $string);
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return $string;
}
 
// sanitize a string in prep for passing a single argument to system() (or similar)
function sanitize_system_string($string, $min='', $max='')
{
  $pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i'; // no piping, passing possible environment variables ($),
                           // seperate commands, nested execution, file redirection, 
                           // background processing, special commands (backspace, etc.), quotes
                           // newlines, or some other special characters
  $string = preg_replace($pattern, '', $string);
  $string = '"'.preg_replace('/\$/', '\\\$', $string).'"'; //make sure this is only interpretted as ONE argument
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return $string;
}
 
// sanitize a string for SQL input (simple slash out quotes and slashes)
function sanitize_sql_string($string, $min='', $max='')
{
  $pattern[0] = '/(\\\\)/';
  $pattern[1] = "/\"/";
  $pattern[2] = "/'/";
  $replacement[0] = '\\\\\\';
  $replacement[1] = '\"';
  $replacement[2] = "\\'";
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return preg_replace($pattern, $replacement, $string);
}
 
// sanitize a string for SQL input (simple slash out quotes and slashes)
function sanitize_ldap_string($string, $min='', $max='')
{
  $pattern = '/(\)|\(|\||&)/';
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return preg_replace($pattern, '', $string);
}
 
 
// sanitize a string for HTML (make sure nothing gets interpretted!)
function sanitize_html_string($string)
{
  $pattern[0] = '/\&/';
  $pattern[1] = '/</';
  $pattern[2] = "/>/";
  $pattern[3] = '/\n/';
  $pattern[4] = '/"/';
  $pattern[5] = "/'/";
  $pattern[6] = "/%/";
  $pattern[7] = '/\(/';
  $pattern[8] = '/\)/';
  $pattern[9] = '/\+/';
  $pattern[10] = '/-/';
  $replacement[0] = '&amp;';
  $replacement[1] = '&lt;';
  $replacement[2] = '&gt;';
  $replacement[3] = '<br>';
  $replacement[4] = '&quot;';
  $replacement[5] = '&#39;';
  $replacement[6] = '&#37;';
  $replacement[7] = '&#40;';
  $replacement[8] = '&#41;';
  $replacement[9] = '&#43;';
  $replacement[10] = '&#45;';
  return preg_replace($pattern, $replacement, $string);
}
 
// make int int!
function sanitize_int($integer, $min='', $max='')
{
  $int = intval($integer);
  if((($min != '') && ($int < $min)) || (($max != '') && ($int > $max)))
    return FALSE;
  return $int;
}
 
// make float float!
function sanitize_float($float, $min='', $max='')
{
  $float = floatval($float);
  if((($min != '') && ($float < $min)) || (($max != '') && ($float > $max)))
    return FALSE;
  return $float;
}
 
// glue together all the other functions
function sanitize($input, $flags, $min='', $max='')
{
  if($flags & UTF8) $input = my_utf8_decode($input);
  if($flags & PARANOID) $input = sanitize_paranoid_string($input, $min, $max);
  if($flags & INT) $input = sanitize_int($input, $min, $max);
  if($flags & FLOAT) $input = sanitize_float($input, $min, $max);
  if($flags & HTML) $input = sanitize_html_string($input, $min, $max);
  if($flags & SQL) $input = sanitize_sql_string($input, $min, $max);
  if($flags & LDAP) $input = sanitize_ldap_string($input, $min, $max);
  if($flags & SYSTEM) $input = sanitize_system_string($input, $min, $max);
  return $input;
}

if(isset($_POST['submit'])) {

	// Reject if Honeypot fields are filled in
	if(trim($_POST['userlastname']) !== '' || trim($POST['subject']) !== '' ) {
		$error_flag = true;
	}

	//Validate Name Field
	if(trim($_POST['username']) === '') {
		$name_err = __( 'Enter Your Name', 'balsacentral' );
		$errorFlag = true;
	}
	else {
		$name = trim($_POST['username']);
		$name = sanitize_system_string($name);
	}

	//Validate E-mail Address
	if(trim($_POST['email']) === '')  {
		$email_err = __( 'An email is required', 'balsacentral' );
		$errorFlag = true;
	} else if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/i", trim($_POST['email']))) {
		$email_err = __( 'Enter a valid email', 'balsacentral' );
		$errorFlag = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Validate Message
	if(trim($_POST['comment']) === '') {
		$comment_err = __( 'A comment is required', 'balsacentral' );
		$errorFlag = true;
	} else {
		$comments = sanitize_html_string( trim( $_POST['comment'] ) );
		
	}

	//If there were no errors, send the mail.
	if(!isset($errorFlag)) {
		$to			= ( $bcent_email != '' ) ? $bcent_email : get_option( 'admin_email' );
		$subject	= "Message via balsacentral.com by ".$name;
		$message		= "$comments";
		$headers[]	= "From: $name <$email>";

		if( wp_mail( $to, $subject, $message, $headers ) )
			$sent = true;

		else	//the mail was not sent
			$sent = false;
	}
}
get_header(); ?>
<div id="content"<?php if ( $bcent_sb_pos == 'left' ) echo (' class="content-right"'); ?> role="main">
	<?php show_breadcrumbs();
    if (have_posts()) :
		while (have_posts()) : the_post();
			the_content();
			if( $bcent_google_map != '' ) {
			$column_class = 'half last';?>
            <div class="half">
            <?php echo stripslashes($bcent_google_map); ?>
            </div><!-- .half -->
            <?php } // Google Map
			else $column_class = 'full';?>
            <div class="<?php echo $column_class; ?>">
			<?php if(isset($sent)) { ?>
                <div id="mail_success_no_JS" class="box box2">
                <?php echo stripslashes($bcent_success_msg); ?>
                </div><!-- .mail_success_no_JS-->
			<?php }?>
			<form <?php if(isset($sent)) { ?>style="display:none"<?php }?> action="<?php the_permalink();?>" method="post" id="contactform" class="commentform">

			<p><input type="text" class="<?php if(isset($name_err) && $name_err != '') { ?>error<?php } ?>" id="name" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>" /><label for="name"><?php _e( 'Name*', 'balsacentral' ); ?></label></p>

			<p id="lastnamefieldgroup"><input type="text" id="userlastname" name="userlastname" class="<?php if(isset($email_err) && $email_err != '') { ?>error<?php } ?>" value="" /><label for="userlastname"><?php _e( 'Last Name - Real People should not see this, please do not fill in this field', 'balsacentral' ); ?></label></p>

			<p><input type="text" id="email" name="email" class="<?php if(isset($email_err) && $email_err != '') { ?>error<?php } ?>" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" /><label for="email"><?php _e( 'E-mail*', 'balsacentral' ); ?></label></p>

			<p id="subjectfieldgroup"><input type="text" id="subject" name="subject" class="<?php if(isset($email_err) && $email_err != '') { ?>error<?php } ?>" value="" /><label for="subject"><?php _e( 'Subject - Real People should not see this, please do not fill in this field', 'balsacentral' ); ?></label></p>

			<p><textarea name="comment" rows="10" cols="8" class="<?php if(isset($comment_err) && $comment_err != '') { ?>error<?php } ?>" id="comment" ><?php if(isset($_POST['comment'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comment']); } else { echo $_POST['comment']; } } ?></textarea><label for="comment"><?php _e( 'Message*', 'balsacentral' ); ?></label></p>

			<p class="submit"><input name="submit" type="submit" class="submit" tabindex="5" value="<?php _e( 'Send Message', 'balsacentral' ); ?>" /></p>
			</form>
			<div id="mail_success" class="box box2">
			<?php echo stripslashes($bcent_success_msg); ?>
			</div>
            </div><!-- .half last -->
		<?php endwhile;
    else : ?>
        <h2><?php _e( 'Not Found', 'balsacentral' ); ?></h2>
        <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'balsacentral' ); ?></p>
    <?php endif;?>
</div><!-- #content -->
<?php get_sidebar(); ?>
</div><!-- #primary .wrap -->
</div><!-- #primary -->
<?php get_footer(); ?>