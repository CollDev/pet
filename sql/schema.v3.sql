CREATE TABLE Usuario (id INT IDENTITY NOT NULL, nombre NVARCHAR(100) NOT NULL, usuario NVARCHAR(100) NOT NULL, password NVARCHAR(50) NOT NULL, salt NVARCHAR(100) NOT NULL, perfil INT NOT NULL, PRIMARY KEY (id))
