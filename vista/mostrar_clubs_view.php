<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Lista de clientes</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/clientes/crearCliente" class="btn btn-success">Agregar nuevo cliente</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>LOCALIDAD</th>
                    <th>RECORD GOLPES</th>
                    <th>ESCUELA</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clubs as $club): ?>
                    <tr>
                        <td><?= $club['idClubGolf'] ?></td>
                        <td><?= $club['nombre'] ?></td>
                        <td><?= $club['localidad'] ?></td>
                        <td><?= $club['recordGolpes'] ?></td>
                        <td><?= $club['Escuela'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</body>

</html>