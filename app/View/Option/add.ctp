<?php echo $this->Form->create('Employee',array('class'=>'form-horizontal well bs-component')); ?>
<fieldset>
  <legend>利用者新規追加</legend>
  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">内線番号</label>
    <div class="col-lg-10">
      <?php echo $this->Form->input('foword_no', array('label' => false ,'class'=>'form-control', 'div' => false)); ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">氏名</label>
    <div class="col-lg-10">
      <?php echo $this->Form->input('last_name', array('label' => false ,'class'=>'form-control', 'div' => false)); ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">読みがな・呼称</label>
    <div class="col-lg-10">
      <?php echo $this->Form->input('first_name', array('label' => false ,'class'=>'form-control', 'div' => false)); ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">転送先番号</label>
    <div class="col-lg-10">
      <?php echo $this->Form->input('phone_no', array('label' => false ,'class'=>'form-control', 'div' => false)); ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">所属</label>
    <div class="col-lg-10">
      <?php echo $this->Form->input('department_id', array('label' => false ,'class'=>'form-control', 'div' => false)); ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
      <input type="submit" class="btn btn-primary" value="登録">
    </div>
  </div>
</fieldset>
<?php echo $this->Form->end(); ?>
