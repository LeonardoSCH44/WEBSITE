<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Financiero</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<script> //javascript usado para calcular el saldo directamente cuando digitado.//
function calcularSaldo() { 
  const entradaInput = document.querySelector('input[name="entrada[]"]');
  const salidaInput = document.querySelector('input[name="salida[]"]');
  const saldoInput = document.querySelector('input[name="saldo[]"]');

  const entrada = parseFloat(entradaInput.value.replace(',', '.')) || 0;
  const salida = parseFloat(salidaInput.value.replace(',', '.')) || 0;

  saldoInput.value = entrada - salida;
}
</script>
<body>  
  <!-- encabezado con titulo y los botones del menu para cambiar entre paginas-->
   <header> 
    <h1>Gestion Financiera</h1>

    <nav class="toolbar">
      <li><a href="index.php">Home</a></li>
      <li><a href="sheet.php">Planillas</a></li>
      <li><a href="result.php">Mis finanzas</a></li>
      <li><a href="calendar.php">Calendario</a></li>
    </nav>
   </header>
<form method="POST">
  <!--formulario con tablas estilo excel para cargar el dia y mes de la operacion utilizando post para el php-->
   <table border="5">
    <thead>
      <tr>
        <th>
          <select name="mes">
            <option value="">Elegí un mes</option>
            <option value="enero">Enero</option>
            <option value="febrero">Febrero</option>
            <option value="marzo">Marzo</option>
            <option value="abril">Abril</option>
            <option value="mayo">Mayo</option>
            <option value="junio">Junio</option>
            <option value="julio">Julio</option>
            <option value="agosto">Agosto</option>
            <option value="septiembre">Septiembre</option>
            <option value="octubre">Octubre</option>
            <option value="noviembre">Noviembre</option>
            <option value="diciembre">Diciembre</option>
          </select>
        </th>
        <th>Entrada</th>
        <th>Salida</th>
        <th>Saldo</th>
      </tr>
    </thead>
    <tbody>
     
        <tr>
          <td>
            <select name="dia[]">
  <option value="">Elegí un día</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
</select>
<!--campos donde el usuario ingresa sus datos de entrada y salida-->
          </td>
          <td><input type="text" name="entrada[]" placeholder="Entrada" oninput="calcularSaldo()"></td>
          <td><input type="text" name="salida[]" placeholder="Salida"oninput="calcularSaldo()"></td>
          <td><input type="text" name="saldo[]" placeholder="Saldo"oninput="calcularSaldo()"></td>
        </tr>
      
      <td>TOTAL</td>
      <td><input type="text" name="total_entrada" placeholder="Total Entrada"></td>
      <td><input type="text" name="total_salida" placeholder="Total Salida"></td>
      <td><input type="text" name="total_saldo" placeholder="Total Saldo"></td>
    </tbody>
  </table>

  <button type="submit">Guardar</button>
<!--boton que te lleva a la pagina con los resultados guardados-->
  <a href="result.php"> <button type="button"> Mis Finanzas</button></a>
</form>
</body>
</html>


<?php
//conexion php para la base de datos en xampp sql
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
//el fetch para cargar en las tablas de la base
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $entrada = $_POST["entrada"] ?? [];
    $salida = $_POST["salida"] ?? [];
    $saldo = $_POST["saldo"] ?? [];
    $mes = $_POST["mes"] ?? null;
    $dia = $_POST["dia"] ?? [];
      

    foreach ($entrada as $index => $valueEntrada) {
        $valueSalida = $salida[$index] ?? 0;
        $valueSaldo = $saldo[$index] ?? 0;
        $valueMes = $mes;
        $valueDia = $dia[$index] ?? 0;

        $stmt = $pdo->prepare("INSERT INTO gestion (entrada, salida, saldo, mes, dia) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$valueEntrada, $valueSalida, $valueSaldo, $valueMes, $valueDia]);
    }

    echo '<div class="mensaje">Datos guardados correctamente</div>';
  
  

}
?>