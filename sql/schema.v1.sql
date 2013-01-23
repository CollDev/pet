CREATE TABLE BoletaMaterial (id INT IDENTITY NOT NULL, boleta_recepcion_id INT NULL, tarifa_id INT NULL, neto NUMERIC(10, 2) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_6426AC67D1DEFD ON BoletaMaterial (boleta_recepcion_id);
CREATE INDEX IDX_6426ACFE3B76B ON BoletaMaterial (tarifa_id);
CREATE TABLE BoletaRecepcion (id INT IDENTITY NOT NULL, cliente_id INT NULL, unidad_id INT NULL, fecha_ingreso DATETIME2(6) NOT NULL, fecha_salida DATETIME2(6) NOT NULL, total NUMERIC(10, 2) NOT NULL, tara NUMERIC(10, 2) NOT NULL, neto NUMERIC(10, 2) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_C261B852DE734E51 ON BoletaRecepcion (cliente_id);
CREATE INDEX IDX_C261B8529D01464C ON BoletaRecepcion (unidad_id);
CREATE TABLE Cliente (id INT IDENTITY NOT NULL, estado_id INT NULL, razon_social NVARCHAR(200) NOT NULL, ruc NVARCHAR(100) NOT NULL, direccion NVARCHAR(200) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_3BA1A2B99F5A440B ON Cliente (estado_id);
CREATE TABLE Estado (id INT IDENTITY NOT NULL, nombre NVARCHAR(100) NOT NULL, PRIMARY KEY (id));
CREATE TABLE Incidencia (id INT IDENTITY NOT NULL, tipo_incidencia_id INT NULL, estado_id INT NULL, unidad_id INT NULL, fecha_incidencia DATETIME2(6) NOT NULL, maquinaria NVARCHAR(200) NOT NULL, observacion NVARCHAR(200) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_889B715CE1D308BC ON Incidencia (tipo_incidencia_id);
CREATE INDEX IDX_889B715C9F5A440B ON Incidencia (estado_id);
CREATE INDEX IDX_889B715C9D01464C ON Incidencia (unidad_id);
CREATE TABLE IncidenciaResolucion (id INT IDENTITY NOT NULL, incidencia_id INT NULL, fecha_resolucion DATETIME2(6) NOT NULL, resolucion NVARCHAR(200) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_F2A3DE1EE1605BE2 ON IncidenciaResolucion (incidencia_id);
CREATE TABLE Indicador (id INT IDENTITY NOT NULL, nombre NVARCHAR(100) NOT NULL, estandar NVARCHAR(200) NOT NULL, PRIMARY KEY (id));
CREATE TABLE LiquidacionMaterial (id INT IDENTITY NOT NULL, cliente_id INT NULL, fecha_liquidacion DATETIME2(6) NOT NULL, importe NUMERIC(10, 2) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_7C8604E3DE734E51 ON LiquidacionMaterial (cliente_id);
CREATE TABLE LiquidacionMaterialDetalle (id INT IDENTITY NOT NULL, importe NUMERIC(10, 2) NOT NULL, PRIMARY KEY (id));
CREATE TABLE LiquidacionRecepcion (id INT IDENTITY NOT NULL, cliente_id INT NULL, estado_id INT NULL, fecha_liguidacion DATETIME2(6) NOT NULL, fecha_inicio DATETIME2(6) NOT NULL, fecha_fin DATETIME2(6) NOT NULL, importe NUMERIC(10, 2) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_247E0671DE734E51 ON LiquidacionRecepcion (cliente_id);
CREATE INDEX IDX_247E06719F5A440B ON LiquidacionRecepcion (estado_id);
CREATE TABLE Material (id INT IDENTITY NOT NULL, nombre NVARCHAR(200) NOT NULL, stock INT NOT NULL, PRIMARY KEY (id));
CREATE TABLE MovimientoIndicador (id INT IDENTITY NOT NULL, indicador_id INT NULL, estado_id INT NULL, valor INT NOT NULL, fecha_movimiento DATETIME2(6) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_1FDC64FD47D487D1 ON MovimientoIndicador (indicador_id);
CREATE INDEX IDX_1FDC64FD9F5A440B ON MovimientoIndicador (estado_id);
CREATE TABLE Pedido (id INT IDENTITY NOT NULL, cliente_id INT NULL, estado_id INT NULL, fecha_programacion DATETIME2(6) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_C34013F8DE734E51 ON Pedido (cliente_id);
CREATE INDEX IDX_C34013F89F5A440B ON Pedido (estado_id);
CREATE TABLE PedidoDetalle (id INT IDENTITY NOT NULL, pedido_id INT NULL, material_id INT NULL, cantidad INT NOT NULL, importe NUMERIC(10, 2) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_A15C58864854653A ON PedidoDetalle (pedido_id);
CREATE INDEX IDX_A15C5886E308AC6F ON PedidoDetalle (material_id);
CREATE TABLE Tarifa (id INT IDENTITY NOT NULL, nombre NVARCHAR(200) NOT NULL, valor NUMERIC(10, 2) NOT NULL, PRIMARY KEY (id));
CREATE TABLE TipoIncidencia (id INT IDENTITY NOT NULL, nombre NVARCHAR(100) NOT NULL, PRIMARY KEY (id));
CREATE TABLE Topes (id INT IDENTITY NOT NULL, indicador_id INT NULL, unidad_medida_id INT NULL, descripcion NVARCHAR(200) NOT NULL, acumulado NUMERIC(10, 2) NOT NULL, previo NUMERIC(10, 2) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_ED83AE7747D487D1 ON Topes (indicador_id);
CREATE INDEX IDX_ED83AE772E003F4 ON Topes (unidad_medida_id);
CREATE TABLE Unidad (id INT IDENTITY NOT NULL, estado_id INT NULL, marca NVARCHAR(200) NOT NULL, fecha_mantenimiento DATETIME2(6) NOT NULL, kilometraje INT NOT NULL, tiempo DATETIME2(6) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_F44AD5199F5A440B ON Unidad (estado_id);
CREATE TABLE UnidadMedida (id INT IDENTITY NOT NULL, nombre NVARCHAR(100) NOT NULL, valor NUMERIC(10, 2) NOT NULL, PRIMARY KEY (id));
ALTER TABLE BoletaMaterial ADD CONSTRAINT FK_6426AC67D1DEFD FOREIGN KEY (boleta_recepcion_id) REFERENCES BoletaRecepcion (id);
ALTER TABLE BoletaMaterial ADD CONSTRAINT FK_6426ACFE3B76B FOREIGN KEY (tarifa_id) REFERENCES Tarifa (id);
ALTER TABLE BoletaRecepcion ADD CONSTRAINT FK_C261B852DE734E51 FOREIGN KEY (cliente_id) REFERENCES Cliente (id);
ALTER TABLE BoletaRecepcion ADD CONSTRAINT FK_C261B8529D01464C FOREIGN KEY (unidad_id) REFERENCES Unidad (id);
ALTER TABLE Cliente ADD CONSTRAINT FK_3BA1A2B99F5A440B FOREIGN KEY (estado_id) REFERENCES Estado (id);
ALTER TABLE Incidencia ADD CONSTRAINT FK_889B715CE1D308BC FOREIGN KEY (tipo_incidencia_id) REFERENCES TipoIncidencia (id);
ALTER TABLE Incidencia ADD CONSTRAINT FK_889B715C9F5A440B FOREIGN KEY (estado_id) REFERENCES Estado (id);
ALTER TABLE Incidencia ADD CONSTRAINT FK_889B715C9D01464C FOREIGN KEY (unidad_id) REFERENCES Unidad (id);
ALTER TABLE IncidenciaResolucion ADD CONSTRAINT FK_F2A3DE1EE1605BE2 FOREIGN KEY (incidencia_id) REFERENCES Incidencia (id);
ALTER TABLE LiquidacionMaterial ADD CONSTRAINT FK_7C8604E3DE734E51 FOREIGN KEY (cliente_id) REFERENCES Cliente (id);
ALTER TABLE LiquidacionRecepcion ADD CONSTRAINT FK_247E0671DE734E51 FOREIGN KEY (cliente_id) REFERENCES Cliente (id);
ALTER TABLE LiquidacionRecepcion ADD CONSTRAINT FK_247E06719F5A440B FOREIGN KEY (estado_id) REFERENCES Estado (id);
ALTER TABLE MovimientoIndicador ADD CONSTRAINT FK_1FDC64FD47D487D1 FOREIGN KEY (indicador_id) REFERENCES Indicador (id);
ALTER TABLE MovimientoIndicador ADD CONSTRAINT FK_1FDC64FD9F5A440B FOREIGN KEY (estado_id) REFERENCES Estado (id);
ALTER TABLE Pedido ADD CONSTRAINT FK_C34013F8DE734E51 FOREIGN KEY (cliente_id) REFERENCES Cliente (id);
ALTER TABLE Pedido ADD CONSTRAINT FK_C34013F89F5A440B FOREIGN KEY (estado_id) REFERENCES Estado (id);
ALTER TABLE PedidoDetalle ADD CONSTRAINT FK_A15C58864854653A FOREIGN KEY (pedido_id) REFERENCES Pedido (id);
ALTER TABLE PedidoDetalle ADD CONSTRAINT FK_A15C5886E308AC6F FOREIGN KEY (material_id) REFERENCES Material (id);
ALTER TABLE Topes ADD CONSTRAINT FK_ED83AE7747D487D1 FOREIGN KEY (indicador_id) REFERENCES Indicador (id);
ALTER TABLE Topes ADD CONSTRAINT FK_ED83AE772E003F4 FOREIGN KEY (unidad_medida_id) REFERENCES UnidadMedida (id);
ALTER TABLE Unidad ADD CONSTRAINT FK_F44AD5199F5A440B FOREIGN KEY (estado_id) REFERENCES Estado (id);