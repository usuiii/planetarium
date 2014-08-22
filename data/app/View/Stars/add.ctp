<div class="stars form">
<?php echo $this->Form->create('Star'); ?>
	<fieldset>
		<legend><?php echo __('Add Star'); ?></legend>
	<?php
		echo $this->Form->input('columns');
		echo $this->Form->input('ra_deg');
		echo $this->Form->input('de_deg');
		echo $this->Form->input('multi_flag');
		echo $this->Form->input('vmag');
		echo $this->Form->input('variable_flg');
		echo $this->Form->input('greek_name');
		echo $this->Form->input('other_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Stars'), array('action' => 'index')); ?></li>
	</ul>
</div>
