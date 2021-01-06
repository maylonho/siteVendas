-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.17-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para sgvc
CREATE DATABASE IF NOT EXISTS `sgvc` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `sgvc`;


-- Copiando estrutura para tabela sgvc.cadastrarconta
CREATE TABLE IF NOT EXISTS `cadastrarconta` (
  `idCompra` int(11) NOT NULL AUTO_INCREMENT,
  `dataCad` datetime DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `descricaoProdutos` varchar(500) DEFAULT NULL,
  `valorTotal` double DEFAULT NULL,
  `numParcelas` int(11) DEFAULT NULL,
  `tipoPagamento` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idCompra`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COMMENT='maylon henrique de oliveira';

-- Copiando dados para a tabela sgvc.cadastrarconta: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `cadastrarconta` DISABLE KEYS */;
INSERT INTO `cadastrarconta` (`idCompra`, `dataCad`, `nome`, `cpf`, `telefone`, `endereco`, `descricaoProdutos`, `valorTotal`, `numParcelas`, `tipoPagamento`) VALUES
	(56, '2020-12-29 21:43:54', 'Maylon de Oliveira', '789.779.798-74', '(13) 38542-138', 'RUA BRASIL', '', 124, 3, 'Crediário'),
	(57, '2020-12-29 22:01:44', 'Maylon de Oliveira', '777.777.777-77', '(13) 38542-138', 'RUA BRASIL', '', 1212, 4, 'Crediário'),
	(58, '2020-12-30 09:00:12', 'Redinelson de Oliveira', '678.565.564-4', '(13) 99779-1878', 'Rua Brasil (antiga rua são paulo)', '', 200, 8, 'Crediário'),
	(59, '2020-12-30 09:00:26', 'Maylon de Oliveira', '678.565.564-4', '(13) 38542-138', 'RUA BRASIL', '', 210, 4, 'Crediário'),
	(60, '2020-12-30 09:34:13', 'Pedro Antonio', '312.313.333-33', '(13) 99779-1878', 'Rua Brasil (antiga rua são paulo)', '', 500, 2, 'Crediário'),
	(61, '2020-12-30 09:37:42', 'JOQO', '900.000.000-00', '(00) 00000-0000', 'jnoon', '', 200, 3, 'Crediário'),
	(62, '2020-12-30 10:02:10', 'Jarconio', '777.777.777-77', '(99) 99999-9999', 'ojnno', '', 400, 7, 'Crediário'),
	(63, '2020-12-30 10:02:56', 'Redinelson de Oliveira', '789.779.798-7', '(13) 99779-1878', 'Rua Brasil (antiga rua são paulo)', '', 210, 7, 'Crediário'),
	(64, '2021-01-03 21:00:34', 'Joanir Cunha', '123.456.789-00', '(13) 99677-8735', 'Rua Aribert Fazio, Parafuso, Cajati SP', 'momimomim', 250, 4, 'Crediário');
/*!40000 ALTER TABLE `cadastrarconta` ENABLE KEYS */;


-- Copiando estrutura para tabela sgvc.login
CREATE TABLE IF NOT EXISTS `login` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  PRIMARY KEY (`usuario`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sgvc.login: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`idUsuario`, `usuario`, `senha`) VALUES
	(1, 'mho', '123'),
	(2, 'miria', '111');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;


-- Copiando estrutura para tabela sgvc.prestacoes
CREATE TABLE IF NOT EXISTS `prestacoes` (
  `idCompra` int(11) DEFAULT NULL,
  `cpfCliente` varchar(20) DEFAULT NULL,
  `valorParcela` double DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `idParcela` int(11) DEFAULT NULL,
  `qtdParcela` int(11) DEFAULT NULL,
  `statusPag` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sgvc.prestacoes: ~42 rows (aproximadamente)
/*!40000 ALTER TABLE `prestacoes` DISABLE KEYS */;
INSERT INTO `prestacoes` (`idCompra`, `cpfCliente`, `valorParcela`, `vencimento`, `idParcela`, `qtdParcela`, `statusPag`) VALUES
	(56, '789.779.798-74', 41.333333333333, '2021-01-09', 1, 3, b'0'),
	(56, '789.779.798-74', 41.333333333333, '2021-03-09', 2, 3, b'0'),
	(56, '789.779.798-74', 41.333333333333, '2021-03-09', 3, 3, b'0'),
	(57, '777.777.777-77', 303, '2021-01-18', 1, 4, b'0'),
	(57, '777.777.777-77', 303, '2021-03-18', 2, 4, b'0'),
	(57, '777.777.777-77', 303, '2021-03-18', 3, 4, b'0'),
	(57, '777.777.777-77', 303, '2021-04-18', 4, 4, b'0'),
	(58, '678.565.564-4', 25, '2021-01-12', 1, 8, b'0'),
	(58, '678.565.564-4', 25, '2021-03-12', 2, 8, b'0'),
	(58, '678.565.564-4', 25, '2021-03-12', 3, 8, b'0'),
	(58, '678.565.564-4', 25, '2021-04-12', 4, 8, b'0'),
	(58, '678.565.564-4', 25, '2021-05-12', 5, 8, b'0'),
	(58, '678.565.564-4', 25, '2021-06-12', 6, 8, b'0'),
	(58, '678.565.564-4', 25, '2021-07-12', 7, 8, b'0'),
	(58, '678.565.564-4', 25, '2021-08-12', 8, 8, b'0'),
	(59, '678.565.564-4', 52.5, '2021-01-08', 1, 4, b'0'),
	(59, '678.565.564-4', 52.5, '2021-03-08', 2, 4, b'0'),
	(59, '678.565.564-4', 52.5, '2021-03-08', 3, 4, b'0'),
	(59, '678.565.564-4', 52.5, '2021-04-08', 4, 4, b'0'),
	(60, '312.313.333-33', 250, '2021-01-09', 1, 2, b'0'),
	(60, '312.313.333-33', 250, '2021-03-09', 2, 2, b'0'),
	(61, '900.000.000-00', 66.666666666667, '2020-12-09', 1, 3, b'0'),
	(61, '900.000.000-00', 66.666666666667, '2021-01-09', 2, 3, b'0'),
	(61, '900.000.000-00', 66.666666666667, '2021-03-09', 3, 3, b'0'),
	(62, '777.777.777-77', 57.142857142857, '2020-12-27', 1, 7, b'0'),
	(62, '777.777.777-77', 57.142857142857, '2021-01-27', 2, 7, b'0'),
	(62, '777.777.777-77', 57.142857142857, '2021-02-27', 3, 7, b'0'),
	(62, '777.777.777-77', 57.142857142857, '2021-03-27', 4, 7, b'0'),
	(62, '777.777.777-77', 57.142857142857, '2021-04-27', 5, 7, b'0'),
	(62, '777.777.777-77', 57.142857142857, '2021-05-27', 6, 7, b'0'),
	(62, '777.777.777-77', 57.142857142857, '2021-06-27', 7, 7, b'0'),
	(63, '789.779.798-7', 30, '2020-12-30', 1, 7, b'0'),
	(63, '789.779.798-7', 30, '2021-01-30', 2, 7, b'0'),
	(63, '789.779.798-7', 30, '2021-03-02', 3, 7, b'0'),
	(63, '789.779.798-7', 30, '2021-03-30', 4, 7, b'0'),
	(63, '789.779.798-7', 30, '2021-04-30', 5, 7, b'0'),
	(63, '789.779.798-7', 30, '2021-05-30', 6, 7, b'0'),
	(63, '789.779.798-7', 30, '2021-06-30', 7, 7, b'0'),
	(64, '123.456.789-00', 62.5, '2021-01-06', 1, 4, b'1'),
	(64, '123.456.789-00', 62.5, '2021-02-06', 2, 4, b'0'),
	(64, '123.456.789-00', 62.5, '2021-03-06', 3, 4, b'0'),
	(64, '123.456.789-00', 62.5, '2021-04-06', 4, 4, b'0');
/*!40000 ALTER TABLE `prestacoes` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
