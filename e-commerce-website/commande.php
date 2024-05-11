<?php
session_start();
$montantTotal = $_SESSION['total_price'] ?? 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Validation de Commande</title>
 <style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
}

.container {
  width: 80%;
  margin: 20px auto;
  text-align: center;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

h1 {
  color: #333;
}

label {
  display: block;
  margin-bottom: 5px;
  text-align: left;
  color: #333;
}

input, select, button {
  margin-bottom: 15px;
  padding: 10px;
  width: 100%;
  border-radius: 5px;
  border: 1px solid #ccc;
}

button {
  background-color: #4caf50;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #45a049;
}

.messageValidation {
  background-color: #dff0d8;
  border: 1px solid #b2dba1;
  color: #3c763d;
  padding: 15px;
  margin-top: 20px;
  border-radius: 5px;
  text-align: center;
}

</style>
</head>
<body>
  <div class="container">
    <h1>Validation de Commande</h1>
    <form id="myForm" action="valide.php" method="POST" onsubmit="return sendEmail();">
    
  
      <label for="adresse">Adresse :</label>
      <input type="text" name="adresse" id="adresse" required><br><br>

      <label for="typePaiement">Type de paiement :</label>
      <select id="typePaiement"  name="typePaiement"required>
        <option value="cache">Paiement en espèces</option>
        <option value="carte">Paiement par carte bancaire</option>
      </select><br><br>

      <label for="email">Email :</label>
      <input type="email" id="email" name="email" required><br><br>

      <label for="tel">Numéro de téléphone :</label>
      <input type="tel" id="tel"  name="tel" required><br><br>

      <label for="montantTotal">Montant total :</label>
<input type="text" id="montantTotal" name="montantTotal" value="<?= $montantTotal ?>" readonly><br><br>

<input type="submit" value="Valider ma commande" class="mon-bouton">
    </form>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
   <!-- Votre code HTML précédent reste inchangé jusqu'à la balise script contenant sendEmail() -->
   <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script>
      function sendEmail() {
        var toEmail = document.getElementById("email").value;

        if (!toEmail) {
          alert("Veuillez saisir une adresse e-mail valide.");
          return false; // Empêcher la soumission si l'e-mail est vide
        }

        fetch('temp.html')
          .then(response => response.text())
          .then(htmlContent => {
            Email.send({
              SecureToken: "93e95963-5f1f-4a21-affe-82587dfd2ecc",
              To: toEmail,
              From: "trigui.amal@enis.tn",
              Subject: "Mail de confirmation de commande",
              Body: htmlContent
            }).then(
              message => {
                alert(message); // Afficher un message de confirmation d'envoi de l'e-mail
                document.getElementById("myForm").submit(); // Soumettre le formulaire après l'envoi de l'e-mail
              }
            );
          })
          .catch(error => console.error(error));

        return false; // Retourner false pour empêcher la soumission par défaut du formulaire
      }
    </script>

  </div>
  <script>

</script>
</body>
</html>
