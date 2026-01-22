<?php
if (! defined('ABSPATH'))
    {
        exit;
    }

function command_form_p6(){
    ob_start();
?>

<form method="post" action="" class="command-form">
    <main>
        <div id="bloc-images">
            <div class="image-count">
                <div class="background-title bt-1">
                    <h4 class="full-center-title">FRAISE</h4>
                </div>
                <input type="number" id="count-fraise" class="counter-cmd" name="fraise" value="0" min="0" max="12"/>
            </div>

            <div class="image-count">
                <div class="background-title bt-2">
                    <h4 class="full-center-title">PAMPLE</br>MOUSSE</h4>
                </div>
                <input type="number" id="count-pamplemousse" class="counter-cmd" name="pamplemousse" value="0" min="0" max="12"/>
            </div>

            <div class="image-count">
                <div class="background-title bt-3">
                    <h4 class="full-center-title">FRAM</br>BOISE</h4>
                </div>
                <input type="number" id="count-framboise" class="counter-cmd" name="framboise" value="0" min="0" max="12"/>
            </div>

            <div class="image-count">
                <div class="background-title bt-4">
                    <h4 class="full-center-title">CITRON</h4>
                </div>
                <input type="number" id="count-citron" class="counter-cmd" name="citron" value="0" min="0" max="12"/>
            </div>
        </div>

        <hr class="form-horizontal-separator"/>

        <div id="bloc-form">
        
            <div class="bloc-form-right">
            
                <h3 class="bloc-form-title bloc-informations">Vos informations</h3>

                <div class="bloc-form-champs">
                    <label for="username">Nom</label>
                    <input  type="text" id="username" name="username" required size="40"/>
                </div>

                <div class="bloc-form-champs">
                    <label for="userlastname">Prénom</label>
                    <input  type="text" id="userlastname" name="userlastname" required size="40"/>
                </div>

                <div class="bloc-form-champs">
                    <label for="usermail">Mail</label>
                    <input  type="email" id="usermail" name="usermail" required size="40"/>
                </div>

            </div>

            <div class="form-vertical-separator"></div>

            <div class="bloc-form-left">
            
                <h3 class="bloc-form-title bloc-livraison">Livraison</h3>

                <div class="bloc-form-champs">
                    <label for="useradresse">Adresse</label>
                    <input  type="text" id="useradresse" name="useradresse" required size="40"/>
                </div>

                <div class="bloc-form-champs">
                    <label for="userpostcode">Code postal</label>
                    <input  type="text" id="userpostcode" name="userpostcode" required size="40"/>
                </div>

                <div class="bloc-form-champs">
                    <label for="usertown">Ville</label>
                    <input  type="text" id="usertown" name="usertown" required size="40"/>
                </div>
            
            </div>
            
        </div>

        <input type="submit" value="Commander"/>
    </main>

</form>
<?php
    return ob_get_clean();
}