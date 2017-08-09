<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Base\Model;
/**
 * Description of Constantes
 *
 * @author romario
 */
class Constantes {
    
    const contadorPorPagina = '10';
    const rotaAdministradorDefault = 'administrador/default';
    const rotaAlunoDefault = 'aluno/default';
    const rotaEmpresaDefault = 'empresa/default';
    const administrador = 'administrador';
    const aluno = 'alunoPresencial';
    //Controllers
    const AdministradorController = 'Administrador\Controller';
    const EmpresaController = 'Empresa\Controller';
    const AlunoController = 'Aluno\Controller';
    const RelatorioController = 'Relatorio\Controller';
    const BaseController = 'Base\Controller';
    const AuthController = 'Auth\Controller';
    const VagaController = 'Vaga\Controller';
    const codigoEmpresa = 'u2';
    const codigoAdministrador = 'u1';
    const codigoAluno = 'u3';
    
    //actions módulo: administrador 
    const todosAlunos = 'todosAlunos';
    const cadastrarUsuario = 'cadastrarUsuario';
    const usuario = 'usuario';
    const excluirUsuario = 'excluirUsuario';
    const editarUsuario = 'editarUsuario';
    const excluirAluno = 'excluirAluno';
    const editarAluno = 'editarAluno';
    const empresa = 'empresa';
    const agente = 'agente';
    const editarEmpresa = 'editarEmpresa';
    const editarAgente = 'editarAgente';
    const excluirEmpresa = 'excluirEmpresa';
    const excluirAgente = 'excluirAgente';
    const documentos = 'documentosPresencial';
    const documentosPendente = 'documentosPresencialPendente';
    const mensagem = 'mensagem';
    
    //actions módulo: Auth
    const login = 'login';
    const loginAluno = 'loginAluno';
    const loginEmpresa = 'loginEmpresa';
    
    
    
    
    
}