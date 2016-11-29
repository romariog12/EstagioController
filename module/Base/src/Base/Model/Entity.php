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
    const alunoPresencial = 'Aluno\Entity\AlunoPresencial';
    const em           = 'Doctrine\ORM\EntityManager';
    const empresa      = 'Administrador\Entity\Empresa';
    const agente = 'Administrador\Entity\Agente';
    const dadosPresencial = 'Base\Entity\DadosPresencial';
    const dadosEad    = 'Base\Entity\Dados';
    const vagaEad = 'Vaga\Entity\Vaga';
    const vagaPresencial = 'Vaga\Entity\VagaPresencial';
    const documentoPresencial = 'Vaga\Entity\DocumentoPresencial';
    const documentoEad = 'Vaga\Entity\Encaminhamento';
    
  
}
