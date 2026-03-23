<?php
session_start();
include '../includes/config.php';

// Solo administradores
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/events_style.css">
</head>

<body>



<div class="container text-center">
  <div class="row align-items-start">
    <div class="col">
        <a href="admin_panel.php"><img class="volver" src="../assets/images/retroceso.png"></a>

    </div>
    <div class="col">
      <div class="container text-center">
        <div class="row align-items-start">

            <div class="col">
                <a href="../pages/index.php"><img class="logo" src="../assets/images/logo-nombre-horizontal-blanco.png"></a>
            </div>

        </div>
    </div>
    </div>
    <div class="col">
      
    </div>
  </div>
</div>



    

    <div class="container text-center">
        <div class="row align-items-start">

            <div class="col">
                <h2 class="titulo">Registro de Eventos</h2>
            </div>

        </div>
    </div>




    <div class="container text-center">
        <div class="row align-items-center">
            
            <div class="col">
                <div class="card">
                    <div class="card-body column">
                        <form class="row g-3" method="POST" action="guardar_evento.php">
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Titulo</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Descripción</label>
                                <textarea class="form-control textarea" name="description" required></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="inputCity" class="form-label">Fecha</label>
                                <input type="date" class="form-control" name="date" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary" name="save">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="row align-items-center">

            <div class="col">
                <div class="card registros">
                    <?php
                    $sql = "SELECT * FROM events ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        echo "<table class='tabla' width='100%'>";
                        echo "<tr class='columnas'>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='column'>
                                    <td>{$row['title']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['date']}</td>
                                    <td><button class='btn btn-primary'><i class='fa-solid fa-pencil'></i></button><button class='btn btn-primary'><i class='fa-solid fa-trash'></i></button></td>
                                </tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "<p>No hay eventos registrados.</p>";
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>





</body>

</html>