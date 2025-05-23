-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2025 a las 22:54:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sheltra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animals`
--

CREATE TABLE `animals` (
  `id` int(225) NOT NULL,
  `id_user` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `description` varchar(225) NOT NULL,
  `foto` varchar(1000) NOT NULL,
  `entry_date` date NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `animals`
--

INSERT INTO `animals` (`id`, `id_user`, `name`, `type`, `age`, `sex`, `size`, `description`, `foto`, `entry_date`, `state`) VALUES
(5, 1, 'Nube', 'Roedor', '1', 'Hembra', 'Grande', 'Nube es un conejo juguetón y curioso. Le encanta explorar y comer zanahorias. Es ideal para familias con niños pequeños.', 'https://content.elmueble.com/medio/2025/03/18/conejo-enano-belier_0c663703_250318172443_900x900.webp', '2025-05-05', 'Adopción activa'),
(6, 3, 'Luna', 'Gato', '3', 'Hembra', 'Pequeno', 'Luna es una gata juguetona y curiosa. Le encanta perseguir luces y descansar en lugares altos. Es ideal para familias que buscan una mascota activa y cariñosa.', 'https://www.zooplus.es/magazine/wp-content/uploads/2022/01/Psicologia-felina.jpeg', '2025-05-05', 'Adopción no activa'),
(7, 3, 'Max', 'Perro', '4', 'Macho', 'Mediano', 'Max es un perro leal y protector. Le encanta jugar al aire libre y es perfecto para familias activas que buscan un compañero energético.', 'https://panchoskitchen.com/cdn/shop/articles/perro-con-la-lengua-afuera-mirando-hacia-arriba.png?v=1677637524', '2025-05-05', 'Adopción activa'),
(8, 1, 'Simba', 'Gato', '7', 'Macho', 'Mediano', 'Simba es un gato curioso y juguetón. Le encanta explorar y es ideal para hogares que buscan una mascota activa y divertida.', 'https://urgenciesveterinaries.com/wp-content/uploads/2023/09/survet-gato-caida-pelo-01.jpeg', '2025-05-05', 'Adopción activa'),
(9, 2, 'Shelly', 'Reptil', '10', 'Hembra', 'Grande', 'Shelly es una tortuga tranquila y fácil de cuidar. Es perfecta para personas que buscan una mascota de bajo mantenimiento.', 'https://cdn0.expertoanimal.com/es/posts/6/3/3/especies_de_tortugas_de_tierra_20336_600.webp', '2025-05-05', 'Adopción activa'),
(10, 1, 'Tom', 'Gato', '2', 'Macho', 'Mediano', 'Tom es un gato simpático y activo, perfecto para familias con niños.', 'https://i.pinimg.com/originals/98/f5/7d/98f57d66e977bc3d5a0c9443ebe6a3db.jpg', '2025-05-05', 'Adopción activa'),
(11, 1, 'Mía', 'Gato', '4', 'Hembra', 'Grande', 'Mía es muy cariñosa y le encanta dormir en lugares soleados.', 'https://th.bing.com/th/id/R.34934b6e6728657008fef33bcd2389dd?rik=wSoAwA5TxYad3g&riu=http%3a%2f%2f5b0988e595225.cdn.sohucs.com%2fq_mini%2cc_zoom%2cw_640%2fimages%2f20170724%2fb036660228b442da8213f83e1f4e7b04.jpeg&ehk=T5KUl%2btkwIoe55aNvrEYyPgDQnll3OqO1ONu7WZsTKY%3d&risl=&pid=ImgRaw&r=0', '2025-05-05', 'Adopción activa'),
(12, 2, 'Oreo', 'Gato', '5', 'Macho', 'Mediano', 'Oreo es tranquilo y se adapta muy bien a los cambios.', 'https://th.bing.com/th/id/R.d38ad5d057371d581e1e468e15524757?rik=4XU0PCl87C4cwQ&riu=http%3a%2f%2f24.media.tumblr.com%2ftumblr_m9gyv5mmT11rnno9uo1_1280.jpg&ehk=S9Ej%2boXajzO8nlaIDyuUXeFuPoImUDhBO%2b7WWDX9svE%3d&risl=&pid=ImgRaw&r=0', '2025-05-05', 'Adopción activa'),
(13, 2, 'Lola', 'Gato', '1', 'Hembra', 'Pequeño', 'Lola es muy juguetona y necesita mucha atención.', 'https://2.bp.blogspot.com/-urfzQM2s62s/UJm5podgrhI/AAAAAAAAjWQ/zPAogh7wvb8/s1600/522_503553456331157_1588333430_n.jpg', '2025-05-05', 'Adopción activa'),
(14, 3, 'Tigre', 'Gato', '6', 'Macho', 'Grande', 'Tigre es independiente, ideal para adoptantes con experiencia.', 'https://live.staticflickr.com/411/19235139791_41cdffa802_b.jpg', '2025-05-05', 'Adopción activa'),
(15, 3, 'Nala', 'Gato', '2', 'Hembra', 'Mediano', 'Nala es muy sociable con otros gatos.', 'https://wakyma.com/blog/wp-content/uploads/2017/09/Qu%C3%A9-es-la-neumon%C3%ADa-en-gatos', '2025-05-05', 'Adopción no activa'),
(16, 3, 'Coco', 'Gato', '3', 'Macho', 'Pequeño', 'Coco es juguetón y se lleva bien con perros pequeños.', 'https://th.bing.com/th/id/OIP.Zl_CdHA0KcEfo0pkDwMb_wHaGU?cb=iwc2&rs=1&pid=ImgDetMain', '2025-05-05', 'Adopción activa'),
(17, 2, 'Sombra', 'Gato', '8', 'Hembra', 'Grande', 'Sombra necesita un hogar tranquilo.', 'https://frusnatassar.se/____impro/1/onewebmedia/2023-08-30%2019.25.27.jpg?etag=%22f902-64ef7baa%22&sourceContentType=image%2Fjpeg&ignoreAspectRatio&resize=704%2B704&extract=0%2B0%2B703%2B624&quality=85', '2025-05-05', 'Adopción activa'),
(18, 8, 'Félix', 'Gato', '5', 'Macho', 'Mediano', 'Félix es muy curioso y le encanta trepar.', 'https://amomeugato.blog.br/wp-content/uploads/2022/09/Chartreux-1024x686.jpg', '2025-05-05', 'Adopción activa'),
(19, 8, 'Daisy', 'Gato', '6', 'Hembra', 'Grande', 'Gata curiosa y cariñosa, le gusta explorar y buscar rincones soleados para descansar. Ideal para familias que buscan una compañera tranquila y juguetona.', 'https://vancouverguardian.com/wp-content/uploads/2022/03/301910-624553c738020.jpeg', '2025-05-13', 'Adopción no activa'),
(20, 1, 'Rocky', 'Perro', '3', 'Macho', 'Grande', 'Rocky es enérgico y le encanta correr al aire libre.', 'https://www.hola.com/imagenes/estar-bien/20200525168642/razas-perro-border-collie/0-827-353/border-collie-m.jpg', '2025-05-05', 'Adopción activa'),
(21, 1, 'Bella', 'Perro', '5', 'Hembra', 'Mediano', 'Bella es dulce y le encanta estar acompañada.', 'https://th.bing.com/th/id/OIP.WC0dupB4lXJLrFMP8zKpBQAAAA?cb=iwc2&w=402&h=402&rs=1&pid=ImgDetMain', '2025-05-05', 'Adopción activa'),
(22, 2, 'Toby', 'Perro', '2', 'Macho', 'Pequeño', 'Toby es perfecto para vivir en un piso.', 'https://th.bing.com/th/id/OIP.mqy_bmn4U4Fq-1pY0rzliQHaG8?cb=iwc2&w=640&h=600&rs=1&pid=ImgDetMain', '2025-05-05', 'Adopción activa'),
(23, 2, 'Lili', 'Perro', '4', 'Hembra', 'Mediano', 'Lili es obediente y está entrenada.', 'https://www.risingsunfarm.com/wp-content/uploads/2023/02/Mercedes-look-head-rising-sun-border-collies-c-3.jpg', '2025-05-05', 'Adopción activa'),
(24, 3, 'Bruno', 'Perro', '6', 'Macho', 'Pequeño', 'Bruno necesita espacio para correr y jugar.', 'https://th.bing.com/th/id/R.f6d4d7e041423d471d8dca63c5030110?rik=5ItEyRsM4%2fsf8Q&riu=http%3a%2f%2fportaldoscaesegatos.com.br%2fwp-content%2fuploads%2f2017%2f09%2f0079eecafa92db7fefbf930fa5bc0a5e-black-pug-puppies-cute-pug-puppies.jpg&ehk=UpYmBT%2fWGVOWrpFDvFZhzTY7Q3q84P%2fMaVS7hEZkZR8%3d&risl=&pid=ImgRaw&r=0', '2025-05-05', 'Adopción activa'),
(25, 3, 'Kira', 'Perro', '3', 'Hembra', 'Pequeño', 'Kira es muy cariñosa y siempre quiere estar cerca.', 'https://th.bing.com/th/id/OIP.G8oQbY6cdZH5nk4ns5C2EAHaHa?cb=iwc2&w=540&h=540&rs=1&pid=ImgDetMain', '2025-05-05', 'Adopción activa'),
(26, 2, 'Zeus', 'Perro', '7', 'Macho', 'Grande', 'Zeus es fuerte y protector.', 'https://pbs.twimg.com/media/FNeHFAlX0AIDszu?format=jpg&name=900x900', '2025-05-05', 'Adopción activa'),
(27, 8, 'Maya', 'Perro', '2', 'Hembra', 'Mediano', 'Maya es juguetona y le gusta el agua.', 'https://upload.chien.com/upload_global/61/86900-147363_light.jpg', '2025-05-05', 'Adopción activa'),
(28, 8, 'Thor', 'Perro', '5', 'Macho', 'Mediano', 'Thor es leal y se lleva bien con otros perros.', 'https://cdn.sanity.io/images/d075r9p6/production/4d91930c2dbc806cc7e1f87fa0582ed1c054f573-400x400.jpg?w=1200&h=630', '2025-05-05', 'Adopción activa'),
(29, 8, 'Lucy', 'Perro', '1', 'Hembra', 'Pequeño', 'Perrita pequeño, alegre y muy cariñosa. Le gusta estar en compañía, recibir mimos y dar paseos cortos. Ideal para cualquier hogar que busque una amiga fiel y tierna.', 'https://lirp-cdn.multiscreensite.com/ed0f610b/dms3rep/multi/opt/criaderos+shih+tzu+mexico+pic+2-1920w.jpg', '2025-05-12', 'Adopción activa'),
(30, 1, 'Draco', 'Reptil', '4', 'Macho', 'Grande', 'Draco es un dragón barbudo sociable.', 'https://media.istockphoto.com/photos/bearded-agama-picture-id1199672924?k=6&m=1199672924&s=612x612&w=0&h=o7jwfnzO4rT3HEogV1a9cQpD-heWjMV5EYsXj88UFEc=', '2025-05-05', 'Adopción activa'),
(31, 1, 'Ivy', 'Reptil', '2', 'Hembra', 'Pequeño', 'Ivy es una salamanquesa activa por las noches.', 'https://3.bp.blogspot.com/-h8OJPKQpjFU/VAXbKYXTwaI/AAAAAAAADtM/7_eNJP1ZRLc/s1600/Tarentola%2Bmauritanica%2Bdragonet%2Bsalamanquesa%2Bdrag%C3%B3%2Bandrag%C3%B3%2Bgecko%2Bmediterranean%2Bhouse%2Bcommon%2BMartorell%2BBaix%2BLlobregat%2BAnoia%2BCatalunya%2BCatalonia%2BCatalunya%2BPhyllodactylidae.JPG', '2025-05-05', 'Adopción activa'),
(32, 2, 'Rex', 'Reptil', '3', 'Macho', 'Mediano', 'Rex es un gecko muy tranquilo y fácil de cuidar.', 'https://www.learnaboutnature.com/wp-content/uploads/Crested-Gecko.jpg', '2025-05-05', 'Adopción activa'),
(33, 2, 'Nina', 'Reptil', '5', 'Hembra', 'Grande', 'Nina es una iguana que necesita luz solar diaria.', 'https://cdn.pixabay.com/photo/2022/03/15/11/16/iguana-7070118_1280.jpg', '2025-05-05', 'Adopción activa'),
(34, 3, 'Spike', 'Reptil', '6', 'Macho', 'Grande', 'Spike es fuerte y está acostumbrado al manejo humano.', 'https://misanimales.com/wp-content/uploads/2019/06/tuatara.jpg?auto=webp&quality=45&width=750&crop=16:9', '2025-05-05', 'Adopción activa'),
(35, 3, 'Ruby', 'Reptil', '1', 'Hembra', 'Pequeño', 'Ruby es joven y aún está creciendo.', 'https://cdn.pixabay.com/photo/2015/05/21/13/39/snake-777197_1280.jpg', '2025-05-05', 'Adopción activa'),
(36, 1, 'Flash', 'Reptil', '2', 'Macho', 'Mediano', 'Flash es rápido y curioso.', 'https://p0.pikist.com/photos/236/177/snake-green-mamba-toxic-dangerous-mamba-scale-green-creature-animal-world.jpg', '2025-05-05', 'Adopción activa'),
(37, 1, 'Aqua', 'Reptil', '4', 'Hembra', 'Grande', 'Aqua es una tortuga acuática que necesita espacio amplio.', 'https://exoticsveterinaria.com/wp-content/uploads/2020/12/tortuga_agua_exotics_3.jpg', '2025-05-05', 'Adopción activa'),
(38, 8, 'Zuko', 'Reptil', '3', 'Macho', 'Mediano', 'Zuko disfruta de los baños de sol.', 'https://i.pinimg.com/originals/92/41/e6/9241e6421542c7c3c34fb67de56d967d.jpg', '2025-05-05', 'Adopción activa'),
(39, 1, 'Chester', 'Roedor', '2', 'Macho', 'Mediano', 'Chester es un cobayo muy cariñoso y le gusta estar en compañía.', 'https://static.wixstatic.com/media/94998b_f5f1240219b44deeb0d159eb9fbd5b27~mv2.jpg/v1/fill/w_568,h_502,fp_0.51_0.57,q_90/94998b_f5f1240219b44deeb0d159eb9fbd5b27~mv2.jpg', '2025-05-05', 'Adopción activa'),
(40, 2, 'Luna', 'Roedor', '3', 'Hembra', 'Pequeño', 'Luna es una hamster activa y le encanta correr en su rueda.', 'https://th.bing.com/th/id/OIP.w_9PT9SK92a95UizBctZ5AHaHa?cb=iwc2&rs=1&pid=ImgDetMain', '2025-05-05', 'Adopción activa'),
(41, 2, 'Pelusa', 'Roedor', '4', 'Hembra', 'Mediano', 'Pelusa es un conejo muy tranquilo y se lleva bien con niños pequeños.', 'https://i.pinimg.com/originals/16/11/5a/16115af66a756dc8e08f2ed3be5696f7.jpg', '2025-05-05', 'Adopción activa'),
(42, 3, 'Rocky', 'Roedor', '1', 'Macho', 'Grande', 'Rocky es un cobayo extrovertido que disfruta de los espacios abiertos.', 'https://cdn.animalencyclopedia.info/wp-content/uploads/2018/05/Guinea-Pigs-1.jpg', '2025-05-05', 'Adopción activa'),
(43, 3, 'Coco', 'Roedor', '3', 'Macho', 'Pequeño', 'Coco es un hamster muy activo y le gusta escalar.', 'https://blog.omlet.co.uk/wp-content/uploads/sites/9/2021/03/ddd_Easy-Resize.com_-e1616685291815.jpg', '2025-05-05', 'Adopción activa'),
(44, 1, 'Gizmo', 'Roedor', '2', 'Macho', 'Mediano', 'Gizmo es un cobayo muy sociable y le gusta ser acariciado.', 'https://www.haustierblog.net/wp-content/uploads/2016/03/meerschweinchen-gehege-1024x768.jpg', '2025-05-05', 'Adopción activa'),
(45, 2, 'Susi', 'Roedor', '4', 'Hembra', 'Pequeño', 'Susi es una hamster tranquila y le encanta dormir durante el día.', 'https://www.aniimoo.com/wp-content/uploads/2021/08/Que-faire-si-votre-Hamster-chute-07.jpg', '2025-05-05', 'Adopción activa'),
(46, 8, 'Pepe', 'Roedor', '2', 'Macho', 'Grande', 'Pepe es un conejo cariñoso que disfruta de los mimos.', 'https://th.bing.com/th/id/OIP.ytMzGV-461HZXBL-hUkP4AHaGM?cb=iwc2&rs=1&pid=ImgDetMain', '2025-05-05', 'Adopción no activa'),
(47, 8, 'Lily', 'Roedor', '3', 'Hembra', 'Mediano', 'Lily es un cobayo juguetón y siempre está explorando.', 'https://einfachtierisch.de/media/cache/article_content/cms/2013/12/Meerschweinchen-Gansebluemchen.jpg', '2025-05-05', 'Adopción activa'),
(48, 1, 'Tina', 'Ave', '2', 'Hembra', 'Mediano', 'Tina es un loro muy hablador y le encanta interactuar con la gente.', 'https://infoanimal.net/wp-content/uploads/2020/05/Loro-cabeza-gris.jpg', '2025-05-05', 'Adopción activa'),
(49, 1, 'Kiara', 'Ave', '1', 'Hembra', 'Pequeño', 'Kiara es una canaria muy melodiosa y le encanta cantar por las mañanas.', 'https://t1.uc.ltmcdn.com/es/posts/6/3/8/como_saber_si_mi_canario_es_macho_o_hembra_39836_orig.jpg', '2025-05-05', 'Adopción activa'),
(50, 2, 'Rocco', 'Ave', '4', 'Macho', 'Grande', 'Rocco es un guacamayo que disfruta de los espacios abiertos.', 'https://estag.fimagenes.com/img/4/V/4/7/V47_900.jpg', '2025-05-05', 'Adopción activa'),
(51, 2, 'Sunny', 'Ave', '3', 'Hembra', 'Mediano', 'Sunny es un periquito muy activo y social.', 'https://th.bing.com/th/id/OIP.KQeHtsGNCsDMLrkfHTAUJwHaFj?cb=iwc2&w=700&h=525&rs=1&pid=ImgDetMain', '2025-05-05', 'Adopción activa'),
(52, 3, 'Lola', 'Ave', '5', 'Hembra', 'Pequeño', 'Lola es una tortolita tranquila que disfruta del sol.', 'https://www.allaboutbirds.org/guide/assets/photo/308127271-1900px.jpg', '2025-05-05', 'Adopción activa'),
(53, 3, 'Max', 'Ave', '2', 'Macho', 'Mediano', 'Max es un loro amazónico que le gusta cantar y volar por la casa.', 'https://th.bing.com/th/id/R.c0bd5b4455a03d16ebde5b53daa447ff?rik=9csybeaUHwCvDg&riu=http%3a%2f%2fhablemosdeaves.com%2fwp-content%2fuploads%2f2017%2f03%2fcaracteristicas-del-loro-verde-1.jpg&ehk=zCNA9SQhKbG2LiOM3n6UYeaN0OZ0BDhs0%2f9d6EKORvU%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1', '2025-05-05', 'Adopción activa'),
(54, 8, 'Toby', 'Ave', '3', 'Macho', 'Pequeño', 'Toby es un canario alegre que disfruta de la compañía.', 'https://atlasanimal.com/wp-content/uploads/2021/02/canario.jpg', '2025-05-05', 'Adopción activa'),
(55, 3, 'Olga', 'Ave', '1', 'Hembra', 'Pequeño', 'Olga es una cacatúa juguetona y le encanta hacer ruidos divertidos.', 'https://inaturalist-open-data.s3.amazonaws.com/photos/160560221/medium.jpeg', '2025-05-05', 'Adopción activa'),
(56, 8, 'Polly', 'Ave', '2', 'Macho', 'Mediano', 'Polly es un loro gris africano que es muy inteligente.', 'https://th.bing.com/th/id/R.fc227b466f9ff9a0d2647b4f529b8f30?rik=RnboEQWVFxtwfg&riu=http%3a%2f%2f3.bp.blogspot.com%2f-tblI357U8Zs%2fUUY90uhvw4I%2fAAAAAAAAA3s%2feWp4KFlZ4sk%2fs1600%2floro.jpg&ehk=IGrQmkuZctpEKfr7QFODznnhl025fb%2fh1EFtPrqp22o%3d&risl=&pid=ImgRaw&r=0', '2025-05-05', 'Adopción activa'),
(57, 8, 'Rio', 'Ave', '3', 'Hembra', 'Grande', 'Rio es un guacamayo que necesita mucho espacio para volar.', 'https://infoanimales.net/wp-content/uploads/2020/06/caracter%C3%ADsticas-del-guacamayo-azul.jpg', '2025-05-05', 'Adopción activa'),
(58, 1, 'Nemo', 'Pez', '1', 'Macho', 'Pequeño', 'Nemo es un pez payaso muy juguetón.', 'https://th.bing.com/th/id/OIP.YjieuFbX6n_k-9hNLZ1RTgAAAA?cb=iwc2&w=320&h=295&rs=1&pid=ImgDetMain', '2025-05-05', 'Adopción activa'),
(59, 1, 'Dory', 'Pez', '2', 'Hembra', 'Mediano', 'Dory es un pez cirujano muy curioso y explorador.', 'https://th.bing.com/th/id/OIP.KunGKTVKLFDZcZSK3X4xDgHaHa?cb=iwc2&w=1060&h=1060&rs=1&pid=ImgDetMain', '2025-05-05', 'Adopción activa'),
(60, 2, 'Goldie', 'Pez', '3', 'Macho', 'Pequeño', 'Goldie es un pez dorado muy tranquilo.', 'https://www.elmueble.com/medio/2023/12/04/pez-dorado_00000000_231205095703_495x495.jpg', '2025-05-05', 'Adopción activa'),
(61, 2, 'Fluffy', 'Pez', '1', 'Hembra', 'Pequeño', 'Fluffy es un pez betta con aletas largas y coloridas.', 'https://http2.mlstatic.com/D_NQ_NP_716172-MCO44190062512_112020-F.jpg', '2025-05-05', 'Adopción activa'),
(62, 3, 'Bubbles', 'Pez', '2', 'Macho', 'Mediano', 'Bubbles es un pez luchador que necesita su propio espacio.', 'https://th.bing.com/th/id/R.257d94b5cefa5311adea8977d6ab4d84?rik=uCxndUipPZzk8Q&pid=ImgRaw&r=0', '2025-05-05', 'Adopción activa'),
(63, 3, 'Shadow', 'Pez', '3', 'Hembra', 'Mediano', 'Shadow es un pez de agua fría muy resistente.', 'https://www.depeces.com/wp-content/uploads/2016/06/goldfish.jpg', '2025-05-05', 'Adopción activa'),
(64, 1, 'Splash', 'Pez', '1', 'Macho', 'Pequeño', 'Splash es un pez de colores vibrantes y muy activo.', 'https://img.freepik.com/fotos-premium/pescado-acuario-pez-colores-agua-submarino-animal-mar-tropical-oro-naturaleza-oceano_938969-66.jpg', '2025-05-05', 'Adopción activa'),
(65, 2, 'Coral', 'Pez', '4', 'Hembra', 'Mediano', 'Coral es un pez ángel que se adapta bien a acuarios comunitarios.', 'https://th.bing.com/th/id/R.a2ff7c4408ade4db3b09a21efdcfa060?rik=qoeTFFVtS0h8%2fA&riu=http%3a%2f%2fwww.mercafauna.com%2ffotos%2fanimales%2f53_pterophyllum_scalare01.jpg&ehk=MAH%2bF1bFTqIDYpTxQFSXBd0Z%2fNSc1OlaY%2bDeM43mor8%3d&risl=&pid=ImgRaw&r=0', '2025-05-05', 'Adopción activa'),
(66, 8, 'Aquarius', 'Pez', '2', 'Macho', 'Pequeño', 'Aquarius es un pez disco que disfruta de la calma en el agua.', 'https://th.bing.com/th/id/R.ccf9b819afe0ca253f15b98d79f45cd5?rik=9yS1dMqnTgKJnA&pid=ImgRaw&r=0', '2025-05-05', 'Adopción activa'),
(67, 8, 'Star', 'Pez', '3', 'Hembra', 'Mediano', 'Star es un pez koi muy sociable que le gusta estar con otros peces.', 'https://thelakehill.com/wp-content/uploads/2023/03/Koi-Fish.webp', '2025-05-05', 'Adopción activa'),
(68, 2, 'Vainilla', 'Roedor', '2', 'Hembra', 'Pequeno', 'Vainilla es una conejita a la que le gusta comer y dormir, perfecta para familias tranquilas', 'https://i.pinimg.com/736x/23/95/36/23953669049a24da6e7cbdbddfac9e6e.jpg', '2025-05-15', 'Adopción activa'),
(70, 2, 'Pedro', 'Ave', '11m', 'Macho', 'Mediano', 'Pedro es un pato divertido y gracioso, le encanta correr y bañarse', 'https://static.nationalgeographic.es/files/styles/image_3200/public/336939012_834362331624638_3334172855623225389_n.webp?w=760&h=570', '2025-05-08', 'Adopción activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `applications`
--

CREATE TABLE `applications` (
  `id` int(225) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_animal` int(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `resolution` varchar(225) NOT NULL,
  `applic_name` varchar(255) NOT NULL,
  `applic_mail` varchar(255) NOT NULL,
  `applic_phone` varchar(255) NOT NULL,
  `applic_address` varchar(255) NOT NULL,
  `housing_type` varchar(255) NOT NULL,
  `ownership_status` varchar(255) NOT NULL,
  `pets_allowed` varchar(255) NOT NULL,
  `outdoor_space` varchar(255) NOT NULL,
  `pets_before` varchar(255) NOT NULL,
  `other_pets` varchar(255) NOT NULL,
  `maintenance` varchar(255) NOT NULL,
  `contract` varchar(255) NOT NULL,
  `post_adop` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `applications`
--

INSERT INTO `applications` (`id`, `id_user`, `id_animal`, `date`, `status`, `text`, `resolution`, `applic_name`, `applic_mail`, `applic_phone`, `applic_address`, `housing_type`, `ownership_status`, `pets_allowed`, `outdoor_space`, `pets_before`, `other_pets`, `maintenance`, `contract`, `post_adop`) VALUES
(1, 2, 5, '2025-05-15', 'pendiente', 'Porque me encantan los animales y vivo sola así que quiero tener compañía', '', 'Vega Pérez Puente', 'vega@gmail.com', '555 55 55 55', 'Calle Vega, 55', 'casa', 'propia', '', 'si', 'si', 'no', 'si', 'si', 'si'),
(3, 2, 6, '2025-05-15', 'pendiente', 'Quiero dar amor sisi', '', 'Vega Pérez Puente', 'vega@gmail.com', '555 55 55 55', 'Calle Vega, 55', 'piso', 'alquilada', 'si', 'no', 'no', 'no', 'si', 'si', 'si'),
(12, 2, 46, '2025-05-16', 'status', 'nnznznnxnxnznxnxzmzmnxmznxzmmznxm', '', 'Paula Gomez Lopez', 'paula@gmail.com', '222 22 22 22', 'Calle Paula, 22', 'piso', 'alquilada', 'si', 'no', 'si', 'no', 'si', 'si', 'no'),
(13, 2, 46, '2025-05-16', 'status', 'nnznznnxnxnznxnxzmzmnxmznxzmmznxm', '', 'Paula Gomez Lopez', 'paula@gmail.com', '222 22 22 22', 'Calle Paula, 22', 'piso', 'propia', '', 'no', 'si', 'no', 'si', 'si', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donations`
--

CREATE TABLE `donations` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_shelter` int(255) NOT NULL,
  `amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `donations`
--

INSERT INTO `donations` (`id`, `id_user`, `id_shelter`, `amount`) VALUES
(1, 8, 2, 40),
(2, 8, 5, 15),
(3, 2, 5, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorites`
--

CREATE TABLE `favorites` (
  `id` int(225) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_animal` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favorites`
--

INSERT INTO `favorites` (`id`, `id_user`, `id_animal`) VALUES
(7, 2, 7),
(9, 2, 16),
(10, 2, 9),
(11, 2, 44),
(12, 2, 64),
(15, 2, 19),
(21, 2, 29),
(23, 2, 37),
(24, 2, 22),
(25, 2, 68),
(26, 2, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shelters`
--

CREATE TABLE `shelters` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `web` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `shelters`
--

INSERT INTO `shelters` (`id`, `name`, `foto`, `web`) VALUES
(1, 'Apadan', 'https://apadan.org/wp-content/uploads/2019/10/logo_APADAN-800x800.jpg', 'https://apadan.org/'),
(2, 'Fundación TEPA', 'https://res.cloudinary.com/dnslkysy1/image/upload/v1698330176/logo_tepa_esld8z.jpg', 'https://www.fundaciontepa.org/'),
(3, 'FAADA', 'https://cartadeviajes.pe/catalogo/imagenes/faadalogo.jpg', 'https://faada.org/entidades-asociaciones-protectoras-coruna'),
(4, 'Acougo', 'https://as2.ftcdn.net/v2/jpg/02/63/76/45/1000_F_263764588_rEI8jQZZ1wTkGivVcTyqD7L6Y0kvS4oA.jpg', 'https://acougo.org/'),
(5, 'Huellas Callejeras', 'https://www.huellascallejeras.com/wp-content/uploads/2020/06/logoHuellas3.png', 'https://www.huellascallejeras.com/'),
(6, 'Aloia', 'https://media.v2.siweb.es/uploaded_thumb_medium/56a9ae392b25b056761b626f433f1503/cropped_cropped_logo_aloia1.png', 'https://aloiaprotectora.org/'),
(7, 'El Refugio', 'https://t2.ea.ltmcdn.com/es/posts/4/9/5/el_refugio_20594_2_orig.jpg', 'https://elrefugio.org/'),
(8, 'ANAA', 'https://www.miwuki.com/wp-content/uploads/2016/10/anaa.png', 'https://anaaweb.org/'),
(9, 'El hogar', 'https://th.bing.com/th/id/OIP.Zi-altaL-hQ1quL-IiH3iAHaHa?cb=iwc2&rs=1&pid=ImgDetMain', 'https://fundacionelhogar.org/'),
(10, 'Arca de Noé', 'https://arcadenoe.org/_mibambu/_arcadenoe/imas/logo-arcadenoe2.jpg', 'https://www.arcadenoe.org/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(225) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `phone` int(9) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `DNI`, `phone`, `address`) VALUES
(1, 'Lua', 'lua@gmail.com', '$2y$10$sHFYY94N.JkGwONB61zjIeXmGL939aa2.XyM2Z6q0MqmUxRq/2x4.', '12345678K', 123456789, 'Calle Lua, 44'),
(2, 'Lupe', 'lupe@gmail.com', '$2y$10$WFw9Zls6NLUdXF1InRBB6.Wm8cudIb9x/ts7yo0TmwfoWiZxWxb/O', '98765432M', 987654321, 'Calle Lupe, 321'),
(3, 'Sonia', 'sonia@gmail.com', '$2y$10$5dYH6jzgi7pxQD0YvcOci./3ZapZ52TmsJC2ucwExloVWX6MSKlRe', '33333333F', 333333333, 'Calle Sonia, 11'),
(8, 'Susi', 'susi@gmail.com', '$2y$10$c07Y4XLaehsbztbidhbZmOQCIdozv3FjjCsf8sed/z59p2Nu2ssXS', '88888888L', 888888888, 'Calle Susi, 88'),
(9, 'Ana', 'ana@gmail.com', '$2y$10$0D3RQHaWyK5qRZMxn4QQEOmX2PS4ySiyv6ljMPi12vCGEtaET.Ln2', '44444444M', 444444444, 'Calle Ana, 22'),
(12, 'Julia', 'julia@gmail.com', '$2y$10$LNhz7ke.KBMb/MfHGPsfP.UMG0M2kLGpO4X79oSnphpTezKnwMzGy', '55555555U', 555555555, 'Calle julia, 55'),
(13, 'Beth', 'beth@gmail.com', '$2y$10$mZfoxmvzEupBdKkFocJmyuMsakeM/V6qt3y2Q1J02X/Et6pxIaViO', '22222222X', 222222222, 'Calle Beth, 22'),
(14, 'Juan', 'juan@example.com', '$2y$10$hoEbBmDxZLJE23.DaGejaO/JCI.zXKjlhzznHVBLBP/RZ6biYU3i6', '12345678L', 123456789, 'Calle Juan, 123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Indices de la tabla `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_shelter` (`id_shelter`);

--
-- Indices de la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Indices de la tabla `shelters`
--
ALTER TABLE `shelters`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `shelters`
--
ALTER TABLE `shelters`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`id_animal`) REFERENCES `animals` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`id_shelter`) REFERENCES `shelters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`id_animal`) REFERENCES `animals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
