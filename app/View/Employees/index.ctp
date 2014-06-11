<div class="employees index">
<h2><?php _h('利用者管理'); ?></h2>
<p>
	<a href="/employees/add" class="btn btn-primary">新規追加</a>
</p>
  <table class="table table-striped table-hover ">
  	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id','管理番号'); ?></th>
			<th><?php echo $this->Paginator->sort('foword_no','内線番号'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id','所属部署'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name','氏名'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name','読みがな・呼称'); ?></th>
			<th><?php echo $this->Paginator->sort('phone_no','転送先電話番号'); ?></th>
			<th>着電受付時間</th>
			<th class="actions"><?php echo __('操作'); ?></th>
		</tr>
  	</thead>
    <tbody>
		<?php foreach ($employees as $employee): ?>
		<tr>
			<td><?php echo h($employee['Employee']['id']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['foword_no']); ?>&nbsp;</td>

			<td>
				<?php echo h($departments[$employee['Employee']['department_id']]); ?>
				&nbsp;
			</td>
			<td><?php echo h($employee['Employee']['last_name']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['first_name']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['phone_no']); ?>&nbsp;</td>
			<td>9:00 〜 19:00</td>
			<td class="actions">
				<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $employee['Employee']['id'])); ?>
				<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $employee['Employee']['id']), null, __('本当に削除してもよろしいですか？ #管理番号:%s', $employee['Employee']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
    </tbody>
  </table>
</div>
