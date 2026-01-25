<?php

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
}

require_once get_stylesheet_directory() . '/form-command.php';

add_shortcode('formulaire_p6_commande', 'command_form_p6');

function send_command_form()
    {
        error_log('send_command_form exécutée');
        
        if (!isset($_POST['command-submit']))
            { return;}
            
        if (!isset($_POST['form_command_nonce']) || !wp_verify_nonce($_POST['form_command_nonce'], 'form_command_action'))
            { return;}
            
        //Récupèration des données du formulaire et sécurisation
        $lastname = sanitize_text_field( $_POST['username'] ?? '' );
        $firstname = sanitize_text_field( $_POST['userlastname'] ?? '' );
        $fullName = $lastname.' '.$firstname;
        $mail = sanitize_email( $_POST['usermail'] ?? '' );
        $adresse = sanitize_text_field( $_POST['useradresse'] ?? '' );
        $postcode = sanitize_text_field( $_POST['userpostcode'] ?? '' );
        $town = sanitize_text_field( $_POST['usertown'] ?? '' );

        $date = date ('d/m/Y');

        $fraise = sanitize_text_field( $_POST['fraise'] ?? '' );
        $pamplemousse = sanitize_text_field( $_POST['pamplemousse'] ?? '' );
        $citron = sanitize_text_field( $_POST['citron'] ?? '' );
        $orange = sanitize_text_field( $_POST['orange'] ?? '' );

        //définition de l'administrateur du site comme destinataire du mail
        $dest = get_option( 'admin_email' );

        //définition du sujet du mail
        $subject = 'nouvelle commande de : '. $fullName;

        //création du corps du message
        $mail_body = 'DATE DE COMMANDE : ' . $date . '\n';
        $mail_body .= 'NOM DU CLIENT : ' . $fullName . '\n';
        $mail_body .= '.........';

        //création des headers
        $headers = ['Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $fullName . ' <' . $mail . '>' ,];

        //envoi du mail
        wp_mail( $dest, $subject, $mail_body, $headers );
    }

add_action( 'init', 'send_command_form');

