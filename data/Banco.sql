-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30-Jun-2016 Ã s 15:34
-- VersÃ£o do servidor: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `idAdministrador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nome` char(50) DEFAULT NULL,
  `Senha` char(50) DEFAULT NULL,
  PRIMARY KEY (`idAdministrador`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `Nome`, `Senha`) VALUES
(1, 'Romario Macedo', '91726418');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `idAluno` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Administrador_idAdministrador` int(10) unsigned DEFAULT NULL,
  `Nome` char(50) CHARACTER SET utf8 DEFAULT NULL,
  `Curso` char(50) CHARACTER SET utf8 DEFAULT NULL,
  `Matricula` char(12) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idAluno`),
  KEY `Usuario_FKIndex1` (`Administrador_idAdministrador`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idAluno`, `Administrador_idAdministrador`, `Nome`, `Curso`, `Matricula`) VALUES
(52, 0, 'WANESSA PEREIRA ROCHA', 'EAD - PEDAGOGIA', 'UC13415486'),
(51, 0, 'REINALDO ARAUJO GREGOLDO', 'EAD - PEDAGOGIA', 'UC12413294'),
(50, 0, 'REJANE MARIA DA COSTA', 'EAD - PEDAGOGIA', 'UC12413846'),
(49, 0, 'PATRICIA CRISTINA ROLO PARREIRA', 'EAD - PEDAGOGIA', 'UC14417552'),
(48, 0, 'VALDILEINA FARIA MARINHO DE CASTRO', 'EAD - PEDAGOGIA', 'UC12412859'),
(47, 0, 'IZABEL CRISTINE DOS REIS DE SANTANA', 'EAD - PEDAGOGIA', 'UC11410179'),
(46, 0, 'ANA PAULA DO NASCIMENTO SABINO TEIXEIRA', 'EAD - PEDAGOGIA', 'UC13414573'),
(45, 0, 'MADLEINE ESTEFANE ARAUJO SAMPAIO', 'EAD - PEDAGOGIA', 'UC12412381'),
(44, 0, 'VITORIA DA SILVA COSTA', 'EAD - PEDAGOGIA', 'UC13101731'),
(43, 0, 'ALEXANDRA ARAUJIO', 'EAD - PEDAGOGIA', 'UC14417746'),
(42, 0, 'JULIANA EPIFANIO DE ARAUJO OLIVEIRA', 'EAD - PEDAGOGIA', 'UC11409376'),
(1, 0, 'LIVIA GONCALVES LIMA DE OLIVEIRA', 'EAD - PEDAGOGIA', 'UC16400286'),
(53, 0, 'JOYCE MARIA PINHEIRO TEIXEIRA', 'EAD - PEDAGOGIA', 'UC12413086'),
(54, 0, 'DANIELLE DA CRUZ SOUSA', 'EAD - PEDAGOGIA', 'UC14416814'),
(55, 0, 'EDILENE SILVA DE SOUSA', 'EAD - PEDAGOGIA', 'UC12413195'),
(56, 0, 'VANESSA ALVES MORAIS SOUZA', 'EAD - PEDAGOGIA', 'UC12413002'),
(57, 0, 'BARBARA DOS SANTOS VALE', 'EAD - PEDAGOGIA', '02010080173'),
(76, 0, 'PAULO HENRIQUE ROCHA', 'EAD - ADMINISTRAÇÃO', 'UC12412399'),
(59, 0, 'KESIA PRISCILA BOSS CORDEIRO', 'RELAÇÕES INTERNACIONAIS', 'UC16100574'),
(61, 0, 'LUCAS ROCHA DE FREITAS', 'EAD - TURISMO', 'UC10407991'),
(62, 0, 'DANIELA LEAO DA SILVA', 'EAD - TURISMO', 'UC12412335'),
(63, 0, 'IVANEIDE DE ALMEIDA COSTA', 'EAD - GESTAO DE RECURSOS HUMANOS', 'UC11410902'),
(64, 0, 'VIVIANE DA SILVA ROSA', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC14416748'),
(65, 0, 'ELDEVANE SANTOS DA SILVA', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC12412342'),
(66, 0, 'NUBIA RAMOS LOIOLA', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC12412400'),
(67, 0, 'JESSICA BRUNA DANTAS SILVA', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC12413917'),
(68, 0, 'HELENEMARRI RUDE GARCIA LEAO', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC10408523'),
(69, 0, 'FELIPE NERES NASCIMENTO JUNIOR', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC11411690'),
(70, 0, 'MARCOS ANTONIO PEREIRA DOS SANTOS FRANCISCO', 'EAD - GESTAO DE RECURSOS HUMANOS', 'UC126015140'),
(71, 0, 'DANIELE MARQUES LIMA', 'EAD - GESTAO DE RECURSOS HUMANOS', 'UC13414616'),
(72, 0, 'EDUARDO MARTINS PEREIRA VASCO', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC12413856'),
(78, 0, 'EMANUELE TEIXEIRA SATURNINO', 'EAD - ADMINISTRAÇÃO', 'UC12412855'),
(77, 0, 'JOAO PAULO PARKER DE ALENCAR PINTO', 'EAD - ADMINISTRAÇÃO', 'UC14416760'),
(81, 0, 'ALCILEIDE PORTO DE SOUZA', 'EAD - ADMINISTRAÇÃO', 'UC12413411'),
(80, 0, 'VALERIA FERNANDES GOMES', 'EAD - ADMINISTRAÇÃO', 'UC14417538'),
(82, 0, 'LUIZ GUSTAVO DE ABREU MARQUES', 'EAD - ADMINISTRAÇÃO', 'UC14417539'),
(83, 0, 'POLIANA MARQUES ALVES', 'EAD - ADMINISTRAÇÃO', 'UC12412856'),
(84, 0, 'LEIDIANE RIBEIRO DA SILVA COSTA', 'EAD - ADMINISTRAÇÃO', 'UC12412470'),
(85, 0, 'AMANDA NUNES LEMOS', 'EAD - ADMINISTRAÇÃO', 'UC14416606'),
(86, 0, 'FERNANDA EVANGELISTA BRAGA', 'EAD - ADMINISTRAÇÃO', 'UC12412348'),
(87, 0, 'RONILSON MENDES DE OLIVEIRA', 'EAD - ADMINISTRAÇÃO', 'UC11411682'),
(88, 0, 'DANIELLE APARECIDA GOMES PEREIRA CIRIA', 'EAD - ADMINISTRAÇÃO', 'UC08029697'),
(89, 0, 'IANA LEITE MARTINS', 'EAD - ADMINISTRAÇÃO', 'UC12412469'),
(90, 0, 'FABRICIO NOLETO CASTRO', 'EAD - ADMINISTRAÇÃO', 'UC114118867'),
(91, 0, 'SANDY SAMIRA SOUTO', 'EAD - ADMINISTRAÇÃO', 'UC12413837'),
(92, 0, 'MARINA PACHECO LOPES DE MENEZES', 'EAD - ADMINISTRAÇÃO', '03058224117'),
(93, 0, 'ALINE FONSECA MENESES', 'EAD - ADMINISTRAÇÃO', 'UC11411656'),
(94, 0, 'ALINE DA SILVA SANTOS', 'EAD - ADMINISTRAÇÃO', 'UC11411661'),
(95, 0, 'THAMARA DE SOUSA NUNES', 'EAD - ADMINISTRAÇÃO', 'UC12413927'),
(96, 0, 'FABIANE TAINARY CARNEIRO DE MACEDO', 'EAD - ADMINISTRAÇÃO', 'UC14416923'),
(97, 0, 'ALAN TAVARES AVELINO', 'EAD - ADMINISTRAÇÃO', 'UC13414565'),
(98, 0, 'STANLEY RODRIGUES SILVA', 'EAD - ADMINISTRAÇÃO', 'UC14417540'),
(99, 0, 'ADELCI DE SOUZA NEIVA', 'EAD - ADMINISTRAÇÃO', 'UC14417985'),
(100, 0, 'LUCAS SANTANA GUIMARAES', 'EAD - ADMINISTRAÇÃO', 'UC13414524'),
(101, 0, 'MICHAEL DE SOUSA ANSELMO FERREIRA', 'EAD - ADMINISTRAÇÃO', '03458289178'),
(102, 0, 'GLORIA MARIA CORDEIRO DA SILVA', 'EAD - ADMINISTRAÇÃO', 'UC12413173'),
(105, 0, 'RODRIGO DE AGUIAR FONSECA', 'EAD - ADMINISTRAÇÃO', 'UC15400149'),
(104, 0, 'MARCOS ANTONIO DA SILVA FERREIRA', 'EAD - ADMINISTRAÇÃO', 'UC15400377'),
(106, 0, 'LOHANA ALVES GREGORIM', 'EAD - ADMINISTRAÇÃO', 'UC12413176'),
(107, 0, 'DAIANE PEREIRA ABADE', 'EAD - ADMINISTRAÇÃO', 'UC12413832'),
(108, 0, 'ROSALY ANTONIO MACEDO DOS SANTOS', 'EAD - ADMINISTRAÇÃO', '02989752625'),
(109, 0, 'MONICA CARNEIRO DA COSTA', 'EAD - GESTÃO DE RECURSOS HUMANOS', 'UC15400226'),
(111, 0, 'DEISIANE DA COSTA ALVES', 'EAD - GESTÃO DA TECNOLOGIA DA INFORMAÇÃO', 'UC13414507'),
(112, 0, 'RENATA DANUSA DANTAS COSTA', 'EAD - ANÁLISE E DESENV. DE SISTEMAS', 'UC08091473'),
(113, 0, 'VICTOR HUGO MENEZES', 'EAD - GESTÃO DA TECNOLOGIA DA INFORMAÇÃO', 'UC12412420'),
(114, 0, 'EULETE MAGALHAES DE SOUZA', 'EAD - ANÁLISE E DESENV. DE SISTEMAS', '98400088115'),
(115, 0, 'GABRIEL CESAR PEREIRA ALVES', 'EAD - ANÁLISE E DESENV. DE SISTEMAS', 'UC12413822');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_has_perfil`
--

CREATE TABLE IF NOT EXISTS `aluno_has_perfil` (
  `Aluno_idAluno` int(10) unsigned NOT NULL,
  `Perfil_idPerfil` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Aluno_idAluno`,`Perfil_idPerfil`),
  KEY `Aluno_has_Perfil_FKIndex1` (`Aluno_idAluno`),
  KEY `Aluno_has_Perfil_FKIndex2` (`Perfil_idPerfil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_has_vaga`
--

CREATE TABLE IF NOT EXISTS `aluno_has_vaga` (
  `Aluno_idAluno` int(10) unsigned NOT NULL,
  `Vaga_idVaga` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Aluno_idAluno`,`Vaga_idVaga`),
  KEY `Aluno_has_Vaga_FKIndex1` (`Aluno_idAluno`),
  KEY `Aluno_has_Vaga_FKIndex2` (`Vaga_idVaga`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_has_vaga`
--

INSERT INTO `aluno_has_vaga` (`Aluno_idAluno`, `Vaga_idVaga`) VALUES
(2, 5),
(39, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `idEmpresa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Vaga_idVaga` int(10) unsigned DEFAULT NULL,
  `Administrador_idAdministrador` int(10) unsigned DEFAULT NULL,
  `Empresa` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Cnpj` int(10) unsigned DEFAULT NULL,
  `Telefone` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idEmpresa`),
  KEY `Empresa_FKIndex1` (`Administrador_idAdministrador`),
  KEY `Empresa_FKIndex2` (`Vaga_idVaga`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`idEmpresa`, `Vaga_idVaga`, `Administrador_idAdministrador`, `Empresa`, `Cnpj`, `Telefone`) VALUES
(6, NULL, NULL, 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 4294967295, 3701),
(7, NULL, NULL, 'UNIVERSIDADE CATÓLICA DE BRASÍLIA', 123456789, 9076),
(8, NULL, NULL, 'BRASILIA ESTAGIOS', 4294967295, 0),
(9, NULL, NULL, 'Tribunal de Justiça do DF', 4294967295, 0),
(10, NULL, NULL, 'Tribunal de Justiça do DF', 4294967295, 0),
(11, NULL, NULL, 'Ministério das Relações Exterioeres', 4294967295, 0),
(12, NULL, NULL, 'Presidência da Republica', 4294967295, 34113353),
(13, NULL, NULL, 'VH Informática LTDA', 4294967295, 30281281),
(14, NULL, NULL, 'ELY Assunção Contabilidade e Audit. LTDA ME', 4294967295, 32251058),
(15, NULL, NULL, 'Serviço de Limpeza Urbana SLU', 4294967295, 32130146),
(16, NULL, NULL, 'SESC - Serviço Social do Comércio', 0, 34519105),
(17, NULL, NULL, 'BRB - Banco de Brasília', 208000100, 34128087),
(18, NULL, NULL, 'Tribunal Regional Federal', 4294967295, 34103932),
(19, NULL, NULL, 'BB Previdência - Fundo de Pensão Banco do Brasil', 4294967295, 0),
(20, NULL, NULL, 'STAG - Central de Estágios S.S Ltda', 4294967295, 0),
(21, NULL, NULL, 'Super Estágios', 0, 0),
(22, NULL, NULL, 'Empresa Brasil de Comunicação', 4294967295, 0),
(23, NULL, NULL, 'Senado Federal', 4294967295, 33033722),
(24, NULL, NULL, 'SENAC - Serviço Nacional de Aprendizagem Comercia', 4294967295, 33460629),
(25, NULL, NULL, 'ETECON - Contabilidade e Auditoria Ltda', 4294967295, 4294967295),
(26, NULL, NULL, 'Blaise Pascal', 0, 0),
(27, NULL, NULL, 'IEL - Instituto Euvaldo Lodi', 0, 0),
(28, NULL, NULL, 'Park Sul Prime Residence', 4294967295, 0),
(29, NULL, NULL, 'Kawin Sorvetes Ltda', 4294967295, 33574769),
(30, NULL, NULL, 'A Crescer Serviços de Orientação a Empreend. SA', 4294967295, 32464314),
(31, NULL, NULL, 'Municipio de Belo Horizonte', 4294967295, 0),
(32, NULL, NULL, 'Empresa de Planejamento e Logística SA - EPL', 4294967295, 34263881),
(33, NULL, NULL, 'Ministério Público do Distrito Federal e Território', 0, 0),
(34, NULL, NULL, 'Fundação Nacional de Desenvolvimento da Educação', 4294967295, 20224476),
(35, NULL, NULL, 'BRED Estágios', 0, 0),
(36, NULL, NULL, 'NN Assessoria e Consultoria Empresarial', 4294967295, 32232205),
(37, NULL, NULL, 'Defensoria Publica Geral da União - DPGU', 4294967295, 33194325),
(38, NULL, NULL, 'Postalis Inst. Seg. Soc Correiros', 4294967295, 21026966),
(39, NULL, NULL, 'Serviço Nacional de Aprendizagem Industrial - Dep', 4294967295, 33179384),
(40, NULL, NULL, 'Empresa Brasileira de Correios e Telégrafos', 4294967295, 0),
(41, NULL, NULL, 'Fundo Nacional de Desenvolvimento da Educação', 4294967295, 20224476),
(42, NULL, NULL, 'Centro de Ensino Unificado', 4294967295, 37048836),
(43, NULL, NULL, 'Superintendencia Nacional de Previdencia Complemen', 4294967295, 20212066),
(44, NULL, NULL, 'Caixa Econômica Federal - Brasília Norte', 4294967295, 32037373),
(45, NULL, NULL, 'Fisiotrauma - Clênica de Fisioterapia e Estática', 4294967295, 32451301),
(46, NULL, NULL, 'Banco do Brasil S.A.', 317047, 39625114),
(47, NULL, NULL, 'Conselho Federal de Enfermagem - COFEN', 0, 0),
(48, NULL, NULL, 'AM1 & Carvalho Goumert Eireli ME', 4294967295, 39634670),
(49, NULL, NULL, 'Globo Comunicação e Participações', 4294967295, 33169370),
(50, NULL, NULL, 'GEAP - Autogestão em Saude', 4294967295, 21034740),
(51, NULL, NULL, 'Centro de Reabilitação Fisio Vatale ME', 4294967295, 39320333),
(52, NULL, NULL, 'Agencia Nac. de Transportes Terrestres ANTT', 4294967295, 34101156),
(53, NULL, NULL, 'Caixa Seguradora', 4294967295, 0),
(54, NULL, NULL, 'Empresa de Tecnologia e Info. da Prev. Social DATA', 4294967295, 32627131),
(55, NULL, NULL, 'Universidade de Brasília', 0, 0),
(56, NULL, NULL, 'Agencia Nac. Petroleo Gas Natural e Biocombustível', 4294967295, 0),
(57, NULL, NULL, 'Supremo Tribunal Federal STF', 4294967295, 32173314),
(58, NULL, NULL, 'VALEC Eng. Constr. Ferrovias', 4294967295, 20296321),
(59, NULL, NULL, 'Instituto Presbiteriano Mackenzie', 4294967295, 0),
(60, NULL, NULL, 'Tribunal de Contas da União - TCU', 4294967295, 33167115),
(61, NULL, NULL, 'Resolução Apoio Escolar e Psicopedagogigo', 4294967295, 33446041),
(62, NULL, NULL, 'USBEE - Colégio Marista', 4294967295, 34264600),
(63, NULL, NULL, 'Prefeitura Municipal de Valparaíso', 4294967295, 0),
(64, NULL, NULL, 'Super Kids Assistência Pedagógica', 4294967295, 33496679),
(65, NULL, NULL, 'Instituto de Educação Avancada', 4294967295, 39614358),
(66, NULL, NULL, 'Escola das Nações Centro de Educação e Cultura', 4294967295, 3361800),
(67, NULL, NULL, 'Vasco Neto Sport Ltda', 4294967295, 30371890),
(68, NULL, NULL, 'Escola de Educação Infantil Bem me Quer', 4294967295, 37979320),
(69, NULL, NULL, 'Sociedade Porvir Cientifico', 4294967295, 35521494),
(70, NULL, NULL, 'Instituto Fecomércio - IF', 0, 0),
(71, NULL, NULL, 'Agencia Nacional de Vigilância Sanitária - Anvis', 4294967295, 0),
(72, NULL, NULL, 'Módulo Security Solutions S.A.', 4294967295, 32187515),
(73, NULL, NULL, 'Instituto de Pesquisa Eldorado', 4294967295, 32463509),
(74, NULL, NULL, 'Confederação Nacional das Coop. dos Sicoob Ltda', 4294967295, 32185164),
(75, NULL, NULL, 'Ministério da Justiça', 4294967295, 20253207),
(77, NULL, NULL, 'Procuradoria Regional da República 1º Região', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `encaminhamento`
--

CREATE TABLE IF NOT EXISTS `encaminhamento` (
  `Inicio` date NOT NULL,
  `Fim` date NOT NULL,
  `Recisao` date DEFAULT NULL,
  `Relatorio` varchar(50) DEFAULT NULL,
  `Entregue` varchar(50) DEFAULT NULL,
  `idEncaminhamento` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idVaga_Encaminhamento` int(50) NOT NULL,
  `idAluno_Encaminhamento` int(254) NOT NULL,
  PRIMARY KEY (`idEncaminhamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=269 ;

--
-- Extraindo dados da tabela `encaminhamento`
--

INSERT INTO `encaminhamento` (`Inicio`, `Fim`, `Recisao`, `Relatorio`, `Entregue`, `idEncaminhamento`, `idVaga_Encaminhamento`, `idAluno_Encaminhamento`) VALUES
('2014-08-11', '2016-08-10', NULL, '', 'Nao', 121, 73, 68),
('2016-06-21', '2016-06-21', NULL, '6', 'Sim', 120, 72, 69),
('2016-06-21', '2016-06-21', NULL, '5', 'Sim', 119, 72, 69),
('2013-12-10', '2015-12-09', NULL, '', 'Nao', 118, 72, 69),
('2016-06-21', '2016-06-21', NULL, '2', 'Sim', 117, 69, 64),
('2015-10-02', '2016-03-01', NULL, '', 'Sim', 116, 70, 66),
('2014-09-01', '2015-02-28', NULL, '', 'Sim', 115, 69, 64),
('2016-06-21', '2016-06-21', NULL, '2', 'Sim', 114, 68, 64),
('2016-06-21', '2016-06-21', NULL, '1', 'Sim', 113, 68, 64),
('2015-05-11', '2016-11-10', NULL, '', 'Sim', 112, 68, 64),
('2015-05-11', '2015-11-10', NULL, '', 'Sim', 111, 68, 64),
('2014-01-22', '2015-12-21', NULL, '', 'Sim', 110, 67, 65),
('2016-06-21', '2016-06-21', NULL, '1', 'Sim', 109, 66, 62),
('2014-02-24', '2014-12-18', NULL, '', 'Nao', 108, 66, 62),
('2014-09-17', '2014-12-31', NULL, '', 'Sim', 107, 65, 71),
('2013-03-18', '2014-09-17', NULL, '', 'Nao', 106, 65, 71),
('2016-06-20', '2017-06-20', NULL, '', 'Sim', 105, 64, 75),
('2014-02-12', '2014-08-11', NULL, '', 'Sim', 104, 62, 70),
('2014-03-10', '2014-09-09', NULL, '', 'Sim', 103, 61, 63),
('2014-10-07', '2015-04-06', NULL, '', 'Sim', 102, 34, 61),
('2016-06-21', '2016-12-20', NULL, '', 'Nao', 101, 58, 60),
('2016-06-21', '2016-06-21', NULL, '', NULL, 99, 60, 60),
('2016-08-10', '2016-08-10', NULL, '', 'Sim', 122, 73, 68),
('2015-02-01', '2015-09-01', NULL, '', 'Nao', 123, 69, 64),
('2015-09-01', '2016-03-31', NULL, '', 'Sim', 124, 69, 64),
('2016-06-21', '2016-06-21', NULL, '1', 'Sim', 125, 69, 64),
('2016-06-21', '2016-06-21', NULL, '2', 'Sim', 126, 73, 68),
('2013-12-09', '2014-06-08', NULL, '', 'Nao', 127, 74, 67),
('2014-06-08', '2014-12-08', NULL, '', 'Sim', 128, 74, 67),
('2014-04-14', '2014-10-13', NULL, '', 'Nao', 129, 75, 66),
('2014-10-13', '2014-10-13', NULL, '', 'Sim', 130, 75, 66),
('2016-06-21', '2016-06-21', NULL, '', 'Sim', 131, 67, 65),
('2015-02-02', '2015-08-01', NULL, '', 'Sim', 132, 78, 96),
('2015-01-23', '2015-06-22', NULL, '', 'Sim', 133, 83, 102),
('2015-06-22', '2015-12-22', NULL, '', 'Sim', 134, 83, 102),
('2015-12-22', '2016-06-22', NULL, '', 'Sim', 135, 83, 102),
('2016-06-22', '2016-06-22', NULL, '1', 'Sim', 136, 83, 102),
('2016-06-22', '2016-06-22', NULL, '2', 'Sim', 137, 83, 102),
('2015-10-01', '2016-03-31', NULL, '', 'Sim', 138, 86, 105),
('2016-03-31', '2016-09-30', NULL, '', 'Sim', 139, 86, 105),
('2016-06-22', '2016-06-22', NULL, '1', 'Sim', 140, 86, 105),
('2014-02-27', '2016-02-27', NULL, '', 'Sim', 141, 88, 108),
('2016-03-07', '2016-06-30', NULL, '', 'Sim', 142, 89, 78),
('2015-10-13', '2016-04-14', NULL, '', 'Sim', 143, 90, 106),
('2016-04-14', '2016-10-13', NULL, '', 'Sim', 144, 90, 106),
('2016-06-22', '2016-06-22', NULL, '1', 'Sim', 145, 90, 106),
('2016-03-08', '2016-09-08', NULL, '', 'Sim', 146, 91, 76),
('2014-08-18', '2015-08-18', NULL, '', 'Sim', 147, 93, 84),
('2016-06-22', '2016-06-22', NULL, '5', 'Sim', 148, 93, 84),
('2016-06-22', '2016-06-22', NULL, '6', 'Sim', 149, 93, 84),
('2016-06-22', '2016-06-22', NULL, '1', 'Sim', 150, 93, 84),
('2016-06-22', '2016-06-22', NULL, '2', 'Sim', 151, 93, 84),
('2016-06-22', '2016-06-22', NULL, '3', 'Sim', 152, 93, 84),
('2015-08-18', '2016-08-18', NULL, '', 'Nao', 153, 93, 84),
('2015-11-25', '2016-05-24', NULL, '', 'Sim', 154, 94, 107),
('2015-03-11', '2015-09-10', NULL, '', 'Nao', 157, 96, 81),
('2015-09-10', '2016-03-10', NULL, '', 'Sim', 159, 96, 81),
('2016-03-10', '2016-06-30', NULL, '', 'Sim', 160, 96, 81),
('2016-06-23', '2016-06-23', NULL, '2', 'Sim', 161, 96, 81),
('2014-06-24', '2014-12-23', NULL, '', 'Sim', 162, 97, 88),
('2014-08-04', '2015-02-04', NULL, '', 'Sim', 163, 98, 90),
('2014-07-07', '2015-01-06', NULL, '', 'Sim', 164, 99, 91),
('2014-02-01', '2015-03-31', NULL, '', 'Sim', 165, 100, 92),
('2014-09-19', '2016-09-19', NULL, '', 'Sim', 166, 101, 87),
('2014-04-22', '2014-10-21', NULL, '', 'Sim', 167, 102, 95),
('2014-09-01', '2015-03-01', NULL, '', 'Sim', 168, 103, 96),
('2014-09-15', '2016-09-14', NULL, '', 'Sim', 169, 104, 98),
('2014-12-06', '2015-06-05', NULL, '', 'Sim', 170, 105, 99),
('2013-04-08', '2014-12-31', NULL, '', 'Sim', 171, 107, 100),
('2014-12-01', '2015-05-30', NULL, '', 'Sim', 172, 108, 89),
('2015-08-17', '2017-08-16', NULL, '', 'Sim', 173, 109, 104),
('2016-06-23', '2016-06-23', NULL, '5', 'Sim', 174, 101, 87),
('2014-02-11', '2014-08-11', NULL, '', 'Nao', 175, 110, 101),
('2014-08-11', '2015-02-10', NULL, '', 'Sim', 176, 110, 101),
('2015-02-11', '2015-08-10', NULL, '', 'Sim', 177, 110, 101),
('2016-06-23', '2016-06-23', NULL, '5', 'Sim', 178, 103, 96),
('2016-06-13', '2016-12-13', NULL, '', 'Sim', 179, 111, 76),
('2014-06-02', '2014-12-01', NULL, '', 'Nao', 180, 112, 86),
('2014-12-01', '2015-06-01', NULL, '', 'Sim', 182, 112, 86),
('2014-06-01', '2015-12-01', NULL, '', 'Sim', 183, 112, 86),
('2015-12-01', '2016-05-31', NULL, '', 'Sim', 184, 113, 80),
('2014-09-12', '2015-03-11', NULL, '', 'Nao', 185, 114, 85),
('2015-03-11', '2015-09-11', NULL, '', 'Sim', 186, 114, 85),
('2016-06-23', '2016-06-23', NULL, '1', 'Sim', 187, 114, 85),
('2013-08-15', '2014-02-14', NULL, '', 'Nao', 188, 115, 97),
('2014-02-14', '2014-08-14', NULL, '', 'Nao', 189, 115, 97),
('2014-08-14', '2015-02-14', NULL, '', 'Sim', 190, 115, 97),
('2014-03-14', '2014-09-14', NULL, '', 'Nao', 191, 116, 94),
('2014-09-14', '2015-09-13', NULL, '', 'Sim', 192, 116, 94),
('2013-04-03', '2013-10-02', NULL, '', 'Nao', 193, 117, 93),
('2014-04-02', '2014-10-02', NULL, '', 'Nao', 198, 117, 93),
('2013-10-02', '2014-04-02', NULL, '', 'Nao', 197, 117, 93),
('2014-10-02', '2015-04-02', NULL, '', 'Sim', 199, 117, 93),
('2014-02-10', '2014-08-10', NULL, '', 'Nao', 200, 118, 89),
('2014-08-10', '2015-02-10', NULL, '1', 'Sim', 201, 118, 89),
('2016-06-23', '2016-06-23', NULL, '6', 'Sim', 202, 101, 87),
('2015-04-06', '2016-04-05', NULL, '', 'Nao', 203, 119, 82),
('2016-04-05', '2016-10-05', NULL, '', 'Sim', 204, 119, 82),
('2016-06-23', '2016-06-23', NULL, '1', 'Sim', 205, 119, 82),
('2016-06-23', '2016-06-23', NULL, '1', 'Sim', 206, 96, 81),
('2014-07-03', '2016-07-03', NULL, '', 'Nao', 208, 120, 83),
('2015-10-05', '2016-04-05', NULL, '', 'Sim', 209, 119, 82),
('2014-10-20', '2015-10-19', NULL, '', 'Nao', 210, 106, 78),
('2015-10-19', '2015-12-31', NULL, '', 'Sim', 211, 106, 78),
('2016-06-23', '2016-06-23', NULL, '1', 'Sim', 212, 106, 78),
('2016-06-23', '2016-06-23', NULL, '2', 'Sim', 213, 106, 78),
('2013-01-21', '2014-08-01', NULL, '', 'Nao', 214, 121, 106),
('2016-06-06', '2016-12-05', NULL, '', 'Sim', 215, 122, 1),
('2015-11-12', '2016-05-11', NULL, '', 'Nao', 216, 123, 42),
('2016-06-27', '2016-06-27', NULL, '1', 'Sim', 217, 123, 42),
('2016-05-11', '2016-06-30', NULL, '', 'Sim', 218, 123, 42),
('2015-08-17', '2016-03-16', NULL, '', 'Sim', 219, 124, 46),
('2016-03-16', '2016-09-16', NULL, '', 'Sim', 220, 124, 46),
('2016-06-27', '2016-06-27', NULL, '1', 'Sim', 221, 124, 46),
('2015-07-20', '2015-10-12', NULL, '', 'Sim', 222, 125, 57),
('2015-11-09', '2016-05-08', NULL, '', 'Sim', 223, 126, 43),
('2016-05-08', '2016-11-08', NULL, '', 'Sim', 224, 126, 43),
('2016-06-27', '2016-06-27', NULL, '1', 'Sim', 225, 126, 43),
('2015-09-01', '2015-12-31', NULL, '', 'Sim', 226, 127, 56),
('2014-02-17', '2014-08-16', NULL, '', 'Sim', 227, 128, 48),
('2013-10-14', '2014-10-13', NULL, '', 'Sim', 228, 129, 55),
('2016-03-14', '2016-12-31', NULL, '', 'Sim', 229, 130, 44),
('2014-08-25', '2015-02-24', NULL, '', 'Sim', 230, 131, 49),
('2014-01-29', '2014-07-28', NULL, '', 'Sim', 231, 132, 53),
('2014-01-24', '2014-07-23', NULL, '', 'Sim', 232, 133, 52),
('2014-08-01', '2015-01-31', NULL, '', 'Sim', 233, 134, 51),
('2015-01-02', '2015-07-02', NULL, '', 'Sim', 234, 135, 50),
('2015-07-02', '2016-01-02', NULL, '', 'Sim', 235, 135, 50),
('2016-01-02', '2016-07-02', NULL, '', 'Sim', 236, 135, 50),
('2016-06-27', '2016-06-27', NULL, '1', 'Sim', 237, 135, 50),
('2016-06-27', '2016-06-27', NULL, '2', 'Sim', 238, 135, 50),
('2014-10-08', '2015-04-07', NULL, '', 'Sim', 239, 136, 49),
('2013-07-16', '2014-01-16', NULL, '', 'Nao', 240, 137, 47),
('2014-01-16', '2014-07-16', NULL, '', 'Sim', 241, 137, 47),
('2014-04-17', '2015-01-17', NULL, '', 'Sim', 243, 137, 47),
('2014-09-15', '2016-09-15', NULL, '', 'Sim', 244, 139, 45),
('2016-06-27', '2016-06-27', NULL, '5', 'Sim', 245, 139, 45),
('2016-06-27', '2016-06-27', NULL, '6', 'Sim', 246, 139, 45),
('2016-06-27', '2016-06-27', NULL, '7', 'Sim', 247, 139, 45),
('2014-08-16', '2015-02-16', NULL, '', 'Sim', 248, 128, 48),
('2015-12-04', '2016-06-03', NULL, '', 'Sim', 249, 140, 109),
('2016-06-03', '2016-12-03', NULL, '', 'Sim', 250, 140, 109),
('2016-06-27', '2016-06-27', NULL, '1', 'Sim', 251, 140, 109),
('2014-05-05', '2014-11-04', NULL, '', 'Sim', 252, 141, 111),
('2014-11-04', '2015-05-04', NULL, '', 'Sim', 253, 141, 111),
('2015-05-04', '2015-06-30', NULL, '', 'Sim', 254, 141, 111),
('2016-06-27', '2016-06-27', NULL, '1', 'Sim', 255, 141, 111),
('2014-03-17', '2014-09-16', NULL, '', 'Nao', 256, 142, 115),
('2014-09-16', '2014-12-31', NULL, '', 'Sim', 257, 142, 115),
('2014-07-01', '2015-01-02', NULL, '', 'Nao', 258, 143, 114),
('2014-01-02', '2015-07-01', NULL, '', 'Sim', 259, 143, 114),
('2014-07-07', '2015-01-06', NULL, '', 'Sim', 260, 144, 113),
('2014-09-04', '2015-03-04', NULL, '', 'Sim', 261, 145, 112),
('2014-03-25', '2014-09-24', NULL, '', 'Nao', 262, 146, 112),
('2014-09-24', '2014-12-31', NULL, '', 'Sim', 263, 146, 112),
('2016-01-25', '2016-07-25', NULL, '', 'Nao', 264, 147, 77),
('2016-06-29', '2016-06-29', NULL, '1', 'Sim', 265, 147, 77);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `idPerfil` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idPerfil`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`idPerfil`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(65),
(66),
(67),
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

CREATE TABLE IF NOT EXISTS `vaga` (
  `idVaga` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Administrador_idAdministrador` int(10) unsigned DEFAULT NULL,
  `Empresa` char(100) DEFAULT NULL,
  `Agente` char(100) DEFAULT NULL,
  `Carga` int(10) unsigned DEFAULT NULL,
  `Bolsa` int(10) unsigned DEFAULT NULL,
  `Recisao` varchar(254) NOT NULL DEFAULT '-',
  `idAluno_Vaga` int(254) NOT NULL,
  PRIMARY KEY (`idVaga`),
  KEY `Vaga_FKIndex1` (`Administrador_idAdministrador`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=149 ;

--
-- Extraindo dados da tabela `vaga`
--

INSERT INTO `vaga` (`idVaga`, `Administrador_idAdministrador`, `Empresa`, `Agente`, `Carga`, `Bolsa`, `Recisao`, `idAluno_Vaga`) VALUES
(58, NULL, 'Presidência da Republica', '', 20, 800, '25/02/2014', 60),
(61, NULL, 'VH Informática LTDA', '', 30, 800, '09/09/2014', 63),
(62, NULL, 'ELY Assunção Contabilidade e Audit. LTDA ME', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 25, 724, '11/08/2014', 70),
(34, NULL, 'Presidência da Republica', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 520, '06/04/2015', 61),
(65, NULL, 'Serviço de Limpeza Urbana SLU', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 0, 0, '31/12/2014', 71),
(66, NULL, '', 'SESC - Serviço Social do Comércio', 20, 0, '18/12/2014', 62),
(67, NULL, 'BRB - Banco de Brasília', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 400, '21/12/2015', 65),
(68, NULL, 'Tribunal Regional Federal', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 20, 900, '-', 64),
(69, NULL, 'BB Previdência - Fundo de Pensão Banco do Brasil', 'STAG - Central de Estágios S.S Ltda', 30, 550, '10/11/2015', 64),
(70, NULL, 'Empresa Brasil de Comunicação', 'Super Estágios', 600, 20, '01/03/2016', 66),
(71, NULL, 'BRB - Banco de Brasília', 'SSuper Estágios', 25, 400, '-', 72),
(72, NULL, 'Senado Federal', '', 20, 0, '09/05/2015', 69),
(73, NULL, 'SENAC - Serviço Nacional de Aprendizagem Comercia', '', 30, 0, '10/08/2015', 68),
(74, NULL, 'ETECON - Contabilidade e Auditoria Ltda', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 0, 0, '08/12/2014', 67),
(75, NULL, 'Empresa Brasil de Comunicação', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 0, 0, '13/04/2015', 66),
(86, NULL, 'A Crescer Serviços de OrientaÃƒÂ§ÃƒÂ£o a Empreend. SA', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 800, '-', 105),
(78, NULL, 'Park Sul Prime Residence', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 700, '2015-08-01', 96),
(83, NULL, 'Kawin Sorvetes Ltda', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 680, '', 102),
(89, NULL, 'Empresa de Planejamento e Logística SA - EPL', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 1100, '-', 78),
(88, NULL, 'Municipio de Belo Horizonte', '', 20, 420, '2016-02-27', 108),
(90, NULL, 'Ministério Público do Distrito Federal e Território', '', 20, 850, '-', 106),
(91, NULL, 'Fundação Nacional de Desenvolvimento da EducaÃƒÂ§Ã¯', 'Brasilia Estágios', 30, 520, '2016-06-13', 76),
(93, NULL, 'Senado Federal', '', 20, 820, '30/06/2016', 84),
(94, NULL, 'NN Assessoria e Consultoria Empresarial', 'BRED Estágios', 30, 600, '2016-05-24', 107),
(96, NULL, 'Defensoria Publica Geral da União - DPGU', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 20, 800, '-', 81),
(97, NULL, 'BRB - Banco de Brasília', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 400, '2014-12-23', 88),
(98, NULL, 'Fundação Nacional de Desenvolvimento da Educação', 'Brasilia Estágios', 30, 520, '2015-02-04', 90),
(99, NULL, 'Postalis Inst. Seg. Soc Correiros', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 800, '2015-01-06', 91),
(100, NULL, 'Serviço Nacional de Aprendizagem Industrial - Dep', 'IEL - Instituto Euvaldo Lodi', 30, 1125, '2015-03-31', 92),
(101, NULL, 'Senado Federal', '', 20, 830, '-', 87),
(102, NULL, 'Empresa Brasileira de Correios e Telégrafos', '', 20, 496, '2014-10-21', 95),
(103, NULL, 'Fundo Nacional de Desenvolvimento da Educação', 'Brasilia Estágios', 30, 520, '2015-03-01', 96),
(104, NULL, 'Centro de Ensino Unificado', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 681, '-', 98),
(105, NULL, 'Superintendencia Nacional de Previdencia Complemen', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 520, '2015-06-05', 99),
(106, NULL, 'Empresa de Planejamento e Logística SA - EPL', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 1000, '2015-12-31', 78),
(107, NULL, 'Caixa Econômica Federal - Brasília Norte', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 25, 581, '2014-12-31', 100),
(108, NULL, 'Fisiotrauma - Clínica de Fisioterapia e EstÃƒÂ©tica', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 25, 700, '2015-05-30', 89),
(109, NULL, 'Banco do Brasil S.A.', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 25, 570, '-', 104),
(110, NULL, 'Conselho Federal de Enfermagem - COFEN', 'IEL - Instituto Euvaldo Lodi', 0, 0, '2015-08-10', 101),
(111, NULL, 'AM1 & Carvalho Goumert Eireli ME', 'Brasilia Estágios', 30, 60, '-', 76),
(112, NULL, 'Globo Comunicação e Participações', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 0, '2015-12-01', 86),
(113, NULL, 'GEAP - Autogestão em Saude', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 20, 520, '2016-05-31', 80),
(114, NULL, 'Centro de Reabilitação Fisio Vatale ME', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 0, '2015-06-12', 85),
(115, NULL, 'Agencia Nac. de Transportes Terrestres ANTT', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 0, '2015-02-14', 97),
(116, NULL, 'Caixa Seguradora', 'STAG - Central de EstÃƒÂ¡gios S.S Ltda', 30, 1000, '2015-09-13', 94),
(117, NULL, 'Empresa de Tecnologia e Info. da Prev. Social DATA', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 0, '2015-04-02', 93),
(118, NULL, 'Universidade de Brasília', '', 30, 0, '2015-02-10', 89),
(119, NULL, 'Agencia Nac. Petroleo Gas Natural e Biocombustível', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 0, '-', 82),
(120, NULL, 'Senado Federal', '', 30, 0, '2014-12-03', 83),
(121, NULL, 'Universidade de Brasília', '', 30, 0, '2014-08-01', 106),
(122, NULL, 'Supremo Tribunal Federal STF', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 20, 976, '-', 1),
(123, NULL, 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 0, '', 42),
(124, NULL, 'VALEC Eng. Constr. Ferrovias', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 782, '-', 46),
(125, NULL, 'Instituto Presbiteriano Mackenzie', 'Super Estágios', 30, 850, '2015-10-12', 57),
(126, NULL, 'Tribunal de Contas da União - TCU', 'Centro de Ensino Unificado', 20, 997, '-', 43),
(127, NULL, 'Resolução Apoio Escolar e Psicopedagogigo', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 27, 530, '2015-12-31', 56),
(128, NULL, 'USBEE - Colégio Marista', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 510, '2014-08-16', 48),
(129, NULL, 'Prefeitura Municipal de Valparaíso', 'IEL - Instituto Euvaldo Lodi', 30, 542, '2014-10-13', 55),
(130, NULL, 'Prefeitura Municipal de Valparaíso', 'IEL - Instituto Euvaldo Lodi', 30, 542, '-', 44),
(131, NULL, 'Resolução Apoio Escolar e Psicopedagogigo', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 27, 530, '2015-02-24', 49),
(132, NULL, 'Super Kids Assistência Pedagógica', 'Brasilia Estágios', 30, 724, '2014-07-28', 53),
(133, NULL, 'Instituto de Educação Avancada', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 809, '2014-07-23', 52),
(134, NULL, 'Escola das Nações Centro de Educação e Cultura', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 1200, '2015-01-31', 51),
(135, NULL, 'Vasco Neto Sport Ltda', 'Brasilia Estágios', 25, 700, '-', 50),
(136, NULL, 'Escola de Educação Infantil Bem me Quer', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 600, '2015-04-07', 49),
(137, NULL, 'Sociedade Porvir Cientifico', 'Instituto Fecomércio - IF', 30, 0, '2015-01-17', 47),
(139, NULL, 'Senado Federal', '', 20, 830, '30/06/2016', 45),
(140, NULL, 'Agencia Nacional de Vigilância Sanitária - Anvisa', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 520, '-', 109),
(141, NULL, 'Módulo Security Solutions S.A.', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 1100, '2015-06-30', 111),
(142, NULL, 'Instituto de Pesquisa Eldorado', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 0, '2014-12-31', 115),
(143, NULL, 'Ministério Público do Distrito Federal e Território', '', 20, 800, '2015-07-01', 114),
(144, NULL, 'Confederação Nacional das Coop. dos Sicoob Ltda', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 30, 1412, '2015-01-06', 113),
(145, NULL, 'Ministério da Justiça', 'Brasilia Estágios', 30, 520, '2015-03-04', 112),
(146, NULL, 'Ministério da Justiça', 'CIEE - CENTRO DE INTEGRAÇÃO ESCOLA EMPRESA', 20, 0, '2014-09-04', 112),
(147, NULL, 'Procuradoria Regional da República 1ª Região', '', 20, 800, '14/06/2016', 77);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
