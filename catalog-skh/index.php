<?php
// جایگزینی H3 خودت را انجام بده
$H3 = 'abc'; // <-- اینجا H3 خودت را بگذار
$table = "items_{$H3}";

require DIR . "/db_{$H3}.php";

// افزودن آیتم جدید
if(isset($_POST['title']) && $_POST['title'] !== '') {
    $title = $mysqli->real_escape_string($_POST['title']);
    $mysqli->query("INSERT INTO $table (title) VALUES ('$title')");
}

// حذف آیتم (اختیاری)
if(isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $mysqli->query("DELETE FROM $table WHERE id=$id");
}

// خواندن ۱۰ آیتم آخر
$result = $mysqli->query("SELECT id,title,created_at FROM $table ORDER BY created_at DESC LIMIT 10");

// شمارش کل آیتم‌ها
$countResult = $mysqli->query("SELECT COUNT(*) AS c FROM $table");
$countRow = $countResult->fetch_assoc();
$totalItems = $countRow['c'];
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>My List – <?php echo $H3; ?></title>
    <style>
        body { font-family: Tahoma, sans-serif; padding: 20px; }
        input[type=text] { padding:5px; width:200px; }
        button { padding:5px 10px; }
        table { border-collapse: collapse; margin-top: 20px; }
        th, td { border:1px solid #ccc; padding:8px; }
    </style>
</head>
<body>
<h1>My List – <?php echo $H3; ?></h1>

<form method="post">
    <input type="text" name="title" placeholder="عنوان آیتم" required>
    <button type="submit">ثبت</button>
</form>

<h2>۱۰ آیتم آخر:</h2>
<table>
    <tr>
        <th>عنوان</th>
        <th>تاریخ ایجاد</th>
        <th>حذف</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['title']); ?></td>
        <td><?php echo $row['created_at']; ?></td>
        <td><a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('مطمئنی؟')">حذف</a></td>
    </tr>
    <?php endwhile; ?>
</table>

<p>تعداد کل آیتم‌ها: <?php echo $totalItems; ?></p>
</body>
</html>