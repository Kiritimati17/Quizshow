<?php
// JSON-Daten von der POST-Anfrage lesen
$data = json_decode(file_get_contents("php://input"), true);

// Antworten aus der JSON-Datei lesen
$answers = json_decode(file_get_contents("answers.json"), true);

// Antwort für das entsprechende Team aktualisieren
$team = $data["team"];
$answers[$team] = $data["answer"];

// Die aktualisierten Antworten in die JSON-Datei zurückschreiben
file_put_contents("answers.json", json_encode($answers));
?>
Dieses Skript wird jedes Mal aufgerufen, wenn ein Team eine Antwort eingibt. Es aktualisiert die JSON-Datei (answers.json) mit den neuen Daten.

3. HTML-Datei für die Teams (team1_input.html usw.)
Für jedes Team gibt es eine separate Eingabedatei, z.B. team1_input.html, team2_input.html, usw. Diese HTML-Dateien senden die Antwort an das PHP-Skript, welches die JSON-Datei aktualisiert.

Hier ein Beispiel für team1_input.html:

html
Code kopieren
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team 1 Eingabe</title>
    <style>
        /* Styling */
    </style>
</head>
<body>
    <h2>Antwort eingeben für Team 1:</h2>
    <input type="text" id="answerInput" placeholder="Deine Antwort..." oninput="submitAnswer()">

    <script>
        function submitAnswer() {
            const answer = document.getElementById("answerInput").value;
            fetch('submit_answer.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ team: "team1", answer: answer })
            });
        }
    </script>
</body>
</html>