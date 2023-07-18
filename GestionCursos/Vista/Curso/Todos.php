<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TodosCursos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #2C2C2C;
        }

        .logo {
            width: 90%;
        }

        .nav-link {
            color: white !important;
            font-size: 1.1rem;
        }

        i {
            color: #FF7844 !important;
        }

        .bi-search {
            color: #FF7844 !important;
        }

        .activo {
            color: #FF7844 !important;
            text-decoration: underline !important;
        }

        .nombre {
            font-size: 1.1rem;
        }

        .card {
            height: 160px !important;
            max-width: 500px !important;
        }

        .form-control:focus {
            box-shadow: none !important;
            border: 1px solid #FF7844 !important;
            outline: none !important;
        }

        .btn-primary {
            background-color: #FF7844 !important;
            border-color: #FF7844 !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 pt-4 text-center">
                <img src="./Vista/IMG/logo.png" alt="logo" class="logo">
            </div>
            <div class="col-md-6 col-sm-6 col-12 pt-5 text-center">
                <ul class="nav justify-content-center">
                    <div class="btn-group ">
                        <li class="dropdown-toggle nav-link activo" data-bs-toggle="dropdown" data-bs-display="static"
                            aria-expanded="false">
                            <span>Cursos</span>
                        </li>
                        <ul class="card-color dropdown-menu dropdown-menu-dark dropdown-menu-lg-end">
                            <li><a class="dropdown-item activo"
                                    href="./index.php?controlador=Curso&accion=Todos">Cursos</a></li>
                            <li><a class="dropdown-item"
                                    href="./index.php?controlador=Categoria&accion=Todos">Categorias</a></li>
                        </ul>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php?controlador=Instructores&accion=Todos">Instructores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php?controlador=Estdiante&accion=Todos">Estudiantes</a>
                    </li>

                </ul>
            </div>
            <div class="col-md-3 col-sm-12 col-12 pt-5 text-center">
                <p style="margin-top: 10px!important">
                    <i class="bi bi-person-circle"></i><span class="nombre text-white"> Carlos Mendez Nuñez</span>
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col"></div>
            <div class="col-md-6 col-12">
                <div class="mt-5 position-relative ">
                    <input type="text" class="rounded-5 form-control bg-transparent text-white" placeholder="Buscar">
                    <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                </div>
            </div>
            <div class="col-md-3 col"></div>
        </div>
        <div class="container mt-2">

            <div class="row pt-5" id="cursos">
                <div class="text-center col-md-4 mt-4 text-white " data-bs-toggle="modal" data-bs-target="#CrearModal">
                    <div class="card text-center fs-1 text-white border-white bg-transparent position-relative">
                        <i class="bi bi-plus position-absolute top-50 start-50 translate-middle "></i>
                    </div>
                </div>

            </div>


        </div>
    </div>


    <?php
    require_once './Vista/Curso/Modales/ModalOpciones.html';
    require_once './Vista/Curso/Modales/ModalVer.html';
    require_once './Vista/Curso/Modales/ModalEditar.html';
    require_once './Vista/Curso/Modales/ModalCrear.html';
    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <script>

        $(document).ready(function () {
            var todosCursos = JSON.parse('<?php echo $todosCur; ?>');

            $.each(todosCursos, function (index, curso) {
                html = `
                    <div class="text-center col-md-4 mt-4 text-white ">
                        
                        <div style="background:linear-gradient(rgba(5,7,12,0.75),rgba(5,7,12,0.75)),url(${curso.img}) no-repeat center center;background-size:cover" class="card text-center fs-3 text-white border-white border-0 position-relative">
                            <span class="position-absolute top-50 start-50 translate-middle">${curso.titulo} 
                            <i  onclick="AbrirModalOp(${curso.id},'${curso.titulo}', this)" class="bi bi-three-dots" data-bs-toggle="modal" data-bs-target="#opciones"></i></span>     
                        </div>
                    </div>
                `;

                $("#cursos").append(html);
            });

            var categorias = JSON.parse('<?php echo $todosCat; ?>');
            var instructores = JSON.parse('<?php echo $todosIns; ?>');
            

            $.each(categorias, function (index, categoria) {
                var html;

                html = `<option selected value="${categoria.id}">${categoria.descripcion}</option> `;

                $("#sCategoriasC").append(html);

            });

            $.each(instructores, function (index, instructor) {
                var html;

                html = `<option selected value="${instructor.id}">${instructor.nombre}</option>`;

                $("#sInstructorC").append(html);

            });

        });
        //Cargar combobox
        function CargarSelectEditar(idCategoria, idInstructor) {

            var categorias = JSON.parse('<?php echo $todosCat; ?>');
            var instructores = JSON.parse('<?php echo $todosIns; ?>');
            $("#sCategorias").empty();
            $("#sInstructor").empty();

            $.each(categorias, function (index, categoria) {
                var html;
                if (categoria.estado == true) {

                    if (categoria.id == idCategoria) {

                        html =
                            `<option selected value="${categoria.id}">${categoria.descripcion}</option>
                        `;

                    } else {
                        html =
                            `<option value="${categoria.id}">${categoria.descripcion}</option>
                        `;

                    }
                    $("#sCategorias").append(html);

                }
            });

            $.each(instructores, function (index, instructor) {
                var html;
                if (instructor.estado == true) {

                    if (instructor.id == idInstructor) {

                        html =
                            `<option selected value="${instructor.id}">${instructor.nombre}</option>`;


                    } else {
                        html =
                            `<option value="${instructor.id}">${instructor.nombre}</option>
                        `;

                    }
                    $("#sInstructor").append(html);

                }
            });
        }

        function CargarSelectVer(idCategoria, idInstructor) {

            var categorias = JSON.parse('<?php echo $todosCat; ?>');
            var instructores = JSON.parse('<?php echo $todosIns; ?>');



            $.each(categorias, function (index, categoria) {
                var html;
                if (categoria.estado == true) {

                    if (categoria.id == idCategoria) {

                        html =
                            `<option selected value="${categoria.id}">${categoria.descripcion}</option>`;

                    }
                    $("#sCategoriasV").append(html);
                    $("#sCategoriasV").attr('disabled', 'disabled');
                    return;


                }
            });

            $.each(instructores, function (index, instructor) {
                var html;

                if (instructor.estado == true) {

                    if (instructor.id == idInstructor) {
                        html =
                            `<option selected value="${instructor.id}">${instructor.nombre}</option>`;
                    }
                    $("#sInstructorV").append(html);
                    $("#sInstructorV").attr('disabled', 'disabled');
                    return;

                }
            });
        }
        function AbrirModalOp(idCurso, titulo, e) {

            $("#tituloOp").text(titulo);

            $("#editarCurso").val(idCurso);
            $("#desactivaCurso").val(idCurso);
            
            $("#desactivaCurso").click(function () {
                Swal.fire({
                    icon: 'warning',
                    title: '¿Quieres eliminar el curso?',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: "btn btn-outline-danger me-1",
                        cancelButton: "btn btn-secondary ms-1"
                    }

                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({

                            method: "GET",
                            url: "https://12g.infocovao.xyz/Carlos/GestionCursos/index.php?controlador=Curso&accion=Desactivar&id=" + $("#desactivaCurso").val(),
                            success: function (response) {

                                window.location="https://12g.infocovao.xyz/Carlos/GestionCursos/index.php?controlador=Curso&accion=Todos";
                                

                            }
                        });
                    }
                })

            });
            $("#editarCurso").click(function () {

                $.ajax({

                    method: "GET",
                    url: "https://12g.infocovao.xyz/Carlos/GestionCursos/index.php?controlador=Curso&accion=BuscarId&id=" + $("#editarCurso").val(),
                    success: function (response) {

                        var response = JSON.parse(response);

                        $("#idCurso").val(response.id);
                        $("#tituloCurso").val(`${response.titulo}`);
                        CargarSelectEditar(response.idCategoria, response.idInstructor);
                        $("#descripcion").val(`${response.descripcion}`);

                    }
                });
            });

            $("#verCurs").click(function () {

                $.ajax({

                    method: "GET",
                    url: "https://12g.infocovao.xyz/Carlos/GestionCursos/index.php?controlador=Curso&accion=BuscarId&id=" + $("#editarCurso").val(),
                    success: function (response) {

                        var response = JSON.parse(response);
                        
                        $("#tituloCursoV").val(response.titulo);
                        $("#tituloCursoV").attr('disabled', 'disabled');
                        CargarSelectVer(response.idCategoria, response.idInstructor);
                        $("#descripcionV").val(response.descripcion);
                        $("#descripcionV").attr('disabled', 'disabled');
                    }
                });
            });

        }

    </script>
</body>

</html>