/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - estructuradatos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`estructuradatos` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;

USE `estructuradatos`;

/*Table structure for table `contenido` */

DROP TABLE IF EXISTS `contenido`;

CREATE TABLE `contenido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo` enum('Array','Pila','Cola','Lista','Grafo','Árbol','Ordenación') NOT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_contenido_usuario` (`usuario_id`),
  KEY `index_titulo` (`titulo`),
  CONSTRAINT `fk_contenido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `contenido` */

insert  into `contenido`(`id`,`titulo`,`descripcion`,`tipo`,`archivo`,`usuario_id`,`created_at`,`updated_at`) values 
(33,'Arrays','Estructuras de datos que almacenan elementos de manera contigua en memoria. Permiten el acceso rápido a sus elementos mediante índices, facilitando la manipulación de colecciones de datos.\r\n','Array','Imagen de WhatsApp 2024-11-04 a las 11.22.58_48efc462.jpg',9,'2024-11-07 16:20:43','2024-11-07 16:20:43'),
(34,'Pilas','Estructuras de datos que siguen el principio LIFO (Last In, First Out). Los elementos se añaden y eliminan desde el mismo extremo, lo que permite un acceso simple y eficiente a los elementos más recientes.\r\n','Pila','Imagen de WhatsApp 2024-11-04 a las 11.22.58_8c23c0dd.jpg',9,'2024-11-07 16:21:05','2024-11-07 16:21:05'),
(35,'Colas','Estructuras que operan bajo el principio FIFO (First In, First Out). Los elementos se añaden en un extremo y se eliminan por el otro, similar a una fila en una tienda. Son útiles para gestionar tareas en orden.','Cola','colas.jpg',9,'2024-11-07 16:22:00','2024-11-07 16:22:00'),
(36,'Listas','Colecciones de elementos que pueden ser de tamaño variable. Existen listas enlazadas (donde cada elemento apunta al siguiente) y listas dobles enlazadas (donde cada elemento apunta tanto al siguiente como al anterior).\r\n','Lista','lista.jpg',9,'2024-11-07 16:22:49','2024-11-07 16:22:49'),
(37,'Grafos','Estructuras compuestas de nodos (o vértices) y aristas (o conexiones) que representan relaciones entre los nodos. Se utilizan en diversas aplicaciones, como redes sociales, mapas y algoritmos de búsqueda.\r\n','Grafo','grafo.jpg',9,'2024-11-07 16:23:39','2024-11-07 16:23:39'),
(38,'Árboles','Estructuras jerárquicas que consisten en nodos conectados por aristas. Cada árbol tiene un nodo raíz y cada nodo puede tener múltiples hijos. Se utilizan en bases de datos y sistemas de archivos.','Árbol','arbol.jpg',9,'2024-11-07 16:24:25','2024-11-07 16:24:25'),
(39,'Ordenación','Técnicas y algoritmos diseñados para reorganizar una colección de elementos en un orden específico (ascendente o descendente). Ejemplos incluyen ordenación por burbuja, ordenación rápida y ordenación por fusión.','Ordenación',NULL,9,'2024-11-07 16:25:40','2024-11-07 16:25:40');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rol` enum('usuario','administrador') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`nombre`,`correo`,`contrasena`,`created_at`,`updated_at`,`rol`) values 
(2,'asjdsaji','asjkldjakd@mail.com','$2y$10$s4nArupnOY1VTpHlpMM0j.slbtjMXMOlMFyzgl3CkssDE8R8ot3Li','2024-11-04 09:34:21','2024-11-04 09:34:21','usuario'),
(3,'GUSTAVO JAVIER GOMEZ CESPEDES','dkajdkl@mailc','$2y$10$JjOD3amfVuztq5hSjoom5.dYCKFjoMK8XBrz/oTJJfDOo0ye1kEOa','2024-11-04 09:39:14','2024-11-04 09:39:14','usuario'),
(6,'djajhsj','asdjd@gmail.com','$2y$10$amHWqQ8un/BitWOMcbXi6OL2s44ZcpeHkh2xekAROq2kMozWqMv9e','2024-11-04 12:04:14','2024-11-04 12:04:14','usuario'),
(7,'fio','fio@gmail.com','$2y$10$D4zdRXUAYWrIVQAQgmpxiep5EuYuSvYxnGe7zvmudqZKFDUKrriOG','2024-11-04 12:13:53','2024-11-04 12:13:53','usuario'),
(9,'administrador','admin@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5','2024-11-04 12:50:46','2024-11-05 09:54:27','administrador'),
(10,'klfjkfjsd','dskk@mail.com','$2y$10$iI5quRetwSp1eeOGc3b5Vu2ira9HwmLZKAzHYOTevrFhbeBweVcsu','2024-11-07 14:34:12','2024-11-07 14:34:12','usuario'),
(11,'fio','fioooo@mail.com','$2y$10$lW7IaJwyGsmGNH36pp3FF.0elKjhhptgy5hmIFQl/eVSqWpdTHB3u','2024-11-07 20:37:13','2024-11-07 20:37:13','usuario'),
(12,'Fiorella ','fiolujan28@gmail.com','$2y$10$axF9v55UFWyjgFCKbo.cv.xMHl70RnB2up5OpDksrtnUB1n5cUWfm','2024-11-11 07:39:46','2024-11-11 07:39:46','usuario');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
