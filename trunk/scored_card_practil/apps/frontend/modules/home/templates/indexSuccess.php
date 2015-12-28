<div id="contenedor-home-init">
    <div class="cls-table-row">
        <div class="cls-table-cell cls-cell-size" >
            <div class="cls-btn-on-left on" onclick="javascript:document.location.href ='<?php echo url_for('@strategy') ?>' ">
                <div class="btn-row1">
                    <div class="image-btn">
                        <span class="btn-label-number">1</span>
                    </div>
                </div>
                <div class="btn-row2">
                    <div><h4>Crear estrategia </h4></div>
                    <div><span>
                         
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php $class = ($count>0)? 'on' : 'off' ; ?>
        <div class="cls-table-cell cls-cell-size" >
            <div class="cls-btn-on-right <?php echo $class ?>" <?php if($class=="on"): ?> onclick="javascript:document.location.href='<?php echo url_for('@list_strategy?select=list') ?>' " <?php endif; ?>>
                 <div class="btn-row1">
                    <div class="image-btn">
                        <span class="btn-label-number">2</span>
                    </div>
                </div>
                <div class="btn-row2">
                      <div><h4>Editar estrategia?</h4></div>
                    <div><span>
                           
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cls-table-row">        
        <div class="cls-table-cell cls-cell-size" >
            <div class="cls-btn-on-left on" onclick="javascript:document.location.href='<?php echo url_for('@list_working_groups') ?>';">
                 <div class="btn-row1">
                    <div class="image-btn">
                        <span class="btn-label-number">3</span>
                    </div>
                </div>
                <div class="btn-row2">
                    <?php $text = ($countGroup>0)? 'Administrar grupos' : 'Crear grupo de trabajo' ; ?>
                    <div><h4><?php echo $text ?></h4></div>
                    <div><span>
                           
                        </span>
                    </div>
                </div>

            </div>
        </div>
        <div class="cls-table-cell cls-cell-size">
            <div class="cls-btn-on-right off">
                
                 <div class="btn-row1">
                    <div class="image-btn">
                        <span class="btn-label-number">4</span>
                    </div>
                </div>
                <div class="btn-row2">
                    <div><h4>Administrar evaluaciones de desempeño</h4></div>
                    <div><span>
                            
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
