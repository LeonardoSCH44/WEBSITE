<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
    <h1>Planillas</h1>

    <nav class="toolbar">
      <li><a href="index.php">Home</a></li>
      <li><a href="sheet.php">Planillas</a></li>
      <li><a href="result.php">Mis finanzas</a></li>
      <li><a href="calendar.php">Calendario</a></li>
    </nav>
   </header>

    <main class="planilla">
        <table class="tabla-excel">
          <thead>
            <tr>
              <th></th>
            </tr>
          </thead>
            <tbody>
                <?php for ($fila = 1; $fila <= 26; $fila++): ?>
                    <tr>
                        <?php for ($columna = 1; $columna <= 30; $columna++): ?>
                            <td>
                                <input type="text">
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </main>
</body>
</html>