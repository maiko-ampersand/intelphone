<div class="departments index">
<h2><?php _h('部署・肩書名管理'); ?></h2>
<p>
	<a href="/departments/add" class="btn btn-primary">新規追加</a>
</p>
  <table class="table table-striped table-hover ">
  	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name','部署・肩書名'); ?></th>
			<th><?php echo $this->Paginator->sort('yomi','読みがな（複数存在する場合はカンマ区切り）'); ?></th>
			<th class="actions"><?php echo __('操作'); ?></th>
		</tr>
  	</thead>
    <tbody>
		<?php foreach ($departments as $department): ?>
		<tr>
			<td><?php echo h($department['Department']['id']); ?>&nbsp;</td>
			<td><?php echo h($department['Department']['name']); ?>&nbsp;</td>
			<td><?php echo h($department['Department']['yomi']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $department['Department']['id'])); ?>
				<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $department['Department']['id']), null, __('本当に削除してもよろしいですか？ #管理番号:%s', $department['Department']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
    </tbody>
  </table>
</div>
