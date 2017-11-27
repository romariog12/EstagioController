CREATE TABLE Administrador (
  idAdministrador INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome VARCHAR(50) NULL,
  Login VARCHAR(20) NULL,
  Senha VARCHAR(20) NULL,
  Matricula CHAR(10) NULL,
  PRIMARY KEY(idAdministrador)
);

CREATE TABLE Aluno (
  idAluno INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idInstituicao INTEGER UNSIGNED NOT NULL,
  Nome VARCHAR(100) NULL,
  Email VARCHAR(50) NULL,
  Cpf CHAR(11) NULL,
  Telefone VARCHAR(20) NULL,
  Curso VARCHAR(50) NULL,
  Matricula VARCHAR(20) NULL,
  PRIMARY KEY(idAluno, idInstituicao),
  INDEX Aluno_FKIndex1(idInstituicao)
);

CREATE TABLE Dados (
  idDados INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idInstituicao INTEGER UNSIGNED NOT NULL,
  Curso VARCHAR(50) NULL,
  codCurso CHAR(3) NULL,
  Meta INTEGER UNSIGNED NULL,
  Orientador VARCHAR(100) NULL,
  PRIMARY KEY(idDados, idInstituicao),
  INDEX Dados_FKIndex1(idInstituicao)
);

CREATE TABLE Documento (
  idDocumento INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idEmpresa INTEGER UNSIGNED NOT NULL,
  idAluno INTEGER UNSIGNED NOT NULL,
  idEstagio INTEGER UNSIGNED NOT NULL,
  Estagio_idInstituicao INTEGER UNSIGNED NOT NULL,
  Inicio DATE NULL,
  Fim DATE NULL,
  PRIMARY KEY(idDocumento, idEmpresa, idAluno, idEstagio, Estagio_idInstituicao),
  INDEX Documento_FKIndex1(idEstagio, idAluno, idEmpresa, Estagio_idInstituicao)
);

CREATE TABLE Empresa (
  idEmpresa INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome VARCHAR(100) NULL,
  Cnpj CHAR(14) NULL,
  Endereco VARCHAR(200) NULL,
  Email VARCHAR(50) NULL,
  PRIMARY KEY(idEmpresa)
);

CREATE TABLE Estagio (
  idEstagio INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idAluno INTEGER UNSIGNED NOT NULL,
  idEmpresa INTEGER UNSIGNED NOT NULL,
  idInstituicao INTEGER UNSIGNED NOT NULL,
  Inicio DATE NULL,
  Fim DATE NULL,
  dataEstagio DATE NULL,
  PRIMARY KEY(idEstagio, idAluno, idEmpresa, idInstituicao),
  INDEX Estagio_FKIndex1(idAluno, idInstituicao),
  INDEX Estagio_FKIndex2(idEmpresa)
);

CREATE TABLE Instituicao (
  idInstituicao INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome VARCHAR(100) NULL,
  Endereco VARCHAR(100) NULL,
  Cnpj CHAR(14) NULL,
  Telefone VARCHAR(20) NULL,
  PRIMARY KEY(idInstituicao)
);

CREATE TABLE Processo (
  idProcesso INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idEstagio INTEGER UNSIGNED NOT NULL,
  idAluno INTEGER UNSIGNED NOT NULL,
  idEmpresa INTEGER UNSIGNED NOT NULL,
  idDocumento INTEGER UNSIGNED NOT NULL,
  Operacao1 CHAR BINARY NULL,
  Operacao2 CHAR BINARY NULL,
  Operacao3 CHAR BINARY NULL,
  Operacao4 CHAR BINARY NULL,
  dataLancamento DATE NULL,
  PRIMARY KEY(idProcesso, idEstagio, idAluno, idEmpresa, idDocumento),
  INDEX Processo_FKIndex1(idDocumento, idEmpresa, idAluno, idEstagio)
);


