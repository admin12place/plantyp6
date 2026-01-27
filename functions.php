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
        $framboise = sanitize_text_field( $_POST['framboise'] ?? '' );
        $citron = sanitize_text_field( $_POST['citron'] ?? '' );

        //définition de l'administrateur du site comme destinataire du mail
        $dest = get_option( 'admin_email' );

        //définition du sujet du mail
        $subject = 'nouvelle commande de : '. $fullName;

        //création du corps du message
        $mail_body = '
        <html>
            <body>
                <h1>NOUVELLE COMMANDE</h1>
                <p>DATE DE COMMANDE : ' . $date . '</br>
                NOM DU CLIENT : ' . $fullName . '</br>
                ADRESSE : ' . $adresse . ' '. $postcode . ' ' . $town . '</br>
                MAIL : ' . $mail . '</br></br>
                Boisson fraise : ' . $fraise . ' unités</br>
                Boisson pamplemousse : ' . $pamplemousse . ' unités</br>
                Boisson framboise : ' . $framboise . ' unités</br>
                Boisson citron : ' . $citron . ' unités</p>
            </body>
        </html>';

        //création des headers
        $headers = ['Content-Type: text/html; charset=UTF-8',
        'from: www.planty.local',
        'Reply-To: ' . $fullName . ' <' . $mail . '>' ,];

        //envoi du mail
        wp_mail( $dest, $subject, $mail_body, $headers );

        wp_redirect( add_query_arg( 'sent', '1', wp_get_referer() ) );
        exit;

    }

add_action( 'init', 'send_command_form');

add_filter( 'wp_nav_menu_items', 'add_admin_link_before_last_item', 10, 2 );
function add_admin_link_before_last_item( $items, $args ) {
    
    // S'il n'y a pas d'utilisateur loggé ou si le menu n'est pas le menu principal,
    // on garde le menu en l'état.
    if (
        ! is_user_logged_in()
        || ! isset( $args->theme_location )
        || $args->theme_location !== 'main-menu'
    ) {
        return $items;
    }

    // Ecriture du nouvel élement de menu
    $new_item = sprintf(
        '<li class="menu-item menu-item-admin">
            <a href="%s">Admin</a>
        </li>',
        esc_url( admin_url() )
    );

    // Découper la chaine contenant les <li> existants en un tableau
    preg_match_all( '/<li[^>]*>.*?<\/li>/s', $items, $matches );
    $menu_items = $matches[0];
    $count = count( $menu_items );

    // S'il n'y a qu'un seul item (ou aucun), on ajoute à la fin
    if ( $count < 2 ) {
        $menu_items[] = $new_item;
    } else {
        // Insertion en avant-dernière position
        array_splice( $menu_items, $count - 1, 0, $new_item );
    }

    // Reconstruire le HTML
    return implode( '', $menu_items );
}