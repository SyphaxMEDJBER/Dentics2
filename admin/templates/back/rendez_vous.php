<?php include 'header.php'; ?>

<main>
    <section class="appointments-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Dentiste</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Jean Dupont</td>
                    <td>Dr. Martin</td>
                    <td>12/03/2024</td>
                    <td>10:00</td>
                    <td class="status pending">En attente</td>
                    <td>
                        <button class="confirm-btn" onclick="confirmAppointment(this)">Confirmer</button>
                        <button class="cancel-btn" onclick="cancelAppointment(this)">Annuler</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Marie Curie</td>
                    <td>Dr. Bernard</td>
                    <td>15/03/2024</td>
                    <td>14:30</td>
                    <td class="status confirmed">Confirmé</td>
                    <td>
                        <button class="cancel-btn" onclick="cancelAppointment(this)">Annuler</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

<script src="js/script.js"></script>
<?php include 'footer.php'; ?>
