<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\Model;


/**
 * Description of Entity
 *
 * @author romario
 */
class Entity {
    
    const administrador = 'Administrador\Entity\Administrador';
    const usuario = 'Administrador\Entity\Usuario';
    const oportunidade = 'Oportunidade\Entity\Oportunidade';
    const alunoEad = 'Aluno\Entity\Aluno';
    const aluno = 'Aluno\Entity\AlunoPresencial';
    const em           = 'Doctrine\ORM\EntityManager';
    const empresa      = 'Empresa\Entity\Empresa';
    const agente = 'Empresa\Entity\Agente';
    const dados = 'Base\Entity\DadosPresencial';
    const dadosEad    = 'Base\Entity\Dados';
    const vaga = 'Vaga\Entity\VagaPresencial';
    const documento = 'Vaga\Entity\DocumentoPresencial';
    const documentoEad = 'Vaga\Entity\Encaminhamento';
    const acompanhamento = 'Vaga\Entity\Acompanhamento';
    const mensagem = 'Base\Entity\Mensagem';
    const AdministradorController = 'Administrador\Controller';
    
  
}
