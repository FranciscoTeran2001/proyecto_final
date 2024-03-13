

 <div class="modal" id=addDocenteModal>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Datos del docente &raquo; Agregar datos</h2>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <hr />
            </div>
            <div class="modal-body addEmpleado">
             
                    <div class="form-group">
                        <label>Nombre del Docente</label>
						 <select id="nombre_docente_input" class="form-control" required>
                            <?php
                            while($row_docente = mysqli_fetch_assoc($resultado_nombres_docentes)) {
                                echo "<option value='{$row_docente['nombre_usuario']}'>{$row_docente['nombre_usuario']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cédula de Identidad</label>
                        <input type="text" id="cedula_docente_input" class="form-control" placeholder="Cédula de Identidad" required>
                    </div>
                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="email" id="correo_docente_input" class="form-control" placeholder="Correo Electrónico">
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" id="telefono_docente_input" class="form-control" placeholder="Teléfono">
                    </div>
                    <div class="form-group">
                        <label>Especialización</label>
                        <input type="text" id="especializacion_docente_input" class="form-control" placeholder="Especialización">
                    </div>
                    <div class="form-group">
                        <label>Horas de Clases</label>
                        <input type="number" id="horas_clase_docente_input" class="form-control" placeholder="Horas de Clases">
                    </div>
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="modal-footer">
                             <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Agregar" onclick="addEmpleado()">
                        </div>
                    </div>
               
            </div>
        </div>
    </div>
</div>
