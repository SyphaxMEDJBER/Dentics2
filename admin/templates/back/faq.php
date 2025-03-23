<?php
session_start();
include 'header.php';
?>

<main>
    <section class="faq-container">
        <h2>Foire aux questions</h2>

        <div class="faq-item">
            <button class="faq-question">Comment modifier un rendez-vous ?</button>
            <div class="faq-answer">Vous pouvez modifier un rendez-vous dans la section "Rendez-vous", en cliquant sur "Modifier".</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Comment supprimer un utilisateur ?</button>
            <div class="faq-answer">La suppression d’un utilisateur peut être effectuée via la section "Utilisateurs", en cliquant sur "🗑".</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Puis-je annuler une disponibilité ?</button>
            <div class="faq-answer">Oui, si elle n’a pas encore été réservée par un patient, depuis "Disponibilités".</div>
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
