<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mensagem
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 * @ORM\Table(name="mensagem")
 * @ORM\Entity (repositoryClass="Base\Entity\MensagemRepository")
 */
class Mensagem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMensagem", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmensagem;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Titulo", type="string", length=1000, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="idDestinatario", type="string", length=50, nullable=false)
     */
    private $iddestinatario;

    /**
     * @var string
     *
     * @ORM\Column(name="Mensagem", type="text", length=16777215, nullable=false)
     */
    private $mensagem;
     /**
     * @var string
     *
     * @ORM\Column(name="Remetente", type="text", length=100, nullable=false)
     */
    private $remetente;
     /**
     * @var string
     *
     * @ORM\Column(name="Status", type="text", length=100, nullable=false)
     */
    private $status = '0';
        /**
     * @var \DateTime
     *
     * @ORM\Column(name="Data", type="date", nullable=false)
     */
    private $data;
    function getIdmensagem() {
        return $this->idmensagem;
    }

    function getEmail() {
        return $this->email;
    }

    function getTitulo() {
        return $this->titulo;
    }
    function getRemetente() {
        return $this->remetente;
    }

    function getStatus() {
        return $this->status;
    }

        function getIddestinatario() {
        return $this->iddestinatario;
    }

    function getMensagem() {
        return $this->mensagem;
    }
    function getData() {
        return $this->data;
    }

    function setIdmensagem($idmensagem) {
        $this->idmensagem = $idmensagem;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
        return $this;
    }

    function setIddestinatario($iddestinatario) {
        $this->iddestinatario = $iddestinatario;
        return $this;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
        return $this;
    }
    function setRemetente($remetente) {
        $this->remetente = $remetente;
        return $this;
    }

    function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    function setData(\DateTime $data) {
        $this->data = $data;
        return $this;
    }




}

