<footer>
        <p>&copy; 2024 Dentics - Tous droits réservés.</p>
        <p><a href="/Dentics2/admin/mentions-legales" style="color: blue;">Mentions légales</a></p>

    </footer>

    <?php if (!isset($_COOKIE['accept_cookies'])): ?>
<div id="cookie-banner" style="position: fixed; bottom: 0; width: 100%; background: #004080; color: white; padding: 10px; text-align: center; z-index: 999;">
    Ce site utilise des cookies pour améliorer votre expérience.
    <button onclick="acceptCookies()">Tout accepter</button>
    <button onclick="showPreferences()">Personnaliser</button>
    <button onclick="refuseCookies()">Refuser</button>
</div>

<div id="cookie-preferences" style="display: none; position: fixed; bottom: 0; left: 0; right: 0; background: white; padding: 20px; box-shadow: 0 -2px 10px rgba(0,0,0,0.3); z-index: 1000; text-align: center;">
    <h3>Préférences des cookies</h3>
    <form id="preferences-form">
        <label><input type="checkbox" name="preferences" value="preferences"> Cookies de préférences</label><br>
        <label><input type="checkbox" name="preferences" value="statistiques"> Cookies de statistiques</label><br><br>
        <button type="submit">Accepter sélection</button>
        <button type="button" onclick="closePreferences()">Annuler</button>
    </form>
</div>

<script>
function acceptCookies() {
    document.cookie = "accept_cookies=true; path=/; max-age=" + (60 * 60 * 24 * 30);
    document.getElementById('cookie-banner').style.display = 'none';
}

function refuseCookies() {
    document.cookie = "accept_cookies=false; path=/; max-age=" + (60 * 60 * 24 * 30);
    document.getElementById('cookie-banner').style.display = 'none';
}

function showPreferences() {
    document.getElementById('cookie-preferences').style.display = 'block';
}

function closePreferences() {
    document.getElementById('cookie-preferences').style.display = 'none';
}

document.getElementById('preferences-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const selected = Array.from(document.querySelectorAll('input[name="preferences"]:checked')).map(el => el.value);
    document.cookie = "accept_cookies=true; path=/; max-age=" + (60 * 60 * 24 * 30);
    document.cookie = "preferences_cookies=" + JSON.stringify(selected) + "; path=/; max-age=" + (60 * 60 * 24 * 30);
    document.getElementById('cookie-banner').style.display = 'none';
    document.getElementById('cookie-preferences').style.display = 'none';
});
</script>
<?php endif; ?>



</body>

</html>