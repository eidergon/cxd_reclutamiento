<?php
$id = $_GET["id"];
// $id = 4;

require '../php/conexion.php';

$sql = "SELECT codigo FROM formacion where estado = 'Activo'";
$result = $conn->query($sql);

$sqls = "SELECT * FROM reclutas where id = '$id'";
$results = $conn->query($sqls);
$row = $results->fetch_assoc();

$conn->close();
?>

<link rel="stylesheet" href="../css/styles.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sociodemografico</title>
<link rel="shortcut icon" href="../img/logo-removebg-preview.png" type="image/x-icon">
<script src="../js/script.js"></script>

<form class="form" id="sociodemografico">
    <h1>Sociodemografico</h1>
    <input type="hidden" class="select" name="id" value="<?php echo $row['id']; ?>">
    <label>1.¿Usted estudia actualmente? *</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio1" name="estudio" value="SI" required>
            <label class="radio-button__label" for="radio1">
                <span class="radio-button__custom"></span>
                SI
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio2" name="estudio" value="NO" required>
            <label class="radio-button__label" for="radio2">
                <span class="radio-button__custom"></span>
                NO
            </label>
        </div>
    </div>

    <label>
        2.¿Cuál es su nivel educativo? *
        <select name="nivel_educativo" id="nivel_educativo" class="select" required>
            <option value="">Selecciona una respuesta</option>
            <option value="BACHILLER">BACHILLER</option>
            <option value="TÉCNICO">TÉCNICO</option>
            <option value="TECNÓLOGO">TECNÓLOGO</option>
            <option value="PROFESIONAL">PROFESIONAL</option>
            <option value="ESPECIALIZACIÓN">ESPECIALIZACIÓN</option>
            <option value="MAESTRÍA">MAESTRÍA</option>
            <option value="DOCTORADO">DOCTORADO</option>
        </select>
    </label>

    <label>3.¿Cuál es tu horario de estudio?</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio3" name="horario" value="MAÑANA" required>
            <label class="radio-button__label" for="radio3">
                <span class="radio-button__custom"></span>
                MAÑANA
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio4" name="horario" value="TARDE" required>
            <label class="radio-button__label" for="radio4">
                <span class="radio-button__custom"></span>
                TARDE
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio5" name="horario" value="ACOMODO HORARIO" required>
            <label class="radio-button__label" for="radio5">
                <span class="radio-button__custom"></span>
                ACOMODO MI HORARIO
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio6" name="horario" value="NO ESTUDIO" required>
            <label class="radio-button__label" for="radio6">
                <span class="radio-button__custom"></span>
                NO ESTUDIO
            </label>
        </div>
    </div>

    <label>4.Tipo de documento</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio7" name="tipo_documento" value="CÉDULA DE CIUDADANÍA" required>
            <label class="radio-button__label" for="radio7">
                <span class="radio-button__custom"></span>
                CÉDULA DE CIUDADANÍA
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio8" name="tipo_documento" value="CÉDULA DE EXTRANJERÍA" required>
            <label class="radio-button__label" for="radio8">
                <span class="radio-button__custom"></span>
                CÉDULA DE EXTRANJERÍA
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio9" name="tipo_documento" value="PASAPORTE" required>
            <label class="radio-button__label" for="radio9">
                <span class="radio-button__custom"></span>
                PASAPORTE
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio10" name="tipo_documento" value="PERMISO DE PERMANENCIA" required>
            <label class="radio-button__label" for="radio10">
                <span class="radio-button__custom"></span>
                PERMISO DE PERMANENCIA
            </label>
        </div>
    </div>

    <label>
        5.Numero de Documento de Identidad
        <input class="select" placeholder="Numero De Documento" name="documento" type="number" autocomplete="off" value="<?php echo $row['documento']; ?>" required>
    </label>

    <label>
        6.Nombre Completo
        <input class="select" name="nombre" type="text" value="<?php echo $row['nombre']; ?>" readonly>
    </label>

    <label>7.Género</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio11" name="genero" value="Masculino" required>
            <label class="radio-button__label" for="radio11">
                <span class="radio-button__custom"></span>
                MASCULINO
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio12" name="genero" value="Femenino" required>
            <label class="radio-button__label" for="radio12">
                <span class="radio-button__custom"></span>
                FEMENINO
            </label>
        </div>
    </div>

    <label>
        8.¿Cuál es la fecha de nacimiento?
        <input class="select" name="nacimiento" type="date" required>
    </label>

    <label>
        9.¿Cuál es el municipio de nacimiento?
        <input class="select" name="municipio_nac" type="text" required>
    </label>

    <label>
        10.¿Cuál es el departamento de nacimiento?
        <input class="select" name="departamento_nac" type="text" required>
    </label>

    <label>
        11.¿Cuál es la fecha de expedición de su documento?
        <input class="select" name="expedicion" type="date" required>
    </label>

    <label>
        12.¿Cuál es el municipio de expedición de su documento?
        <input class="select" name="municipio_exp" type="text" required>
    </label>

    <label>
        13.¿Cuál es el departamento de expedición de su documento?
        <input class="select" name="departamento_exp" type="text" required>
    </label>

    <label>
        14.¿Cuál es la dirección de su residencia?
        <p class="title">ejemplo: CL 21 # 3 SUR - 21</p>
        <input class="select" name="direccion" placeholder="Direccion" autocomplete="off" type="text" required>
    </label>

    <label>
        15.¿Cuál es su municipio de residencia?
        <p class="title">ejemplo: MEDELLIN</p>
        <input class="select" name="municipio" placeholder="Municipio" autocomplete="off" type="text" required>
    </label>

    <label>
        16.¿En qué barrio vives?
        <p class="title">ejemplo: CASTILLA</p>
        <input class="select" name="barrio" placeholder="Barrio" autocomplete="off" type="text" required>
    </label>

    <label>
        17.¿Cuál es su número de contacto o celular?
        <p class="title">Ejemplo: "2276565" o "3009002020"</p>
        <input class="select" name="telefono" type="number" value="<?php echo $row['telefono']; ?>" readonly>
    </label>

    <label>
        18.¿Cuál es su correo electrónico?
        <p class="title">ejemplo: JUAN@GMAIL.COM</p>
        <input class="select" placeholder="Correo" name="correo" autocomplete="off" type="email" required>
    </label>

    <label>
        19.¿Cuál es el número celular de su contacto de emergencia?
        <p class="title">Ejemplo: "2276565" o "3009002020"</p>
        <input class="select" placeholder="Telefono de emergencia" autocomplete="off" name="tel_emergencia" type="number" required>
    </label>

    <label>
        20.Nombre de contacto de emergencia
        <input class="select" placeholder="Nombre de emergencia" autocomplete="off" name="nombre_emergencia" type="text" required>
    </label>

    <label>21.¿Cuál es su EPS?</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio13" name="eps" value="SURA" required>
            <label class="radio-button__label" for="radio13">
                <span class="radio-button__custom"></span>
                SURA
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio14" name="eps" value="NUEVA EPS" required>
            <label class="radio-button__label" for="radio14">
                <span class="radio-button__custom"></span>
                NUEVA EPS
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio15" name="eps" value="SANITAS" required>
            <label class="radio-button__label" for="radio15">
                <span class="radio-button__custom"></span>
                SANITAS
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio16" name="eps" value="SALUD TOTAL" required>
            <label class="radio-button__label" for="radio16">
                <span class="radio-button__custom"></span>
                SALUD TOTAL
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio17" value="" name="eps" required>
            <label class="radio-button__label" for="radio17">
                <span class="radio-button__custom"></span>
                <input type="text" placeholder="Otra EPS" class="select eps" disabled>
            </label>
        </div>
    </div>

    <label>22.¿Cuál es su fondo de pensiones?</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio18" name="pension" value="PORVENIR" required>
            <label class="radio-button__label" for="radio18">
                <span class="radio-button__custom"></span>
                PORVENIR
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio19" name="pension" value="COLFONDOS" required>
            <label class="radio-button__label" for="radio19">
                <span class="radio-button__custom"></span>
                COLFONDOS
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio20" name="pension" value="COLPENSIONES" required>
            <label class="radio-button__label" for="radio20">
                <span class="radio-button__custom"></span>
                COLPENSIONES
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio21" name="pension" value="PROTECCION" required>
            <label class="radio-button__label" for="radio21">
                <span class="radio-button__custom"></span>
                PROTECCION
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio22" name="pension" value="NO TENGO" required>
            <label class="radio-button__label" for="radio22">
                <span class="radio-button__custom"></span>
                NO TENGO
            </label>
        </div>
    </div>

    <label>23.¿Cuál es su nacionalidad?</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio23" name="nacionalidad" value="COLOMBIANA" required>
            <label class="radio-button__label" for="radio23">
                <span class="radio-button__custom"></span>
                COLOMBIANA
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio24" name="nacionalidad" value="VENEZOLANA" required>
            <label class="radio-button__label" for="radio24">
                <span class="radio-button__custom"></span>
                VENEZOLANA
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio25" name="nacionalidad" value="ECUATORIANA" required>
            <label class="radio-button__label" for="radio25">
                <span class="radio-button__custom"></span>
                ECUATORIANA
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio26" name="nacionalidad" value="" required>
            <label class="radio-button__label" for="radio26">
                <span class="radio-button__custom"></span>
                <input type="text" placeholder="Otra nacionalidad" class="select nacionalidad" disabled>
            </label>
        </div>
    </div>

    <label>
        24.¿Cuál es el medio por el cuál se enteró de la oferta?
        <select name="medio" id="medio" class="select" required>
            <option value="">Selecciona una respuesta</option>
            <option value="FACEBOOK">FACEBOOK</option>
            <option value="COMPUTRABAJO">COMPUTRABAJO</option>
            <option value="WHATSAPP">WHATSAPP</option>
            <option value="POSTER">POSTER</option>
            <option value="VOZ A VOZ">VOZ A VOZ</option>
            <option value="INEED">INEED</option>
            <option value="Otras">Otras</option>
        </select>
    </label>

    <label>
        25.Campaña
        <select name="campaña" id="campaña" class="select" required>
            <option value="">Selecciona una Campaña</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['codigo'] . "'>" . $row['codigo'] . "</option>";
            }
            ?>
        </select>
    </label>

    <label>26.¿Horas de interés?</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio27" name="hora" value="4 HORAS" required>
            <label class="radio-button__label" for="radio27">
                <span class="radio-button__custom"></span>
                4 HORAS
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio28" name="hora" value="6 HORAS" required>
            <label class="radio-button__label" for="radio28">
                <span class="radio-button__custom"></span>
                6 HORAS
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio29" name="hora" value="8 HORAS" required>
            <label class="radio-button__label" for="radio29">
                <span class="radio-button__custom"></span>
                6 HORAS
            </label>
        </div>
    </div>

    <label>27.¿Tiene experiencia en ventas?</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio30" name="expVenta" value="SI" required>
            <label class="radio-button__label" for="radio30">
                <span class="radio-button__custom"></span>
                SI
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio31" name="expVenta" value="NO" required>
            <label class="radio-button__label" for="radio31">
                <span class="radio-button__custom"></span>
                NO
            </label>
        </div>
    </div>

    <label>28.¿Tiene experiencia en call center?</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio32" name="expCall" value="SI" required>
            <label class="radio-button__label" for="radio32">
                <span class="radio-button__custom"></span>
                SI
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio33" name="expCall" value="NO" required>
            <label class="radio-button__label" for="radio33">
                <span class="radio-button__custom"></span>
                NO
            </label>
        </div>
    </div>

    <label>29.¿Cuáles son sus gastos mensuales?</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio34" name="gastos" value="$0-500000" required>
            <label class="radio-button__label" for="radio34">
                <span class="radio-button__custom"></span>
                $0-500000
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio35" name="gastos" value="$500000-1000000" required>
            <label class="radio-button__label" for="radio35">
                <span class="radio-button__custom"></span>
                $500000-1000000
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio36" name="gastos" value="$1000000-1500000" required>
            <label class="radio-button__label" for="radio36">
                <span class="radio-button__custom"></span>
                $1000000-1500000
            </label>
        </div>
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio37" name="gastos" value=" $1500000-2000000" required>
            <label class="radio-button__label" for="radio37">
                <span class="radio-button__custom"></span>
                $1500000-2000000
            </label>
        </div>
    </div>

    <button type="submit" class="submit">Guardar</button>
</form>