<div class="text-sub-bar-score-card text-sub-bar-score-card-p" style="margin-left: 25px;margin-right: 5px;">Grupo de Trabajo:</div>
<div>
     <select id="cbo-group-tree" name="cbo-group-tree">
          <?php foreach($list as $row):  ?>
              <option value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>
          <?php endforeach; ?>
              <option   value="add" onclick="javascript:open_new_group();">Agregar nuevo grupo de trabajo</option>
    </select>
</div>