<!--MODAL EDITAR-->
<div class="modal fade edit_crit_eva<?php echo $rb_crit_eva['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel" align="center">Editar Detalle de Criterio de Evaluación</h4>
      </div>
      <div class="modal-body">
        <!--INICIO CONTENIDO DE MODAL-->
        <form action="#">
          <div class="x_panel">
            <div class="x_content">
              <br />

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Detalle : </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <?php
                  ?>
                  <input type="text" class="form-control" required="" value="<?php echo $rb_crit_eva['detalle']; ?>" id="detalle_crit_eva_<?php echo $rb_crit_eva['id'];?>">
                  <br>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ponderado : </label>
                <div class="col-md-3 col-sm-3 col-xs-6">
                  <?php
                  ?>
                  <input type="number" class="form-control" required="" value="<?php echo $rb_crit_eva['ponderado']; ?>" id="ponderado_crit_eva_<?php echo $rb_crit_eva['id'];?>">
                  <br>
                </div>
              </div>
              <div class="clearfix"></div>
              <div align="center">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="actualizarCritEvaluacion(<?php echo $rb_crit_eva['id'].', '.$mostrar_eva['id'].', '.$id_calificacion.', '.$rb_crit_eva['orden']; ?>)">Guardar</button>
              </div>

            </div>
          </div>
        </form>
        <!--FIN DE CONTENIDO DE MODAL-->
      </div>
    </div>
  </div>
</div>