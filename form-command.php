<?php
if (! defined('ABSPATH'))
    {
        exit;
    }
?>

<form method="post" action="">
    <main>
        <div id="bloc-images">
            <div class="image-count">
                <img src="" alt=""/>
                <input type="number" id="count-fraise" name="fraise" min="0" max="12"/>
            </div>

            <div class="image-count">
                <img src="" alt=""/>
                <input type="number" id="count-pamplemousse" name="pamplemousse" min="0" max="12"/>
            </div>

            <div class="image-count">
                <img src="" alt=""/>
                <input type="number" id="count-framboise" name="framboise" min="0" max="12"/>
            </div>

            <div class="image-count">
                <img src="" alt=""/>
                <input type="number" id="count-citron" name="citron" min="0" max="12"/>
            </div>
        </div>

        <hr class="form-horizontal-separator"/>

        <div id="bloc-form">
            <div class="bloc-form-right">
                <h3 class="bloc-form-title">Vos informations</h3>

            </div>

            <div class="form-vertical-separator"></div>

            <div class="bloc-form-left">
                <h3 class="bloc-form-title">Livraison</h3>
            
            </div>
        
        
        </div>
    </main>

</form>