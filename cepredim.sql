SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema cepredim
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cepredim` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `cepredim` ;

-- -----------------------------------------------------
-- Table `cepredim`.`clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cepredim`.`clientes` ;

CREATE TABLE IF NOT EXISTS `cepredim`.`clientes` (
  `idcliente` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cli_nombre` VARCHAR(100) NOT NULL,
  `cli_procedencia` TINYINT(1) NOT NULL,
  `cli_direccion` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`idcliente`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cepredim`.`vendedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cepredim`.`vendedores` ;

CREATE TABLE IF NOT EXISTS `cepredim`.`vendedores` (
  `idvendedor` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ven_nombre` VARCHAR(15) NOT NULL,
  `ven_apellido` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idvendedor`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cepredim`.`tipo_trabajo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cepredim`.`tipo_trabajo` ;

CREATE TABLE IF NOT EXISTS `cepredim`.`tipo_trabajo` (
  `idtipo_trabajo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tip_nombre` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idtipo_trabajo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cepredim`.`trabajos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cepredim`.`trabajos` ;

CREATE TABLE IF NOT EXISTS `cepredim`.`trabajos` (
  `idtrabajo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tra_orden` VARCHAR(10) NOT NULL,
  `tra_titulo` VARCHAR(100) NOT NULL,
  `tra_tiraje` INT UNSIGNED NOT NULL,
  `tra_fecha_cliente` DATE NULL,
  `tra_fecha_produccion` DATE NULL,
  `tra_descripcion` TEXT NOT NULL,
  `tra_estado` TINYINT(1) NOT NULL,
  `idcliente` INT UNSIGNED NOT NULL,
  `idvendedor` INT UNSIGNED NOT NULL,
  `idtipo_trabajo` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idtrabajo`),
  INDEX `fk_trabajo_cliente_idx` (`idcliente` ASC),
  INDEX `fk_trabajo_vendedor1_idx` (`idvendedor` ASC),
  INDEX `fk_trabajos_tipo_trabajo1_idx` (`idtipo_trabajo` ASC),
  CONSTRAINT `fk_trabajo_cliente`
    FOREIGN KEY (`idcliente`)
    REFERENCES `cepredim`.`clientes` (`idcliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_trabajo_vendedor1`
    FOREIGN KEY (`idvendedor`)
    REFERENCES `cepredim`.`vendedores` (`idvendedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_trabajos_tipo_trabajo1`
    FOREIGN KEY (`idtipo_trabajo`)
    REFERENCES `cepredim`.`tipo_trabajo` (`idtipo_trabajo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cepredim`.`guias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cepredim`.`guias` ;

CREATE TABLE IF NOT EXISTS `cepredim`.`guias` (
  `idguia` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `gui_numero` VARCHAR(45) NOT NULL,
  `gui_cantidad` INT UNSIGNED NOT NULL,
  `gui_estado` TINYINT(1) NOT NULL DEFAULT 1,
  `idtrabajo` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idguia`),
  INDEX `fk_guia_trabajo1_idx` (`idtrabajo` ASC),
  CONSTRAINT `fk_guia_trabajo1`
    FOREIGN KEY (`idtrabajo`)
    REFERENCES `cepredim`.`trabajos` (`idtrabajo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cepredim`.`incidencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cepredim`.`incidencias` ;

CREATE TABLE IF NOT EXISTS `cepredim`.`incidencias` (
  `idincidencia` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `inc_fecha` DATETIME NOT NULL,
  `inc_detalle` TEXT NOT NULL,
  `idtrabajo` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idincidencia`),
  INDEX `fk_incidencia_trabajo1_idx` (`idtrabajo` ASC),
  CONSTRAINT `fk_incidencia_trabajo1`
    FOREIGN KEY (`idtrabajo`)
    REFERENCES `cepredim`.`trabajos` (`idtrabajo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cepredim`.`contactos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cepredim`.`contactos` ;

CREATE TABLE IF NOT EXISTS `cepredim`.`contactos` (
  `idcontacto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `con_nombre` VARCHAR(45) NOT NULL,
  `con_telefono` VARCHAR(10) NULL,
  `con_email` VARCHAR(45) NULL,
  `idcliente` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idcontacto`),
  INDEX `fk_contacto_cliente1_idx` (`idcliente` ASC),
  CONSTRAINT `fk_contacto_cliente1`
    FOREIGN KEY (`idcliente`)
    REFERENCES `cepredim`.`clientes` (`idcliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cepredim`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cepredim`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `cepredim`.`usuarios` (
  `idusuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usu_nombre` VARCHAR(45) NOT NULL,
  `usu_apellido` VARCHAR(45) NOT NULL,
  `usu_password` VARCHAR(45) NOT NULL,
  `usu_access_level` INT(2) NOT NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `cepredim`.`clientes`
-- -----------------------------------------------------
START TRANSACTION;
USE `cepredim`;
INSERT INTO `cepredim`.`clientes` (`idcliente`, `cli_nombre`, `cli_procedencia`, `cli_direccion`) VALUES (NULL, 'Secretaria General', 0, 'Ciudad Universitaria');

COMMIT;


-- -----------------------------------------------------
-- Data for table `cepredim`.`vendedores`
-- -----------------------------------------------------
START TRANSACTION;
USE `cepredim`;
INSERT INTO `cepredim`.`vendedores` (`idvendedor`, `ven_nombre`, `ven_apellido`) VALUES (NULL, 'Luz', 'Alfaro');
INSERT INTO `cepredim`.`vendedores` (`idvendedor`, `ven_nombre`, `ven_apellido`) VALUES (NULL, 'Carolina', 'Cornejo');

COMMIT;


-- -----------------------------------------------------
-- Data for table `cepredim`.`tipo_trabajo`
-- -----------------------------------------------------
START TRANSACTION;
USE `cepredim`;
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Libro de Texto');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Libro de Investigación');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Libro de Registro');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Cuaderno');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Revista');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Agenda');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Almanaque');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Block');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Boletín');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Periódico');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Manual');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Catálogo');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Legajo');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Brochure');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Folleto');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Libreta');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Memoria');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Díptico');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Tríptico');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Cuadríptico');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Afiche');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Afiche-Díptico');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Afiche-Tríptico');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Afiche Cuadríptico');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Programa');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Encarte');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Volante');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Carátula');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Sticker');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Carné');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Certificado');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Constancia');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Credencial');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Diploma');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Fotocheck');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Tarjeta de Invitación');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Tarjeta de presentación');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Tarjeta conmemorativa');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Tarjeta de navidad');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Tarjeta de control');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Bolsa');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Caja');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Carpeta con bolsillo');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Carpeta sin bolsillo');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Sobres con membrete');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Sobres sin membrete');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Tapas y contratapas');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Tubos potadiploma');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'CD');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Folder de plástico');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Estuche de CD');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Cartilla');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Hoja membretada');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Ticket');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Recibo de movilidad');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Fichas');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Hojas de exámen');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'FUT');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Vale');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Impresión de carátulas');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Confección de libros');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Impresión');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Grabado de CD');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Banner');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'Serigrafiado');
INSERT INTO `cepredim`.`tipo_trabajo` (`idtipo_trabajo`, `tip_nombre`) VALUES (NULL, 'OTROS');

COMMIT;


-- -----------------------------------------------------
-- Data for table `cepredim`.`trabajos`
-- -----------------------------------------------------
START TRANSACTION;
USE `cepredim`;
INSERT INTO `cepredim`.`trabajos` (`idtrabajo`, `tra_orden`, `tra_titulo`, `tra_tiraje`, `tra_fecha_cliente`, `tra_fecha_produccion`, `tra_descripcion`, `tra_estado`, `idcliente`, `idvendedor`, `idtipo_trabajo`) VALUES (NULL, '10034', 'Libro de Registro', 8, '2015.01.01', '2015.01.01', '8 libros de registro', 0, 1, 1, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `cepredim`.`usuarios`
-- -----------------------------------------------------
START TRANSACTION;
USE `cepredim`;
INSERT INTO `cepredim`.`usuarios` (`idusuario`, `usu_nombre`, `usu_apellido`, `usu_password`, `usu_access_level`) VALUES (NULL, 'jorge', 'ventura', 'pepsiman', 1);
INSERT INTO `cepredim`.`usuarios` (`idusuario`, `usu_nombre`, `usu_apellido`, `usu_password`, `usu_access_level`) VALUES (NULL, 'gerardo', 'quispe', 'gquispe', 2);

COMMIT;

