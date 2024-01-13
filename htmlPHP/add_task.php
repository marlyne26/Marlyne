<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/marlyneTodo/css/todo.css">
    <link rel="stylesheet" href="/marlyneTodo/css/add_task.css">
</head>
<body>
    <?php
    // Include the database connection
    include('db_connection.php');

    // Initialize variables for validation
    $taskError = "";

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $task = $_POST["task"];

        // Validate task name
        if (empty($task)) {
            $taskError = "Please enter a task name";
        } else {
            $sql = "INSERT INTO task (name, complete) VALUES ('$task', 'N')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Task added successfully');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    ?>

    <div class="box">
        <form action="" method="post">
            <p>Please Enter a task: <input type="text" name="task"></p>
            <p style="color: red;"><?php echo $taskError; ?></p>
            <p style="text-align: center;"><input type="submit" name="submit" value="Add Task"></p>
        </form>
    </div>    

    <div class="back">
        <a href="home.html"><button>Back</button></a>    
    </div>
</body>
</html>
