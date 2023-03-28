<?php
// Database Conncection //
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "search";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search query</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <!-- Search Input -->
    <div class="center">
      <input type="search" name="search" id="search" placeholder="Search by title">
    </div>

    <!-- Cards -->
    <div class="flex mt" id="searchBox">
      <?php
      $sql = "SELECT id, author, title, content FROM search_item";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<div class='card'>
            <h2 class='searchable'>" . $row['title'] . "</h2>
            <span>" . $row['author'] . "</span>
            <p>" . $row['content'] . "</p>
          </div>";
        }
      } else {
        echo "0 results";
      }
      ?>
    </div>
  </div>

  <script>
    const searchInput = document.getElementById('search');
    const myDiv = document.getElementById('searchBox');
    const title = myDiv.getElementsByTagName('h2');
    const box = document.getElementsByClassName("card");

    searchInput.addEventListener('keyup', function() {
      const searchTerm = this.value.toLowerCase();
      
      for (let i = 0; i < box.length; i++) {
        const text = box[i].getElementsByClassName('searchable')[0].textContent.toLowerCase();

        if (text.includes(searchTerm)) {
          box[i].style.display = 'block';
        } else {
          box[i].style.display = 'none';
        }
      }
    });
  </script>
</body>
</html>

<?php
// Close Database Conncection //
$conn->close();
?>