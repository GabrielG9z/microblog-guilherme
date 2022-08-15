<?php
namespace Microblog;
use PDO, Exception;

final class Noticia{
    private int $id;
    private string $nome;
    private string $data;
    private string $titulo;
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

    public function inserir():void
    {
        $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem , destaque, usuario_id, categoria_id) VALUES(:titulo, :texto, :resumo, :imagem , :destaque, :usuario_id, :categoria_id)";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":titulo", $this->titulo, PDO::PARAM_STR);
            $consulta->bindParam(":texto", $this->texto, PDO::PARAM_STR);
            $consulta->bindParam(":resumo", $this->resumo, PDO::PARAM_STR);
            $consulta->bindParam(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindParam(":destaque", $this->destaque, PDO::PARAM_STR);
            $consulta->bindParam(":categoria_id", $this->categoriaId, PDO::PARAM_INT);
            $consulta->bindValue(":usuario_id",$this->usuario->getId(), PDO::PARAM_INT);
            $consulta->execute();
            
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
    }
    public function upload(array $arquivo){
        /* Definindo os formatos aceitos*/
        $tiposValidos = [
            "image/png",
            "image/jpeg",
            "image/gif",
            "image/svg+xml"
        ];
        if(!in_array($arquivo['type'], $tiposValidos))
        {
            die("<script>
            alert('Formato inválido!');
            history.back();
            </script>"
            );
        }
        /* acessar apenas o nome do arquivo */
        $nome = $arquivo['name'];

        /* acessando os dados de acesso temporário */
        $temporario = $arquivo['tmp_name'];

        /* Definindo a pasta de distino junto com o nome do arquivo */
        $destino = "../imagem/".$nome;

        /* Usamos a função abaico para pegar a área temporária e enviar para a pasta de destino (com o nome do arquivo) */
        move_uploaded_file($temporario, $destino);
    }
    public function listar():array{
       if($this->usuario->getTipo() === 'admin' ){
        $sql = "SELECT noticias.id, noticias.data, noticias.titulo ,noticias.destaque, usuarios.nome AS autor FROM noticias LEFT JOIN usuarios ON noticias.usuario_id = usuarios.id  ORDER BY data DESC";
        }else{
            $sql = "SELECT id, data, titulo , destaque FROM noticias
            WHERE usuario_id = :usuario_id ORDER BY data DESC";
        }


        try{
            $consulta = $this->conexao->prepare($sql);
            if($this->usuario->getTipo()!=='admin'){
            $consulta->bindValue(":usuario_id",$this->usuario->getId(), PDO::PARAM_INT);
            }
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
        return $resultado;
    }

    public function listarUm():array{
        if($this->usuario->getTipo() === 'admin' ){
            $sql = "SELECT titulo, texto, resumo, imagem, categoria_id, usuario_id, destaque FROM noticias WHERE id = :id";
            }else{
                $sql = "SELECT titulo, texto, resumo, imagem, categoria_id, usuario_id, destaque FROM noticias WHERE id = :id AND usuario_id = :usuario_id";
            }
    
    
            try{
                $consulta = $this->conexao->prepare($sql);
                $consulta->bindParam(":id",$this->id, PDO::PARAM_INT);

                if($this->usuario->getTipo()!=='admin'){
                    $consulta->bindValue(":usuario_id",$this->usuario->getId(), PDO::PARAM_INT);
                }
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            }catch(Exception $erro){
                die("Erro:". $erro->getMessage());
            }
            return $resultado;
        }
        public function atualizar():void{
            if($this->usuario->getTipo() === 'admin' ){
                $sql = "UPDATE noticias SET titulo = :titulo, texto = :texto, resumo = :resumo, imagem = :imagem, categoria_id = :categoria_id, destaque = :destaque WHERE id = :id";
            }else{
                $sql = "UPDATE noticias SET titulo = :titulo, texto = :texto, resumo = :resumo, imagem = :imagem, categoria_id = :categoria_id, destaque = :destaque WHERE id = :id AND usuario_id = :usuario_id";
            }
            
            try{
                $consulta = $this->conexao->prepare($sql);
                $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);  
                $consulta->bindParam(":titulo", $this->titulo, PDO::PARAM_STR);  
                $consulta->bindParam(":texto", $this->texto, PDO::PARAM_STR);  
                $consulta->bindParam(":imagem", $this->imagem, PDO::PARAM_STR);  
                $consulta->bindParam(":resumo", $this->resumo, PDO::PARAM_STR);  
                $consulta->bindParam(":destaque", $this->destaque, PDO::PARAM_STR);  
                $consulta->bindParam(":categoria_id", $this->categoriaId, PDO::PARAM_INT);  
                if($this->usuario->getTipo()!=='admin'){
                    $consulta->bindValue(":usuario_id",$this->usuario->getId(), PDO::PARAM_INT);
                }
                $consulta->execute();
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
    }
    public function excluir():void{
        if($this->usuario->getTipo() === 'admin' ){
        $sql = "DELETE FROM noticias WHERE id = :id";
        }else{
            $sql = "DELETE FROM noticias WHERE id = :id AND usuario_id = :usuario_id";
        }
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);
            
            if($this->usuario->getTipo()!=='admin'){
                $consulta->bindValue(":usuario_id",$this->usuario->getId(), PDO::PARAM_INT);
            }
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: " .$erro->getMessage());
        }
    }
        /* médotos para área pública */
    public function listarDestaque():array{
        $sql = "SELECT titulo, imagem, resumo, id FROM noticias WHERE destaque = :destaque ORDER BY data DESC";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":destaque",$this->destaque, PDO::PARAM_STR);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: " .$erro->getMessage());
        }
        return $resultado;
    } 
    public function listarTodos():array{
        $sql = "SELECT data, titulo, resumo, id FROM noticias ORDER BY data DESC";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: " .$erro->getMessage());
        }
        return $resultado;
    } 
    public function listarUmaNoticia():array{
        $sql = "SELECT noticias.id, noticias.data, noticias.titulo, noticias.imagem, noticias.texto, noticias.usuario_id, usuarios.nome AS autor FROM noticias LEFT JOIN usuarios ON noticias.usuario_id = usuarios.id WHERE noticias.id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: " .$erro->getMessage());
        }
        return $resultado;
    } 
    public function listarPorCategoria():array{
        $sql = "SELECT noticias.id, noticias.data,noticias.titulo, noticias.resumo,  noticias.usuario_id, noticias.categoria_id, usuarios.nome AS autor, categorias.id, categorias.nome FROM noticias INNER JOIN usuarios ON noticias.usuario_id = usuarios.id INNER JOIN categorias ON noticias.categoria_id = categorias.id WHERE categorias.id = :categoria_id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":categoria_id", $this->categoriaId, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetchALL(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: " .$erro->getMessage());
        }
        return $resultado;
    } 






































    /* GETTERS E SETTERS */
    
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

    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }
    public function setCategoriaId(int $categoriaId)
    {
        $this->categoriaId = $categoriaId;
    }
    
    public function getTitulo(): string
    {
        return $this->titulo;
    }
    public function setTitulo(string $titulo)
    {
        $this->titulo = $titulo;
    }
}