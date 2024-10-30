<?php
session_start();

if (isset($_SESSION['uid']) && isset($_GET['rid'])) {
    $email = $_SESSION['uid'];
    $roomno = $_GET['rid'];
    include 'Conn.php';

    $sql = "SELECT * FROM booking_requests WHERE roomno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $roomno);
    $stmt->execute();
    $result = $stmt->get_result();

    // Define $stmt1 outside the if block
    $stmt1 = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking Requests</title>
    <link rel="stylesheet" href="CSS/reqBooks.css">
</head>
<body>
    <header>
        <h2>Room Renting Requests</h2>
    </header>
    <main id="main-table">
        <section class="requests-list">
            <table>
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th colspan="2">Requester's Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

<?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tid = $row['tid'];

            $sql1 = "SELECT * FROM tenant WHERE tid = ?";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("i", $tid);
            $stmt1->execute();
            $result1 = $stmt1->get_result();

            if ($result1->num_rows > 0) {
                $row1 = $result1->fetch_assoc();
                echo '<tr>';
                echo '<td>' . $row['bid'] . '</td>';
                echo '<td>' . 'Name' . '<br><hr>' . 'Phone' . '<br><hr>' . 'Email' . '</td>';
                echo '<td>' . $row1['tname'] . '<br><hr>' . $row1['tphone'] . '<br><hr>' . $row1['temail'] . '</td>';
                echo '<td>'
                    . "<a href='acceptReq.php?bid=" . $row['bid'] . "'><button class='btn-accept'>Accept</button></a>"
                    . "<a href='rejectReq.php?bid=" . $row['bid'] . "'><button class='btn-reject'>Reject</button></a>"
                    . '</td>';
                echo '</tr>';
            }
            else{
                echo '<tr><td colspan=4>No such request found</td></tr>';
            }
        }
    }

    // Close $stmt1 if it was opened
    if ($stmt1 !== null) {
        $stmt1->close();
    }

    $stmt->close();
    $conn->close();
?>

                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 CHHAANO</p>
    </footer>
</body>
</html>

<?php
} else {
    header('Location: Dashboard.php');
    exit;
}
?>
