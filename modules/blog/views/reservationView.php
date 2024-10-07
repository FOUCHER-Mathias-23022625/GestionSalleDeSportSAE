<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../../assets/styles/reservation.css">
    <title>Réservation de Terrain</title>
    <?php include 'naveBar.php'?>

    <div class="reservationChoice">
        <h1>Réserver un terrain de sport</h1>
        
        <div class="icons">
            <div class="icon" onclick="showForm('football')">
                <img src="https://img.icons8.com/ios-filled/50/000000/soccer-ball.png" alt="Football">
            </div>
            <div class="icon" onclick="showForm('basketball')">
                <img src="https://img.icons8.com/ios-filled/50/000000/basketball.png" alt="Basketball">
            </div>
            <div class="icon" onclick="showForm('tennis')">
                <img src="https://img.icons8.com/ios-filled/50/000000/tennis-ball.png" alt="Tennis">
            </div>
            <div class="icon" onclick="showForm('volleyball')">
                <img src="https://img.icons8.com/ios-filled/50/000000/volleyball.png" alt="Volleyball">
            </div>
            <div class="icon" onclick="showForm('badminton')">
                <img src="https://img.icons8.com/ios-filled/50/000000/badminton.png" alt="Badminton">
            </div>
        </div>
    
        <div id="form-container">
            <form>
                <label for="sport">Sport sélectionné :</label>
                <input type="text" id="selected-sport" name="sport" readonly>

                <label for="creneaux">Créneaux horaires disponibles :</label>
                <select id="creneaux">
                    <option value="09:00-10:00">09:00 - 10:00</option>
                    <option value="10:00-11:00">10:00 - 11:00</option>
                    <option value="11:00-12:00">11:00 - 12:00</option>
                    <option value="13:00-14:00">13:00 - 14:00</option>
                    <option value="14:00-15:00">14:00 - 15:00</option>
                    <option value="15:00-16:00">15:00 - 16:00</option>
                </select>

                <button type="submit">Réserver</button>
            </form>
        </div>

    </div>
<?php include 'footer.php'?>
    <script type="text/javascript" src="../../../assets/scripts/reservation.js"></script>

</body>
</html>
