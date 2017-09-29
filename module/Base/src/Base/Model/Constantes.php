<?php


namespace Base\Model;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class Constantes {
    //View
    const temaBootstrap = 'primary';
    const contadorPorPagina = '100';
    const cadastroSucesso = 'Cadastro realizado com sucesso!';
    const alteraçãoSucesso = 'Alterações realizada com sucesso!';
    //rotas
    const rotaPerfilAluno = 'perfilAluno';
    const rotaAdministradorDefault = 'administrador/default';
    const rotaAlunoDefault = 'aluno/default';
    const rotaEmpresaDefault = 'empresa/default';
    const rotaPerfilEmpresaDefault = 'perfilEmpresa/default';
    const rotaPerfilAlunoDefault = 'perfilAluno/default';
    const rotaVagaDefault = 'vagaPresencial/default';
    const administrador = 'administrador';
    const aluno = 'alunoPresencial';
    const vaga = 'vagaPresencial';
    const excluir = 'excluir';
    const id = 'id';
    //Controllers
    const AdministradorController = 'Administrador\Controller';
    const EmpresaController = 'Empresa\Controller';
    const AlunoController = 'Aluno\Controller';
    const RelatorioController = 'Relatorio\Controller';
    const BaseController = 'Base\Controller';
    const AuthController = 'Auth\Controller';
    const VagaController = 'vagaPresencial\Controller';
    const codigoEmpresa = 'u2';
    const codigoAdministrador = 'u1';
    const codigoAluno = 'u3';
    
    // actions módulo: administrador 
    const todosAlunos = 'todosAlunos';
    const cadastrarUsuario = 'cadastrarUsuario';
    const usuario = 'usuario';
    const excluirUsuario = 'excluirUsuario';
    const editarUsuario = 'editarUsuario';
    const excluirAluno = 'excluirAluno';
    const editarAluno = 'editarAluno';
    const empresa = 'empresa';
    const perfilAluno = 'perfilAluno';
    const agente = 'agente';
    const editarEmpresa = 'editarEmpresa';
    const editarAgente = 'editarAgente';
    const excluirEmpresa = 'excluirEmpresa';
    const excluirAgente = 'excluirAgente';
    const documentos = 'documentosPresencial';
    const documentosPendente = 'documentosPresencialPendente';
    const mensagem = 'mensagem';
    const cadastrarEmpresa = 'cadastrarEmpresa';
    const cadastrarAgente = 'cadastrarAgente';
    const cadastrarAluno = 'cadastrarAluno';
    const perfilEmpresa = 'perfilEmpresa';
    
    //actions módulo: Auth
    const login = 'login';
    const loginAluno = 'loginAluno';
    const loginEmpresa = 'loginEmpresa'; 
    
    
    const cadastrarVagaPresencial = 'cadastrarVagaPresencial';
    const perfilVagaFinalizada = 'perfilVagaFinalizada';
}