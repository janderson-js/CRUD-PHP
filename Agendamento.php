<?php
class Agendamento{
    
    private int $id;
    private string $dataRegistroAgendamento;
    private string $dataAgendamento;
    private string $horaAgendamento;
    private string $status;
    private string $titulo;
    private string $cor;
    

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getDataRegistroAgendamento(): string
    {
        return $this->dataRegistroAgendamento;
    }

    public function setDataRegistroAgendamento(string $dataRegistroAgendamento): self
    {
        $this->dataRegistroAgendamento = $dataRegistroAgendamento;

        return $this;
    }

    public function getDataAgendamento(): string
    {
        return $this->dataAgendamento;
    }

    public function setDataAgendamento(string $dataAgendamento): self
    {
        $this->dataAgendamento = $dataAgendamento;

        return $this;
    }

    public function getHoraAgendamento(): string
    {
        return $this->horaAgendamento;
    }

    public function setHoraAgendamento(string $horaAgendamento): self
    {
        $this->horaAgendamento = $horaAgendamento;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getCor(): string
    {
        return $this->cor;
    }

    public function setCor(string $cor): self
    {
        $this->cor = $cor;

        return $this;
    }
}