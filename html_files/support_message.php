<?php
require 'db.php';

$result = $conn->query("SELECT * FROM support_requests ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Support Requests – Admin Panel</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #0074d9;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #0074d9;
            color: white;
        }

        tr:hover {
            background: #f5f5f5;
        }

        a.attachment-link {
            color: #0074d9;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h2>Support Tickets Dashboard</h2>
    <table>
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Attachment</th>
                <th>Received</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['ticket_id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['subject']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                    <td>
                        <?php if ($row['attachment']): ?>
                            <a class="attachment-link" href="<?= $row['attachment'] ?>" target="_blank">View</a>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>