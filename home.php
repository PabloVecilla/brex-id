<?php
// Declaro variable para el título
$pageTitle = "Home | Brex-id";
// Incluyo el menú
include "menu.html";
// Conecto con la base de datos. 
require_once "conexion.php"; 
// Validación de datos
require_once "validaciones.php"; 

// Número máximo de tarjetas 
$max_cards = 3; 

// Select de todos los campos de EVENTOS
$sql="select * from eventos order by fecha desc";
$result = mysqli_query($conn, $sql); 
?>
    <main class="page_wrap">
    <h1>Brex-id</h1>
    <div class="principal container px-0">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <p class="about"><b>
                NACIONALISMO(S) Y POST-IMPERIO: GUERRAS
                CULTURALES Y LAS CONSTRUCCIONES DE LA IDENTIDAD EN NARRATIVAS
                BRITÁNICAS CONTEMPORÁNEAS</b><br>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non nisi a deserunt, saepe culpa odio! Modi recusandae, molestiae voluptate quod est sed officiis expedita exercitationem eveniet! Minus, vero. Minus quam enim veniam, tempore error odio quae earum itaque! Dolore tenetur quisquam eos aperiam libero similique recusandae ab voluptate quis dolor facilis asperiores corrupti odit deserunt, autem, eligendi magni. Debitis quo, enim repudiandae magnam, voluptatibus at vero libero dolor, nostrum ipsam eligendi ipsa accusantium quia corporis quasi consequuntur! Aliquid impedit magni libero? Quibusdam harum quod quam ipsam enim. Maiores magnam vitae veniam omnis nihil laboriosam, reiciendis commodi accusamus, assumenda deserunt autem non in totam similique doloribus cum corrupti quaerat velit dolorem rerum neque expedita quae? Itaque perferendis repellat, pariatur rerum beatae corrupti perspiciatis dolorem fugiat architecto omnis ullam ipsam aliquam suscipit dolor voluptates sapiente officia adipisci nemo odio? Molestias quod magnam recusandae blanditiis laborum debitis, eos nulla aliquam officia doloremque architecto. Molestias deserunt, necessitatibus quam asperiores cumque inventore. Animi molestias vel sapiente inventore, doloribus magni. Labore vel, consequatur alias, explicabo est officiis doloribus dolorem illum perferendis sunt repellat nihil ab fugiat corporis necessitatibus itaque nostrum vero! Nostrum provident ullam tenetur in, magni dolor, autem quis iusto ducimus distinctio itaque modi laudantium. Labore, soluta hic molestias, dicta consectetur repellendus velit expedita vitae quibusdam aliquam, accusantium iusto perspiciatis maxime sed cupiditate voluptas rem neque repudiandae amet dolore perferendis minus consequuntur sit? Eaque commodi corrupti itaque, distinctio eveniet soluta eos corporis molestias aliquid sapiente eligendi!</p>
            </div>
            <div class="aboutPic col-lg-4 col-sm-12">
                <img src="img/brexid_banderas.jpg" alt="Banderas de Europa y Reino unido desligadas con unas tijeras">
            </div>
        </div>
    </div>
        <div class="content_wrap">
        <?php
            $index = 0; 
            while (($evento = mysqli_fetch_assoc($result)) && $index<$max_cards){
        ?>
            <div class="card_wrap col-lg-4 col-md-6 col-sm-12">
            <!-- Página dinámica que cargue la info completa del evento desde BD -->
            <a href="evento.php?id=<?php echo escape($evento['id_evento']); ?>" class="link_card">
            <div class="card" style="width: 18rem;">
                <div class="img_wrap">
                    <img src="<?php echo $evento['foto']; ?>" class="card-img-top" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo escape($evento['titulo']); ?></h5>
                    <p class="card-text texto_discreto"><?php echo escape($evento['fecha']) ?></p>
                    <p class="card-text"><?php echo escape($evento['ponentes']) ?></p>
                </div>
            </div>
            </a>
            </div>
            <?php $index++; 
            }
            // Libero espacio en la RAM eliminando el resultset
            mysqli_free_result($result); 
            // Cierro la conexión
            mysqli_close($conn); 
            ?>
        </div>
        </main>

        <?php include ('footer.html'); ?>