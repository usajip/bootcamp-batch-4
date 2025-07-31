<?php

//insert to users table

include 'koneksi.php';

// $sql = "INSERT INTO users (name, email) VALUES ('Ali 3', 'ali3@example.com')";

// if ($conn->query($sql) === TRUE) {
//     echo "Data berhasil disimpan.";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();