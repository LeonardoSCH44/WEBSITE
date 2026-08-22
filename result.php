<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "financiero";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT salida, entrada, saldo, dia, mes FROM gestion ORDER BY mes, dia");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Resultados</h1>
        <nav class="toolbar">
         <li><a href="index.php">Home</a></li>
         <li><a href="sheet.php">Planillas</a></li>
         <li><a href="result.php">Mis finanzas</a></li>
         <li><a href="calendar.php">Calendario</a></li>
        </nav>

    </header>

    
<div class="resultados">
    <?php if (count($rows) === 0): ?>
        <p>No hay datos registrados todavía.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Día</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['mes']) ?></td>
                        <td><?= htmlspecialchars($row['dia']) ?></td>
                        <td><?= htmlspecialchars($row['entrada']) ?></td>
                        <td><?= htmlspecialchars($row['salida']) ?></td>
                        <td><?= htmlspecialchars($row['saldo']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <nav>
        <a href="index.php">Volver al formulario</a>
    </nav>
</div>
</body>
</html>