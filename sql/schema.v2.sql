CREATE TABLE RecepcionMaterial (id INT IDENTITY NOT NULL, boleta_recepcion_id INT NULL, material_id INT NULL, unidad_medida_id INT NULL, fecha_ingreso DATETIME2(6) NOT NULL, cantidad NUMERIC(10, 2) NOT NULL, PRIMARY KEY (id));
CREATE INDEX IDX_D5E7A41C67D1DEFD ON RecepcionMaterial (boleta_recepcion_id);
CREATE INDEX IDX_D5E7A41CE308AC6F ON RecepcionMaterial (material_id);
CREATE INDEX IDX_D5E7A41C2E003F4 ON RecepcionMaterial (unidad_medida_id);
ALTER TABLE RecepcionMaterial ADD CONSTRAINT FK_D5E7A41C67D1DEFD FOREIGN KEY (boleta_recepcion_id) REFERENCES BoletaRecepcion (id);
ALTER TABLE RecepcionMaterial ADD CONSTRAINT FK_D5E7A41CE308AC6F FOREIGN KEY (material_id) REFERENCES Material (id);
ALTER TABLE RecepcionMaterial ADD CONSTRAINT FK_D5E7A41C2E003F4 FOREIGN KEY (unidad_medida_id) REFERENCES UnidadMedida (id)
