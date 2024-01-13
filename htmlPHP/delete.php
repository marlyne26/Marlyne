<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/marlyneTodo/css/todo.css">
    <link rel="stylesheet" href="/marlyneTodo/css/delete.css">
</head>
<body>
    <?php
    // Include the database connection
    include('db_connection.php');

    // Handle form submission for task deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedTask = $_POST["cars"];

        if (!empty($selectedTask)) {
            $sql = "DELETE FROM task WHERE name = '$selectedTask'";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Task deleted successfully');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<script>alert('Please select a task to delete');</script>";
        }
    }

    // Retrieve task names for the dropdown
    $taskOptions = "";
    $result = $conn->query("SELECT name FROM task");
    while ($row = $result->fetch_assoc()) {
        $taskOptions .= "<option value='{$row['name']}'>{$row['name']}</option>";
    }
    ?>

    <div class="box">
        <form action="" method="post">
            <p>Select item to delete: 
                <select name="cars" id="cars">
                    <?php echo $taskOptions; ?>
                </select>
            </p>
            <br><br>
            <p style="text-align: center;"><input type="submit" value="Delete"></p>
        </form>
    </div>
    <div class="back">
        <a href="home.html"><button>Back</button></a>    
    </div>
</body>
</html>
