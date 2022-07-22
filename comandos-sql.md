
```sql
CREATE TABLE usuarios(
    id SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    email VARCHAR() NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM ('admin','editor') NOT NULL
);
CREATE TABLE noticias(
    id MEDIUMINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    data DATETIME NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    texto TEXT NOT NULL,
    resumo TINYTEXT NOT NULL,
    imagem ENUM ('sim','nao') NOT NULL,
    usuario_id SMALLINT NULL,
    categorias_id SMALLINT NULL
);
CREATE TABLE categorias(
    id SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL
);
ALTER TABLE noticias 
    ADD CONSTRAINT fk_noticias_usuarios_idx
    FOREIGN KEY (usuarios_id) REFERENCES usuarios(id) ON DELETE SET NULL ON UPDATE NO ACTION;
ALTER TABLE noticias 
    ADD CONSTRAINT fk_noticias_categorias1_idx
    FOREIGN KEY (categorias_id) REFERENCES categorias(id) ON DELETE SET NULL ON UPDATE NO ACTION;
