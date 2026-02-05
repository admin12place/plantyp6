<?php

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');//Prise en compte du css parent
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/plantyp6child.css', array(), filemtime(get_stylesheet_directory() . '/css/plantyp6child.css'));// css enfant
}

require_once get_stylesheet_directory() . '/form-command.php';//fichier à inclure une seule fois

add_shortcode('formulaire_p6_commande', 'command_form_p6');

function send_command_form()
    {
        error_log('send_command_form exécutée');

        //Si le bouton Commander n'a pas été actionné, on sort...
        if (!isset($_POST['command-submit']))
            { return;}
        
        //Sécurisation du formulaire    
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

        $fraise = sanitize_text_field( $_POST['fraise'] ?? '' );
        $pamplemousse = sanitize_text_field( $_POST['pamplemousse'] ?? '' );
        $framboise = sanitize_text_field( $_POST['framboise'] ?? '' );
        $citron = sanitize_text_field( $_POST['citron'] ?? '' );

        //Création de la date de commande
        $date = date ('d/m/Y');

        //définition du destinataire principal
        $mainDest = 'planty.drinks@gmail.com';

        //définition de l'administrateur du site comme destinataire Cc du mail
        $ccDest = get_option( 'admin_email' );

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

        //création des headers du message
        $headers = ['Content-Type: text/html; charset=UTF-8',
        'from: www.planty.local',
        'Cc: ' . $ccDest ,
        'Reply-To: ' . $fullName . ' <' . $mail . '>' ,];

        //envoi du mail
        wp_mail( $mainDest, $subject, $mail_body, $headers );

        //Evite les envois multiples
        wp_redirect( add_query_arg( 'sent', '1', wp_get_referer() ) );
        exit;

    }

add_action( 'init', 'send_command_form');

//LE HOOK DU NAV_MENU

add_filter( 'wp_nav_menu_items', 'add_admin_link_before_last_item', 10, 2 );

function add_admin_link_before_last_item( $items, $args ) {
    
    // S'il n'y a pas d'utilisateur loggé si le menu n'est pas lié à un emplacement ou si le menu n'est pas le menu principal,
    // on garde le menu en l'état.
    if (
        ! is_user_logged_in()
        || ! current_user_can( 'edit_posts' )
        || ! isset( $args->theme_location )
        || $args->theme_location !== 'main-menu'
    ) {
        return $items;
    }

    // Découper la chaine contenant les <li> existants (regex) en un tableau
    preg_match_all( '/<li[^>]*>.*?<\/li>/s', $items, $matches );
    $menu_items = $matches[0];
    $count = count( $menu_items );

    switch ( $count ) {
        case 0:
            $new_item = sprintf(
            '<li class="menu-item menu-item-admin">
                <a href="%s" class="item-alone">Admin</a>
            </li>',
            esc_url( admin_url() )
            );
        break;
        
        default:
            $new_item = sprintf(
            '<li class="menu-item menu-item-admin">
                <a href="%s">Admin</a>
            </li>',
            esc_url( admin_url() )
            );
        break;
    }

    // S'il n'y a aucun item, on ajoute à la fin
    if ( $count === 0 ) {
        $menu_items[] = $new_item;
    } else {
        // Insertion en avant-dernière position
        array_splice( $menu_items, $count - 1, 0, $new_item );
    }

    // Reconstruire le HTML
    return implode( '', $menu_items );
}