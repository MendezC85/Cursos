<?php
session_start();

require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Curso.php';
require_once './Modelo/Entidades/EstudianteCurso.php';
require_once './Modelo/Metodos/CursoM.php';
require_once './Modelo/Metodos/EstudianteCursoM.php';
require_once './Modelo/Entidades/Estudiante.php';
require_once './Modelo/Metodos/EstudianteM.php';
require_once './Modelo/Entidades/Instructor.php';
require_once './Modelo/Metodos/InstructorM.php';
require_once './Modelo/Entidades/Categoria.php';
require_once './Modelo/Metodos/CategoriaM.php';



class CursoControlador
{
    private function Validar()
    {

        $band = true;
        $est = new Estudiante();

        if (isset($_SESSION["idEstudiante"])) {
            $eM = new EstudianteM();
            $est = $eM->BuscarId($_SESSION["idEstudiante"]);
            if ($est == null) {
                $return = false;
            }
        } else if ($_SESSION["idInstructor"]) {
            $insM = new InstructorM();
            $ins = $insM->BuscarId($_SESSION["idInstructor"]);
            $return = $ins;
            if ($ins == null)
                $return = false;
        }
        if (!$return)
            header("Location:./index.php");

        return $return;
    }
    public function Todos()
    {
        //$this->Validar();
        $todosCur = array();
        $todosCat = array();
        $todosIns = array();

        $curM = new CursoM();
        $ecM = new EstudianteCursoM();
        $catM = new CategoriaM();
        $insM = new InstructorM();

        $todosIns = json_encode($insM->Todos());
        $todosCat = json_encode($catM->Todos());

        $todosCur = json_encode($curM->Todos());
        $todosEC = $ecM->Todos();

        require_once './Vista/Curso/Todos.php';
    }

    public function Crear()
    {
        //$this->Validar();
        $cur = new Curso();

        $cur->setTitulo($_POST["TITULO"]);
        $cur->setDescripcion($_POST["DESCRIPCION"]);
        $cur->setIdCategoria($_POST["IDCATEGORIA"]);
        $cur->setIdInstructor($_POST["IDINSTRUCTOR"]);

        $fecha = date('YmdHis');
        $nombreImg = $fecha . "-" . $_FILES['IMG']['name'];
        $foto = "./Vista/Curso/imgCursos/" . $nombreImg;

        copy($_FILES["IMG"]['tmp_name'], $foto);

        $cur->setImg($foto);
        //mandar a BD
        $curM = new CursoM();

        if ($curM->Crear($cur)) {
            header("Location: ./index.php?controlador=Curso&accion=Todos");
        }

    }
    public function BuscarId()
    {
        //$this->Validar();
        $curM = new CursoM();
        $cur = new Curso;

        $ecM = new EstudianteCursoM();
        $ec = new EstudianteCurso;

        $cur = $curM->BuscarId($_GET["id"]);
        //$ec = $ecM->BuscarCurso($cur->getId());   

        echo json_encode($cur);
    }
    public function BuscarEstudiantesCurso()
    {
        $this->Validar();
        $esM = new EstudianteM();
        $ecM = new EstudianteCursoM();

        $listEs = array();
        $idCurso = $_POST["ID"];

        $listaEstCur = $ecM->BuscarCurso($idCurso);

        foreach ($listaEstCur as $lec) {
            $listEs[] = $esM->BuscarId($lec->getIdEstudiante());
        }
        var_dump($listEs);
        /*require_once '';*/
    }
    public function Actualizar()
    {
        //$this->Validar();

        $curM = new CursoM();
        $cur = new Curso;

        $id = $_POST["ID"];

        if (isset($id)) {

            $cur = $curM->BuscarId($id);

            if (isset($cur)) {
                $cur->setTitulo($_POST["TITULO"]);
                $cur->setDescripcion($_POST["DESCRIPCION"]);
                $cur->setIdCategoria($_POST["IDCATEGORIA"]);
                $cur->setIdInstructor($_POST["IDINSTRUCTOR"]);
                
                if ($_FILES["IMG"]["name"] != "") {
                    $fecha = date('YmdHis');
                    $nombreImg = $fecha . "-" . $_FILES['IMG']['name'];
                    $foto = "./Vista/Curso/imgCursos/" . $nombreImg;

                    copy($_FILES["IMG"]['tmp_name'], $foto);

                    $cur->setImg($foto);
                }
                
                if ($curM->Actualizar($cur)) {
                    header("Location: ./index.php?controlador=Curso&accion=Todos");
                }
            }
        }
    }
    public function Desactivar()
    {
        //$this->Validar();
        $curM = new CursoM();
        $id = $_GET["id"];
        var_dump($id);
        if ($curM->Desactivar($id)) {
            header("Location: ./index.php?controlador=Curso&accion=Todos");
        }
    }
    public function AsignarCursos()
    {
        $this->Validar();
        $band = false;
        $listaEstudiantes = $_POST["LISTAESTUDIANTES"];
        $ceM = new EstudianteCursoM();

        $ec = new EstudianteCurso();

        foreach ($listaEstudiantes as $le) {
            $ec->setIdCurso($_POST["IDCURSO"]);
            $ec->setIdEstudiante($le);

            if ($ceM->Crear($ec))
                $band = true;
            else
                $band = false;
        }
        if ($band)
            header("Location: ./index.php?controlador=Curso&accion=Todos");

    }
    public function DesactivarAsignacion()
    {
        $this->Validar();
        $ecM = new EstudianteCursoM();
        $id = $_POST["ID"];
        if (isset($id)) {
            $ecM->Desactivar($id);
            header("Location: ./index.php?controlador=Curso&accion=Todos");
        }
    }
    public function ActivarAsignacion()
    {
        $this->Validar();
        $ecM = new EstudianteCursoM();
        $id = $_POST["ID"];
        if (isset($id)) {
            $ecM->Activar($id);
            header("Location: ./index.php?controlador=Curso&accion=Todos");
        }
    }
}