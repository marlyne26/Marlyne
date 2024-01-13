<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/marlyneTodo/css/todo.css">
    <link rel="stylesheet" href="/marlyneTodo/css/view.css">
    <style>
        table {
            width: 100%;
            margin: 0 auto; /* Center the table */
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
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
        // Check if 'completed' is set in the POST data
        if (isset($_POST["completed"])) {
            $completedTasks = $_POST["completed"];

            // Iterate through submitted tasks and update completion status
            foreach ($completedTasks as $taskName) {
                $completed = isset($_POST[$taskName]) ? 'Y' : 'N';

                $sql = "UPDATE task SET complete = '$completed' WHERE name = '$taskName'";
                
                if ($conn->query($sql) !== TRUE) {
                    die("Error updating task status: " . $conn->error);
                }
            }

            echo "<script>alert('Task status updated successfully');</script>";
        } else {
            echo "<script>alert('No tasks selected');</script>";
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
        <form action="" method="post">
            <table>
                <tr>
                    <th>Task</th>
                    <th>Completed</th>
                </tr>

                <?php
                while ($row = $result->fetch_assoc()) {
                    $taskName = $row['name'];
                    $completed = $row['complete'] === 'Y' ? 'checked' : '';

                    echo "<tr>";
                    echo "<td>{$taskName}</td>";
                    echo "<td><input type='checkbox' name='completed[]' value='{$taskName}' {$completed}></td>";
                    echo "</tr>";
                }
                ?>
            </table>

            <br>
            <p style="text-align: center;"><input type="submit" value="Update Task Status"></p>
        </form>
    </div>
    <div class="back">
        <a href="home.html"><button>Back</button></a>    
    </div>
</body>
</html>
