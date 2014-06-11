
<?php echo $this->Form->create('Department',array('class'=>'form-horizontal well bs-component')); ?>
<fieldset>
  <legend>部署・肩書新規追加</legend>
  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">部署・肩書</label>
    <div class="col-lg-10">
      <?php echo $this->Form->input('name', array('label' => false ,'class'=>'form-control', 'div' => false)); ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">読みがな・呼称</label>
    <div class="col-lg-10">
      <?php echo $this->Form->input('yomi', array('label' => false ,'class'=>'form-control', 'div' => false)); ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
      <input type="submit" class="btn btn-primary" value="登録">
    </div>
  </div>
</fieldset>
<?php echo $this->Form->input('id'); ?>	
<?php echo $this->Form->end(); ?>
