-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29-Nov-2016 às 21:22
-- Versão do servidor: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fabrica`
--
--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sobrenome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CPF` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Senha` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nivel` int(3) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Nome`, `Sobrenome`, `Email`, `Telefone`, `CPF`, `Senha`, `Nivel`) VALUES
(1, 'Romário', 'Macedo', 'romario@ucb.br', '82261418', '05712387506', '91726418', 1);
--
-- Database: `projem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agente`
--

CREATE TABLE IF NOT EXISTS `agente` (
  `idAgente` int(254) NOT NULL AUTO_INCREMENT,
  `Agente` varchar(254) NOT NULL,
  `Cnpj` varchar(50) NOT NULL,
  `Telefone` varchar(50) NOT NULL,
  `Endereco` varchar(100) NOT NULL,
  `Responsavel` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`idAgente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `agente`
--

INSERT INTO `agente` (`idAgente`, `Agente`, `Cnpj`, `Telefone`, `Endereco`, `Responsavel`, `Email`) VALUES
(7, 'STAG CENTRAL DE ESTÃGIOS S.S LTDA', '00.000.000/0000-00', '(61)33569076', 'Qs', '', ''),
(6, 'CIEE - CENTRO DE INTEGRAÃ‡ÃƒO EMPRESA ESCOLA', '00.000.000/0000-01', '(00)00000000', 'Qs', 'Lucas Carvalho', 'romario@ucb.br'),
(10, 'INSTITUTO BLAISE PASCAL', '00.000.000/0000-00', '(00)00000000', 'Qs', '', ''),
(11, 'BRASÃLIA PLANEJAMENTO EM RECURSOS HUMANOS', '00.000.000/0000-00', '(61)33569076', 'qs 11 conj k', '', ''),
(12, 'IEL', '00.366.849/0001-83', '(61)34030887', 'Sia Trecho 03', 'N/C', 'iel@iel'),
(13, 'IEGE', '12.345.678/9101-21', '(61)33569076', 'qs 11', 'RomÃ¡rio', 'romario@ucb.br');

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
  `Modalidade` varchar(50) NOT NULL,
  `Telefone` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Cpf` varchar(50) NOT NULL,
  PRIMARY KEY (`idAluno`),
  KEY `Usuario_FKIndex1` (`Administrador_idAdministrador`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=154 ;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idAluno`, `Administrador_idAdministrador`, `Nome`, `Curso`, `Matricula`, `Modalidade`, `Telefone`, `Email`, `Cpf`) VALUES
(52, 0, 'WANESSA PEREIRA ROCHA', 'EAD - PEDAGOGIA', 'UC13415486', '', '(61)82261418', 'romario@ucb', '057.123.875-06'),
(51, 0, 'REINALDO ARAUJO GREGOLDO', 'EAD - PEDAGOGIA', 'UC12413294', '', '(61)98765432', 'reginaldo@reginaldo.com', '012.345.678-91'),
(50, 0, 'REJANE MARIA DA COSTA', 'EAD - PEDAGOGIA', 'UC12413846', '', '', '', ''),
(49, 0, 'PATRICIA CRISTINA ROLO PARREIRA', 'EAD - PEDAGOGIA', 'UC14417552', '', '(61)33569076', 'aluno@ucb.br', '000.000.000-00'),
(48, 0, 'VALDILEINA FARIA MARINHO DE CASTRO', 'EAD - PEDAGOGIA', 'UC12412859', '', '', '', ''),
(47, 0, 'IZABEL CRISTINE DOS REIS DE SANTANA', 'EAD - PEDAGOGIA', 'UC11410179', '', '', '', ''),
(46, 0, 'ANA PAULA DO NASCIMENTO SABINO TEIXEIRA', 'EAD - PEDAGOGIA', 'UC13414573', '', '', '', ''),
(45, 0, 'MADLEINE ESTEFANE ARAUJO SAMPAIO', 'EAD - PEDAGOGIA', 'UC12412381', '', '', '', ''),
(44, 0, 'VITORIA DA SILVA COSTA', 'EAD - PEDAGOGIA', 'UC13101731', '', '', '', ''),
(43, 0, 'ALEXANDRA ARAUJO', 'EAD - PEDAGOGIA', 'UC14417746', '', '', '', ''),
(42, 0, 'JULIANA EPIFANIO DE ARAUJO OLIVEIRA', 'EAD - PEDAGOGIA', 'UC11409376', '', '', '', ''),
(1, 0, 'LIVIA GONCALVES LIMA DE OLIVEIRA', 'EAD - PEDAGOGIA', 'UC16400286', '', '', '', ''),
(53, 0, 'JOYCE MARIA PINHEIRO TEIXEIRA', 'EAD - PEDAGOGIA', 'UC12413086', '', '', '', ''),
(54, 0, 'DANIELLE DA CRUZ SOUSA', 'EAD - PEDAGOGIA', 'UC14416814', '', '', '', ''),
(55, 0, 'EDILENE SILVA DE SOUSA', 'EAD - PEDAGOGIA', 'UC12413195', '', '', '', ''),
(56, 0, 'VANESSA ALVES MORAIS SOUZA', 'EAD - PEDAGOGIA', 'UC12413002', '', '', '', ''),
(57, 0, 'BARBARA DOS SANTOS VALE', 'EAD - PEDAGOGIA', '02010080173', '', '', '', ''),
(76, 0, 'PAULO HENRIQUE ROCHA', 'EAD - ADMINISTRAÇÃO', 'UC12412399', '', '', '', ''),
(59, 0, 'KESIA PRISCILA BOSS CORDEIRO', 'RELAÇÕES INTERNACIONAIS', 'UC16100574', '', '', '', ''),
(61, 0, 'LUCAS ROCHA DE FREITAS', 'EAD - TURISMO', 'UC10407991', '', '', '', ''),
(62, 0, 'DANIELA LEAO DA SILVA', 'EAD - TURISMO', 'UC12412335', '', '', '', ''),
(63, 0, 'IVANEIDE DE ALMEIDA COSTA', 'EAD - GESTAO DE RECURSOS HUMANOS', 'UC11410902', '', '', '', ''),
(64, 0, 'VIVIANE DA SILVA ROSA', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC14416748', '', '', '', ''),
(65, 0, 'ELDEVANE SANTOS DA SILVA', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC12412342', '', '', '', ''),
(66, 0, 'NUBIA RAMOS LOIOLA', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC12412400', '', '', '', ''),
(67, 0, 'JESSICA BRUNA DANTAS SILVA', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC12413917', '', '', '', ''),
(68, 0, 'HELENEMARRI RUDE GARCIA LEAO', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC10408523', '', '', '', ''),
(69, 0, 'FELIPE NERES NASCIMENTO JUNIOR', 'EAD - CIÊNCIAS CONTÁBEIS', 'UC11411690', '', '', '', ''),
(70, 0, 'MARCOS ANTONIO PEREIRA DOS SANTOS FRANCISCO', 'EAD - GESTAO DE RECURSOS HUMANOS', 'UC126015140', '', '', '', ''),
(71, 0, 'DANIELE MARQUES LIMA', 'EAD - GESTAO DE RECURSOS HUMANOS', 'UC13414616', '', '', '', ''),
(72, 0, 'EDUARDO MARTINS PEREIRA VASCO', 'EAD - CIÃŠNCIAS CONTÃBEIS', 'UC12413856', '', '', '', ''),
(78, 0, 'EMANUELE TEIXEIRA SATURNINO', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12412855', '', '', '', ''),
(77, 0, 'JOÃƒO PAULO PARKER DE ALENCAR PINTO', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC14416760', '', '', '', ''),
(81, 0, 'ALCILEIDE PORTO DE SOUZA', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12413411', '', '', '', ''),
(80, 0, 'VALERIA FERNANDES GOMES', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC14417538', '', '', '', ''),
(82, 0, 'LUIZ GUSTAVO DE ABREU MARQUES', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC14417539', '', '', '', ''),
(83, 0, 'POLIANA MARQUES ALVES', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12412856', '', '', '', ''),
(84, 0, 'LEIDIANE RIBEIRO DA SILVA COSTA', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12412470', '', '', '', ''),
(85, 0, 'AMANDA NUNES LEMOS', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC14416606', '', '', '', ''),
(86, 0, 'FERNANDA EVANGELISTA BRAGA', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12412348', '', '', '', ''),
(87, 0, 'RONILSON MENDES DE OLIVEIRA', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC11411682', '', '', '', ''),
(88, 0, 'DANIELLE APARECIDA GOMES PEREIRA CIRIA', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC08029697', '', '', '', ''),
(89, 0, 'IANA LEITE MARTINS', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12412469', '', '', '', ''),
(90, 0, 'FABRICIO NOLETO CASTRO', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC114118867', '', '', '', ''),
(91, 0, 'SANDY SAMIRA SOUTO', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12413837', '', '', '', ''),
(92, 0, 'MARINA PACHECO LOPES DE MENEZES', 'EAD - ADMINISTRAÃ‡ÃƒO', '03058224117', '', '', '', ''),
(93, 0, 'ALINE FONSECA MENESES', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC11411656', '', '', '', ''),
(94, 0, 'ALINE DA SILVA SANTOS', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC11411661', '', '', '', ''),
(95, 0, 'THAMARA DE SOUSA NUNES', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12413927', '', '', '', ''),
(96, 0, 'FABIANE TAINARY CARNEIRO DE MACEDO', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC14416923', '', '', '', ''),
(97, 0, 'ALAN TAVARES AVELINO', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC13414565', '', '', '', ''),
(98, 0, 'STANLEY RODRIGUES SILVA', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC14417540', '', '', '', ''),
(99, 0, 'ADELCI DE SOUZA NEIVA', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC14417985', '', '', '', ''),
(100, 0, 'LUCAS SANTANA GUIMARÃƒES', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC13414524', '', '', '', ''),
(101, 0, 'MICHAEL DE SOUSA ANSELMO FERREIRA', 'EAD - ADMINISTRAÃ‡ÃƒO', '03458289178', '', '', '', ''),
(102, 0, 'GLORIA MARIA CORDEIRO DA SILVA', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12413173', '', '', '', ''),
(105, 0, 'RODRIGO DE AGUIAR FONSECA', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC15400149', '', '', '', ''),
(104, 0, 'MARCOS ANTONIO DA SILVA FERREIRA', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC15400377', '', '', '', ''),
(106, 0, 'LOHANA ALVES GREGORIM', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12413176', '', '', '', ''),
(107, 0, 'DAIANE PEREIRA ABADE', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC12413832', '', '', '', ''),
(108, 0, 'ROSALY ANTONIO MACEDO DOS SANTOS', 'EAD - ADMINISTRAÃ‡ÃƒO', '02989752625', '', '', '', ''),
(109, 0, 'MONICA CARNEIRO DA COSTA', 'EAD - TECNOLOGIA EM GESTÃƒO DE RECURSOS HUMANOS', 'UC15400226', '', '', '', ''),
(151, 0, 'ROMARIO MACEDO PORTELA', 'ARQUITETURA E URBANISMO', 'uc14200979', 'Presencial', '', '', ''),
(112, 0, 'RENATA DANUSA DANTAS COSTA', 'EAD - ANÃLISE E DESENV. DE SISTEMAS', 'UC08091473', '', '', '', ''),
(113, 0, 'VICTOR HUGO MENEZES', 'EAD - GESTÃƒO DA TECNOLOGIA DA INFORMAÃ‡ÃƒO', 'UC12412420', '', '', '', ''),
(114, 0, 'EULETE MAGALHÃƒES DE SOUZA', 'EAD - ANÃLISE E DESENV. DE SISTEMAS', '98400088115', '', '', '', ''),
(115, 0, 'GABRIEL CESAR PEREIRA ALVES', 'EAD - ANÃLISE E DESENV. DE SISTEMAS', 'UC12413822', '', '', '', ''),
(152, 0, 'ROMARIO MACEDO PORTELA', 'CST - ANÃLISE E DESENV. DE SISTEMAS', 'uc14200979', 'Presencial', '', '', ''),
(126, 0, 'RENATA DANUSA DANTAS COSTA', 'EAD - PEDAGOGIA', 'UC13414507', '', '', '', ''),
(127, 0, 'DEISIANE DA COSTA ALVES', 'EAD - ADMINISTRAÃ‡ÃƒO', 'UC13414507', '', '', '', '');

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
-- Estrutura da tabela `alunopresencial`
--

CREATE TABLE IF NOT EXISTS `alunopresencial` (
  `idAluno` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Administrador_idAdministrador` int(10) unsigned DEFAULT NULL,
  `Nome` char(50) CHARACTER SET utf8 DEFAULT NULL,
  `Curso` char(50) CHARACTER SET utf8 DEFAULT NULL,
  `Matricula` char(12) CHARACTER SET utf8 DEFAULT NULL,
  `Modalidade` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefone` varchar(50) NOT NULL,
  `Cpf` varchar(50) NOT NULL,
  PRIMARY KEY (`idAluno`),
  KEY `Usuario_FKIndex1` (`Administrador_idAdministrador`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Extraindo dados da tabela `alunopresencial`
--

INSERT INTO `alunopresencial` (`idAluno`, `Administrador_idAdministrador`, `Nome`, `Curso`, `Matricula`, `Modalidade`, `Email`, `Telefone`, `Cpf`) VALUES
(152, 0, 'ROMARIO MACEDO PORTELA', 'CST - ANÃLISE E DESENV. DE SISTEMAS', 'UC14200979', 'Presencial', 'romario@ucb.br', '(61)82261419', '057.123.875-06'),
(156, 0, 'Wagner Alves Soares', 'CST - ANÃLISE E DESENV. DE SISTEMAS', 'uc14200978', 'Presencial', 'wasoares@ucb.br', '(61)82261418', '057.123.875-06'),
(157, 0, 'KERLEN SILVA RABELO', 'DIREITO', 'UC16200585', 'Presencial', 'aluno@ucb.br', '(61)92254455', '012.345.678-91'),
(158, 0, 'LORENA OLIVEIRA DRUMOND', 'ARQUITETURA E URBANISMO', 'UC14100812', 'Presencial', 'sem@email', '(61)33996240', '047.148.511-01'),
(159, 0, 'Marcos Teixeira Rodrigues', 'ADMINISTRAÃ‡ÃƒO', '04081289', 'Presencial', 'mteixeira@ucb.br', '(61)33569076', '012.345.678-91');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados`
--

CREATE TABLE IF NOT EXISTS `dados` (
  `Curso` varchar(50) NOT NULL,
  `Meta` varchar(50) NOT NULL,
  `quantidadeAlunos` varchar(50) NOT NULL,
  `Ano` varchar(50) NOT NULL,
  `idDados` int(11) NOT NULL,
  `idCurso` varchar(50) NOT NULL,
  `Orientador` varchar(50) NOT NULL,
  PRIMARY KEY (`idDados`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dados`
--

INSERT INTO `dados` (`Curso`, `Meta`, `quantidadeAlunos`, `Ano`, `idDados`, `idCurso`, `Orientador`) VALUES
('EAD - PEDAGOGIA', '1', '100', '', 2, 'GV-2', 'nao entendi'),
('EAD - ADMINISTRAÃ‡ÃƒO', '1', '201', '', 1, 'GV-1', ''),
('EAD - GESTAO DE RECURSOS HUMANOS', '1', '50', '', 3, 'GV-3', ''),
('EAD - TURISMO', '1', '200', '', 4, 'GV-4', ''),
('EAD - GESTÃƒO DA TECNOLOGIA DA INFORMAÃ‡ÃƒO', '1', '100', '', 5, 'GV-5', ''),
('EAD - ANÃLISE E DESENV. DE SISTEMAS', '1', '254', '', 6, 'GV-6', ''),
('EAD - CIÃŠNCIAS CONTÃBEIS', '1', '99', '', 7, 'GV-7', ''),
('EAD - CIENCIAS ECONÃ”MICAS', '1', '310', '', 8, 'GV-8', ''),
('EAD - FILOSOFIA', '1', '25', '', 9, 'GV-9', ''),
('EAD - GESTÃƒO PÃšBLICA', '1', '351', '', 10, 'GV-10', ''),
('EAD - GESTÃƒO DO COMÃ‰RCIO EXTERIOR', '1', '120', '', 11, 'GV-11', ''),
('EAD - GESTÃƒO FINANCEIRA', '1', '211', '', 12, 'GV-12', ''),
('EAD - LETRAS PORTUGUÃŠS', '1', '355', '', 13, 'GV-13', ''),
('EAD - PROFORM', '1', '21', '', 14, 'GV-14', ''),
('EAD - SEGURANÃ‡A DA INFORMAÃ‡ÃƒO', '1', '215', '', 15, 'GV-15', ''),
('EAD - SEGURANÃ‡A PÃšBLICA', '1', '25', '', 16, 'GV-16', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dadospresencial`
--

CREATE TABLE IF NOT EXISTS `dadospresencial` (
  `Curso` varchar(50) NOT NULL,
  `Meta` varchar(50) NOT NULL,
  `quantidadeAlunos` varchar(50) NOT NULL,
  `Orientador` varchar(50) NOT NULL,
  `idDados` int(11) NOT NULL AUTO_INCREMENT,
  `idCurso` varchar(50) NOT NULL,
  PRIMARY KEY (`idDados`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `dadospresencial`
--

INSERT INTO `dadospresencial` (`Curso`, `Meta`, `quantidadeAlunos`, `Orientador`, `idDados`, `idCurso`) VALUES
('ADMINISTRAÃ‡ÃƒO', '1', '579', 'GERALDO ALMEIDA SARDINHA', 2, 'GP-2'),
('ARQUITETURA E URBANISMO', '1', '440', 'ALINE ESTEFÃ‚NIA ZIM', 1, 'GP-1'),
('BIOMEDICINA', '1', '185', 'YARA DE FATIMA HAMO', 3, 'GP-3'),
('CIÃŠNCIAS DA COMPUTAÃ‡ÃƒO', '1', '199', 'SEPASTIÃƒO CLETO SPOTTO', 4, 'GP-4'),
('CIÃŠNCIAS BIOLÃ“GICAS', '1', '316', 'MORGANA MARIA ARCANJO BRUNO', 5, 'GP-5'),
('CIÃŠNCIAS CONTÃBEIS', '1', '265', 'LUIZ FERNANDO RODRIGUES', 6, 'GP-6'),
('CIÃŠNCIAS ECONÃ”MICAS', '1', '173', 'CELSON VILA NOVA', 7, 'GP-7'),
('COMUNICAÃ‡ÃƒO SOCIAL', '1', '499', 'LEANDRO DE BESSA OLIVEIRA', 8, 'GP-8'),
('ANÃLISE E DESENV. DE SISTEMAS', '1', '252', 'EDSON FRANCISCO DA FONSECA', 9, 'GP-9'),
('GASTRONOMIA', '1', '123', 'GERALDO ALMEIDA SARDINHA', 10, 'GP-10'),
('GESTÃƒO AMBIENTAL', '1', '24', 'TATYANE SOUZA NUNES RODRIGUES', 11, 'GP-11'),
('GESTÃƒO DA TECNOLOGIA DA INFORMAÃ‡ÃƒO', '1', '88', 'BILMAR ANGELIS DE ALMEIDA FERREIRA', 12, 'GP-12'),
('GESTÃƒO PÃšBLICA', '1', '123', 'GERALDO ALMEIDA SARDINHA', 13, 'GP-13'),
('LOGÃSTICA', '1', '52', 'GERALDO ALMEIDA SARDINHA', 14, 'GP-14'),
('REDES DE COMPUTADORES', '1', '54', 'JOSÃ‰ ADALBERTO FARÃ‡ANHA GUALEVE', 15, 'GP-15'),
('DIREITO', '1', '2217', 'MARCIO JOSÃ‰ DE MIRANDA ALMEIDA', 16, 'GP-16'),
('EDUCAÃ‡ÃƒO FÃSICA', '1', '667', 'MONICA VIEIRA DE SOUZA', 17, 'GP-17'),
('ENFERMAGEM', '1', '223', 'FERNANDA MONTEIRO DE CASTRO FERNANDES', 18, 'GP-18'),
('ENGENHARIA AMBIENTAL', '1', '115', 'TATYANE SOUZA NUNES RODRIGUES', 19, 'GP-19'),
('ENGENHARIA CIVIL', '1', '881', 'GABRIEL JAIMES ZAPATA', 20, 'GP-20'),
('FARMÃCIA', '1', '124', 'LAIS FLAVIA NUNES LEMES', 21, 'GP-21'),
('FÃSICA', '1', '75', 'JOAO PAULO MARTINS DE CASTRO CHAIB', 22, 'GP-22'),
('MATEMÃTICA', '1', '52', 'ADRIANA BARBOSA DE SOUZA', 23, 'GP-23'),
('MEDICINA', '1', '542', 'OSVALDO SAMPAIO NETO', 24, 'GP-24'),
('NUTRIÃ‡ÃƒO', '1', '300', 'MARCUS VINICIUS VASCONCELOS CERQUEIRA', 25, 'GP-25'),
('ODONTOLOGIA', '1', '462', 'LUCIANA FREITAS BEZERRA', 26, 'GP-26'),
('PEDAGOGIA', '1', '250', 'MARIA DA CONCEIÃ‡ÃƒO BATISTA DA SILVA', 27, 'GP-27'),
('PSICOLOGIA', '1', '604', 'ROBERTO MENEZES DE OLIVEIRA', 28, 'GP-28'),
('QUÃMICA', '1', '84', 'MARIA BEATRIZ PEREIRA MANGAS', 29, 'GP-29'),
('RELAÃ‡Ã•ES INTERNACIONAIS', '1', '233', 'FRANCISCO AMILTON WOLLMANN', 30, 'GP-30'),
('SERVIÃ‡O SOCIAL', '1', '15', 'KARINA APARECIDA FIGUEIREDO', 31, 'GP-31'),
('SISTEMAS DE INFORMAÃ‡ÃƒO', '1', '142', 'EDSON FRANCISCO DA FONSECA', 32, 'GP-32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentopresencial`
--

CREATE TABLE IF NOT EXISTS `documentopresencial` (
  `Inicio` varchar(50) NOT NULL,
  `Fim` varchar(50) NOT NULL,
  `Recisao` date DEFAULT NULL,
  `Relatorio` varchar(50) NOT NULL,
  `anoDocumento` varchar(50) NOT NULL,
  `mesDocumento` varchar(50) NOT NULL,
  `Entregue` varchar(50) NOT NULL,
  `idDocumento` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cursoDocumento` int(50) NOT NULL,
  `idVagaDocumento` int(50) NOT NULL,
  `idAlunoDocumento` int(254) NOT NULL,
  PRIMARY KEY (`idDocumento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=453 ;

--
-- Extraindo dados da tabela `documentopresencial`
--

INSERT INTO `documentopresencial` (`Inicio`, `Fim`, `Recisao`, `Relatorio`, `anoDocumento`, `mesDocumento`, `Entregue`, `idDocumento`, `cursoDocumento`, `idVagaDocumento`, `idAlunoDocumento`) VALUES
('24/11/2016', '29/11/2016', NULL, 'TCE', '2016', '11', 'Nao', 449, 9, 272, 156),
('10/11/2016', '10/11/2016', NULL, 'TCE', '2016', '11', 'Sim', 440, 0, 281, 152),
('11/10/2016', '25/10/2016', NULL, 'TA', '2016', '10', 'Sim', 432, 9, 275, 152),
('25/02/2016', '30/12/2016', NULL, 'TCE', '2016', '10', 'Sim', 433, 0, 275, 152),
('22/11/2016', '22/11/2016', NULL, 'TCE', '2016', '11', 'Sim', 450, 9, 280, 152),
('22/11/2016', '30/11/2016', NULL, 'TA', '2016', '11', 'Nao', 451, 9, 280, 152),
('03/11/2016', '03/11/2016', NULL, 'TCE', '2016', '11', 'Nao', 439, 1, 279, 158),
('28/11/2016', '30/11/2016', NULL, 'TCE', '2016', '11', 'Nao', 441, 0, 281, 152),
('15/11/2016', '15/11/2016', NULL, 'TCE', '2016', '11', 'Nao', 448, 9, 271, 156),
('01/03/2016', '01/09/2016', NULL, 'TCE', '2016', '11', 'Nao', 452, 9, 275, 152);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `idEmpresa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Vaga_idVaga` int(10) unsigned DEFAULT NULL,
  `Administrador_idAdministrador` int(10) unsigned DEFAULT NULL,
  `Empresa` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Cnpj` varchar(50) DEFAULT NULL,
  `Telefone` varchar(50) DEFAULT NULL,
  `Endereco` varchar(100) NOT NULL,
  `Responsavel` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`idEmpresa`),
  KEY `Empresa_FKIndex1` (`Administrador_idAdministrador`),
  KEY `Empresa_FKIndex2` (`Vaga_idVaga`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`idEmpresa`, `Vaga_idVaga`, `Administrador_idAdministrador`, `Empresa`, `Cnpj`, `Telefone`, `Endereco`, `Responsavel`, `Email`) VALUES
(10, NULL, NULL, 'Tribunal de JustiÃ§a Eleitoral', '01.234.567/8911-11', '061982261418', 'Qs', 'RomÃ¡rio Macedo Portela', 'romario@ucb.br'),
(11, NULL, NULL, 'MinistÃ©rio das RelaÃ§Ãµes Exterioeres', '12345', '33569076', '5', '', ''),
(12, NULL, NULL, 'PresidÃªncia da Republica', '4294967295', '34113353', '', '', ''),
(14, NULL, NULL, 'ELY AssunÃ§Ã£o Contabilidade e Audit. LTDA ME', '4294967295', '32251058', '', '', ''),
(15, NULL, NULL, 'ServiÃ§o de Limpeza Urbana SLU', '4294967295', '32130146', '', '', ''),
(16, NULL, NULL, 'SESC - ServiÃ§o Social do ComÃ©rcio', '0', '34519105', '', '', ''),
(17, NULL, NULL, 'BRB - Banco de BrasÃ­lia', '208000100', '34128087', '', '', ''),
(18, NULL, NULL, 'Tribunal Regional Federal', '4294967295', '34103932', '', '', ''),
(19, NULL, NULL, 'BB PrevidÃªncia - Fundo de PensÃ£o Banco do Brasil', '4294967295', '0', '', '', ''),
(105, NULL, NULL, 'Empresa da Kerlen', '98.765.432/1234-56', '(61)33569076', 'Recanto', 'Kerlen ', 'kerlen@empresadakerlen.com'),
(23, NULL, NULL, 'Senado Federal', '4294967295', '33033722', '', '', ''),
(24, NULL, NULL, 'SENAC - ServiÃ§o Nacional de Aprendizagem Comercia', '4294967295', '33460629', '', '', ''),
(25, NULL, NULL, 'ETECON - Contabilidade e Auditoria Ltda', '4294967295', '4294967295', '', '', ''),
(80, NULL, NULL, 'Sociedade Porvir Cientifico', '0', '0', '', '', ''),
(29, NULL, NULL, 'Kawin Sorvetes Ltda', '4294967295', '33574769', '', '', ''),
(30, NULL, NULL, 'A Crescer ServiÃ§os de OrientaÃ§Ã£o a Empreend. SA', '4294967295', '32464314', '', '', ''),
(31, NULL, NULL, 'Municipio de Belo Horizonte', '4294967295', '0', '', '', ''),
(79, NULL, NULL, 'Sociedade Porvir Cientifico', '0', '0', '', '', ''),
(36, NULL, NULL, 'NN Assessoria e Consultoria Empresarial', '4294967295', '32232205', '', '', ''),
(37, NULL, NULL, 'Defensoria Publica Geral da UniÃ£o - DPGU', '4294967295', '33194325', '', '', ''),
(38, NULL, NULL, 'Postalis Inst. Seg. Soc Correiros', '4294967295', '21026966', '', '', ''),
(39, NULL, NULL, 'ServiÃ§o Nacional de Aprendizagem Industrial - Dep', '4294967295', '33179384', '', '', ''),
(40, NULL, NULL, 'Empresa Brasileira de Correios e TelÃ©grafos', '4294967295', '0', '', '', ''),
(41, NULL, NULL, 'Fundo Nacional de Desenvolvimento da EducaÃ§Ã£o', '4294967295', '20224476', '', '', ''),
(42, NULL, NULL, 'Centro de Ensino Unificado', '4294967295', '37048836', '', '', ''),
(43, NULL, NULL, 'Superintendencia Nacional de Previdencia Complemen', '4294967295', '20212066', '', '', ''),
(44, NULL, NULL, 'Caixa EconÃ´mica Federal - BrasÃ­lia Norte', '4294967295', '32037373', '', '', ''),
(45, NULL, NULL, 'Fisiotrauma - ClÃ­nica de Fisioterapia e EstÃ©tica', '4294967295', '32451301', '', '', ''),
(46, NULL, NULL, 'Banco do Brasil S.A.', '317047', '39625114', '', '', ''),
(47, NULL, NULL, 'Conselho Federal de Enfermagem - COFEN', '0', '0', '', '', ''),
(48, NULL, NULL, 'AM1 & Carvalho Goumert Eireli ME', '4294967295', '39634670', '', '', ''),
(49, NULL, NULL, 'Globo ComunicaÃ§Ã£o e ParticipaÃ§Ãµes', '4294967295', '33169370', '', '', ''),
(50, NULL, NULL, 'GEAP - AutogestÃ£o em Saude', '4294967295', '21034740', '', '', ''),
(51, NULL, NULL, 'Centro de ReabilitaÃ§Ã£o Fisio Vatale ME', '4294967295', '39320333', '', '', ''),
(52, NULL, NULL, 'Agencia Nac. de Transportes Terrestres ANTT', '4294967295', '34101156', '', '', ''),
(53, NULL, NULL, 'Caixa Seguradora', '4294967295', '0', '', '', ''),
(54, NULL, NULL, 'Empresa de Tecnologia e Info. da Prev. Social DATA', '4294967295', '32627131', '', '', ''),
(55, NULL, NULL, 'Universidade de BrasÃ­lia', '12.345.678/9101-11', '33569076', 'qs', '', ''),
(56, NULL, NULL, 'Agencia Nac. Petroleo Gas Natural e BiocombustÃ­ve', '4294967295', '0', '', '', ''),
(57, NULL, NULL, 'Supremo Tribunal Federal STF', '4294967295', '32173314', '', '', ''),
(58, NULL, NULL, 'VALEC Eng. Constr. Ferrovias', '4294967295', '20296321', '', '', ''),
(59, NULL, NULL, 'Instituto Presbiteriano Mackenzie', '4294967295', '0', '', '', ''),
(60, NULL, NULL, 'Tribunal de Contas da UniÃ£o - TCU', '4294967295', '33167115', '', '', ''),
(61, NULL, NULL, 'ResoluÃ§Ã£o Apoio Escolar e Psicopedagogigo', '4294967295', '33446041', '', '', ''),
(62, NULL, NULL, 'USBEE - ColÃ©gio Marista', '4294967295', '34264600', '', '', ''),
(63, NULL, NULL, 'Prefeitura Municipal de ValparaÃ­so', '4294967295', '0', '', '', ''),
(64, NULL, NULL, 'Super Kids AssistÃªncia PedagÃ³gica', '4294967295', '33496679', '', '', ''),
(65, NULL, NULL, 'Instituto de EducaÃ§Ã£o Avancada', '4294967295', '39614358', '', '', ''),
(66, NULL, NULL, 'Escola das NaÃ§Ãµes Centro de EducaÃ§Ã£o e Cultura', '4294967295', '3361800', '', '', ''),
(67, NULL, NULL, 'Vasco Neto Sport Ltda', '4294967295', '30371890', '', '', ''),
(68, NULL, NULL, 'Escola de EducaÃ§Ã£o Infantil Bem me Quer', '4294967295', '37979320', '', '', ''),
(69, NULL, NULL, 'Sociedade Porvir Cientifico', '12.345.678/9101-11', '35521494', 'Qs 6', 'Lucas Carvalho', 'romario@ucb'),
(70, NULL, NULL, 'Instituto FecomÃ©rcio - IF', '0', '0', '', '', ''),
(71, NULL, NULL, 'Agencia Nacional de VigilÃ¢ncia SanitÃ¡ria - Anvis', '25.002.222/1555-55', '0', 'qss sss ', 'Lucas Carvalho', 'romario@ucb.br'),
(72, NULL, NULL, 'MÃ³dulo Security Solutions S.A.', '4294967295', '32187515', '', '', ''),
(73, NULL, NULL, 'Instituto de Pesquisa Eldorado', '4294967295', '32463509', '', '', ''),
(74, NULL, NULL, 'ConfederaÃ§Ã£o Nacional das Coop. dos Sicoob Ltda', '4294967295', '32185164', '', '', ''),
(77, NULL, NULL, 'Procuradoria Regional da RepÃºblica 1Âª RegiÃ£o', '0', '0', '', '', ''),
(88, NULL, NULL, 'Circuito da VisÃ£o', '98.765.432/1012-34', '0', 'Sudoeste', 'Lucas Carvalho', 'lucas@circuito.com'),
(89, NULL, NULL, 'UCB', '12.345.678/9101-11', '6133569076', 'Qs 07', 'RomÃ¡rio', 'ucb@ucb.br'),
(103, NULL, NULL, 'Empresa do RomÃ¡rio', '05.712.387/5061-23', '(61)82261418', 'Qs 11 onj K', 'RomÃ¡rio Macedo Portela', 'romario@ucb.br'),
(104, NULL, NULL, 'Empresa do Marcos', '01.234.567/8912-34', '(61)33569076', 'GURA1', 'Marcos Teixeira', 'mteixeira@ucb.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encaminhamento`
--

CREATE TABLE IF NOT EXISTS `encaminhamento` (
  `Inicio` varchar(50) NOT NULL,
  `Fim` varchar(50) NOT NULL,
  `Recisao` date DEFAULT NULL,
  `Relatorio` varchar(50) NOT NULL,
  `anoDocumento` varchar(50) NOT NULL,
  `mesDocumento` varchar(50) NOT NULL,
  `Entregue` varchar(50) NOT NULL,
  `idEncaminhamento` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cursoDocumento` int(50) NOT NULL,
  `idVaga_Encaminhamento` int(50) NOT NULL,
  `idAluno_Encaminhamento` int(254) NOT NULL,
  PRIMARY KEY (`idEncaminhamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=429 ;

--
-- Extraindo dados da tabela `encaminhamento`
--

INSERT INTO `encaminhamento` (`Inicio`, `Fim`, `Recisao`, `Relatorio`, `anoDocumento`, `mesDocumento`, `Entregue`, `idEncaminhamento`, `cursoDocumento`, `idVaga_Encaminhamento`, `idAluno_Encaminhamento`) VALUES
('02/10/2016', '02/10/2016', NULL, 'TCE', '2016', '10', 'Sim', 427, 1, 255, 51),
('03/11/2016', '03/11/2016', NULL, 'TCE', '2016', '11', 'Sim', 428, 7, 258, 64);

-- --------------------------------------------------------

--
-- Estrutura da tabela `oportunidade`
--

CREATE TABLE IF NOT EXISTS `oportunidade` (
  `idOportunidade` int(11) NOT NULL AUTO_INCREMENT,
  `Empresa` varchar(100) NOT NULL,
  `Curso` varchar(100) NOT NULL,
  `Descricao` varchar(1000) NOT NULL,
  `numeroVaga` varchar(50) NOT NULL,
  `Cargo` varchar(100) NOT NULL,
  `Data` date NOT NULL,
  PRIMARY KEY (`idOportunidade`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `oportunidade`
--

INSERT INTO `oportunidade` (`idOportunidade`, `Empresa`, `Curso`, `Descricao`, `numeroVaga`, `Cargo`, `Data`) VALUES
(1, 'Tribunal de JustiÃ§a Eleitoral', 'CIÃŠNCIAS ECONÃ”MICAS', 'casa', '3', 'Auxiliar', '2016-11-18'),
(2, 'Tribunal de JustiÃ§a Eleitoral', 'CIÃŠNCIAS CONTÃBEIS', 'Estagio', '3', 'EstagiÃ¡rio', '2016-11-18'),
(3, 'Tribunal de JustiÃ§a Eleitoral', 'BIOMEDICINA', 'Dar aulas aos alunos da UCB ', '5', 'Professor Orientador', '2016-11-21'),
(4, 'Tribunal de JustiÃ§a Eleitoral', 'CST - ANÃLISE E DESENV. DE SISTEMAS', 'Administrar as coisas administrativas ', '5', 'EstagiÃ¡rio em AdministraÃ§Ã£o', '2016-11-22'),
(5, 'A Crescer ServiÃ§os de OrientaÃ§Ã£o a Empreend. SA', 'CST - GASTRONOMIA', 'Programar sistemas', '2', 'EstagiÃ¡rio em Sistemas de InformaÃ§Ã£o', '2016-11-22'),
(6, 'A Crescer ServiÃ§os de OrientaÃ§Ã£o a Empreend. SA', 'CST - GASTRONOMIA', 'Programar sistemas', '2', 'EstagiÃ¡rio em Sistemas de InformaÃ§Ã£o', '2016-11-22'),
(7, 'A Crescer ServiÃ§os de OrientaÃ§Ã£o a Empreend. SA', 'CST - GASTRONOMIA', 'Programar sistemas', '2', 'EstagiÃ¡rio em Sistemas de InformaÃ§Ã£o', '2016-11-22'),
(14, 'Banco do Brasil S.A.', 'CIÃŠNCIAS DA COMPUTAÃ‡ÃƒO<br/>EAD - ADMINISTRAÃ‡ÃƒO', 'Programar sistemas em sistemas da informaÃ§Ã£o', '3', 'EstagiÃ¡rio em Sistemas de InformaÃ§Ã£o', '2016-11-24'),
(13, 'A Crescer ServiÃ§os de OrientaÃ§Ã£o a Empreend. SA', 'ADMINISTRAÃ‡ÃƒO<br/>CIÃŠNCIAS DA COMPUTAÃ‡ÃƒO<br/>EAD - GESTAO DE RECURSOS HUMANOS', '<p><strong>Empresa:</strong> privada &ndash;99393/Sem.: 2&ordm; ao 3&ordm;/ Vagas: 1/ Taguatinga/ Bolsa: R$ 600,00 +AT/ Per&iacute;odo: A combinar/ Conhec. Exigido; Pacote Office/ Enviar curr&iacute;culos para: curriculos.iel@sistemafibra.org.br e no assunto coloque:99393.<br />\r\n<strong>Empresa:</strong> privada &ndash;99655/Sem.: 1&ordm; ao 2&ordm;/ Vagas: 1/ Taguatinga/ Bolsa: R$ 500,00 +AT/ Per&iacute;odo: 12h &agrave;s18h/ Conhec. Exigido; Curricular/ Enviar curr&iacute;culos para: curriculos.iel@sistemafibra.org.br e no assunto coloque:99655.</p>\r\n', '1', 'EstagiÃ¡rio em Sistemas de InformaÃ§Ã£o', '2016-11-24'),
(12, 'EstÃ¡gio', 'ARQUITETURA E URBANISMO, BIOMEDICINA, CIÃŠNCIAS BIOLÃ“GICAS, CIÃŠNCIAS CONTÃBEIS, CIÃŠNCIAS ECONÃ”M', '0', '52', 'Auxiliar', '2016-11-23'),
(15, 'A Crescer ServiÃ§os de OrientaÃ§Ã£o a Empreend. SA', 'ADMINISTRAÃ‡ÃƒO<br/>ARQUITETURA E URBANISMO<br/>EAD - ADMINISTRAÃ‡ÃƒO<br/>EAD - TURISMO', '<p>&nbsp;</p>\r\n\r\n<hr />\r\n<p><strong>Plano de atividades&nbsp;</strong></p>\r\n\r\n<hr />\r\n<p>&nbsp;</p>\r\n', '2', 'Professor Orientador', '2016-11-25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedagogico`
--

CREATE TABLE IF NOT EXISTS `pedagogico` (
  `idPedagogico` int(11) NOT NULL AUTO_INCREMENT,
  `Semestre` varchar(10) NOT NULL,
  `Orientador` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Orientacao` varchar(500) NOT NULL,
  `idCurso` varchar(50) NOT NULL,
  PRIMARY KEY (`idPedagogico`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `pedagogico`
--

INSERT INTO `pedagogico` (`idPedagogico`, `Semestre`, `Orientador`, `Email`, `Orientacao`, `idCurso`) VALUES
(1, '1', 'Sardinha', 'aluno@ucb.br', 'pode', '2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `idPerfil` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idPerfil`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

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
(81),
(82),
(83),
(84),
(85),
(86);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Login` char(50) DEFAULT NULL,
  `Senha` char(50) DEFAULT NULL,
  `Nome` varchar(100) NOT NULL,
  `Nivel` int(254) NOT NULL,
  `Matricula` varchar(50) NOT NULL,
  `Cargo` varchar(50) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Login`, `Senha`, `Nome`, `Nivel`, `Matricula`, `Cargo`) VALUES
(27, 'mteixeira', '102030', 'Marcos Teixeira Rodrigues', 2, '04010352', 'Auxiliar'),
(18, 'wasoares', '123456', 'Wagner Alves', 1, '', ''),
(25, 'romario', '91726418', 'ROMARIO MACEDO PORTELA', 1, '04081289', 'Auxiliar'),
(26, 'kerlen.silva', '123456', 'KERLEN SILVA RABELO', 1, '04081289', 'Auxiliar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

CREATE TABLE IF NOT EXISTS `vaga` (
  `idVaga` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Usuario_idUsuario` varchar(50) DEFAULT NULL,
  `Aluno` varchar(50) NOT NULL,
  `Empresa` char(100) DEFAULT NULL,
  `Agente` char(100) DEFAULT NULL,
  `Carga` int(10) unsigned DEFAULT NULL,
  `Bolsa` int(254) unsigned DEFAULT NULL,
  `Inicio` date NOT NULL,
  `Recisao` varchar(254) NOT NULL DEFAULT '-',
  `idAluno_Vaga` int(254) NOT NULL,
  `idEmpresa_Vaga` int(254) NOT NULL,
  `cursoVaga` varchar(50) NOT NULL,
  `mesVaga` varchar(50) NOT NULL,
  `anoVaga` varchar(50) NOT NULL,
  PRIMARY KEY (`idVaga`),
  KEY `Vaga_FKIndex1` (`Usuario_idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=260 ;

--
-- Extraindo dados da tabela `vaga`
--

INSERT INTO `vaga` (`idVaga`, `Usuario_idUsuario`, `Aluno`, `Empresa`, `Agente`, `Carga`, `Bolsa`, `Inicio`, `Recisao`, `idAluno_Vaga`, `idEmpresa_Vaga`, `cursoVaga`, `mesVaga`, `anoVaga`) VALUES
(251, '25', '', 'Tribunal de JustiÃ§a Eleitoral', 'CIEE - CENTRO DE INTEGRAÃ‡ÃƒO EMPRESA ESCOLA', 20, 500, '2016-02-25', '', 82, 0, '1', '10', '2016'),
(255, '25', '', 'Tribunal de JustiÃ§a Eleitoral', 'STAG CENTRAL DE ESTÃGIOS S.S LTDA', 20, 500, '2016-10-24', '', 51, 0, '1', '10', '2016'),
(259, '25', 'REINALDO ARAUJO GREGOLDO', 'ETECON - Contabilidade e Auditoria Ltda', 'IEGE', 20, 500, '2016-11-07', '07/11/2016', 51, 0, '2', '11', '2016'),
(258, '25', 'VIVIANE DA SILVA ROSA', 'ELY AssunÃ§Ã£o Contabilidade e Audit. LTDA ME', 'CIEE - CENTRO DE INTEGRAÃ‡ÃƒO EMPRESA ESCOLA', 20, 500, '2016-02-25', '', 64, 0, '7', '10', '2016');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagapresencial`
--

CREATE TABLE IF NOT EXISTS `vagapresencial` (
  `idVaga` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Usuario_idUsuario` varchar(50) DEFAULT NULL,
  `Aluno` varchar(50) NOT NULL,
  `Empresa` char(100) DEFAULT NULL,
  `Agente` char(100) DEFAULT NULL,
  `Carga` int(10) unsigned DEFAULT NULL,
  `Bolsa` int(254) unsigned DEFAULT NULL,
  `Inicio` date NOT NULL,
  `Recisao` varchar(254) NOT NULL DEFAULT '-',
  `idAluno_Vaga` int(254) NOT NULL,
  `idEmpresa_Vaga` int(254) NOT NULL,
  `cursoVaga` varchar(50) NOT NULL,
  `mesVaga` varchar(50) NOT NULL,
  `anoVaga` varchar(50) NOT NULL,
  PRIMARY KEY (`idVaga`),
  KEY `Vaga_FKIndex1` (`Usuario_idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=285 ;

--
-- Extraindo dados da tabela `vagapresencial`
--

INSERT INTO `vagapresencial` (`idVaga`, `Usuario_idUsuario`, `Aluno`, `Empresa`, `Agente`, `Carga`, `Bolsa`, `Inicio`, `Recisao`, `idAluno_Vaga`, `idEmpresa_Vaga`, `cursoVaga`, `mesVaga`, `anoVaga`) VALUES
(271, '18', '', 'Tribunal de JustiÃ§a Eleitoral', 'STAG CENTRAL DE ESTÃGIOS S.S LTDA', 20, 500, '2016-02-25', '', 156, 0, '9', '8', '2016'),
(272, '25', '', 'ServiÃ§o de Limpeza Urbana SLU', '', 20, 500, '2016-02-25', '', 156, 0, '9', '10', '2016'),
(275, '25', '', 'MinistÃ©rio das RelaÃ§Ãµes Exterioeres', 'CIEE - CENTRO DE INTEGRAÃ‡ÃƒO EMPRESA ESCOLA', 30, 500, '2016-02-25', '', 152, 0, '9', '10', '2016'),
(279, '25', 'LORENA OLIVEIRA DRUMOND', 'Tribunal de JustiÃ§a Eleitoral', 'IEL', 20, 500, '2016-02-25', '', 158, 0, '1', '10', '2016'),
(280, '25', 'ROMARIO MACEDO PORTELA', 'Empresa do Marcos', 'STAG CENTRAL DE ESTÃGIOS S.S LTDA', 30, 500, '2016-05-21', '16/11/2016', 152, 0, '9', '10', '2016'),
(284, '25', 'Marcos Teixeira Rodrigues', 'Tribunal de JustiÃ§a Eleitoral', 'STAG CENTRAL DE ESTÃGIOS S.S LTDA', 20, 500, '2016-02-25', '', 159, 0, '2', '11', '2016');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
