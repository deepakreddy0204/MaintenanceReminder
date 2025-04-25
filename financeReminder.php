<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Auto Maintenance Reminder</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        /* Global Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
        }

        header nav ul li {
            display: inline;
            margin-right: 15px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
        }

        /* Table Styling */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table td {
            background-color: #f9f9f9;
        }

        table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        table tr:hover td {
            background-color: #ddd;
        }

        table a {
            color: #2196F3;
            text-decoration: none;
        }

        table a:hover {
            text-decoration: underline;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }
            table th, table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="home.php">Home</a>&nbsp;&nbsp;</li>
            <li><a href="autoRemainder.php">Auto Reminders</a>&nbsp;&nbsp;</li>
            <li><a href="financeRemainder.php">Finance Reminders</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
        </ul>
    </nav>
</header>

<?php
require('db.php');
include('authentication.php');
$username = $_SESSION['username'];
$result = mysqli_query($con, "SELECT * from maintenance_remainder where username='$username' and type='finance'");

echo "<table>
        <tr>
            <th>Task Name</th>
            <th>Due Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>";

while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['task']) . "</td>";
    echo "<td>" . htmlspecialchars($row['due_date']) . "</td>";
?>
    <td><a href="edit.php?remainder_id=<?php echo $row['remainder_id']; ?>">Edit</a></td>
    <td><a href="delete.php?remainder_id=<?php echo $row['remainder_id']; ?>">Delete</a></td>
<?php
}
echo "</table>";
?>
<!-- Link to Add Reminder -->
<div class="add-reminder-link">
    <a href="addfinanceReminder.php">Add a New Finance Reminder</a>
</div>

</body>
</html>
