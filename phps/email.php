<?php
// Assuming you have already established a connection to your MySQL database
@include("config.php");
// Function to insert a participant and automatically add them to Inscription table
function insertParticipant($full_name, $email, $phone_number, $event_id, $conn) {
    // Insert participant into Participants table
    $stmt = $conn->prepare("INSERT INTO Participants (full_name, email, phone_number) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $email, $phone_number);
    $stmt->execute();
    
    // Get the last inserted participant ID
    $participant_id = $conn->insert_id;

    // Insert participant into Inscription table
    $stmt = $conn->prepare("INSERT INTO Inscription (event_id, participant_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $event_id, $participant_id);
    $stmt->execute();

    
    // Close statement
    $stmt->close();
    return $participant_id;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Example usage
    $full_name = $_POST['participant-name'];
    $email = $_POST['participant-email'];
    $phone_number = $_POST['participant-phone'];
    $event_id = $_POST['event_id'];

    // Call the function to insert participant and automatically add them to Inscription table
    $participant_id = insertParticipant($full_name, $email, $phone_number, $event_id, $conn);

    $to = $email;
    $subject = "Event Registration Confirmation";
    $message = "You are confirmed";
    $headers = "From: no-reply@eventmanager.com";

    if (mail($to, $subject, $message, $headers)) {
        // Redirect to the confirmation page
        header("Location: acceuil.php?eventId=$event_id&message=Participant added successfully and confirmation email sent");
    } else {
        // Redirect to the acceuil page with an error message
        header("Location: acceuil.php?eventId=$event_id&message=Participant added successfully but failed to send confirmation email");
    }
    exit();
}

// Close database connection
$conn->close();
?>