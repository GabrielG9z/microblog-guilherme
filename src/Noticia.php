<?php
namespace Microblog;
use PDO, Exception;

final class Noticia{
    private int $id;
    private string $nome;
    private string $data;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private int $categoriaId;

    /* 
    Criando uma propriedade do tipo usuario, ou seja, a partir de uma classe que criamos com o objetivo de reutilizar recursos dela
    
    Isto permitirá fazer uma ASSOCIAÇÃO entre classes.
    */
    public Usuario $usuario;
    private PDO $conexao;

    public function __construct()
    {
        /* No momento em que um objeto Noticia for instanciado nas páginas, aproveitaremos para também instanciar um objeto Usuario e com isso acessar recursos desta classe. */
        $this->usuario = new Usuario;
        $this->conexao = $this->usuario->getConexao();
    }














    public function getConexao():PDO
    {
        return $this->conexao;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);

    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);

    }
    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data)
    {
        $this->data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);

    }

    public function getTexto(): string
    {
        return $this->texto;
    }

    public function setTexto(string $texto)
    {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);

    }

    public function getResumo(): string
    {
        return $this->resumo;
    }

    public function setResumo(string $resumo)
    {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);

    }

    public function getImagem(): string
    {
        return $this->imagem;
    }

    public function setImagem(string $imagem)
    {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);

    }

    public function getDestaque(): string
    {
        return $this->destaque;
    }

    public function setDestaque(string $destaque)
    {
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);

    }

}