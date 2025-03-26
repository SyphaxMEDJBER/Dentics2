<?php 

    
include 'header.php'; ?>

<main>
    <section class="faq-container">
        <h2>Foire aux questions</h2>

        <div class="faq-item">
            <button class="faq-question">➕ Comment ajouter un dentiste ?</button>
            <div class="faq-answer">
                Allez dans la section "Utilisateurs", remplissez le formulaire et cliquez sur "Ajouter".
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question"> Comment confirmer ou annuler un rendez-vous ?</button>
            <div class="faq-answer">
                Accédez à la section "Rendez-vous" puis utilisez les boutons  ou 🗑 pour gérer le rendez-vous.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question"> Comment supprimer un utilisateur ?</button>
            <div class="faq-answer">
                Rendez-vous dans "Utilisateurs" puis cliquez sur l'icône 🗑 à côté du client à supprimer.
            </div>
        </div>
    </section>
</main>


    <script>
document.querySelectorAll('.faq-question').forEach(button => {
  button.addEventListener('click', () => {
    const answer = button.nextElementSibling;
    answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
  });
});
</script>



<?php include 'footer.php'; ?>
