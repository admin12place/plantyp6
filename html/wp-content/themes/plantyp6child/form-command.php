<?php
if (! defined('ABSPATH'))
    {
        exit;
    }

function command_form_p6(){
    ob_start();//Buffer pour que le form soit envoyé en 1 bloc et non pas à la volée
?>

<form method="post" class="command-form" >
 <?php wp_nonce_field( 'form_command_action', 'form_command_nonce' ); ?><!--Protection du formulaire-->

    <div>
    
        <div id="bloc-images">
            <div class="bloc-2images bloc-2images-left">
                <div class="image-count">
                    <div class="background-title bt-1">
                        <h4 class="full-center-title">FRAISE</h4>
                    </div>
                    <input type="number" id="count-fraise" class="counter-cmd" name="fraise" value="0" min="0" max="12">
                </div>

                <div class="image-count">
                    <div class="background-title bt-2">
                        <h4 class="full-center-title">PAMPLE<br/>MOUSSE</h4>
                    </div>
                    <input type="number" id="count-pamplemousse" class="counter-cmd" name="pamplemousse" value="0" min="0" max="12">
                </div>
            </div>
            
            <div class="bloc-2images bloc-2images-right">
                <div class="image-count">
                    <div class="background-title bt-3">
                        <h4 class="full-center-title">FRAM<br/>BOISE</h4>
                    </div>
                    <input type="number" id="count-framboise" class="counter-cmd" name="framboise" value="0" min="0" max="12">
                </div>

                <div class="image-count">
                    <div class="background-title bt-4">
                        <h4 class="full-center-title">CITRON</h4>
                    </div>
                    <input type="number" id="count-citron" class="counter-cmd" name="citron" value="0" min="0" max="12">
                </div>
            </div>
        </div>

        <hr class="form-horizontal-separator"/>

        <div id="bloc-form">
        
            <div class="bloc-form-left">
            
                <h3 class="bloc-form-title bloc-informations">Vos informations</h3>

                <div class="bloc-form-champs">
                    <label for="username" class="label-cmd">Nom</label>
                    <input  type="text" id="username" name="username" class="input-cmd" required size="40">
                </div>

                <div class="bloc-form-champs">
                    <label for="userlastname" class="label-cmd">Prénom</label>
                    <input  type="text" id="userlastname" name="userlastname" class="input-cmd" required size="40">
                </div>

                <div class="bloc-form-champs">
                    <label for="usermail" class="label-cmd">Mail</label>
                    <input  type="email" id="usermail" name="usermail" class="input-cmd" required size="40">
                </div>

            </div>

            <div class="form-vertical-separator"></div>

            <div class="bloc-form-right">
            
                <h3 class="bloc-form-title bloc-livraison">Livraison</h3>

                <div class="bloc-form-champs">
                    <label for="useradresse" class="label-cmd">Adresse</label>
                    <input  type="text" id="useradresse" name="useradresse" class="input-cmd" required size="40">
                </div>

                <div class="bloc-form-champs">
                    <label for="userpostcode" class="label-cmd">Code postal</label>
                    <input  type="text" id="userpostcode" name="userpostcode" class="input-cmd" required size="40">
                </div>

                <div class="bloc-form-champs">
                    <label for="usertown" class="label-cmd">Ville</label>
                    <input  type="text" id="usertown" name="usertown" class="input-cmd" required size="30">
                </div>
                
            </div>
            
        </div>

        <div class="cmd-form-submit">
            <input type="submit" name="command-submit" class="submit-button-cmd" value="Commander">

            <?php if ( isset ($_GET['sent']) && $_GET['sent'] === '1' ) : ?>
                <p class="submit-msg" >Commande envoyée avec succès.</p>
            <?php endif; ?>
        </div>
        
    </div>

</form>
<?php
    return ob_get_clean();//récupère le formulaire
}