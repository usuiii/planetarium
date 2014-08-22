<div class="stars view">
<h2><?php echo __('Star'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($star['Star']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Columns'); ?></dt>
		<dd>
			<?php echo h($star['Star']['columns']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ra Deg'); ?></dt>
		<dd>
			<?php echo h($star['Star']['ra_deg']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('De Deg'); ?></dt>
		<dd>
			<?php echo h($star['Star']['de_deg']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Multi Flag'); ?></dt>
		<dd>
			<?php echo h($star['Star']['multi_flag']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vmag'); ?></dt>
		<dd>
			<?php echo h($star['Star']['vmag']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Variable Flg'); ?></dt>
		<dd>
			<?php echo h($star['Star']['variable_flg']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Greek Name'); ?></dt>
		<dd>
			<?php echo h($star['Star']['greek_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Other Name'); ?></dt>
		<dd>
			<?php echo h($star['Star']['other_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($star['Star']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($star['Star']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Star'), array('action' => 'edit', $star['Star']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Star'), array('action' => 'delete', $star['Star']['id']), array(), __('Are you sure you want to delete # %s?', $star['Star']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Star'), array('action' => 'add')); ?> </li>
	</ul>
</div>
