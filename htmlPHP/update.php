<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/marlyneTodo/css/todo.css">
    <link rel="stylesheet" href="/marlyneTodo/css/view.css">
    <style>
        .form-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
    // Include the database connection
    include('db_connection.php');

    // Check for database connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle form submission for updating completion status
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedTask = $_POST['selectedTask'];
        $newTaskName = $_POST['newTaskName'];

        if (!empty($selectedTask) && !empty($newTaskName)) {
            $sql = "UPDATE task SET name = '$newTaskName' WHERE name = '$selectedTask'";
            
            if ($conn->query($sql) !== TRUE) {
                die("Error updating task name: " . $conn->error);
            }

            echo "<script>alert('Task name updated successfully');</script>";
        } else {
            echo "<script>alert('Please select a task and enter a new task name');</script>";
        }
    }

    // Fetch task names and completion status from the database
    $result = $conn->query("SELECT name, complete FROM task");

    // Check for SQL query execution error
    if ($result === false) {
        die("Error in SQL query: " . $conn->error);
    }
    ?>
    <div class="box">
    <div class="form-container">
            <form action="" method="post">
                <label for="selectedTask">Select Task:</label>
                <select name="selectedTask" id="selectedTask">
                    <?php
                    // Fetch task names for the dropdown
                    $result->data_seek(0); // Reset the result set pointer
                    while ($row = $result->fetch_assoc()) {
                        $taskName = $row['name'];
                        echo "<option value='$taskName'>$taskName</option>";
                    }
                    ?>
                </select>

                <label for="newTaskName">New Task Name:</label>
                <input type="text" name="newTaskName" id="newTaskName" required>

                <input type="submit" value="Update Task Name">
            </form>
        </div>
    </div>
        

    <div class="back">
        <a href="home.html"><button>Back</button></a>    
    </div>
</body>
</html>
