<div class="options index">
<h2><?php _h('オプション管理'); ?></h2>
<?php echo $this->Form->create('',array('class'=>'form-horizontal well bs-component')); ?>
<fieldset>
  <div class="form-group">
    <label class="col-lg-2 control-label">始業・電話受付開始時間</label>
    <small>営業時間外の架電は指定の留守電メッセージを流します。</small>
    <div class="col-lg-10">
      <?php echo $this->Form->input('opeing_time', array('label' => false ,'class'=>'form-control', 'div' => false)); ?>
    </div>
  </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">終業・電話受付終了時間</label>
        <small>営業時間外の架電は指定の留守電メッセージを流します。</small>
        <div class="col-lg-10">
            <?php echo $this->Form->input('ending_time', array('label' => false ,'class'=>'form-control', 'div' => false)); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">代表電話番号</label>
        <small>転送先が見つからない場合この番号へ転送します。</small>
        <div class="col-lg-10">
            <?php echo $this->Form->input('pilot_number', array('label' => false ,'class'=>'form-control', 'div' => false)); ?>
        </div>
    </div>
  <div class="form-group">
    <label class="col-lg-2 control-label">留守電メッセージ</label>
    <div class="col-lg-10">
      <?php echo $this->Form->input('answering_machine_message', array('label' => false ,'type'=>'textarea', 'class'=>'form-control', 'div' => false)); ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
      <input type="submit" class="btn btn-primary" value="登録">
    </div>
  </div>
</fieldset>
<?php  echo $this->Form->input('id'); ?>
<?php echo $this->Form->end(); ?>
</div>
