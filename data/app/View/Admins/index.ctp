<?php $this->Wamp->init(); ?>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
$(document).ready(function(){
    $('#send_button').click(function(){
        cakeWamp.publish('Plugin.TopicName', {
            type: 'eventObject',
            text:$('#message_text').val()
        });
    });

    $('#start_button').click(function(){
        cakeWamp.publish('Planetarium', {
            type: 'eventObject',
            text:$('#message_text').val()
        });
    });
});
<?php $this->Html->scriptEnd(); ?>

<?php echo $this->Form->create(); ?>
<?php echo $this->Form->input('message', array('id' => 'message_text')); ?>
<?php echo $this->Form->end(array('label' => 'send', 'type' => 'button', 'id' => 'send_button')); ?>
<?php echo $this->Form->create(); ?>
<?php echo $this->Form->end(array('label' => 'planetarium', 'type' => 'button', 'id' => 'start_button')); ?>
