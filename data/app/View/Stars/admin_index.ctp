<div class="stars index">
	<h2><?php echo __('Stars'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('columns'); ?></th>
			<th><?php echo $this->Paginator->sort('ra_deg'); ?></th>
			<th><?php echo $this->Paginator->sort('de_deg'); ?></th>
			<th><?php echo $this->Paginator->sort('multi_flag'); ?></th>
			<th><?php echo $this->Paginator->sort('vmag'); ?></th>
			<th><?php echo $this->Paginator->sort('variable_flg'); ?></th>
			<th><?php echo $this->Paginator->sort('greek_name'); ?></th>
			<th><?php echo $this->Paginator->sort('other_name'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($stars as $star): ?>
	<tr>
		<td><?php echo h($star['Star']['id']); ?>&nbsp;</td>
		<td><?php echo h($star['Star']['columns']); ?>&nbsp;</td>
		<td><?php echo h($star['Star']['ra_deg']); ?>&nbsp;</td>
		<td><?php echo h($star['Star']['de_deg']); ?>&nbsp;</td>
		<td><?php echo h($star['Star']['multi_flag']); ?>&nbsp;</td>
		<td><?php echo h($star['Star']['vmag']); ?>&nbsp;</td>
		<td><?php echo h($star['Star']['variable_flg']); ?>&nbsp;</td>
		<td><?php echo h($star['Star']['greek_name']); ?>&nbsp;</td>
		<td><?php echo h($star['Star']['other_name']); ?>&nbsp;</td>
		<td><?php echo h($star['Star']['modified']); ?>&nbsp;</td>
		<td><?php echo h($star['Star']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $star['Star']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $star['Star']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $star['Star']['id']), array(), __('Are you sure you want to delete # %s?', $star['Star']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Star'), array('action' => 'add')); ?></li>
	</ul>
</div>
